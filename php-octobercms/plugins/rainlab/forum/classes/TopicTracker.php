<?php namespace RainLab\Forum\Classes;

use Db;
use Carbon\Carbon;
use Cookie;

/**
 * Topic tracker
 */
class TopicTracker
{
    use \October\Rain\Support\Traits\Singleton;

    public $cookieName = 'forum_cookie_tracker';

    /**
     * Initialize this singleton.
     */
    protected function init()
    {
    }

    //
    // Topics
    //

    /**
     * Flag a topic as being tracked by a member
     * @param Topic $topic   Forum topic
     */
    public function markTopicTracked($topic)
    {
        $trackedTopics = $this->getTrackedTopics();
        $trackedTopics['topics'][$topic->id] = Carbon::now()->getTimestamp();
        $this->setTrackedTopics($trackedTopics);
    }

    /**
     * Sets the watched flag (hasNew) for an array of topics
     * @param array $topics  Collection of topics
     * @param Member $member Forum member
     */
    public function setFlagsOnTopics($topics, $member)
    {
        if (!count($topics) || !$member || !$member->user) {
            return $topics;
        }

        $lastLogin = $member->user->last_login;

        $trackedTopics = $this->getTrackedTopics();

        foreach ($topics as $topic) {
            $trackedTopic = !empty($trackedTopics['topics'][$topic->id])
                ? Carbon::createFromTimestamp($trackedTopics['topics'][$topic->id])
                : null;

            $topic->hasNew = $topic->last_post_at &&
                $topic->last_post_at->gt($lastLogin) &&
                (!$trackedTopic || $topic->last_post_at->gt($trackedTopic));
        }

        return $topics;
    }

    //
    // Channels
    //

    /**
     * Flag a channel as being tracked by a member
     * @param Channel $channel   Forum channel
     */
    public function markChannelTracked($channel)
    {
        $trackedTopics = $this->getTrackedTopics();
        $trackedTopics['channels'][$channel->id] = Carbon::now()->getTimestamp();
        $this->setTrackedTopics($trackedTopics);
    }

    /**
     * Sets the has new flag (hasNew) for an array of channels
     * @param array $channels  Collection of channels
     * @param Member $member Forum member
     */
    public function setFlagsOnChannels($channels, $member)
    {
        if (!count($channels) || !$member || !$member->user) {
            return $channels;
        }

        $lastLogin = $member->user->last_login;

        $trackedTopics = $this->getTrackedTopics();

        $newTopics = $this->getNewTopics($member);

        foreach ($channels as $channel) {
            if (!$firstTopic = $channel->first_topic) {
                continue;
            }

            $trackedChannel = !empty($trackedTopics['channels'][$channel->id])
                ? Carbon::createFromTimestamp($trackedTopics['channels'][$channel->id])
                : null;

            $newPosts = $firstTopic->last_post_at &&
                $firstTopic->last_post_at->gt($lastLogin) &&
                (!$trackedChannel || $firstTopic->last_post_at->gt($trackedChannel));

            /*
             * There are new posts, check if they have been read already.
             */
            if ($newPosts) {
                $newChannelTopics = array_get($newTopics, $channel->id, []);
                foreach ($newChannelTopics as $topicId => $timestamp) {

                    $topicStamp = Carbon::parse($timestamp);

                    $trackedTopic = !empty($trackedTopics['topics'][$topicId])
                        ? Carbon::createFromTimestamp($trackedTopics['topics'][$topicId])
                        : null;

                    if (
                        (!$trackedTopic || $trackedTopic->lt($topicStamp)) &&
                        (!$trackedChannel || $trackedChannel->lt($topicStamp))
                    ) {
                        $channel->hasNew = true;
                        break;
                    }
                }
            }

        }

        return $channels;
    }

    /**
     * Returns new topics across all channels for a member
     * @param Member $member Forum member
     */
    public function getNewTopics($member)
    {
        $lastLogin = $member->user->last_login;

        $results = Db::table('rainlab_forum_topics')->select([
                'rainlab_forum_topics.id',
                'rainlab_forum_topics.channel_id',
                'rainlab_forum_topics.last_post_at'
            ])
            ->join('rainlab_forum_channels', 'rainlab_forum_channels.id', '=', 'rainlab_forum_topics.channel_id')
            ->where('rainlab_forum_topics.last_post_at', '>', $lastLogin)
            ->get()
        ;

        $topics = [];

        foreach ($results as $result) {
            $topics[$result->channel_id][$result->id] = $result->last_post_at;
        }

        return $topics;
    }

    /**
     * Returns an array of tracked channels and topics from the 
     * user's cookie storage.
     */
    public function getTrackedTopics()
    {
        $cookieData = Cookie::get($this->cookieName, false);

        if (!$cookieData) {
            return ['topics' => [], 'channels' => []];
        }

        if (strlen($cookieData) > 4048) {
            return ['topics' => [], 'channels' => []];
        }

        /*
         * Unserialize data from cookie
         */
        $trackedTopics = ['topics' => [], 'channels' => []];
        foreach (explode(';', $cookieData) as $idData) {
            switch (substr($idData, 0, 1)) {
                case 'c': $type = 'channels'; break;
                case 't': $type = 'topics'; break;
                default: continue 2;
            }

            $id = intval(substr($idData, 1));

            if (($pos = strpos($idData, '=')) === false) {
                continue;
            }

            $timestamp = intval(substr($idData, $pos + 1));

            if ($id > 0 && $timestamp > 0) {
                $trackedTopics[$type][$id] = $timestamp;
            }
        }

        return $trackedTopics;
    }

    /**
     * Sets the tracked topics in cookie storage.
     */
    public function setTrackedTopics($trackedTopics)
    {
        $cookieData = '';

        if (!empty($trackedTopics)) {

            /*
             * Sort the arrays (latest read first)
             */
            arsort($trackedTopics['topics'], SORT_NUMERIC);
            arsort($trackedTopics['channels'], SORT_NUMERIC);

            /*
             * Homebrew serialization (to avoid having to run unserialize() on cookie data)
             */
            foreach ($trackedTopics['topics'] as $id => $timestamp) {
                $cookieData .= 't'.$id.'='.$timestamp.';';
            }

            foreach ($trackedTopics['channels'] as $id => $timestamp) {
                $cookieData .= 'c'.$id.'='.$timestamp.';';
            }

            /*
             * Enforce a 4048 byte size limit (4096 minus some space for the cookie name)
             */
            if (strlen($cookieData) > 4048) {
                $cookieData = substr($cookieData, 0, 4048);
                $cookieData = substr($cookieData, 0, strrpos($cookieData, ';')).';';
            }
        }

        Cookie::queue($this->cookieName, $cookieData, 60);
    }

}
