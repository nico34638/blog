<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'posts';

    /**
     * The database primary key value.
     *
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'slug', 'content', 'category_id', 'user_id'];

    public function category(){
      return $this->belongsTo('App\Category');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getExcerpt($max_words = 100, $ending = "...") {
        $text = strip_tags($this->html);
        $words = explode(' ', $text);
        if (count($words) > $max_words) {
            return implode(' ', array_slice($words, 0, $max_words)) . $ending;
        }
        return $text;
    }

    public function getExtrait(){
            $html =  substr($this->content, 0, 300) ;
            return $html;
        }
}
