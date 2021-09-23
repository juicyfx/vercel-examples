<?php namespace RainLab\User\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;
use RainLab\User\Models\User;

class UsersAddLastSeen extends Migration
{
    public function up()
    {
        Schema::table('users', function($table)
        {
            $table->timestamp('last_seen')->nullable();
        });
    }

    public function down()
    {
        if (Schema::hasColumn('users', 'last_seen')) {
            Schema::table('users', function($table)
            {
                $table->dropColumn('last_seen');
            });
        }
    }
}
