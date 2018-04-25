<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
class Reporteditem extends Model
{
    // Don't add create and update timestamps in database.
    public $timestamps  = false;

    public function news() {
        return $this->belongsTo('App\News');
    }
}
