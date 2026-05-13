<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Password;
use App\Models\User;
use App\Models\Guest;
use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function create(){
        return view('auth.register');
    }

    public function store(Request $request)
    {
        //validate
        $request->validate([
            'firstName' => ['required', 'string', 'max:255'],
            'lastName' => ['required', 'string', 'max:255'],
            'birthDate' => ['required', 'date', 'before:today'],
            'birthPlace' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', Password::default()],
        ]);

        //create first guest and than user
        $guest = Guest::create([
            'firstName' => $request->firstName,
            'lastName' => $request->lastName,
            'birthDate' => $request->birthDate,
            'birthPlace' => $request->birthPlace
        ]);

        $user = User::create([
            'firstName' => $request->firstName,
            'lastName' => $request->lastName,
            'birthDate' => $request->birthDate,
            'birthPlace' => $request->birthPlace,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'guestId' => $guest->id
        ]);

        event(new Registered($user));
        Auth::login($user);

        return redirect()->route('verification.notice');
    }

    public function verify()
    {
        return view('auth.verify-email');
    }

    public function click(EmailVerificationRequest $request)
    {
        $request->fulfill();
        return redirect('/profile');
    }
}
