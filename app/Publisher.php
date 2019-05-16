<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Publisher
 *
 * @package App
 */
class Publisher extends Model
{
    protected $fillable = ['title', 'url'];
}
