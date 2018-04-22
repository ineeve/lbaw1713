<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    public function news() {
        return $this->hasMany('App\News');
    }
}
