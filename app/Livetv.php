<?php

namespace App;




use Illuminate\Database\Eloquent\Model;

class Livetv extends Model


{
    protected $fillable = ['name', 'overview', 'poster_path', 'backdrop_path', 'link','vip'];


}
