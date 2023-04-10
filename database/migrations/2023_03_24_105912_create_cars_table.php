<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cars', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            // $table->string('plat');
            $table->float('dailyPrice')->nullable();
            $table->float('monthlyPrice')->nullable();
            $table->float('mileage')->nullable();
            $table->string('gearType')->nullable();
            $table->string('gasType')->nullable();
            $table->text('description')->nullable();
            $table->boolean('status')->default(0);
            $table->string('thumbnailUrl')->nullable();
            // $table->double('price');
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
};
