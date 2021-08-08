<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Perusahaan extends Model
{
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function categorie()
    {
        return $this->belongsTo('App\Categorie');
    }

    public function job()
    {
        return $this->hasOne('App\Job');
    }
}
