<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $fillable = ['title', 'isbn', 'count_of_pages', 'user_id', 'publishers_id'];

    public function authors()
    {
        return $this->hasMany(User::class, 'id');
    }

    public function publishers(){
        return $this->hasMany(Publisher::class, 'id');
    }
    public function publishers1(){
        return $this->belongsToMany(Publisher::class, 'books', 'publishers_id', 'id');
    }
}
