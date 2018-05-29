<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Reporteditem;
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

    static public function queryNewsFromAllSectionsTB($searchText, $startDate, $endDate, $author) {
        if($request->authorSearch == null) {
            return DB::select("SELECT news.id, title, users.username As author, date, votes, image, substring(body, '(?:<p>)[^<>]*\.(?:<\/p>)') as body_preview FROM news JOIN users ON news.author_id = users.id
            WHERE textsearchable_body_and_title_index_col @@ plainto_tsquery('english',?)
            AND date BETWEEN ? AND ?
           ;",[$searchText,$startDate,$endDate]); 
        } else {
            return DB::select("SELECT news.id, title, users.username As author, date, votes, image, substring(body, '(?:<p>)[^<>]*\.(?:<\/p>)') as body_preview FROM news JOIN users ON news.author_id = users.id
            WHERE textsearchable_body_and_title_index_col @@ plainto_tsquery('english',?)
            AND date BETWEEN ? AND ?
           
            AND username = ?;",[$searchText,$startDate,$endDate, $author ]); 
        }
    }

    static public function queryNewsFromSpecificSectionTB($searchText, $startDate, $endDate, $section, $author) {
        if($author == null) {
            return DB::select("SELECT news.id, title, users.username As author, date, votes, image, substring(body, '(?:<p>)[^<>]*\.(?:<\/p>)') as body_preview FROM news JOIN users ON news.author_id = users.id
            WHERE textsearchable_body_and_title_index_col @@ plainto_tsquery('english',?)
            AND date BETWEEN ? AND ?
            AND section_id = ?
            ;",[$searchText,$startDate,$endDate,$section]); 
        } else {
            return DB::select("SELECT news.id, title, users.username As author, date, votes, image, substring(body, '(?:<p>)[^<>]*\.(?:<\/p>)') as body_preview FROM news JOIN users ON news.author_id = users.id
            WHERE textsearchable_body_and_title_index_col @@ plainto_tsquery('english',?)
            AND date BETWEEN ? AND ?
            AND section_id = ?
            AND username = ?;",[$searchText,$startDate,$endDate, $section, $author]); 
        }
    }

    static public function queryNewsFromAllSectionsT($searchText, $startDate, $endDate, $author) {
        if($author == null) {
            return DB::select("SELECT news.id, title, users.username As author, date, votes, image, substring(body, '(?:<p>)[^<>]*\.(?:<\/p>)') as body_preview FROM news JOIN users ON news.author_id = users.id
            WHERE textsearchable_title_index_col @@ plainto_tsquery('english',?)
            AND date BETWEEN ? AND ?
           ;",[$searchText,$startDate,$endDate]); 
        } else {
            return DB::select("SELECT news.id, title, users.username As author, date, votes, image, substring(body, '(?:<p>)[^<>]*\.(?:<\/p>)') as body_preview FROM news JOIN users ON news.author_id = users.id
            WHERE textsearchable_title_index_col @@ plainto_tsquery('english',?)
            AND date BETWEEN ? AND ?
           
            AND username = ?;",[$searchText,$startDate,$endDate, $author]); 
        }
    }

    static public function queryNewsFromSpecificSectionT($searchText, $startDate, $endDate, $section, $author) {
        if($author == null) {
            return DB::select("SELECT news.id, title, users.username As author, date, votes, image, substring(body, '(?:<p>)[^<>]*\.(?:<\/p>)') as body_preview FROM news JOIN users ON news.author_id = users.id
            WHERE textsearchable_title_index_col @@ plainto_tsquery('english',?)
            AND date BETWEEN ? AND ?
            AND section_id = ?
            ;",[$searchText,$startDate,$endDate,$section]); 
        } else {
            return DB::select("SELECT news.id, title, users.username As author, date, votes, image, substring(body, '(?:<p>)[^<>]*\.(?:<\/p>)') as body_preview FROM news JOIN users ON news.author_id = users.id
            WHERE textsearchable_title_index_col @@ plainto_tsquery('english',?)
            AND date BETWEEN ? AND ?
            AND section_id = ?
            AND username = ?;",[$searchText,$startDate,$endDate, $section, $author]); 
        }
    }

    static public function queryNewsFromAllSectionsB($searchText, $startDate, $endDate, $author) {
        if($author == null) {
            return DB::select("SELECT news.id, title, users.username As author, date, votes, image, substring(body, '(?:<p>)[^<>]*\.(?:<\/p>)') as body_preview FROM news JOIN users ON news.author_id = users.id
            WHERE textsearchable_body_index_col @@ plainto_tsquery('english',?)
            AND date BETWEEN ? AND ?
           ;",[$searchText,$startDate,$endDate]); 
        } else {
            return DB::select("SELECT news.id, title, users.username As author, date, votes, image, substring(body, '(?:<p>)[^<>]*\.(?:<\/p>)') as body_preview FROM news JOIN users ON news.author_id = users.id
            WHERE textsearchable_body_index_col @@ plainto_tsquery('english',?)
            AND date BETWEEN ? AND ?
           
            AND username = ?;",[$searchText,$startDate,$endDate, $author]); 
        }
    }

    static public function queryNewsFromSpecificSectionB($searchText, $startDate, $endDate, $section, $author) {
        if($author == null) {
            return DB::select("SELECT news.id, title, users.username As author, date, votes, image, substring(body, '(?:<p>)[^<>]*\.(?:<\/p>)') as body_preview FROM news JOIN users ON news.author_id = users.id
            WHERE textsearchable_body_index_col @@ plainto_tsquery('english',?)
            AND date BETWEEN ? AND ?
            AND section_id = ?
            ;",[$searchText,$startDate,$endDate, $section]); 
        } else {
            return DB::select("SELECT news.id, title, users.username As author, date, votes, image, substring(body, '(?:<p>)[^<>]*\.(?:<\/p>)') as body_preview FROM news JOIN users ON news.author_id = users.id
            WHERE textsearchable_body_index_col @@ plainto_tsquery('english',?)
            AND date BETWEEN ? AND ?
            AND section_id = ?
            AND username = ?;",[$searchText,$startDate,$endDate, $section, $author]); 
        }
    }

    static public function getNewsAdvanceSearch(Request $request) {
        switch ($request->elementToSearch) {
            case 'titleAndBody':{
                if($request->sectionSearch == null){
                    return News::queryNewsFromAllSectionsTB($request->searchText,$request->date1,$request->date2, $request->authorSearch);
                } 
                return News::queryNewsFromSpecificSectionTB($request->searchText,$request->date1,$request->date2,$request->sectionSearch, $request->authorSearch);                
            }case 'onlyTitle':{
                if($request->sectionSearch == null){
                    return News::queryNewsFromAllSectionsT($request->searchText,$request->date1,$request->date2, $request->authorSearch);
                } 
                return News::queryNewsFromSpecificSectionT($request->searchText,$request->date1,$request->date2,$request->sectionSearch, $request->authorSearch);
            }case 'onlyBody':{
                if($request->sectionSearch == null){
                    return News::queryNewsFromAllSectionsB($request->searchText,$request->date1,$request->date2, $request->authorSearch);
                }
                return News::queryNewsFromSpecificSectionB($request->searchText,$request->date1,$request->date2,$request->sectionSearch, $request->authorSearch);                
            }
        }
    }
    static public function getNews(Request $request, $section) {
       return DB::select('SELECT news.id, title, users.username As author, date, votes, image, substring(body, \'(?:<p>)[^<>]*\.(?:<\/p>)\') as body_preview 
        FROM news JOIN users ON news.author_id = users.id JOIN sections ON sections.id = news.section_id
        WHERE sections.name = ? AND NOT EXISTS (SELECT DeletedItems.news_id FROM DeletedItems WHERE News.id = DeletedItems.news_id)
        ORDER BY date DESC LIMIT 10 OFFSET ?',[$section, $request->input('next_preview')]);
    }
    static public function getPreviews(Request $request) {
        return DB::select('SELECT news.id, title, users.username As author, date, votes, image, substring(body, \'(?:<p>)[^<>]*\.(?:<\/p>)\') as body_preview 
        FROM news JOIN users ON news.author_id = users.id WHERE NOT EXISTS (SELECT DeletedItems.news_id FROM DeletedItems WHERE News.id = DeletedItems.news_id)
        ORDER BY date DESC LIMIT 10 OFFSET ?',[$request->input('next_preview')]);
    }







    static public function userOwnsNews($news_id,$user_id) {
        return DB::select('SELECT * FROM news WHERE id = ? AND author_id = ?',[$news_id,$user_id]);
    }

    static public function getVote($news_id,$user_id) {
        return DB::select('SELECT type from votes WHERE user_id = ? AND news_id = ?',[$user_id,$news_id]);
    }

    static public function getVotes($news_id) {
        return  DB::select('SELECT votes FROM news WHERE id = ?', [$news_id]);
    }

    static public function insertVote($user_id,$news_id,$request_vote_type) {
        DB::select('INSERT INTO Votes (user_id, news_id, type) VALUES (?, ?, ?);',[$user_id,$news_id,$request_vote_type]);   
    }
    static public function deleteVote($user_id,$news_id) {
        DB::select('DELETE FROM votes WHERE user_id=? AND news_id=?',[$user_id,$news_id]);
                }
    static public function updateVote($user_id,$news_id,$request_vote_type) {
        DB::select('UPDATE Votes SET type=? WHERE user_id=? AND news_id=?',[$request_vote_type,$user_id,$news_id]);   
    }



    static public function searchUsers($searchText, $offset) {
        $name = strtolower($searchText);
        return DB::select("SELECT users.id, username, picture
        FROM users WHERE LOWER(users.username) LIKE '%{$name}%'
        ORDER BY username DESC LIMIT 25 OFFSET ?;",[$offset]);
      }
  
      static  public function searchNewsByPopularity($searchText, $offset) {
        return DB::select("SELECT news.id, title, users.username As author, date, votes, image, substring(body, '(?:<p>)[^<>]*\.(?:<\/p>)') as body_preview
          FROM news NATURAL JOIN newspoints JOIN users ON news.author_id = users.id
            WHERE NOT EXISTS (SELECT * FROM DeletedItems WHERE DeletedItems.news_id = News.id)
            AND textsearchable_body_and_title_index_col @@ plainto_tsquery('english',?)
          ORDER BY newspoints.points DESC LIMIT 10 OFFSET ?", [$searchText, $offset]);
      }
  
      static  public function searchNewsByDate($searchText, $offset) {
        return DB::select("SELECT news.id, title, users.username As author, date, votes, image, substring(body, '(?:<p>)[^<>]*\.(?:<\/p>)') as body_preview
          FROM news JOIN users ON news.author_id = users.id
            WHERE NOT EXISTS (SELECT * FROM DeletedItems WHERE DeletedItems.news_id = News.id)
            AND textsearchable_body_and_title_index_col @@ plainto_tsquery('english',?)
          ORDER BY date DESC LIMIT 10 OFFSET ?", [$searchText, $offset]);
      }
  
      static  public function searchNewsByVotes($searchText, $offset) {
        return DB::select("SELECT news.id, title, users.username As author, date, votes, image, substring(body, '(?:<p>)[^<>]*\.(?:<\/p>)') as body_preview
          FROM news JOIN users ON news.author_id = users.id
            WHERE NOT EXISTS (SELECT * FROM DeletedItems WHERE DeletedItems.news_id = News.id)
            AND textsearchable_body_and_title_index_col @@ plainto_tsquery('english',?)
          ORDER BY votes DESC LIMIT 10 OFFSET ?", [$searchText, $offset]);
      }
  
      static   public function getUserSectionsArray() {
        $userSections = DB::select('SELECT name
          FROM Sections
            INNER JOIN UserInterests ON Sections.id = UserInterests.section_id
          WHERE UserInterests.user_id = ?', [Auth::user()->id]);
        $userSectionsArray = [];
        for ($i = 0; $i < count($userSections); $i++) {
          array_push($userSectionsArray, $userSections[$i]->name);
        }
        return $userSectionsArray;
      }
      static public function getQueryBindings($numBindings) {
        if ($numBindings == 0) {
          return "1 = 2 AND"; // impossible so no news are returned
        }
        return 'sections.name IN (' . implode(',', array_fill(0, $numBindings, '?')) . ') AND';
      }
    static public function getNewsByPopularity($section, $offset, $direction) {
        if(strcmp($section, 'All') == 0) {
          return DB::select('SELECT news.id, title, users.username As author, date, votes, image, substring(body, \'(?:<p>)[^<>]*\.(?:<\/p>)\') as body_preview
            FROM news NATURAL JOIN newspoints JOIN users ON news.author_id = users.id
            WHERE NOT EXISTS (SELECT * FROM DeletedItems WHERE DeletedItems.news_id = News.id)
            ORDER BY newspoints.points '.$direction.' LIMIT 10 OFFSET ?', [$offset]);
        } else if (strcmp($section, 'For You') == 0) {
          $selectInputs = News::getUserSectionsArray();
          $userSectionsBindings = News::getQueryBindings(count($selectInputs));
          array_push($selectInputs, $offset);
          return DB::select('SELECT news.id, title, users.username As author, date, votes, image, substring(body, \'(?:<p>)[^<>]*\.(?:<\/p>)\') as body_preview
            FROM news NATURAL JOIN newspoints JOIN users ON news.author_id = users.id
              INNER JOIN sections ON news.section_id = sections.id
            WHERE ' . $userSectionsBindings . ' NOT EXISTS (SELECT * FROM DeletedItems WHERE DeletedItems.news_id = News.id)
            ORDER BY newspoints.points '.$direction.' LIMIT 10 OFFSET ?', $selectInputs);
        } else {
          return DB::select('SELECT news.id, title, users.username As author, date, votes, image, substring(body, \'(?:<p>)[^<>]*\.(?:<\/p>)\') as body_preview
            FROM news NATURAL JOIN newspoints JOIN users ON news.author_id = users.id
              INNER JOIN sections ON news.section_id = sections.id
            WHERE sections.name = ? AND NOT EXISTS (SELECT * FROM DeletedItems WHERE DeletedItems.news_id = News.id)
            ORDER BY newspoints.points '.$direction.' LIMIT 10 OFFSET ?', [$section, $offset]);
        }
      }
  
      static public function getNewsByVotes($section, $offset, $direction) {
        if(strcmp($section, 'All') == 0) {
          return DB::select('SELECT news.id, title, users.username As author, date, votes, image, substring(body, \'(?:<p>)[^<>]*\.(?:<\/p>)\') as body_preview
              FROM news JOIN users ON news.author_id = users.id
              WHERE NOT EXISTS (SELECT * FROM DeletedItems WHERE DeletedItems.news_id = News.id)
              ORDER BY votes '.$direction.' LIMIT 10 OFFSET ?', [$offset]);
        } else if (strcmp($section, 'For You') == 0) {
          $selectInputs = News::getUserSectionsArray();
          $userSectionsBindings = News::getQueryBindings(count($selectInputs));
          array_push($selectInputs, $offset);
          return DB::select('SELECT news.id, title, users.username As author, date, votes, image, substring(body, \'(?:<p>)[^<>]*\.(?:<\/p>)\') as body_preview
            FROM news NATURAL JOIN newspoints JOIN users ON news.author_id = users.id
              INNER JOIN sections ON news.section_id = sections.id
            WHERE ' . $userSectionsBindings . ' NOT EXISTS (SELECT * FROM DeletedItems WHERE DeletedItems.news_id = News.id)
            ORDER BY votes '.$direction.' LIMIT 10 OFFSET ?', $selectInputs);
        } else {
          return DB::select('SELECT news.id, title, users.username As author, date, votes, image, substring(body, \'(?:<p>)[^<>]*\.(?:<\/p>)\') as body_preview
            FROM news JOIN users ON news.author_id = users.id
              INNER JOIN sections ON news.section_id = sections.id
            WHERE sections.name = ? AND NOT EXISTS (SELECT * FROM DeletedItems WHERE DeletedItems.news_id = News.id)
            ORDER BY votes '.$direction.' LIMIT 10 OFFSET ?', [$section, $offset]);
        }
      }
  
  


      static public function getNewsByDate($section, $offset, $direction) {
        if(strcmp($section, 'All') == 0) {
          return DB::select('SELECT news.id, title, users.username As author, date, votes, image, substring(body, \'(?:<p>)[^<>]*\.(?:<\/p>)\') as body_preview
            FROM news JOIN users ON news.author_id = users.id
            WHERE NOT EXISTS (SELECT * FROM DeletedItems WHERE DeletedItems.news_id = News.id)
            ORDER BY date '.$direction.' LIMIT 10 OFFSET ?', [$offset]);
        } else if (strcmp($section, 'For You') == 0) {
          $selectInputs = News::getUserSectionsArray();
          $userSectionsBindings = News::getQueryBindings(count($selectInputs));
          array_push($selectInputs, $offset);
          return DB::select('SELECT news.id, title, users.username As author, date, votes, image, substring(body, \'(?:<p>)[^<>]*\.(?:<\/p>)\') as body_preview
            FROM news NATURAL JOIN newspoints JOIN users ON news.author_id = users.id
              INNER JOIN sections ON news.section_id = sections.id
            WHERE ' . $userSectionsBindings . ' NOT EXISTS (SELECT * FROM DeletedItems WHERE DeletedItems.news_id = News.id)
            ORDER BY date '.$direction.' LIMIT 10 OFFSET ?', $selectInputs);
        } else {
          return DB::select('SELECT news.id, title, users.username As author, date, votes, image, substring(body, \'(?:<p>)[^<>]*\.(?:<\/p>)\') as body_preview
            FROM news JOIN users ON news.author_id = users.id
              INNER JOIN sections ON news.section_id = sections.id
            WHERE sections.name = ? AND NOT EXISTS (SELECT * FROM DeletedItems WHERE DeletedItems.news_id = News.id)
            ORDER BY date '.$direction.' LIMIT 10 OFFSET ?', [$section, $offset]);
        }
      }


      static public function getSections() {
        return DB::select('SELECT icon || \' fa-fw\' AS icon, name FROM Sections');
    }

    static public function getArticle($id) {
        return DB::select('SELECT News.id, title, author_id, date, body, image, votes, Sections.name AS section, Users.username AS author
        FROM News, Sections, Users
        WHERE News.id  = ? AND Sections.id = News.section_id AND Users.id = News.author_id AND NOT EXISTS (SELECT DeletedItems.news_id FROM DeletedItems WHERE DeletedItems.news_id = News.id)',[$id]);
    }

    static public function getSources($news_id) {
        return DB::select('SELECT *
        FROM Sources
          INNER JOIN NewsSources ON Sources.id = NewsSources.source_id
        WHERE NewsSources.news_id = ?', [$news_id]);;
    }

    static public function insertSource($news_id,$created_source_id) {
        DB::table('newssources')->insert(['news_id' => $news_id, 'source_id' => $created_source_id ]);
    }

    static public function selectSources($id) {
        return DB::select('SELECT link,author,publication_year FROM 
        sources JOIN (SELECT * FROM newssources WHERE news_id=?) AS sourcesForANews ON sources.id = sourcesForANews.source_id',
        [$id]);
    }


    static public function getDelected($article) {
        return DB::table('deleteditems')->where('news_id', $article->id)->get();
    }
    static public function newsExist($news_id) {
        return DB::table('news')->where('id',$news_id)->exists();
    }
    
}