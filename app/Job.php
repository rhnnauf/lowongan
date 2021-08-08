<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    protected $guarded = [];

    public function perusahaan()
    {
        return $this->belongsTo('App\Perusahaan');
    }

    public function pelamar()
    {
        return $this->hasOne('App\Job');
    }
}
