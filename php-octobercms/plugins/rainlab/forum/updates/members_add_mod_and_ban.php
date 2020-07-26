<?php namespace RainLab\Forum\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class MembersAddModAndBan extends Migration
{
    public function up()
    {
        Schema::table('rainlab_forum_members', function($table)
        {
            $table->boolean('is_moderator')->default(0)->index();
            $table->boolean('is_banned')->default(0);
        });
    }

    public function down()
    {
        Schema::table('rainlab_forum_members', function($table)
        {
            $table->dropColumn('is_moderator', 'is_banned');
        });
    }
}
