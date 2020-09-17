<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->bigIncrements('id');
            $table->String('app_name');
            $table->String('authorization')->nullable();
            $table->String('tmdb_api_key')->nullable();
            $table->String('purchase_key')->nullable();
            $table->longText('tmdb_lang');
            $table->String('app_url_android')->nullable();
            $table->boolean('autosubstitles');
            $table->boolean('livetv');
            $table->boolean('ads_player');
            $table->boolean('anime');
            $table->integer('facebook_show_interstitial');
            $table->integer('ad_show_interstitial');
            $table->boolean('ad_interstitial');
            $table->String('ad_unit_id_interstitial')->nullable();
            $table->boolean('ad_banner');
            $table->String('ad_unit_id_banner')->nullable();
            $table->boolean('ad_face_audience_interstitial');
            $table->boolean('ad_face_audience_banner');
            $table->String('ad_unit_id_facebook_interstitial_audience')->nullable();
            $table->String('ad_unit_id_facebook_banner_audience')->nullable();
            $table->longText('privacy_policy')->nullable();
            $table->String('latestVersion')->nullable();
            $table->String('update_title')->nullable();
            $table->longText('releaseNotes')->nullable();
            $table->String('url')->nullable();
            $table->String('imdb_cover_path')->nullable();
            $table->String('paypal_client_id')->nullable();
            $table->String('paypal_amount')->nullable();
            $table->integer('featured_home_numbers');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('settings');
    }
}
