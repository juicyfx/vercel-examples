<?php namespace RainLab\Forum\Components;

use Auth;
use Mail;
use Flash;
use Request;
use Redirect;
use Cms\Classes\Page;
use Cms\Classes\ComponentBase;
use ApplicationException;
use RainLab\Forum\Models\Member as MemberModel;
use RainLab\User\Models\User as UserModel;
use RainLab\User\Models\MailBlocker;
use Exception;

class Member extends ComponentBase
{
    /**
     * @var RainLab\Forum\Models\Member Member cache
     */
    protected $member = null;

    /**
     * @var RainLab\Forum\Models\Member Other member cache
     */
    protected $otherMember = null;

    /**
     * @var array Mail preferences cache
     */
    protected $mailPreferences = null;

    /**
     * @var string Reference to the page name for linking to topics.
     */
    public $topicPage;

    /**
     * @var string Reference to the page name for linking to channels.
     */
    public $channelPage;

    public function componentDetails()
    {
        return [
            'name'        => 'rainlab.forum::lang.memberpage.name',
            'description' => 'rainlab.forum::lang.memberpage.self_desc'
        ];
    }

    public function defineProperties()
    {
        return [
            'slug' => [
                'title'       => 'rainlab.forum::lang.memberpage.slug_name',
                'description' => 'rainlab.forum::lang.memberpage.slug_desc',
                'default'     => '{{ :slug }}',
                'type'        => 'string'
            ],
            'viewMode' => [
                'title'       => 'rainlab.forum::lang.memberpage.view_title',
                'description' => 'rainlab.forum::lang.memberpage.view_desc',
                'type'        => 'dropdown',
                'default'     => ''
            ],
            'channelPage' => [
                'title'       => 'rainlab.forum::lang.memberpage.ch_title',
                'description' => 'rainlab.forum::lang.memberpage.ch_desc',
                'type'        => 'dropdown',
                'group'       => 'Links',
            ],
            'topicPage' => [
                'title'       => 'rainlab.forum::lang.memberpage.topic_title',
                'description' => 'rainlab.forum::lang.memberpage.topic_desc',
                'type'        => 'dropdown',
                'group'       => 'Links',
            ],
        ];
    }

    public function getViewModeOptions()
    {
        return ['' => '- none -', 'view' => 'View', 'edit' => 'Edit'];
    }

    public function getPropertyOptions($property)
    {
        return Page::sortBy('baseFileName')->lists('baseFileName', 'baseFileName');
    }

    public function onRun()
    {
        $this->addCss('assets/css/forum.css');

        $this->prepareVars();
    }

    protected function prepareVars()
    {
        $this->page['member'] = $this->getMember();
        $this->page['otherMember'] = $this->getOtherMember();
        $this->page['mailPreferences'] = $this->getMailPreferences();
        $this->page['canEdit'] = $this->canEdit();
        $this->page['mode'] = $this->getMode();

        /*
         * Page links
         */
        $this->topicPage = $this->page['topicPage'] = $this->property('topicPage');
        $this->channelPage = $this->page['channelPage'] = $this->property('channelPage');
    }

    public function getRecentPosts()
    {
        $member = $this->getMember();
        $posts = $member->posts()->with('topic')->limit(10)->get();

        $posts->each(function($post) {
            $post->topic->setUrl($this->topicPage, $this->controller);
        });

        return $posts;
    }

    public function getMember()
    {
        if ($this->member !== null) {
            return $this->member;
        }

        if (!$slug = $this->property('slug')) {
            $member = MemberModel::getFromUser();
        }
        else {
            $member = MemberModel::whereSlug($slug)->first();
        }

        return $this->member = $member;
    }

    public function getOtherMember()
    {
        if ($this->otherMember !== null) {
            return $this->otherMember;
        }

        return $this->otherMember = MemberModel::getFromUser();
    }

    public function getMailPreferences()
    {
        if ($this->mailPreferences !== null) {
            return $this->mailPreferences;
        }

        $member = $this->getMember();
        if (!$member || !$member->user) {
            return [];
        }

        $preferences = [];
        $blocked = MailBlocker::checkAllForUser($member->user);
        foreach ($this->getMailTemplates() as $alias => $template) {
            $preferences[$alias] = !in_array($template, $blocked);
        }

        return $this->mailPreferences = $preferences;
    }

