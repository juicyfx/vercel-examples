<?php namespace RainLab\Forum\Components;

use Auth;
use Flash;
use Event;
use Request;
use Redirect;
use Cms\Classes\Page;
use RainLab\User\Models\User as UserModel;
use RainLab\User\Models\MailBlocker;
use Cms\Classes\ComponentBase;
use ApplicationException;
use RainLab\Forum\Models\Topic as TopicModel;
use RainLab\Forum\Models\Channel as ChannelModel;
use RainLab\Forum\Models\Member as MemberModel;
use RainLab\Forum\Models\Post as PostModel;
use RainLab\Forum\Models\TopicFollow;
use RainLab\Forum\Classes\TopicTracker;
use Exception;

class Topic extends ComponentBase
{
    /**
     * @var boolean Determine if this component is being used by the EmbedChannel component.
     */
    public $embedMode = false;

    /**
     * @var RainLab\Forum\Models\Topic Topic cache
     */
    protected $topic = null;

    /**
     * @var RainLab\Forum\Models\Channel Channel cache
     */
    protected $channel = null;

    /**
     * @var RainLab\Forum\Models\Member Member cache
     */
    protected $member = null;

    /**
     * @var string Reference to the page name for linking to members.
     */
    public $memberPage;

    /**
     * @var string Reference to the page name for linking to channels.
     */
    public $channelPage;

    /**
     * @var string URL to redirect to after posting to the topic.
     */
    public $returnUrl;

    /**
     * @var Collection Posts cache for Twig access.
     */
    public $posts = null;

    public function componentDetails()
    {
        return [
            'name'        => 'rainlab.forum::lang.topicpage.name',
            'description' => 'rainlab.forum::lang.topicpage.self_desc'
        ];
    }

    public function defineProperties()
    {
        return [
            'slug' => [
                'title'       => 'rainlab.forum::lang.topicpage.slug_name',
                'description' => 'rainlab.forum::lang.topicpage.slug_desc',
                'default'     => '{{ :slug }}',
                'type'        => 'string',
            ],
            'postsPerPage' => [
                'title'       => 'rainlab.forum::lang.topicpage.pagination_name',
                'default'     => '20',
                'type'        => 'string',
            ],
            'memberPage' => [
                'title'       => 'rainlab.forum::lang.member.page_name',
                'description' => 'rainlab.forum::lang.member.page_help',
                'type'        => 'dropdown',
                'group'       => 'Links',
            ],
            'channelPage' => [
                'title'       => 'rainlab.forum::lang.topicpage.channel_title',
                'description' => 'rainlab.forum::lang.topicpage.channel_desc',
                'type'        => 'dropdown',
                'group'       => 'Links',
            ],
        ];
    }

    public function getPropertyOptions($property)
    {
        return Page::sortBy('baseFileName')->lists('baseFileName', 'baseFileName');
    }

    public function onRun()
    {
        $this->addCss('assets/css/forum.css');
        $this->addJs('assets/js/forum.js');

        $this->prepareVars();
        $this->page['channel'] = $this->getChannel();
        $this->page['topic']   = $topic = $this->getTopic();
        $this->page['member']  = $member = $this->getMember();
        $this->handleOptOutLinks();

        return $this->preparePostList();
    }

    protected function prepareVars()
    {
        /*
         * Page links
         */
        $this->memberPage   = $this->page['memberPage']  = $this->property('memberPage');
        $this->channelPage  = $this->page['channelPage'] = $this->property('channelPage');
    }

    public function getTopic()
    {
        if ($this->topic !== null) {
            return $this->topic;
        }

        if (!$slug = $this->property('slug')) {
            return null;
        }

        $topic = TopicModel::whereSlug($slug)->first();

        if ($topic) {
            $topic->increaseViewCount();
        }

        return $this->topic = $topic;
    }

    public function getMember()
    {
        if ($this->member !== null) {
            return $this->member;
        }

        return $this->member = MemberModel::getFromUser();
    }

    public function getChannel()
    {
        if ($this->channel !== null) {
            return $this->channel;
        }

        if ($topic = $this->getTopic()) {
            $channel = $topic->channel;
        }
        elseif ($channelId = input('channel')) {
            $channel = ChannelModel::find($channelId);
        }
        else {
            $channel = null;
        }

        // Add a "url" helper attribute for linking to the category
        if ($channel) {
            $channel->setUrl($this->channelPage, $this->controller);
        }

        return $this->channel = $channel;
    }

