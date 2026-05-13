<?php

namespace App\Http\Controllers;

use App\Models\Guest;
use App\Models\Room;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class UserController extends Controller
{
    
    public function home()
    {
        $rooms = Room::all();
        return view('welcome', compact('rooms'));
    }

    public function index()
    {
        $guests = Guest::with('user')->latest()->paginate(15);

        return view('admin.users.index', compact('guests'));
    }

    
    public function create()
    {
        return view('admin.users.create');
    }

    
    public function store(Request $request)
    {
        $validated = $request->validate([
            'firstName'  => 'required|string|max:255',
            'lastName'   => 'required|string|max:255',
            'birthDate'  => 'required|date',
            'birthPlace' => 'required|string|max:255',
            'email'      => 'required_if:has_account,on|nullable|email|unique:users,email',
            'password'   => 'required_if:has_account,on|nullable|min:8',
        ]);

        try {
            DB::transaction(function () use ($request, $validated) {

                $guest = Guest::create([
                    'firstName'  => $validated['firstName'],
                    'lastName'   => $validated['lastName'],
                    'birthDate'  => $validated['birthDate'],
                    'birthPlace' => $validated['birthPlace'],
                ]);

                if ($request->has('has_account')) {
                    User::create([
                        'firstName'  => $validated['firstName'],
                        'lastName'   => $validated['lastName'],
                        'birthDate'  => $validated['birthDate'],
                        'birthPlace' => $validated['birthPlace'],
                        'email'      => $validated['email'],
                        'password'   => Hash::make($validated['password']),
                        'guestId'    => $guest->id,
                        'isBanned'   => false,
                    ]);
                }
            }); 

            return redirect()->route('admin.users.index')
                ->with('success', 'Ospite registrato correttamente!');
        } catch (\Exception $e) {
            return back()->withInput()
                ->with('error', 'Errore durante il salvataggio: ' . $e->getMessage());
        }
    }

    
    public function show(User $user)
    {
        //
    }

    
    public function edit($id)
    {
        $guest = Guest::with('user')->findOrFail($id);

        return view('admin.users.edit', compact('guest'));
    }
    
    public function update(Request $request, $id)
    {
        $guest = Guest::findOrFail($id);

        $validated = $request->validate([
            'firstName'  => 'required|string|max:255',
            'lastName'   => 'required|string|max:255',
            'birthDate'  => 'required|date',
            'birthPlace' => 'required|string|max:255',
            'email'      => 'nullable|email|unique:users,email,' . ($guest->user->id ?? 'NULL'),
            'password'   => 'nullable|min:8',
        ]);

        try {
            DB::transaction(function () use ($request, $validated, $guest) {

                $guest->update([
                    'firstName'  => $validated['firstName'],
                    'lastName'   => $validated['lastName'],
                    'birthDate'  => $validated['birthDate'],
                    'birthPlace' => $validated['birthPlace'],
                ]);

                if ($guest->user) {
                    $userData = [
                        'firstName'  => $validated['firstName'],
                        'lastName'   => $validated['lastName'],
                        'birthDate'  => $validated['birthDate'],
                        'birthPlace' => $validated['birthPlace'],
                        'email'      => $validated['email'],
                        'isBanned'   => $request->has('isBanned'),
                    ];

                    if ($request->filled('password')) {
                        $userData['password'] = Hash::make($request->password);
                    }

                    $guest->user->update($userData);
                } elseif ($request->has('activate_account')) {
                    User::create([
                        'firstName'  => $validated['firstName'],
                        'lastName'   => $validated['lastName'],
                        'birthDate'  => $validated['birthDate'],
                        'birthPlace' => $validated['birthPlace'],
                        'email'      => $validated['email'],
                        'password'   => Hash::make($request->password),
                        'guestId'    => $guest->id,
                    ]);
                }
            });

            return redirect()->route('admin.users.index')->with('success', 'Dati aggiornati e sincronizzati!');
        } catch (\Exception $e) {
            return back()->withInput()->with('error', 'Errore: ' . $e->getMessage());
        }
    }

    
    public function destroy(User $user)
    {
        //
    }

    public function ban($id)
    {
        
    }
}
