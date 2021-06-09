<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class AffiliateLink
 * @package App
 * @mixin \Eloquent
 * @property int user_id
 * @property string link
 * @property int views
 * @property int registers
 */
class AffiliateLink extends Model
{
    use SoftDeletes;
    protected $table = 'affiliate_links';
    protected $fillable = [
        'user_id', 'link', 'views', 'registers',
    ];

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }
}
