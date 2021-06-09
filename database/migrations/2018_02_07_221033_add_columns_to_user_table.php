<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnsToUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('industry')->after('name')->nullable();
            $table->string('country')->after('name')->nullable();
            $table->string('phone')->after('name')->nullable();
            $table->string('title')->after('name')->nullable();
            $table->string('company')->after('name')->nullable();
            $table->string('last_name')->after('name')->nullable();
            $table->string('name')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
       Schema::table('users', function (Blueprint $table) {
           $table->string('name')->change();
           $table->dropColumn('industry');
           $table->dropColumn('country');
           $table->dropColumn('phone');
           $table->dropColumn('title');
           $table->dropColumn('company');
           $table->dropColumn('last_name');
       });
    }
}
