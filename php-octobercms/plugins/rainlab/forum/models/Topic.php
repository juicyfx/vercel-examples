<?php namespace RainLab\Forum\Models;

use Config;
use Db;
use App;
use Model;
use Carbon\Carbon;
use ApplicationException;

/**
 * Topic Model
 */
class Topic extends Model
{
    use \October\Rain\Database\Traits\Purgeable;
    use \October\Rain\Database\Traits\Sluggable;
    use \October\Rain\Database\Traits\Validation;

    /**
     * @var string The database table used by the model.
     */
    public $table = 'rainlab_forum_topics';

    /**
     * @var array Guarded fields
     */
    protected $guarded = [];

    /**
     * @var array Fillable fields
     */
    protected $fillable = ['subject'];

    /**
     * @var array List of attribute names which should not be saved to the database.
     */
     protected $purgeable = ['url'];

    /**
     * @var array Validation rules
     */
    public $rules = [
        'subject'         => 'required',
        'channel_id'      => 'required',
        'start_member_id' => 'required'
    ];

    /**
     * @var array The attributes that should be visible in arrays.
     */
    protected $visible = ['id', 'slug', 'subject', 'channel', 'created_at', 'updated_at'];

    /**
     * @var array Date fields
     */
    public $dates = ['last_post_at'];

    /**
     * @var array Auto generated slug
     */
    protected $slugs = ['slug' => 'subject'];

    /**
     * @var array Relations
     */
    public $hasMany = [
        'posts' => ['RainLab\Forum\Models\Post'],
    ];

    /**
     * @var array Relations
     */
    public $hasOne = [
        'first_post' => ['RainLab\Forum\Models\Post', 'order' => 'created_at asc']
    ];

    public $belongsTo = [
        'channel'          => ['RainLab\Forum\Models\Channel'],
        'start_member'     => ['RainLab\Forum\Models\Member'],
        'last_post'        => ['RainLab\Forum\Models\Post'],
        'last_post_member' => ['RainLab\Forum\Models\Member'],
    ];

    public $belongsToMany = [
        'followers' => ['RainLab\Forum\Models\Member', 'table' => 'rainlab_forum_topic_followers', 'timestamps' => true]
    ];

    /**
     * @var boolean Topic has new posts for member, set by TopicTracker model
     */
    public $hasNew = false;

    /**
     * Creates a topic and a post inside a channel
     * @param  Channel $channel
     * @param  Member $member
     * @param  array $data Topic and post data: subject, content.
     * @return self
     */
    public static function createInChannel($channel, $member, $data)
    {
        $topic = new static;
        $topic->subject = array_get($data, 'subject');
        $topic->channel = $channel;
        $topic->start_member = $member;

        $post = new Post;
        $post->topic = $topic;
        $post->member = $member;
        $post->content = array_get($data, 'content');

        Db::transaction(function() use ($topic, $post) {
            $topic->save();
            $post->save();
        });

        TopicFollow::follow($topic, $member);
        $member->touchActivity();

        return $topic;
    }

    /**
     * Returns true if member is throttled and cannot post
     * again. Maximum 3 posts every 15 minutes.
     * @return bool
     */
    public static function checkThrottle($member)
    {
        if (!$member) {
            return false;
        }
        $throttleCount = Config::get('rainlab.forum::throttleCount', 2);
        $throttleMinutes = Config::get('rainlab.forum::throttleMinutes', 15);

        $timeLimit = Carbon::now()->subMinutes($throttleMinutes);
        $count = static::make()
            ->where('start_member_id', $member->id)
            ->where('created_at', '>', $timeLimit)
            ->count();

        return $count > $throttleCount;
    }

    public function scopeForEmbed($query, $channel, $code)
    {
        return $query
            ->where('embed_code', $code)
            ->where('channel_id', $channel->id);
    }

    /**
     * Auto creates a topic based on embed code and channel
     * @param  string $code        Embed code
     * @param  string $channel     Channel to create the topic in
     * @param  string $subject     Title for the topic (if created)
     * @return self
     */
    public static function createForEmbed($code, $channel, $subject = null)
    {
        $topic = self::forEmbed($channel, $code)->first();

        if (!$topic) {
            $topic = new self;
            $topic->subject = $subject;
            $topic->embed_code = $code;
            $topic->channel = $channel;
            $topic->start_member_id = 0;
            $topic->save();
        }

        return $topic;
    }

    /**
     * Lists topics for the front end
     * @param  array $options Display options
     *                        - page      Page number
     *                        - perPage   Results per page
     *                        - sort      Sorting field
     *                        - channels  Topics in channels
     *                        - search    Search query
     * @return self
     */
    public function scopeListFrontEnd($query, $options)
    {
        /*
         * Default options
         */
        extract(array_merge([
            'page'     => 1,
            'perPage'  => 20,
            'sort'     => 'created_at',
            'channels' => null,
            'search'   => ''
        ], $options));

        /*
         * Sorting
         */
        $allowedSortingOptions = ['created_at', 'updated_at', 'subject'];
        if (!in_array($sort, $allowedSortingOptions)) {
            $sort = $allowedSortingOptions[0];
        }

        $query->orderBy('is_sticky', 'desc');
        $query->orderBy($sort, in_array($sort, ['created_at', 'updated_at']) ? 'desc' : 'asc');

        /*
         * Search
         */
        $search = trim($search);
        if (strlen($search)) {
            $query->where(function($query) use ($search) {
                $query->whereHas('posts', function($query) use ($search) {
                    $query->searchWhere($search, ['subject', 'content']);
                });

                $query->orSearchWhere($search, 'subject');
            });
        }

        /*
         * Channels
         */
        if ($channels !== null) {
            if (!is_array($channels)) {
                $channels = [$channels];
            }

            $query->whereIn('channel_id', $channels);
        }

        return $query->paginate($perPage, $page);
    }

    public function moveToChannel($channel)
    {
        $oldChannel = $this->channel;
        $this->timestamps = false;
        $this->channel = $channel;
        $this->save();
        $this->timestamps = true;
        $oldChannel->rebuildStats()->save();
        $channel->rebuildStats()->save();
    }

    public function increaseViewCount()
    {
        $this->timestamps = false;
        $this->increment('count_views');
        $this->timestamps = true;
    }

    public function afterCreate()
    {
        $this->start_member()->increment('count_topics');
        $this->channel()->increment('count_topics');
    }

    public function afterDelete()
    {
        $this->start_member()->decrement('count_topics');
        $this->channel()->decrement('count_topics');
        $this->channel()->decrement('count_posts', $this->posts()->count());
        $this->posts()->delete();
        $this->followers()->detach();
    }

    public function canPost($member = null)
    {
        if (!$member) {
            $member = Member::getFromUser();
        }

        if (!$member) {
            return false;
        }

        if ($member->is_banned) {
            return false;
        }

        if ($this->is_locked && !$member->is_moderator) {
            return false;
        }

        return true;
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

    public function stickyTopic()
    {
        $this->is_sticky = ($this->is_sticky == 1 ? 0 : 1);
        $this->save();
    }

    public function lockTopic()
    {
        $this->is_locked = ($this->is_locked == 1 ? 0 : 1);
        $this->save();
    }
}
