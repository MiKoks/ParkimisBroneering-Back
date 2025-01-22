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
        Schema::create('parking_spots', function (Blueprint $table) {
            $table->id(); // Primary key
            $table->unsignedBigInteger('house_id'); // Foreign key to houses table
            $table->unsignedBigInteger('room_id')->nullable(); // Foreign key to rooms table
            $table->string('status')->default('available'); // Status: available, occupied
            $table->string('vehicle_reg_number')->nullable(); // Vehicle registration number
            $table->timestamps();
    
            $table->foreign('house_id')->references('id')->on('houses')->onDelete('cascade');
            $table->foreign('room_id')->references('id')->on('rooms')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('parking_spots');
    }
};
