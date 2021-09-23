<?php namespace RainLab\Forum\Models;

use Model;
use ApplicationException;

/**
 * Channel Model
 */
class Channel extends Model
{

    use \October\Rain\Database\Traits\Purgeable;
    use \October\Rain\Database\Traits\Sluggable;
    use \October\Rain\Database\Traits\Validation;
    use \October\Rain\Database\Traits\NestedTree;

    public $implement = ['@RainLab.Translate.Behaviors.TranslatableModel'];

    /**
     * @var string The database table used by the model.
     */
    public $table = 'rainlab_forum_channels';

    /**
     * @var array Guarded fields
     */
    protected $guarded = [];

    /**
     * @var array Fillable fields
     */
    protected $fillable = ['title', 'description', 'parent_id'];

    /**
     * @var array The attributes that should be visible in arrays.
     */
    protected $visible = ['title', 'description'];

    /**
     * @var array List of attribute names which should not be saved to the database.
     */
     protected $purgeable = ['url'];

    /**
     * @var array Validation rules
     */
    public $rules = [
        'title' => 'required'
    ];

    /**
     * @var array Auto generated slug
     */
    protected $slugs = ['slug' => 'title'];

    /**
     * @var array Relations
     */
    public $hasMany = [
        'topics' => ['RainLab\Forum\Models\Topic']
    ];

    /**
     * @var array Relations
     */
    public $hasOne = [
        'first_topic' => ['RainLab\Forum\Models\Topic', 'order' => 'updated_at desc']
    ];

    /**
     * @var array Attributes that support translation, if available.
     */
    public $translatable = ['title', 'description'];

    /**
     * @var boolean Channel has new posts for member, set by TopicTracker model
     */
    public $hasNew = false;

    /**
     * Apply embed code to channel.
     */
    public function scopeForEmbed($query, $channel, $code)
    {
        return $query
            ->where('embed_code', $code)
            ->where('parent_id', $channel->id);
    }

    /**
     * Auto creates a channel based on embed code and a parent channel
     * @param  string $code          Embed code
     * @param  string $parentChannel Channel to create the topic in
     * @param  string $title         Title for the channel (if created)
     * @return self
     */
    public static function createForEmbed($code, $parentChannel, $title = null, $isGuarded = false)
    {
        $channel = self::forEmbed($parentChannel, $code)->first();

        if (!$channel) {
            $channel = new self;
            $channel->title = $title;
            $channel->embed_code = $code;
            $channel->parent = $parentChannel;
            $channel->is_guarded = $isGuarded;
            $channel->save();
        }

        return $channel;
    }

    /**
     * Rebuilds the statistics for the channel
     * @return void
     */
    public function rebuildStats()
    {
        $this->count_topics = $this->topics()->count();
        $this->count_posts = $this->topics()->sum('count_posts');

        return $this;
    }

    /**
     * Filters if the channel should be visible on the front-end.
     */
    public function scopeIsVisible($query)
    {
        return $query->where('is_hidden', '<>', true);
    }

    public function afterDelete()
    {
        foreach ($this->topics as $topic) {
            $topic->delete();
        }
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
}
