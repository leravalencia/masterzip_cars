<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Car
 * @package App
 * @mixin \Eloquent
 */
class Car extends Model
{
    protected $table = 'cars';
    protected $fillable = [
        'id', 'car_id', 'url', 'make', 'model', 'trim', 'year', 'color',
        'transmission', 'fuel_type', 'number_of_seats', 'number_of_doors',
        'gps', 'convertible', 'status', 'booking_instantly', 'city', 'state',
        'zip_code', 'country', 'latitude', 'longitude', 'owner_id', 'owner',
        'price_per_day', 'custom_delivery_fee', 'airport_delivery_fee',
        'distance_includedday_miles_km', 'distance_includedweek_miles_km',
        'distance_includedmonthy_miles_km', 'booking_discount_weekly',
        'booking_discount_monthly', 'fee_for_extra_mile', 'registration_date',
        'trip_count', 'occupancy_jan', 'occupancy_feb', 'occupancy_mar',
        'occupancy_apr', 'occupancy_may', 'occupancy_jun', 'occupancy_jul',
        'occupancy_aug', 'occupancy_sep', 'occupancy_oct', 'occupancy_nov',
        'occupancy_dec', 'processed',
    ];
}
