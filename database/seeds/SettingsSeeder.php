<?php

use App\Setting;
use Illuminate\Database\Seeder;

class SettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Setting::create([
            'app_name' => 'EASYPLEX',
            'authorization' => '',
            'tmdb_api_key' => '',
            'purchase_key' => '',
            'tmdb_lang' => [
                'english_name' => "English",
                'iso_639_1' => "en",
                'name' => "English"
            ],
            'app_url_android' => '',
            'autosubstitles' => 1,
            'livetv' => 1,
            'ads_player' => 1,
            'anime' => 1,
            'facebook_show_interstitial' => 0,
            'ad_show_interstitial' => 0,
            'ad_interstitial' => 0,
            'ad_unit_id_interstitial' => '',
            'ad_banner' => 0,
            'ad_unit_id_banner' => '',
            'ad_face_audience_interstitial' => 0,
            'ad_face_audience_banner' => 0,
            'ad_unit_id_facebook_interstitial_audience' => '',
            'ad_unit_id_facebook_banner_audience' => '',
            'privacy_policy' => '',
            'latestVersion' => '',
            'update_title' => '',
            'releaseNotes' => '',
            'featured_home_numbers' => '5',
            'url' => '',
            'imdb_cover_path' => 'http://image.tmdb.org/t/p/w500',
            'paypal_client_id' => '',
            'paypal_amount' => '',

        ]);
    }
}
