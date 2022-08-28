<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('age')->nullable();
            $table->string('gender')->nullable();
            $table->string('location')->nullable();
            $table->string('qualifications')->nullable();
            $table->string('experience')->nullable();
            $table->string('salary')->nullable();
            $table->string('skills')->nullable();
            $table->mediumText('about_me')->nullable();
            $table->unsignedInteger('sector_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
}
