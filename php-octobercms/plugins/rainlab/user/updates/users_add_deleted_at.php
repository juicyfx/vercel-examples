<?php namespace RainLab\User\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class UsersAddDeletedAt extends Migration
{
    public function up()
    {
        Schema::table('users', function($table)
        {
            $table->timestamp('deleted_at')->nullable();
        });
    }

    public function down()
    {
        if (Schema::hasColumn('users', 'deleted_at')) {
            Schema::table('users', function($table)
            {
                $table->dropColumn('deleted_at');
            });
        }
    }
}
