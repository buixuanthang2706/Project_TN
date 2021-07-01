<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumTableMotelrooms extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('motelrooms', function (Blueprint $table) {
            $table->string('experience');
            $table->string('requests');
            $table->string('skills');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('motelrooms', function (Blueprint $table) {
            $table->dropColumn('experience');
            $table->dropColumn('requests');
            $table->dropColumn('skills');
        });
    }
}
