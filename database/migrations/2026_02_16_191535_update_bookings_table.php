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
        Schema::table('bookings', function (Blueprint $table) {
            // Aggiungiamo il nuovo attributo 'status'
            // Lo mettiamo dopo 'roomId' o dove preferisci con 'after'
            $table->string('status')->default('pending')->after('room_id');

            // Eliminiamo il vecchio attributo 'cancellation'
            $table->dropColumn('cancellation');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
