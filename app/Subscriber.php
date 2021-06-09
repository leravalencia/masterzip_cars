<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Subscriber
 * @package App
 * @mixin \Eloquent
 */
class Subscriber extends Model
{
    use SoftDeletes;
    protected $table = 'subscribers';
    protected $fillable = ['email'];
}
