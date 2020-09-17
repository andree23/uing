<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AnimeVideo extends Model
{
      protected $fillable = ['anime_episode_id', 'server', 'link', 'lang'];

    public function episode()
    {
        return $this->belongsTo('App\AnimeEpisode');
    }

}
