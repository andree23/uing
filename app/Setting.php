<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $guarded = [];

    protected $casts = [
        'tmdb_lang' => 'array',
        'autosubstitles' => 'int',
        'livetv' => 'int',
        'kids' => 'int',
        'ad_interstitial' => 'int'
    ];
}
