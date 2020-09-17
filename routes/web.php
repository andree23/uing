<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();

Route::get('/', function () {
    return redirect('/home');
});

Route::group(['prefix' => 'admin', 'middleware' => 'admin'], function () {
    // Admin Routes
    Route::get('/', 'AdminController@index')->name('admin');
    Route::get('/movies', 'AdminController@movies')->name('admin.movies');
    Route::get('/series', 'AdminController@series')->name('admin.series');
    Route::get('/users', 'AdminController@users')->name('admin.users');
    Route::get('/streaming', 'AdminController@streaming')->name('admin.streaming');
    Route::get('/qualities', 'AdminController@servers')->name('admin.server');
    Route::get('/genres', 'AdminController@genres')->name('admin.genres');
    Route::get('/notifications', 'AdminController@notifications')->name('admin.notifications');
    Route::get('/settings', 'AdminController@settings')->name('admin.settings');
    Route::get('/account', 'AdminController@account')->name('admin.account');
    Route::get('/news', 'AdminController@articles')->name('admin.articles');
    Route::get('/substitles', 'AdminController@substitles')->name('admin.substitles');
    Route::get('/reports', 'AdminController@reports')->name('admin.reports');
    Route::get('/animes', 'AdminController@animes')->name('admin.animes');
    Route::get('/ads', 'AdminController@ads')->name('admin.ads');
    Route::get('/upcoming', 'AdminController@upcomings')->name('admin.upcomings');
    Route::get('/plans', 'AdminController@plans')->name('admin.plans');


    // Dashboard
    Route::get('/Allfeatured', 'AdminController@featured');
    Route::get('/topmovies', 'AdminController@topmovies');
    Route::get('/topanimes', 'AdminController@topanimes');
    Route::get('/topepisodes', 'AdminController@topepisodes');
    Route::get('/toplivetvs', 'AdminController@toplivetvs');

    // Settings
    Route::get('/settings/data', 'SettingController@data');
    Route::put('/settings/update/{setting}', 'SettingController@update');
    Route::post('/update/logo', 'SettingController@updateLogo');
    Route::post('/update/minilogo', 'SettingController@updateMiniLogo');


    // Account
    Route::get('/account/data', 'UserController@data');
    Route::put('/account/update', 'UserController@update');
    Route::put('/account/password/update', 'UserController@passwordUpdate');
    Route::post('/update/avatar', 'UserController@updateAvatar');


    // Users
    Route::get('/users/data', 'UserController@data');
    Route::get('/users/allusers', 'UserController@allusers');
    Route::delete('/users/destroy/{user}', 'UserController@destroy');
    Route::put('/users/update/{user}', 'UserController@updateUser');

    // Movies
    Route::get('/movies/data', 'MovieController@data');
    Route::post('/movies/store', 'MovieController@store');
    Route::delete('/movies/destroy/{movie}', 'MovieController@destroy');
    Route::post('/movies/image/store', 'MovieController@storeImg');
    Route::put('/movies/update/{movie}', 'MovieController@update');
    Route::delete('/movies/videos/destroy/{movievideo}', 'MovieController@videoDestroy');
    Route::delete('/movies/substitles/destroy/{moviesubstitle}', 'MovieController@substitleDestroy');
    Route::delete('/movies/genres/destroy/{moviegenre}', 'MovieController@destroyGenre');

    //Series
    Route::get('/series/data', 'SerieController@data');
    Route::post('/series/store', 'SerieController@store');
    Route::delete('/series/destroy/{serie}', 'SerieController@destroy');
    Route::put('/series/update/{serie}', 'SerieController@update');
    Route::post('/series/image/store', 'SerieController@storeImg');
    Route::delete('/series/genres/destroy/{seriegenre}', 'SerieController@destroyGenre');

    // Seasons And Episodes
    Route::delete('/series/seasons/destroy/{season}', 'SeasonController@destroy');
    Route::delete('/series/episodes/destroy/{episode}', 'EpisodeController@destroy');
    Route::delete('/series/videos/destroy/{serievideo}', 'EpisodeController@destroyVideo');
    Route::delete('/series/substitles/destroy/{seriesubstitle}', 'EpisodeController@destroySubstitles');

    // Livetv
    Route::get('/livetv/data', 'LivetvController@data');
    Route::post('/livetv/store', 'LivetvController@store');
    Route::delete('/livetv/destroy/{livetv}', 'LivetvController@destroy');
    Route::put('/livetv/update/{livetv}', 'LivetvController@update');
    Route::post('/livetv/image/store', 'LivetvController@storeImg');


    // Upcoming
    Route::get('/upcoming/data', 'UpcomingController@data');
    Route::post('/upcoming/store', 'UpcomingController@store');
    Route::delete('/upcoming/destroy/{upcoming}', 'UpcomingController@destroy');
    Route::put('/upcoming/update/{upcoming}', 'UpcomingController@update');
    Route::post('/upcoming/image/store', 'UpcomingController@storeImg');


    // Animes
    Route::get('/animes/data', 'AnimeController@data');
    Route::post('/animes/store', 'AnimeController@store');
    Route::delete('/animes/destroy/{anime}', 'AnimeController@destroy');
    Route::put('/animes/update/{anime}', 'AnimeController@update');
    Route::post('/animes/image/store', 'AnimeController@storeImg');
    Route::delete('/animes/genres/destroy/{animegenre}', 'AnimeController@destroyGenre');


    // Servers
    Route::get('/servers/data', 'ServerController@data');
    Route::post('/servers/store', 'ServerController@store');
    Route::put('/servers/update/{server}', 'ServerController@update');
    Route::delete('/servers/destroy/{server}', 'ServerController@destroy');

    // Genres
    Route::get('/genres/data', 'GenreController@data');
    Route::post('/genres/store', 'GenreController@store');
    Route::post('/genres/fetch', 'GenreController@fetch');
    Route::delete('/genres/destroy/{genre}', 'GenreController@destroy');
    Route::put('/genres/update/{genre}', 'GenreController@update');



    // Videos
    Route::post('/video/store', 'VideoController@store');
    Route::post('/video/anime/store', 'VideoController@store');


    // Substitles
    Route::get('/substitles/data', 'SubstitleController@data');
    Route::post('/substitle/store', 'SubstitleController@store');
    Route::put('/substitles/update/{substitle}', 'SubstitleController@update');


    // Reports
    Route::post('/reports/send', 'ReportController@sendReport');
    Route::get('/reports/data', 'ReportController@data');
    Route::delete('/reports/destroy/{report}', 'ReportController@destroy');


    // Ads
    Route::get('/ads/data', 'AdsController@data');
    Route::delete('/ads/destroy/{ads}', 'AdsController@destroy');
    Route::post('/ads/store', 'AdsController@store');
    Route::put('/ads/update/{ads}', 'AdsController@update');

});

Auth::routes();

Route::get('/home', 'AdminController@index')->name('home');
