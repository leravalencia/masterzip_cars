<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Affiliate
 * @package App
 * @mixin \Eloquent
 */
class Affiliate extends Model
{
    protected $table = 'affiliates';
    protected $fillable = [
        'partner_id', 'affiliate_id', 'link', 'link_id',
    ];

    public function partner()
    {
        return $this->hasOne(User::class, 'id', 'partner_id');
    }

    public function affiliates()
    {
        return $this->hasOne(User::class, 'id', 'affiliate_id');
    }
}
