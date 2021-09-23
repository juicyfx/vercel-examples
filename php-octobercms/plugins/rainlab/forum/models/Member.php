<?php namespace RainLab\Forum\Models;

use Str;
use Auth;
use Model;
use Carbon\Carbon;

/**
 * Member Model
 */
class Member extends Model
{
    use \October\Rain\Database\Traits\Purgeable;
    use \October\Rain\Database\Traits\Sluggable;

    /**
     * @var string The database table used by the model.
     */
    public $table = 'rainlab_forum_members';

    /**
     * @var array Guarded fields
     */
    protected $guarded = [];

    /**
     * @var array Fillable fields
     */
    protected $fillable = ['username'];

    /**
     * @var array The attributes that should be visible in arrays.
     */
    protected $visible = ['username', 'slug'];

    /**
     * @var array List of attribute names which should not be saved to the database.
     */
     protected $purgeable = ['url'];

    /**
     * @var array Auto generated slug
     */
    public $slugs = ['slug' => 'username'];

    public $dates = ['last_active_at'];

    /**
     * @var array Relations
     */
    public $belongsTo = [
        'user' => ['RainLab\User\Models\User']
    ];

    public $hasMany = [
        'posts' => ['RainLab\Forum\Models\Post', 'order' => 'created_at desc']
    ];

    /**
     * Automatically creates a forum member for a user if not one already.
     * @param  RainLab\User\Models\User $user
     * @return RainLab\Forum\Models\Member
     */
    public static function getFromUser($user = null)
    {
        if ($user === null) {
            $user = Auth::getUser();
        }

        if (!$user) {
            return null;
        }

        if ($member = $user->forum_member) {
            $member->setRelation('user', $user);
        }
        else {
            $generatedUsername = explode('@', $user->email);
            $generatedUsername = array_shift($generatedUsername);
            $generatedUsername = Str::limit($generatedUsername, 24, '') . $user->id;

            $member = new static;
            $member->user = $user;
            $member->username = $generatedUsername;
            $member->save();

            $user->forum_member = $member;
        }

        return $member;
    }

    /**
     * Can the specified member edit this member
     * @param  self $member
     * @return bool
     */
    public function canEdit($member = null)
    {
        if (!$member) {
            $member = Member::getFromUser();
        }

        if (!$member) {
            return false;
        }

        if ($this->id == $member->id) {
            return true;
        }

        if ($member->is_moderator) {
            return true;
        }

        return false;
    }

    public function beforeSave()
    {
        /*
         * Reset the slug
         */
        if ($this->isDirty('username')) {
            $this->slug = null;
            $this->slugAttributes();
        }
    }

    public function beforeDelete()
    {
        if ($this->posts && $this->posts->count() > 0) {
            foreach ($this->posts as $post) {
                $post->delete();
            }
        }
    }

    /**
     * Returns true if this member is following this topic.
     * @param  Topic  $topic
     * @return boolean
     */
    public function isFollowing($topic)
    {
        return TopicFollow::check($topic, $this);
    }

    public function touchActivity()
    {
        return $this
            ->newQuery()
            ->where('id', $this->id)
            ->update(['last_active_at' => Carbon::now()]);
    }

    /**
     * Sets the "url" attribute with a URL to this object
     * @param string $pageName
     * @param Cms\Classes\Controller $controller
     */
    public function setUrl($pageName, $controller)
    {
        $params = [
            'id'   => $this->id,
            'slug' => $this->slug,
        ];

        return $this->url = $controller->pageUrl($pageName, $params);
    }

    public function approveMember()
    {
        $this->is_approved = ($this->is_approved == 1 ? 0 : 1);
        $this->save();
    }

    public function banMember()
    {
        $this->is_banned = ($this->is_banned == 1 ? 0 : 1);
        $this->save();
    }

}
