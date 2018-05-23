<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ban extends Model
{
    // Don't add create and update timestamps in database.
    public $timestamps  = false;

    protected $primaryKey = 'banned_user_id';

    protected $fillable = [
        'reason'
    ];

    public function user(){
        return $this->belongsTo('App\User','banned_user_id');
    }
}
