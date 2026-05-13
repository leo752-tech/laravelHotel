<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('userId')->constrained('users')->cascadeOnDelete();
            $table->date('checkInDate');
            $table->date('checkOutDate');
            $table->foreignId('roomId')->constrained('rooms');
            $table->integer('totalPrice');
            $table->foreignId('specialOfferId')->nullable()->constrained('special_offers')->cascadeOnDelete();
            $table->boolean('cancellation')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
