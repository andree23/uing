<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MovieSubstitle extends Model
{
    protected $fillable = ['link', 'lang', 'status'];

    public function movie()
    {
        return $this->belongsTo('App\Movie');
    }

}
