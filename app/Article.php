<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Article extends Model
{
    protected $fillable = ['title', 'body', 'user_id', 'visibility'];

    public static function filterBy(Request $request){
        return self::when($request->_title, function($query) use($request){
            return $query->where('title', "LIKE", "%{$request->_title}%");
        })->when($request->_body, function($query) use($request){
            return $query->where('body', "LIKE", "%{$request->_body}%");
        })->when($request->_key, function($query)  use($request){
            return $query->where('id', '=', $request->_key);
        })->when($request->user, function($query)  use($request){
            return $query->where('user_id', '=', $request->user);
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class, "user_id");
    }

}
