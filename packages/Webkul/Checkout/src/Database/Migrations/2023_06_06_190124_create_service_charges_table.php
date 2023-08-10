<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServiceChargesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('service_charges', function (Blueprint $table) {
            $table->id();
            $table->decimal('primary_charge', 12, 4)->default(0);
            $table->string('payment_service_name')->nullable();
            $table->decimal('charge_limit', 12, 4)->default(0);
            $table->decimal('additional_charge', 12, 4)->default(0);
            $table->string('percent_of_total')->nullable();
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
        Schema::dropIfExists('service_charges');
    }
}