    public function getChannelList()
    {
        return ChannelModel::make()->getRootList('title', 'id');
    }

    protected function preparePostList()
    {
        /*
         * If topic exists, loads the posts
         */
        if ($topic = $this->getTopic()) {
            $currentPage = input('page');
            $searchString = trim(input('search'));
            $posts = PostModel::with('member.user.avatar')->listFrontEnd([
                'page'    => $currentPage,
                'perPage' => $this->property('postsPerPage'),
                'sort'    => 'created_at',
                'topic'   => $topic->id,
                'search'  => $searchString,
            ]);

            /*
             * Add a "url" helper attribute for linking to each member
             */
            $posts->each(function($post){
                if ($post->member)
                    $post->member->setUrl($this->memberPage, $this->controller);
            });

            $this->page['posts'] = $this->posts = $posts;

            /*
             * Pagination
             */
            $queryArr = [];
            if ($searchString) {
                $queryArr['search'] = $searchString;
            }
            $queryArr['page'] = '';
            $paginationUrl = Request::url() . '?' . http_build_query($queryArr);

            $lastPage = $posts->lastPage();
            if ($currentPage == 'last' || $currentPage > $lastPage && $currentPage > 1) {
                return Redirect::to($paginationUrl . $lastPage);
            }

            $this->page['paginationUrl'] = $paginationUrl;
        }

        /*
         * Set topic as watched
         */
        if ($this->topic && $this->member) {
            TopicTracker::instance()->markTopicTracked($this->topic);
        }

        /*
         * Return URL
         */
        if ($this->getChannel()) {
            if ($this->embedMode == 'single') {
                $returnUrl = null;
            }
            elseif ($this->embedMode) {
                $returnUrl = $this->currentPageUrl([$this->paramName('slug') => null]);
            }
            else {
                $returnUrl = $this->channel->url;
            }

             $this->returnUrl = $this->page['returnUrl'] = $returnUrl;
         }
    }

    protected function handleOptOutLinks()
    {
        if (!$topic = $this->getTopic()) return;
        if (!$action = post('action')) return;
        if (!in_array($action, ['unfollow', 'unsubscribe'])) return;

        /*
         * Attempt to find member using dry authentication
         */
        if (!$member = $this->getMember()) {
            if (!($authCode = post('auth')) || !strpos($authCode, '!')) {
                return;
            }
            list($hash, $userId) = explode('!', $authCode);
            if (!$user = UserModel::find($userId)) {
                return;
            }
            if (!$member = MemberModel::getFromUser($user)) {
                return;
            }

            $expectedCode = TopicFollow::makeAuthCode($action, $topic, $member);
            if ($authCode != $expectedCode) {
                Flash::error('Invalid authentication code, please sign in and try the link again.');
                return;
            }
        }

        /*
         * Unfollow link
         */
        if ($action == 'unfollow') {
            TopicFollow::unfollow($topic, $member);
            Flash::success('You will no longer receive notifications about this topic.');
        }

        /*
         * Unsubscribe link
         */
        if ($action == 'unsubscribe' && $member->user) {
            MailBlocker::addBlock('rainlab.forum::mail.topic_reply', $member->user);
            Flash::success('You will no longer receive notifications about any topics in this forum.');
        }

    }

    public function onCreate()
    {
        try {
            if (!$user = Auth::getUser()) {
                throw new ApplicationException('You should be logged in.');
            }

            $member = $this->getMember();
            $channel = $this->getChannel();
            
            if ($channel->is_moderated && !$member->is_moderator) {
                throw new ApplicationException('You cannot create a topic in this channel.');
            }

            if (TopicModel::checkThrottle($member)) {
                throw new ApplicationException('Please wait a few minutes before posting another topic.');
            }

            if ($member->is_banned) {
                throw new ApplicationException('You cannot create new topics: Your account is banned.');
            }

            $topic = TopicModel::createInChannel($channel, $member, post());
            $topicUrl = $this->currentPageUrl([$this->paramName('slug') => $topic->slug]);

            Flash::success(post('flash', 'Topic created successfully!'));

            /*
             * Extensbility
             */
            Event::fire('rainlab.forum.topic.create', [$this, $topic, $topicUrl]);
            $this->fireEvent('topic.create', [$topic, $topicUrl]);

            /*
             * Redirect to the intended page after successful update
             */
            $redirectUrl = post('redirect', $topicUrl);

            return Redirect::to($redirectUrl);
        }
        catch (Exception $ex) {
            Flash::error($ex->getMessage());
        }
    }

