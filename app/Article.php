<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $fillable = ['title', 'body', 'user_id', 'visibility'];

    public function user()
    {
        return $this->belongsTo(User::class, "user_id");
    }

}
