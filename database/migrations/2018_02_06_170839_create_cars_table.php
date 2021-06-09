<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cars', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('car_id')->unique()->unsigned();
            $table->string('url');
            $table->string('make');
            $table->string('model');
            $table->string('trim')->nullable();
            $table->integer('year');
            $table->string('color')->nullable();
            $table->string('transmission')->nullable();
            $table->string('fuel_type')->nullable();
            $table->integer('number_of_seats')->nullable();
            $table->integer('number_of_doors')->nullable();
            $table->boolean('gps')->default(0);
            $table->boolean('convertible')->default(0);
            $table->string('status')->default('Disabled');
            $table->boolean('booking_instantly')->default(0);
            $table->string('city');
            $table->string('state');
            $table->string('zip_code');
            $table->string('country');
            $table->decimal('latitude', 10, 7);
            $table->decimal('longitude', 10, 7);
            $table->integer('owner_id')->unsigned();
            $table->string('owner');
            $table->integer('price_per_day');
            $table->string('custom_delivery_fee')->nullable();
            $table->string('airport_delivery_fee')->nullable();
            $table->integer('distance_includedday_miles_km')->nullable();
            $table->integer('distance_includedweek_miles_km')->nullable();
            $table->integer('distance_includedmonthy_miles_km')->nullable();
            $table->integer('booking_discount_weekly');
            $table->integer('booking_discount_monthly');
            $table->decimal('fee_for_extra_mile');
            $table->dateTime('registration_date');
            $table->integer('trip_count');
            $table->integer('occupancy_jan')->nullable();
            $table->integer('occupancy_feb')->nullable();
            $table->integer('occupancy_mar')->nullable();
            $table->integer('occupancy_apr')->nullable();
            $table->integer('occupancy_may')->nullable();
            $table->integer('occupancy_jun')->nullable();
            $table->integer('occupancy_jul')->nullable();
            $table->integer('occupancy_aug')->nullable();
            $table->integer('occupancy_sep')->nullable();
            $table->integer('occupancy_oct')->nullable();
            $table->integer('occupancy_nov')->nullable();
            $table->integer('occupancy_dec')->nullable();
            $table->boolean('processed')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cars');
    }
}
