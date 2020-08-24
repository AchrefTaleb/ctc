<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddMonthsPlansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('plans', function (Blueprint $table) {
            $table->float('m3_price');
            $table->string('m3_stripe_id')->nullable();

            $table->float('m6_price');
            $table->string('m6_stripe_id')->nullable();

            $table->float('m9_price');
            $table->string('m9_stripe_id')->nullable();

            $table->float('m12_price');
            $table->string('m12_stripe_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
