<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

use App\Model\UserHasFavorite;

class AdvertisementsUpdateSwitchingFromMailToFullName extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('user_has_favorites', function (Blueprint $table) {
            $table->char('user_full_name', 50)->nullable(true)->default("no data available");
        
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('user_has_favorites', function (Blueprint $table) {
            $table->dropColumn('user_full_name');
        });
    }
}
