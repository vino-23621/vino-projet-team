<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
   
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('auth.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
            'password' => 'required|min:2|max:20'
        ],[
            'email.required' => 'L’email est obligatoire.',
            'email.email'    => 'L’email doit être valide.',
            'email.exists'   => 'Cet email n’existe pas dans notre base.',
            'password.required' => 'Le mot de passe est obligatoire.',
            'password.min'      => 'Le mot de passe doit avoir au moins :min caractères.',
            'password.max'      => 'Le mot de passe ne peut pas dépasser :max caractères.'
        ]);

        $credentials = $request->only('email', 'password');

        if (!Auth::attempt($credentials)) {
            return redirect()->route('login')->withInput($request->except('password'))
                         ->withErrors(['email' => 'Les informations de connexion sont invalides.']);
        }

        return redirect()->intended(route('user.show'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy()
    {
        Session::flush();
        Auth::logout();
        return redirect(route('login'));
    }
}
