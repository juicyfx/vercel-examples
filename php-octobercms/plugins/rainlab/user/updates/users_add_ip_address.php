<?php namespace RainLab\User\Updates;

use Carbon\Carbon;
use Schema;
use October\Rain\Database\Updates\Migration;

class UsersAddIpAddress extends Migration
{
    public function up()
    {
        Schema::table('users', function($table)
        {
            $table->string('created_ip_address')->nullable();
            $table->string('last_ip_address')->nullable();
        });
    }

    public function down()
    {
        if (Schema::hasColumn('users', 'created_ip_address')) {
            Schema::table('users', function($table)
            {
                $table->dropColumn('created_ip_address');
                $table->dropColumn('last_ip_address');
            });
        }
    }
}
