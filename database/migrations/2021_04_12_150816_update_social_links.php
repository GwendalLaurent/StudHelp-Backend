<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Doctrine\DBAL\Types\StringType; use Doctrine\DBAL\Types\Type;
class UpdateSocialLinks extends Migration
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
            $table->dropColumn('facebook');
            $table->char('phone', 50)->nullable()->default("");
            $table->char('email', 50)->nullable()->default("");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('social_links', function (Blueprint $table) {
            $table->dropColumn('phone');
            $table->dropColumn('email');
            $table->char('facebook', 100)->nullable()->default("");
        });
    }
}
