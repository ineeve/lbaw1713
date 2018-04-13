<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class News extends Model {

    // Don't add create and update timestamps in database.
    public $timestamps  = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title', 'date', 'body', 'image', 'section_id'
    ];

    public function comments() {
        return $this->hasMany('App\Comment');
    }
}