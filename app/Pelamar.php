<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pelamar extends Model
{
    protected $guarded = [];

    public function job()
    {
        return $this->belongsTo('App\Job');
    }
}
