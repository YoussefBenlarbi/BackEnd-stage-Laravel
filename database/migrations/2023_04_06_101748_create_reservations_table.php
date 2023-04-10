<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reservations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreignId('car_id')->references('id')->on('cars')->onDelete('cascade');
            $table->date('date_start');
            $table->date('date_end');
            $table->date('date_reservation')->default(date('Y-m-d'));
            $table->string('status')->default(1);
            $table->double('total')->nullable();
            $table->text('note')->nullable();
            $table->timestamps();
        });
        DB::statement('ALTER TABLE reservations ADD CONSTRAINT check_dates CHECK (date_start < date_end)');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reservations');
    }
};
