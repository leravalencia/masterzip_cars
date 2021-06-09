<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Report
 * @package App
 * @mixin \Eloquent
 * @property int id
 * @property string url
 * @property string file_name
 */
class Report extends Model
{
    use SoftDeletes;

    public static $userReportsPath = 'reports';

    protected $table = 'reports';
    protected $fillable = [
        'id', 'title', 'file_name', 'user_id', 'url',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
