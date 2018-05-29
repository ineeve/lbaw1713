<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class FAQ extends Model
{
    static public function getFAQ(){
        return DB::select('SELECT * FROM faqs');
    }
}
