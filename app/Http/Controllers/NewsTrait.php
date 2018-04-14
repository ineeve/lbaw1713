<?php
namespace App\Http\Controllers;

trait NewsTrait {

    public function prettify_date($news_array){
        foreach($news_array as $news){
            $news->date = date("F jS, Y \a\\t H:i", strtotime($news->date));
        }
    }
}
?>