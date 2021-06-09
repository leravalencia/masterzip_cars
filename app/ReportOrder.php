<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class ReportOrder
 * @package App
 * @mixin \Eloquent
 */
class ReportOrder extends Model
{
    protected $table = 'report_orders';
    protected $fillable = [
        'id', 'user_id', 'report_id', 'processed',
    ];

    public function report()
    {
        return $this->hasOne(Report::class);
    }

    public function user()
    {
        return $this->hasOne(User::class);
    }
}
