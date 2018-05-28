<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class News extends Model {

    // Don't add create and update timestamps in database.
    public $timestamps  = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title', 'date', 'body', 'image', 'section_id', 'author_id'
    ];

     /**
     * The user this news belongs to
     */
    public function user() {
        return $this->belongsTo('App\User');
    }
    public function report() {
        return $this->hasOne('App\Reportitem');
    }

    public function comments() {
        return $this->hasMany('App\Comment');
    }

    public function section() {
        return $this->belongsTo('App\Section');
    }

    static public function getNewsAdvanceSearch(Request $request) {
        switch ($request->elementToSearch) {
            case 'titleAndBody':{
                if($request->sectionSearch == null){
                    if($request->authorSearch == null) {
                        return DB::select("SELECT news.id, title, users.username As author, date, votes, image, substring(body, '(?:<p>)[^<>]*\.(?:<\/p>)') as body_preview FROM news JOIN users ON news.author_id = users.id
                        WHERE textsearchable_body_and_title_index_col @@ plainto_tsquery('english',?)
                        AND date BETWEEN ? AND ?
                       ;",[$request->searchText,$request->date1,$request->date2]); 
                    } else {
                        return DB::select("SELECT news.id, title, users.username As author, date, votes, image, substring(body, '(?:<p>)[^<>]*\.(?:<\/p>)') as body_preview FROM news JOIN users ON news.author_id = users.id
                        WHERE textsearchable_body_and_title_index_col @@ plainto_tsquery('english',?)
                        AND date BETWEEN ? AND ?
                       
                        AND username = ?;",[$request->searchText,$request->date1,$request->date2, $request->authorSearch ]); 
                    }
                } else{
                    if($request->authorSearch == null) {
                        return DB::select("SELECT news.id, title, users.username As author, date, votes, image, substring(body, '(?:<p>)[^<>]*\.(?:<\/p>)') as body_preview FROM news JOIN users ON news.author_id = users.id
                        WHERE textsearchable_body_and_title_index_col @@ plainto_tsquery('english',?)
                        AND date BETWEEN ? AND ?
                        AND section_id = ?
                        ;",[$request->searchText,$request->date1,$request->date2,$request->sectionSearch ]); 
                    } else {
                        return DB::select("SELECT news.id, title, users.username As author, date, votes, image, substring(body, '(?:<p>)[^<>]*\.(?:<\/p>)') as body_preview FROM news JOIN users ON news.author_id = users.id
                        WHERE textsearchable_body_and_title_index_col @@ plainto_tsquery('english',?)
                        AND date BETWEEN ? AND ?
                        AND section_id = ?
                        AND username = ?;",[$request->searchText,$request->date1,$request->date2,$request->sectionSearch, $request->authorSearch ]); 
                    }
                }
                
            }case 'onlyTitle':{
                if($request->sectionSearch == null){
                    if($request->authorSearch == null) {
                        return DB::select("SELECT news.id, title, users.username As author, date, votes, image, substring(body, '(?:<p>)[^<>]*\.(?:<\/p>)') as body_preview FROM news JOIN users ON news.author_id = users.id
                        WHERE textsearchable_title_index_col @@ plainto_tsquery('english',?)
                        AND date BETWEEN ? AND ?
                       ;",[$request->searchText,$request->date1,$request->date2]); 
                    } else {
                        return DB::select("SELECT news.id, title, users.username As author, date, votes, image, substring(body, '(?:<p>)[^<>]*\.(?:<\/p>)') as body_preview FROM news JOIN users ON news.author_id = users.id
                        WHERE textsearchable_title_index_col @@ plainto_tsquery('english',?)
                        AND date BETWEEN ? AND ?
                       
                        AND username = ?;",[$request->searchText,$request->date1,$request->date2, $request->authorSearch ]); 
                    }
                } else{
                    if($request->authorSearch == null) {
                        return DB::select("SELECT news.id, title, users.username As author, date, votes, image, substring(body, '(?:<p>)[^<>]*\.(?:<\/p>)') as body_preview FROM news JOIN users ON news.author_id = users.id
                        WHERE textsearchable_title_index_col @@ plainto_tsquery('english',?)
                        AND date BETWEEN ? AND ?
                        AND section_id = ?
                        ;",[$request->searchText,$request->date1,$request->date2,$request->sectionSearch ]); 
                    } else {
                        return DB::select("SELECT news.id, title, users.username As author, date, votes, image, substring(body, '(?:<p>)[^<>]*\.(?:<\/p>)') as body_preview FROM news JOIN users ON news.author_id = users.id
                        WHERE textsearchable_title_index_col @@ plainto_tsquery('english',?)
                        AND date BETWEEN ? AND ?
                        AND section_id = ?
                        AND username = ?;",[$request->searchText,$request->date1,$request->date2,$request->sectionSearch, $request->authorSearch ]); 
                    }
                }
                
            }case 'onlyBody':{
                if($request->sectionSearch == null){
                    if($request->authorSearch == null) {
                        return DB::select("SELECT news.id, title, users.username As author, date, votes, image, substring(body, '(?:<p>)[^<>]*\.(?:<\/p>)') as body_preview FROM news JOIN users ON news.author_id = users.id
                        WHERE textsearchable_body_index_col @@ plainto_tsquery('english',?)
                        AND date BETWEEN ? AND ?
                       ;",[$request->searchText,$request->date1,$request->date2]); 
                    } else {
                        return DB::select("SELECT news.id, title, users.username As author, date, votes, image, substring(body, '(?:<p>)[^<>]*\.(?:<\/p>)') as body_preview FROM news JOIN users ON news.author_id = users.id
                        WHERE textsearchable_body_index_col @@ plainto_tsquery('english',?)
                        AND date BETWEEN ? AND ?
                       
                        AND username = ?;",[$request->searchText,$request->date1,$request->date2, $request->authorSearch ]); 
                    }
                } else{
                    if($request->authorSearch == null) {
                        return DB::select("SELECT news.id, title, users.username As author, date, votes, image, substring(body, '(?:<p>)[^<>]*\.(?:<\/p>)') as body_preview FROM news JOIN users ON news.author_id = users.id
                        WHERE textsearchable_body_index_col @@ plainto_tsquery('english',?)
                        AND date BETWEEN ? AND ?
                        AND section_id = ?
                        ;",[$request->searchText,$request->date1,$request->date2,$request->sectionSearch ]); 
                    } else {
                        return DB::select("SELECT news.id, title, users.username As author, date, votes, image, substring(body, '(?:<p>)[^<>]*\.(?:<\/p>)') as body_preview FROM news JOIN users ON news.author_id = users.id
                        WHERE textsearchable_body_index_col @@ plainto_tsquery('english',?)
                        AND date BETWEEN ? AND ?
                        AND section_id = ?
                        AND username = ?;",[$request->searchText,$request->date1,$request->date2,$request->sectionSearch, $request->authorSearch ]); 
                    }
                }
                
            }
        }
    }
}