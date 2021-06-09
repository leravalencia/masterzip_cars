<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Feedback
 * @package App
 * @mixin \Eloquent
 */
class Feedback extends Model
{
    use SoftDeletes;
    protected $table = 'feedback';
    protected $fillable = ['email', 'name', 'message'];
}