    public function onPost()
    {
        try {
            if (!$user = Auth::getUser()) {
                throw new ApplicationException('You should be logged in.');
            }

            $member = $this->getMember();
            $topic = $this->getTopic();

            if (!$topic || !$topic->canPost()) {
                throw new ApplicationException('You cannot edit posts or make replies.');
            }

            $post = PostModel::createInTopic($topic, $member, post());
            $postUrl = $this->currentPageUrl([$this->paramName('slug') => $topic->slug]);

            TopicFollow::sendNotifications($topic, $post, $postUrl);
            Flash::success(post('flash', 'Response added successfully!'));

            /*
             * Extensbility
             */
            Event::fire('rainlab.forum.topic.post', [$this, $post, $postUrl]);
            $this->fireEvent('topic.post', [$post, $postUrl]);

            /*
             * Redirect to the intended page after successful update
             */
            $redirectUrl = post('redirect', $postUrl);

            return Redirect::to($redirectUrl.'?page=last#post-'.$post->id);
        }
        catch (Exception $ex) {
            Flash::error($ex->getMessage());
        }
    }

    public function onUpdate()
    {
        $this->page['member'] = $member = $this->getMember();

        $topic = $this->getTopic();
        $post = PostModel::find(post('post'));

        if (!$post || !$post->canEdit()) {
            throw new ApplicationException('Permission denied.');
        }

        /*
         * Supported modes: edit, view, delete, save
         */
        $mode = post('mode', 'edit');
        if ($mode == 'save') {
            if (!$topic || !$topic->canPost()) {
                throw new ApplicationException('You cannot edit posts or make replies.');
            }

            $post->fill(post());
            $post->save();

            // First post will update the topic subject
            if ($topic->first_post->id == $post->id) {
                $topic->fill(['subject' => post('subject')]);
                $topic->save();
            }
        }
        elseif ($mode == 'delete') {
            $post->delete();
        }

        $this->page['mode'] = $mode;
        $this->page['post'] = $post;
        $this->page['topic'] = $topic;
    }

    public function onQuote()
    {
        if (!$user = Auth::getUser()) {
            throw new ApplicationException('You should be logged in.');
        }

        if (!$post = PostModel::find(post('post'))) {
            throw new ApplicationException('Unable to find that post.');
        }

        $result = $post->toArray();
        $result['author'] = $post->member ? $post->member->username : '???';

        return $result;
    }

    public function onMove()
    {
        $member = $this->getMember();
        if (!$member->is_moderator) {
            Flash::error('Access denied');
            return;
        }

        $channelId = post('channel');
        $channel = ChannelModel::find($channelId);
        if ($channel) {
            $this->getTopic()->moveToChannel($channel);
            Flash::success(post('flash', 'Post moved successfully!'));
        }
        else {
            Flash::error('Unable to find a channel to move to.');
        }
    }

    public function onFollow()
    {
        try {
            if (!$user = Auth::getUser()) {
                throw new ApplicationException('You should be logged in.');
            }

            $this->page['member'] = $member = $this->getMember();
            $this->page['topic'] = $topic = $this->getTopic();

            TopicFollow::toggle($topic, $member);
            $member->touchActivity();
        }
        catch (Exception $ex) {
            if (Request::ajax()) throw $ex; else Flash::error($ex->getMessage());
        }
    }

    public function onSticky()
    {
        try {
            $member = $this->getMember();
            if (!$member || !$member->is_moderator) {
                throw new ApplicationException('Access denied');
            }

            if ($topic = $this->getTopic()) {
                $topic->stickyTopic();
            }

            $this->page['member'] = $member;
            $this->page['topic']  = $topic;
        }
        catch (Exception $ex) {
            if (Request::ajax()) throw $ex; else Flash::error($ex->getMessage());
        }
    }

    public function onLock()
    {
        try {
            $member = $this->getMember();
            if (!$member || !$member->is_moderator) {
                throw new ApplicationException('Access denied');
            }

            if ($topic = $this->getTopic()) {
                $topic->lockTopic();
            }

            $this->page['member'] = $member;
            $this->page['topic']  = $topic;
        }
        catch (Exception $ex) {
            if (Request::ajax()) throw $ex; else Flash::error($ex->getMessage());
        }
    }
}
