<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Serie extends Model
{
    protected $fillable = ['tmdb_id', 'name', 'overview', 'poster_path', 'backdrop_path', 'preview_path', 'vote_average', 'vote_count', 'popularity', 'premuim', 'featured', 'first_air_date', 'tv'];

    protected $with = ['genres', 'seasons'];

    
    protected $appends = ['hd', 'genreslist', 'views','hasubs'];

    protected $casts = [
        'status' => 'int',
        'premuim' => 'int',
        'featured' => 'int'
    ];


    public function genres()
    {
        return $this->hasMany('App\SerieGenre');
    }

    public function seasons()
    {
        return $this->hasMany('App\Season')->orderBy('season_number');
    }

    public function getHdAttribute()
    {
        $hd = 0;

        foreach ($this->seasons as $season) {
            foreach ($season->episodes as $episode) {
                foreach ($episode->videos as $video) {
                    if ($video->hd) {
                        $hd = 1;
                    }
                }
            }
        }

        return $hd;
    }


    public function gethasubsAttribute()
    {
        $hasubs = 0;

        foreach ($this->seasons as $season) {
            foreach ($season->episodes as $episode) {
                foreach ($episode->substitles as $hasubs) {
                    if ($hasubs->id) {
                        $hasubs = 1;
                    }
                }
            }
        }

        return $hasubs;
    }

    public function getViewsAttribute()
    {
        $views = 0;
        $counter = 0;

        foreach ($this->seasons as $season) {
            foreach ($season->episodes as $episode) {
                $views += $episode->views;
                $counter++;
            }
        }

        if ($views > 0) {
            $views = $views / $counter;
        }

        return round($views);
    }

    public function getGenreslistAttribute()
    {
        $genres = [];
        foreach ($this->genres as $genre) {
            array_push($genres, $genre['name']);
        }
        return $genres;
    }
}
