<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * App\User
 *
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @mixin \Eloquent
 * @property string email
 * @property string|null name
 * @property string|null last_name
 * @property array|null reports
 * @property int id
 * @property string fullName
 * @property bool|int admin
 * @property bool|int partner
 * @property \Illuminate\Database\Eloquent\Collection|nul affiliateUsers
 */
class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'last_name', 'company', 'title', 'country', 'industry', 'phone',
        'email', 'password', 'partner',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $dates = [
        'created_at', 'updated_at'
    ];

    public function reports()
    {
        return $this->hasMany(Report::class);
    }

    public function getFullNameAttribute(): string
    {
        return "{$this->name} {$this->last_name}";
    }

    public function affiliateLinks()
    {
        return $this->hasMany(AffiliateLink::class, 'user_id', 'id');
    }

    public function affiliates()
    {
        return $this->hasMany(Affiliate::class, 'partner_id', 'id');
    }

    public function affiliateUsers()
    {
        return $this->belongsToMany(User::class, (new Affiliate())->getTable(),'partner_id', 'affiliate_id');
    }

    public function affiliatesBy()
    {
        return $this->hasOne(Affiliate::class, 'affiliate_id', 'id');
    }
}