    public function getMode()
    {
        return $this->property('viewMode') ?: input('mode', 'view');
    }

    public function canEdit()
    {
        if ($this->property('viewMode') == 'view') {
            return false;
        }

        if (!$member = $this->getMember()) {
            return false;
        }

        return $member->canEdit(MemberModel::getFromUser());
    }

    public function onUpdate()
    {
        try {
            if (!$this->canEdit()) {
                throw new ApplicationException('Permission denied.');
            }

            $member = $this->getMember();
            if (!$member) {
                return;
            }

            /*
             * Process mail preferences
             */
            if ($member->user) {
                MailBlocker::setPreferences(
                    $member->user,
                    post('MailPreferences'),
                    ['aliases' => $this->getMailTemplates()]
                );
            }

            /*
             * Save member
             */
            $data = array_except(post(), 'MailPreferences');
            $member->fill($data);
            $member->save();

            Flash::success(post('flash', 'Settings successfully saved!'));

            return $this->redirectToSelf();
        }
        catch (Exception $ex) {
            Flash::error($ex->getMessage());
        }
    }

    protected function getMailTemplates()
    {
        return ['topic_reply' => 'rainlab.forum::mail.topic_reply'];
    }

    public function onPurgePosts()
    {
        try {
            $otherMember = $this->getOtherMember();
            if (!$otherMember || !$otherMember->is_moderator) {
                throw new ApplicationException('Access denied');
            }

            if ($member = $this->getMember()) {
                foreach ($member->posts as $post) {
                    $post->delete();
                }
            }

            Flash::success(post('flash', 'Posts deleted!'));

            return $this->redirectToSelf();
        }
        catch (Exception $ex) {
            Flash::error($ex->getMessage());
        }
    }

    public function onApprove()
    {
        try {
            $otherMember = $this->getOtherMember();
            if (!$otherMember || !$otherMember->is_moderator) {
                throw new ApplicationException('Access denied');
            }

            if ($member = $this->getMember()) {
                $member->approveMember();
            }

            $this->prepareVars();
        }
        catch (Exception $ex) {
            if (Request::ajax()) throw $ex; else Flash::error($ex->getMessage());
        }
    }

    public function onBan()
    {
        try {
            $otherMember = $this->getOtherMember();
            if (!$otherMember || !$otherMember->is_moderator) {
                throw new ApplicationException('Access denied');
            }

            if ($member = $this->getMember()) {
                $member->banMember();
            }

            $this->prepareVars();
        }
        catch (Exception $ex) {
            if (Request::ajax()) throw $ex; else Flash::error($ex->getMessage());
        }
    }

    public function onReport()
    {
        if (!Auth::check()) {
            throw new ApplicationException('You must be logged in to perform this action!');
        }

        Flash::success(post('flash', 'User has been reported for spamming, thank-you for your assistance!'));

        $moderators = UserModel::whereHas('forum_member', function($member) {
            $member->where('is_moderator', true);
        })->lists('name', 'email');

        if ($moderators) {
            $member = $this->getMember();
            $memberUrl = $this->currentPageUrl(['slug' => $member->slug]);
            $otherMember = $this->getOtherMember();
            $otherMemberUrl = $this->currentPageUrl(['slug' => $otherMember->slug]);
            $params = [
                'member'         => $member,
                'memberUrl'      => $memberUrl,
                'otherMember'    => $otherMember,
                'otherMemberUrl' => $otherMemberUrl,
            ];
            Mail::sendTo($moderators, 'rainlab.forum::mail.member_report', $params);
        }

        return $this->redirectToSelf();
    }

    protected function redirectToSelf()
    {
        if (!$member = $this->getMember()) {
            return false;
        }

        /*
         * Redirect to the intended page after successful update
         */
        $redirectUrl = post('redirect', $this->currentPageUrl([
            'slug' => $member->slug
        ]));

        return Redirect::to($redirectUrl);
    }
}
