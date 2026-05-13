<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Models\Image;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    
    public function index()
    {
        $rooms = Room::with('images')->get();
        return view('admin.rooms.index', compact('rooms'));
    }

    public function indexUser()
    {
        $rooms = Room::with('images')->get();
        return view('room.index', compact('rooms'));
    }
   
    public function showDetailGuest($id)
    {
        $room = Room::with('images')->findOrFail($id);
        return view('room.detailGuest', compact('room'));
    }
    public function create()
    {
        return view('admin.rooms.create');
    }

   
    public function store(Request $request)
    {
        try{
            $validated = $request->validate([
                'name'        => 'required|string|max:100',
                'type'        => 'required|string|in:Standard,Luxury,Suite,Deluxe',
                'beds'        => 'required|integer|min:1|max:10',
                'price'       => 'required|numeric|min:0',
                'description' => 'required|string|min:10',
                'images'      => 'required|array|min:1|max:5', 
                'images.*'    => 'image|mimes:jpeg,png,jpg|max:2048', 
            ], [
                'images.required' => 'Devi caricare almeno una foto per la camera.',
                'images.*.max'    => 'Ogni immagine non può superare i 2MB.',
                'type.in'         => 'Seleziona una tipologia valida tra quelle elencate.',
            ]);

            $room = Room::create([
                'name'        => $validated['name'],
                'type'        => $validated['type'],
                'beds'        => $validated['beds'],
                'price'       => $validated['price'],
                'description' => $validated['description'],
            ]);

            if ($request->hasFile('images')) {
                foreach ($request->file('images') as $file) {
                    $path = $file->store('room', 'public');

                    $room->images()->create([
                        'pathImage' => $path
                    ]);
                }
            }

            return redirect()->route('admin.rooms.index')->with('success', 'Camera creata con successo!');
        } catch (\Exception $e) {
            // Questo fermerà l'esecuzione e ti mostrerà l'errore esatto a schermo
            dd($e->getMessage());
        }
    }

    
    public function show(Room $room)
    {
        return view('admin.rooms.show', compact('room'));
    }

    
    public function edit(Room $room)
    {
        return view('admin.rooms.edit', compact('room'));
    }

   
    
    public function update(Request $request, Room $room)
    {
        $room->update($request->only(['name', 'beds', 'price', 'type', 'description']));

        if ($request->hasFile('new_images')) {
            foreach ($request->file('new_images') as $file) {
                $path = $file->store('room', 'public');
                $room->images()->create(['pathImage' => $path]);
            }
        }

        return redirect()->route('admin.rooms.index')->with('success', 'Camera aggiornata con successo!');
    }

    public function deleteImage($id)
    {
        try {
            $image = \App\Models\Image::findOrFail($id); // Cerchiamo l'immagine manualmente
            // 1. Elimina il file fisico dallo storage di Herd
            if (Storage::disk('public')->exists($image->pathImage)) {
                Storage::disk('public')->delete($image->pathImage);
            }

            // 2. Elimina il record dal database
            $image->delete();

            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }
    

  
    public function destroy(Room $room)
    {
        $room->delete();

        return redirect('/admin/rooms')->with('success', 'Camera eliminata.');
    }
}
