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
        Schema::create('booking_service', function (Blueprint $table) {
            $table->id();
            // Collega alla tabella bookings
            $table->foreignId('bookingId')->constrained('bookings')->onDelete('cascade');
            // Collega alla tabella services (o extra_services, controlla il tuo nome tabella)
            $table->foreignId('serviceId')->constrained('service')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('booking_service');
    }
};
