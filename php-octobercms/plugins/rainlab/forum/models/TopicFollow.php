<?php namespace RainLab\Forum\Models;

use Mail;
use Model;
use Carbon\Carbon;

/**
 * Topic watching model
 */
class TopicFollow extends Model
{
    /**
     * @var string The database table used by the model.
     */
    public $table = 'rainlab_forum_topic_followers';

    /**
     * @var string Primary key, used to satisfy PostgreSQL
     */
    protected $primaryKey = 'member_id';

    /**
     * Flag a topic as being followed by a member
     * @param Topic $topic   Forum topic
     * @param Member $member Forum member
     */
    public static function follow($topic, $member)
    {
        $obj = self::where('member_id', $member->id)->where('topic_id', $topic->id)->first();
        if (!$obj) {
            $obj = new self;
            $obj->member_id = $member->id;
            $obj->topic_id = $topic->id;
        }

        $obj->save();
    }

    /**
     * Unflag a topic as being followed by a member
     * @param Topic $topic   Forum topic
     * @param Member $member Forum member
     */
    public static function unfollow($topic, $member)
    {
        return self::where('member_id', $member->id)->where('topic_id', $topic->id)->delete();
    }

    /**
     * Toggles a topic as being followed by a member, returns true
     * if the member was following, or false if they were not.
     * @param Topic $topic   Forum topic
     * @param Member $member Forum member
     */
    public static function toggle($topic, $member)
    {
        if (static::check($topic, $member)) {
            static::unfollow($topic, $member);
            return true;
        }
        else {
            static::follow($topic, $member);
            return false;
        }
    }

    /**
     * Checks if a topic is being followed by a member
     * @param Topic $topic   Forum topic
     * @param Member $member Forum member
     */
    public static function check($topic, $member)
    {
        return self::where('member_id', $member->id)->where('topic_id', $topic->id)->count() > 0;
    }

    /**
     * Sends notifications to followers of a topic about a post
     * @param  Topic $topic
     * @param  Post $post
     * @return void
     */
    public static function sendNotifications($topic, $post, $postUrl)
    {
        $members = $topic->followers;

        $data = [
            'member'  => null,
            'post'    => $post,
            'topic'   => $topic,
            'channel' => $topic->channel,
            'postUrl' => $postUrl . '?' . http_build_query(['page' => 'last']),
        ];

        foreach ($members as $member) {
            /*
             * Not notifying self
             */
            if ($post->member->id == $member->id) {
                continue;
            }

            /*
             * Already notified
             */
            if ($member->last_active_at && $member->pivot->updated_at) {
                if ($member->last_active_at->lt($member->pivot->updated_at)) {
                    continue;
                }
            }

            /*
             * Send notification
             */
            $data['member'] = $member;

            $data['unfollowUrl'] = $postUrl . '?' . http_build_query([
                'auth' => static::makeAuthCode('unfollow', $topic, $member),
                'action' => 'unfollow'
            ]);

            $data['unsubscribeUrl'] = $postUrl . '?' . http_build_query([
                'auth' => static::makeAuthCode('unsubscribe', $topic, $member),
                'action' => 'unsubscribe'
            ]);

            $vars = [
                'name'  => $member->username,
                'email' => $member->user->email
            ];

            Mail::queue('rainlab.forum::mail.topic_reply', $data, function($message) use ($vars)
            {
                extract($vars);
                $message->to($email, $name);
            });
        }

        static::where('topic_id', $topic->id)->update(['updated_at' => Carbon::now()]);
    }

    public static function makeAuthCode($action, $topic, $member)
    {
        $hash = md5(
            $action
            .$topic->id
            .$member->user->created_at
            .$member->user->persist_code
        );

        return $hash.'!'.$member->id;
    }
}
