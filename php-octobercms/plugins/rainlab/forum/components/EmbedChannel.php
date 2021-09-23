<?php namespace RainLab\Forum\Components;

use Cms\Classes\Page;
use Cms\Classes\ComponentBase;
use RainLab\Forum\Models\Topic as TopicModel;
use RainLab\Forum\Models\Channel as ChannelModel;
use Exception;

class EmbedChannel extends ComponentBase
{
    /**
     * @var boolean Determine if this component is being used by the EmbedChannel component.
     */
    public $embedMode = true;

    public function componentDetails()
    {
        return [
            'name'        => 'rainlab.forum::lang.embedch.channel_name',
            'description' => 'rainlab.forum::lang.embedch.channel_self_desc'
        ];
    }

    public function defineProperties()
    {
        return [
            'embedCode' => [
                'title'       => 'rainlab.forum::lang.embedch.embed_title',
                'description' => 'rainlab.forum::lang.embedch.embed_desc',
                'type'        => 'string',
                'group'       => 'Parameters',
            ],
            'channelSlug' => [
                'title'       => 'rainlab.forum::lang.embedch.channel_title',
                'description' => 'rainlab.forum::lang.embedch.channel_desc',
                'type'        => 'dropdown'
            ],
            'topicSlug' => [
                'title'       => 'rainlab.forum::lang.embedch.topic_name',
                'description' => 'rainlab.forum::lang.embedch.topic_desc',
                'type'        => 'string',
                'default'     => '{{ :topicSlug }}',
                'group'       => 'Parameters',
            ],
            'memberPage' => [
                'title'       => 'rainlab.forum::lang.member.page_name',
                'description' => 'rainlab.forum::lang.member.page_help',
                'type'        => 'dropdown',
                'group'       => 'Links',
            ],
            'isGuarded' => [
                'title'       => 'Spam Guarded Channel',
                'description' => 'Newly created channels will have spam guard enabled',
                'type'        => 'checkbox',
                'default'     => 0,
                'group'       => 'Parameters',
            ],
        ];
    }

    protected function getChannelSlugOptions()
    {
        return ChannelModel::listsNested('title', 'slug', ' - ');
    }

    public function getMemberPageOptions()
    {
        return Page::sortBy('baseFileName')->lists('baseFileName', 'baseFileName');
    }

    public function init()
    {
        $code = $this->property('embedCode');

        if (!$code) {
            throw new Exception('No code specified for the Forum Embed component');
        }

        $parentChannel = ($channelSlug = $this->property('channelSlug'))
            ? ChannelModel::whereSlug($channelSlug)->first()
            : null;

        if (!$parentChannel) {
            throw new Exception('No channel specified for Forum Embed component');
        }

        $properties = $this->getProperties();

        /*
         * Proxy as topic
         */
        if (input('channel') || $this->property('topicSlug')) {
            $properties['slug'] = '{{' . $this->propertyName('topicSlug') . '}}';
            $component = $this->addComponent('RainLab\Forum\Components\Topic', $this->alias, $properties);
        }
        /*
         * Proxy as channel
         */
        else {
            if ($channel = ChannelModel::forEmbed($parentChannel, $code)->first()) {
                $properties['slug'] = $channel->slug;
            }

            $properties['topicPage'] = $this->page->baseFileName;
            $component = $this->addComponent('RainLab\Forum\Components\Channel', $this->alias, $properties);
            $component->embedTopicParam = $this->paramName('topicSlug');

            /*
             * If a channel does not already exist, generate it when the page ends.
             * This can be disabled by the page setting embedMode to FALSE, for example,
             * if the page returns 404 a channel should not be generated.
             */
            if (!$channel) {
                $this->controller->bindEvent('page.end', function() use ($component, $parentChannel, $code) {
                    if ($component->embedMode !== false) {
                        $channel = ChannelModel::createForEmbed(
                            $code,
                            $parentChannel,
                            $this->page->title,
                            (bool) $this->property('isGuarded')
                        );
                        $component->setProperty('slug', $channel->slug);
                        $component->onRun();
                    }
                });
            }
        }

        /*
         * Set the default embedding mode
         */
        if (input('channel')) {
            $component->embedMode = 'post';
        }
        elseif (input('search')) {
            $component->embedMode = 'search';
        }
        elseif ($this->property('topicSlug')) {
            $component->embedMode = 'topic';
        }
        else {
            $component->embedMode = 'channel';
        }
    }
}
