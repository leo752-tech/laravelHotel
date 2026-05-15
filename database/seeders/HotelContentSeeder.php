<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Service;
use App\Models\Room;
use App\Models\SpecialOffer;
use App\Models\User;
use App\Models\Guest;
use App\Models\Image;
use App\Models\Booking;
use App\Models\Season;
use Illuminate\Support\Carbon;
use App\Models\Review; // Aggiunto il modello Review
use Illuminate\Support\Facades\Hash;

class HotelContentSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Crea un Guest e un User di test (necessario per le recensioni)
        $guest = Guest::create([
            'firstName' => 'Mario',
            'lastName' => 'Rossi',
            'birthDate' => '1990-01-01',
            'birthPlace' => 'Roma'
        ]);

        $guest1 = Guest::create([
            'firstName' => 'Leopoldo',
            'lastName' => 'Silvestri',
            'birthDate' => '2001-05-07',
            'birthPlace' => 'Sulmona'
        ]);

        $guest2 = Guest::create([
            'firstName' => 'Filiberto',
            'lastName' => 'Silvestri',
            'birthDate' => '2003-09-03',
            'birthPlace' => 'Sulmona'
        ]);

        $user = User::create([
            'firstName' => 'Mario',
            'lastName' => 'Rossi',
            'birthDate' => '1990-01-01',
            'birthPlace' => 'Roma',
            'email' => 'mario@example.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'guestId' => $guest->id,
            'isBanned' => false
        ]);
        

        $user1 = User::create([
            'firstName' => 'Leopoldo',
            'lastName' => 'Silvestri',
            'birthDate' => '2001-05-07',
            'birthPlace' => 'Sulmona',
            'email' => 'leopoldosilvestri@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('leomauri'),
            'guestId' => $guest1->id,
            'isBanned' => false
        ]);
        $user1->isAdmin = true;
        $user1->save();

        // 2. Servizi
        Service::create([
            'name' => 'Spa',
            'description' => 'Sauna e relax con percorso idromassaggio',
            'price' => 50,
            'pathImage' => 'service/spa2.jpg'
        ]);
        Service::create([
            'name' => 'Wifi',
            'description' => 'Connessione in fibra alta velocità in tutta la struttura',
            'price' => 5,
            'pathImage' => 'service/wifi.jpg'
        ]);

        // 3. Camere
        Room::create([
            'name' => 'Suite 101',
            'beds' => 2,
            'price' => 200,
            'type' => 'Luxury',
            'description' => 'Vista mare con balcone panoramico'
        ]);

        Room::create([
            'name' => 'Stanza 202',
            'beds' => 1,
            'price' => 90,
            'type' => 'Standard',
            'description' => 'Affaccio corte interna, molto silenziosa'
        ]);

        // 4. Offerte
        SpecialOffer::create([
            'title' => 'Sconto Estate',
            'description' => 'Soggiorno di 7 giorni al prezzo di 5',
            'lenght' => 7,
            'specialPrice' => 0.28
        ]);

        //inserimento immagini per camere
        $images1 = [
            'room/camera1_1.jpeg',
            'room/camera1_2.jpeg',
            'room/camera1_3.jpeg',
            'room/camera1_4.jpeg'            
        ];

        foreach($images1 as $image){
            Image::create([
                'roomId' => 1,
                'pathImage' => $image
            ]);
        }

        $images2 = [
            'room/camera2_1.jpeg',
            'room/camera2_2.jpeg',
            'room/camera2_3.jpeg',
            'room/camera2_4.jpeg'
        ];

        foreach ($images2 as $image) {
            Image::create([
                'roomId' => 2,
                'pathImage' => $image
            ]);
        }

        

        // --- RECORD 1: Prenotazione passata con Recensione ---
        $booking1 = Booking::create([
            'userId'         => 1,
            'roomId'         => 1,
            'checkInDate'    => Carbon::now()->addMonths(2)->format('Y-m-d'), // 2 mesi fa
            'checkOutDate'   => Carbon::now()->addMonths(2)->addDays(5)->format('Y-m-d'),
            'totalPrice'     => 550,
            'specialOfferId' => null,
            'status' => Booking::STATUS_CONFIRMED
        ]);

        Review::create([
            'title'       => 'Soggiorno indimenticabile',
            'description' => 'La camera era pulitissima e la vista mozzafiato. Torneremo sicuramente!',
            'rating'      => 5,
            'userId'      => 1,
            'bookingId'   => $booking1->id,
        ]);

        // --- RECORD 2: Prenotazione recente con Recensione ---
        $booking2 = Booking::create([
            'userId'         => 2,
            'roomId'         => 2,
            'checkInDate'    => Carbon::now()->addDays(10)->format('Y-m-d'),
            'checkOutDate'   => Carbon::now()->addDays(17)->format('Y-m-d'),
            'totalPrice'     => 320,
            'specialOfferId' => null,
            'status' => Booking::STATUS_CONFIRMED
        ]);

        Review::create([
            'title'       => 'Buona esperienza',
            'description' => 'Tutto bene, colazione ottima. Unica pecca il Wi-Fi un po\' lento in camera.',
            'rating'      => 4,
            'userId'      => 2,
            'bookingId'   => $booking2->id,
        ]);

        $booking3 = Booking::create([
            'userId'         => 1,
            'roomId'         => 2,
            'checkInDate'    => Carbon::now()->subDays(10)->format('Y-m-d'),
            'checkOutDate'   => Carbon::now()->subDays(6)->format('Y-m-d'),
            'totalPrice'     => 320,
            'specialOfferId' => null,
            'status' => Booking::STATUS_CHECKED_IN
        ]);

        Season::create([
            'name' => 'Alta Stagione Invernale',
            'startDate' => '2025-12-01',
            'endDate' => '2026-02-28',
            'multiplier' => 1.50, // Prezzo aumentato del 50%
        ]);

        // ALTA STAGIONE ESTIVA (Agosto)
        Season::create([
            'name' => 'Alta Stagione Estiva',
            'startDate' => '2026-08-01',
            'endDate' => '2026-08-31',
            'multiplier' => 1.70, // Prezzo aumentato del 70%
        ]);
    }
}
