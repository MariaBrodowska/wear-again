<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:'.User::class],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ], [
            'name.required' => 'Nazwa jest wymagana.',
            'name.string' => 'Nazwa musi być ciągiem tekstowym.',
            'name.max' => 'Nazwa nie może być dłuższa niż 255 znaków.',
            'name.unique' => 'Podane nazwa jest już zajęta.',
            'email.required' => 'Adres e-mail jest wymagany.',
            'email.string' => 'Adres e-mail musi być ciągiem tekstowym.',
            'email.lowercase' => 'Adres e-mail musi być zapisany małymi literami.',
            'email.email' => 'Podaj prawidłowy adres e-mail.',
            'email.max' => 'Adres e-mail nie może być dłuższy niż 255 znaków.',
            'email.unique' => 'Podany adres e-mail jest już zarejestrowany.',
            'password.required' => 'Hasło jest wymagane.',
            'password.confirmed' => 'Podane hasła muszą się zgadzać.',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect(route('offers.index', absolute: false));
    }
}
