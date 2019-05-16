<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Book
 *
 * @package App
 */
class Book extends Model
{
    protected $fillable = [
        'title', 'isbn', 'count_of_pages', 'user_id', 'publisher_id'
    ];

    /**
     * Get author of book
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function authors()
    {
        return $this->hasMany(User::class, 'id', 'publisher_id');
    }

    /**
     * Get publisher of book
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function publishers()
    {
        return $this->hasMany(Publisher::class, 'id', 'user_id');
    }

}
