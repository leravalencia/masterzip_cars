<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAffiliatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('affiliates', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('partner_id')->unsigned();
            $table->foreign('partner_id')->references('id')->on('users');
            $table->integer('affiliate_id')->unsigned();
            $table->foreign('affiliate_id')->references('id')->on('users');
            $table->string('link')->nullable();
            $table->integer('link_id')->unsigned()->nullable();
            $table->foreign('link_id')->references('id')->on('affiliate_links');
            $table->softDeletes();
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
        Schema::dropIfExists('affiliates');
    }
}
