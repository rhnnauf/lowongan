<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Categorie extends Model
{
    protected $guarded = [];

    public function perusahaan()
    {
        return $this->hasOne('App\Perusahaan');
    }
}
