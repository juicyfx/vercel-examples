<?php namespace RainLab\Forum\Components;

use Cms\Classes\Page;
use Cms\Classes\ComponentBase;
use RainLab\Forum\Models\Topic as TopicModel;
use RainLab\Forum\Models\Channel as ChannelModel;
use Exception;

class EmbedTopic extends ComponentBase
{
    /**
     * @var boolean Determine if this component is being used by the EmbedChannel component.
     */
    public $embedMode = true;

    public function componentDetails()
    {
        return [
            'name'        => 'rainlab.forum::lang.embedtopic.topic_name',
            'description' => 'rainlab.forum::lang.embedtopic.topic_self_desc'
        ];
    }

    public function defineProperties()
    {
        return [
            'embedCode' => [
                'title'       => 'rainlab.forum::lang.embedtopic.embed_title',
                'description' => 'rainlab.forum::lang.embedtopic.embed_desc',
                'type'        => 'string',
            ],
            'channelSlug' => [
                'title'       => 'rainlab.forum::lang.embedtopic.target_name',
                'description' => 'rainlab.forum::lang.embedtopic.target_desc',
                'type'        => 'dropdown'
            ],
            'memberPage' => [
                'title'       => 'rainlab.forum::lang.member.page_name',
                'description' => 'rainlab.forum::lang.member.page_help',
                'type'        => 'dropdown',
                'group'       => 'Links',
            ],
        ];
    }

    public function getChannelSlugOptions()
    {
        return ChannelModel::listsNested('title', 'slug', ' - ');
    }

    public function getMemberPageOptions()
    {
        return Page::sortBy('baseFileName')->lists('baseFileName', 'baseFileName');
    }

    public function init()
    {
        $mode = $this->property('mode');
        $code = $this->property('embedCode');

        if (!$code) {
            throw new Exception('No code specified for the Forum Embed component');
        }

        $channel = ($channelSlug = $this->property('channelSlug'))
            ? ChannelModel::whereSlug($channelSlug)->first()
            : null;

        if (!$channel) {
            throw new Exception('No channel specified for Forum Embed component');
        }

        $properties = $this->getProperties();

        /*
         * Proxy as topic
         */
        if ($topic = TopicModel::forEmbed($channel, $code)->first()) {
            $properties['slug'] = $topic->slug;
        }

        $component = $this->addComponent('RainLab\Forum\Components\Topic', $this->alias, $properties);

        /*
         * If a topic does not already exist, generate it when the page ends.
         * This can be disabled by the page setting embedMode to FALSE, for example,
         * if the page returns 404 a topic should not be generated.
         */
        if (!$topic) {
            $this->controller->bindEvent('page.end', function() use ($component, $channel, $code) {
                if ($component->embedMode !== false) {
                    $topic = TopicModel::createForEmbed($code, $channel, $this->page->title);
                    $component->setProperty('slug', $topic->slug);
                    $component->onRun();
                }
            });
        }

        /*
         * Set the embedding mode: Single topic
         */
        $component->embedMode = 'single';
    }
}
