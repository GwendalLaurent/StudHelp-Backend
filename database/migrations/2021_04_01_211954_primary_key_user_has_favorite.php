<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class PrimaryKeyUserHasFavorite extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('user_has_favorites', function (Blueprint $table) {
            $table->primary(['user_email', 'course_id']);
            $table->foreign('user_email')->references('email')->on('users')->OnDelete('cascade');
            $table->foreign('course_id')->references('id')->on('courses')->OnDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('user_has_favorite', function (Blueprint $table) {
            $table->dropPrimary(['user_email', 'coure_id']);
            // If migrating throws an exception with sqlite, comment the following line
            $table->dropForeign(['user_email', 'course_id']);
        });
    }
}
