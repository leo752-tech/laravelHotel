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
            'lastName' => 'Casale',
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
            'lastName' => 'Casale',
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

        $services = [
            [
                'name' => 'Accoglienza & Flessibilità',
                'pathImage' => 'services/accoglienza.webp', // Mani che passano una chiave di design / benvenuto
                'description' => 'Ti accogliamo facendoti sentire a casa fin dal primo momento. Garantiamo la massima flessibilità sugli orari di arrivo, adattandoci alle tue esigenze per un check-in comodo, sicuro e senza stress.',
                'price' => 0, // Incluso nel soggiorno
            ],
            [
                'name' => 'Colazione Artigianale',
                'pathImage' => 'services/colazione2.webp', // Dettaglio tazza di caffè e pasticceria chic
                'description' => 'Il tuo buongiorno inizia con i sapori del territorio: una selezione di prodotti locali, dolci fatti in casa appena sfornati e opzioni personalizzate per ogni esigenza alimentare.',
                'price' => 0, // Incluso o gestibile come extra
            ],
            [
                'name' => 'Noleggio e convenzioni attrezzatura',
                'description' => 'Dimentica le code e lo stress. Prenota i tuoi sci, lo snowboard o le e-bike direttamente in hotel grazie alle nostre partnership esclusive con i migliori noleggi del territorio. Al tuo ritorno, potrai depositare tutto nella nostra Ski Room riscaldata e videosorvegliata.',
                'price' => 50,
                'pathImage' => 'services/noleggio.webp'
            ],
            [
                'name' => 'Beach Experience & Relax',
                'pathImage' => 'services/beach.webp', // Spiaggia / lettini al tramonto
                'description' => 'Il tuo posto al sole senza pensieri. Include l’accesso alla spiaggia attrezzata partner con ombrellone e lettini riservati, teli mare premium gratuiti e la possibilità di prenotare escursioni in barca al tramonto lungo la costa.',
                'price' => 0,
            ],
        ];

        foreach ($services as $service) {
            Service::create($service);
        }


        $rooms = [
            [
                'name' => 'Stanza Essenza',
                'beds' => 2,
                'price' => 9500, // 95.00€
                'type' => 'Standard',
                'description' => 'Un ambiente intimo e minimale, perfetto per chi cerca comfort e funzionalità. Arredata con materiali naturali, offre una splendida illuminazione naturale e dettagli di design contemporaneo.',
            ],
            [
                'name' => 'Stanza Orizzonte',
                'beds' => 2,
                'price' => 13000, // 130.00€
                'type' => 'Superior',
                'description' => 'Spazio e raffinatezza si fondono in questa camera superior. Dotata di un’ampia area relax interna e di una vista privilegiata sul panorama circostante, è pensata per soggiorni rigeneranti.',
            ],
            [
                'name' => 'Dimora Levante Suite',
                'beds' => 4,
                'price' => 19000, // 190.00€
                'type' => 'Suite',
                'description' => 'La massima espressione della nostra ospitalità. Una suite esclusiva con letto king-size, vasca da bagno di design a vista e un salotto privato dove godersi momenti di assoluta riservatezza.',
            ],
            [
                'name' => 'Stanza Equilibrio',
                'beds' => 3,
                'price' => 15500, // 155.00€
                'type' => 'Triple',
                'description' => 'Soluzione versatile ideale per piccoli gruppi o famiglie. Gli spazi sono ottimizzati per garantire a ciascun ospite la massima privacy, senza rinunciare allo stile sobrio ed elegante della struttura.',
            ],
        ];

        foreach ($rooms as $room) {
            Room::create($room);
        }

        $images1 = [
            'rooms/standardC.webp',
            'rooms/standard2.webp',
            'rooms/standard3.webp',
        ];

        foreach ($images1 as $image) {
            Image::create([
                'roomId' => 1,
                'pathImage' => $image
            ]);
        }

        $images2 = [
            'rooms/orizzonteC.webp',
            'rooms/orizzonte2.webp',
            'rooms/orizzonte3.webp',
        ];

        foreach ($images2 as $image) {
            Image::create([
                'roomId' => 2,
                'pathImage' => $image
            ]);
        }

        $images3 = [
            'rooms/suiteC.webp',
            'rooms/suite2.webp',
            'rooms/suite3.webp',
        ];

        foreach ($images3 as $image) {
            Image::create([
                'roomId' => 3,
                'pathImage' => $image
            ]);
        }

        //inserimento immagini per camere
        $images4 = [
            'rooms/equilibrioC.webp',
            'rooms/equilibrio2.webp',
            'rooms/equilibrio3.webp',
        ];

        foreach($images4 as $image){
            Image::create([
                'roomId' => 4,
                'pathImage' => $image
            ]);
        }

        // 4. Offerte
        SpecialOffer::create([
            'title' => 'Sconto Estate',
            'description' => 'Soggiorno di 7 giorni al prezzo di 5',
            'lenght' => 7,
            'specialPrice' => 0.28
        ]);

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
            'description' => 'Tutto bene, colazione ottima. Personale molto preparato e accogliente.',
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
