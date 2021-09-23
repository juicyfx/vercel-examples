<?php namespace RainLab\User\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class UsersRenameLoginToUsername extends Migration
{

    public function up()
    {
        Schema::table('users', function($table)
        {
            $table->renameColumn('login', 'username');
        });
    }

    public function down()
    {
        if (Schema::hasColumn('users', 'login')) {
            Schema::table('users', function($table)
            {
                $table->renameColumn('username', 'login');
            });
        }
    }
}
