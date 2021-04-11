<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Doctrine\DBAL\Types\StringType; use Doctrine\DBAL\Types\Type;
class SocialLinksTableUpdate2 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Type::hasType('char')) {
            Type::addType('char', StringType::class);
        }
        Schema::table('social_links', function (Blueprint $table) {
            // $table->foreign('user_email')->reference('email')->on('users')->onDelete('cascade');
            $table->char('discord', 100)->default("")->change(); 
            $table->char('teams', 100)->default("")->change();
            $table->char('facebook', 100)->default("")->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
