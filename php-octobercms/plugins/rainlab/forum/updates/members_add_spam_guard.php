<?php namespace RainLab\Forum\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class MembersAddSpamGuard extends Migration
{
    public function up()
    {
        Schema::table('rainlab_forum_members', function($table)
        {
            $table->boolean('is_approved')->default(0)->index();
        });

        Schema::table('rainlab_forum_channels', function($table)
        {
            $table->boolean('is_guarded')->default(0);
        });

        Schema::table('rainlab_forum_posts', function($table)
        {
            $table->integer('count_links')->default(0);
        });

        // Automatically approve users with more than 25 posts
        // Db::table('rainlab_forum_members')->where('count_posts', '>=', 25)->update([
        //     'is_approved' => 1
        // ]);

        // Make all channels guarded
        // Db::table('rainlab_forum_channels')->update([
        //     'is_guarded' => 1
        // ]);
    }

    public function down()
    {
        Schema::table('rainlab_forum_members', function($table)
        {
            $table->dropColumn('is_approved');
        });

        Schema::table('rainlab_forum_channels', function($table)
        {
            $table->dropColumn('is_guarded');
        });

        Schema::table('rainlab_forum_posts', function($table)
        {
            $table->dropColumn('count_links');
        });
    }
}
