<?php


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Settings
Route::get('/settings', 'SettingController@index');
Route::get('/status', 'SettingController@status');
Route::get('/status2', 'SettingController@status2');
Route::get('/image/users', 'UserController@showAvatar');
Route::get('/image/logo', 'SettingController@showLogo');
Route::get('/image/minilogo', 'SettingController@showMiniLogo');
Route::post('/register', 'Api\Auth\RegisterController@register');
Route::post('/report', 'ReportController@sendReport');
Route::post('/register', 'Api\Auth\RegisterController@register');
Route::post('/login', 'Api\Auth\LoginController@login');
Route::post('/disconnect', 'Api\Auth\LoginController@logout');
Route::post('/refresh', 'Api\Auth\LoginController@refresh');
Route::post('/social_auth', 'Api\Auth\SocialAuthController@socialAuth');
Route::middleware('auth:api')->group(function () {
    Route::post('/logout', 'Api\Auth\LoginController@logout');
    Route::post('/update', 'Api\Auth\LoginController@update');
    Route::get('/user', 'Api\Auth\LoginController@user');
    Route::put('/account/update', 'UserController@update');
});


// Animes
Route::get('/animes/{code}', 'AnimeController@index');
Route::get('/animes/image/{filename}/{code}', 'AnimeController@getImg');
Route::get('/animes/show/{anime}/{code}', 'AnimeController@show');
Route::get('/animes/watch/{serie}/{code}', 'AnimeController@showbyimdb');
Route::get('/animes/recents/{code}', 'AnimeController@recents');
Route::get('/animes/relateds/{anime}/{code}', 'AnimeController@relateds');


// Movies
Route::get('/movies/image/{filename}', 'MovieController@getImg');
Route::get('/movies/latest/{code}', 'MovieController@latest');
Route::get('/movies/recommended/{code}', 'MovieController@recommended');
Route::get('/movies/popular/{code}', 'MovieController@popular');
Route::get('/movies/recents/{code}', 'MovieController@recents');
Route::get('/movies/thisweek/{code}', 'MovieController@thisweek');
Route::get('/movies/recommended/{code}', 'MovieController@recommended');
Route::get('/movies/trending/{code}', 'MovieController@trending');
Route::get('/movies/featured/{code}', 'MovieController@featured');
Route::get('/movies/suggested/{code}', 'MovieController@suggested');
Route::get('/movies/random/{code}', 'MovieController@random');
Route::get('/movies/relateds/{movie}', 'MovieController@relateds');
Route::get('/movies/videos/{movie}', 'MovieController@videos');
Route::get('/movies/substitles/{movie}', 'MovieController@substitles');
Route::get('/movies/kids/{code}', 'MovieController@kids');
Route::get('/movies/view/{movie}', 'MovieController@view');
Route::get('/movies/show/{movie}', 'MovieController@show');

// Series
Route::get('/series/{code}', 'SerieController@index');
Route::get('/series/image/{filename}/{code}', 'SerieController@getImg');
Route::get('/series/show/{serie}/{code}', 'SerieController@show');
Route::get('/series/watch/{serie}/{code}', 'SerieController@showbyimdb');
Route::get('/series/recommended/{code}', 'SerieController@recommended');
Route::get('/series/popular/{code}', 'SerieController@popular');
Route::get('/series/recents/{code}', 'SerieController@recents');
Route::get('/series/kids/{code}', 'SerieController@kids');
Route::get('/series/relateds/{serie}/{code}', 'SerieController@relateds');


// Upcoming
Route::get('/upcoming/latest', 'UpcomingController@latest');
Route::get('/upcoming/show/{upcoming}', 'UpcomingController@show');

// Seasons and Episodes
Route::get('/series/season/{season}', 'SeasonController@show');
Route::get('/series/episode/{episode}', 'EpisodeController@videos');
Route::get('/series/substitle/{episode}', 'EpisodeController@substitles');
Route::get('/series/substitle/{episode}', 'EpisodeController@substitles');
Route::get('/series/view/{episode}/{code}', 'EpisodeController@view');

// Live TV
Route::get('/livetv/{code}', 'LivetvController@index');
Route::get('/livetv/latest/{code}', 'LivetvController@latest');
Route::get('/livetv/show/{livetv}', 'LivetvController@show');
Route::get('/livetv/image/{filename}', 'LivetvController@getImg');
Route::get('/livetv/random/{livetv}', 'LivetvController@random');

//Genres
Route::get('/genres/{code}', 'GenreController@index');
Route::get('/genres/movies/show/{genre}/{code}', 'GenreController@showMovies');
Route::get('/genres/series/show/{genre}/{code}', 'GenreController@showSeries');
Route::get('/genres/list/{code}', 'GenreController@list');


//Ads
Route::get('/ads', 'AdsController@ads');


//Search
Route::get('/search/{query}', 'SearchController@index');


//Videos
Route::get('/video/{filename}', 'VideoController@show');


//Substitles
Route::get('/substitles/{filename}', 'SubstitleController@show');