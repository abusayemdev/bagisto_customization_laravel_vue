<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCourierZonesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('courier_zones', function (Blueprint $table) {
            $table->id();
            $table->string('zone_name')->nullable();
            $table->string('weight_increase_rate')->nullable();
            $table->string('initial_shipping_charge')->nullable();
            $table->string('shipping_charge_increase_rate')->nullable();
            $table->string('shipping_charge_type')->nullable();
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
        Schema::dropIfExists('courier_zones');
    }
}
