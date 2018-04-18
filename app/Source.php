<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Source extends Model
{
    public $timestamps  = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'link', 'author', 'publication_year'
    ];
}
