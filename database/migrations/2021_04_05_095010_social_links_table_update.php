<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use Doctrine\DBAL\Types\StringType; use Doctrine\DBAL\Types\Type;

class SocialLinksTableUpdate extends Migration
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
            $table->char('discord', 100)->nullable()->change(); 
            $table->char('teams', 100)->nullable()->change();
            $table->char('facebook', 100)->nullable()->change();
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if (!Type::hasType('char')) {
            Type::addType('char', StringType::class);
        }

        Schema::table('social_links', function (Blueprint $table) {
            // $table->dropForeign(['user_email']);
            $table->char('discord', 100)->nullable()->change(); 
            $table->char('teams', 100)->nullable()->change();
            $table->char('facebook', 100)->nullable()->change();
        });
    }
}
