<?php namespace RainLab\Forum\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class CreateTopicsTable extends Migration
{
    public function up()
    {
        Schema::create('rainlab_forum_topics', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('subject')->nullable();
            $table->string('slug')->index()->unique();
            $table->integer('channel_id')->unsigned()->index();
            $table->integer('start_member_id')->index()->nullable();
            $table->integer('last_post_id')->nullable();
            $table->integer('last_post_member_id')->nullable();
            $table->dateTime('last_post_at')->index()->nullable();
            $table->boolean('is_private')->index()->default(0);
            $table->boolean('is_sticky')->default(0);
            $table->boolean('is_locked')->index()->default(0);
            $table->integer('count_posts')->index()->default(0);
            $table->integer('count_views')->index()->default(0);
            $table->index(['is_sticky', 'last_post_at'], 'sticky_post_time');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('rainlab_forum_topics');
    }
}
