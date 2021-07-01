<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumTableProfile extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('profile_users', function (Blueprint $table) {
            $table->string('fullname');
            $table->string('birthday');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('profile_users', function (Blueprint $table) {
            $table->dropColumn('fullname');
            $table->dropColumn('birthday');
        });
    }
}
