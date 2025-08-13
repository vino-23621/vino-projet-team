<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Cellar;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('user.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|min:2|max:255',
            'cellar_name' => 'required|string||min:2|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6|max:255|regex:/[a-z]/|regex:/[A-Z]/|regex:/[0-9]/|confirmed',
            'password_confirmation' => 'required'

        ],[
        'name.required' => 'Le champ nom est obligatoire.',
        'name.string'   => 'Le nom doit être une chaîne de caractères.',
        'name.min'      => 'Le nom doit contenir au moins :min caractères.',
        'name.max'      => 'Le nom ne peut pas dépasser :max caractères.',

        'cellar_name.required' => 'Le nom du cellier est obligatoire.',
        'cellar_name.string'   => 'Le nom du cellier doit être une chaîne de caractères.',
        'cellar_name.min'      => 'Le nom du cellier doit contenir au moins :min caractères.',
        'cellar_name.max'      => 'Le nom du cellier ne peut pas dépasser :max caractères.',

        'email.required' => 'Le champ adresse courriel est obligatoire.',
        'email.email'    => 'Veuillez fournir un format d’adresse courriel valide.',
        'email.unique'   => 'Cette adresse courriel est déjà utilisée.',

        'password.required'  => 'Le champ mot de passe est obligatoire.',
        'password.min'       => 'Le mot de passe doit avoir au moins :min caractères.',
        'password.max'       => 'Le mot de passe ne peut pas dépasser :max caractères.',
        'password.regex'     => 'Le mot de passe doit contenir au moins une majuscule, une minuscule et un chiffre.',
        'password.confirmed' => 'Le mot de passe et sa confirmation ne correspondent pas.',

        'password_confirmation.required' => 'Veuillez confirmer votre mot de passe.'
    ]);


        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $cellar = Cellar::create([
            'name' => $request->cellar_name,
            'user_id' => $user->id,
        ]);

        $user->update(['cellar_id' => $cellar->id]);

        return redirect()->route('login')->with('success', 'Utilisateur enregistré');
    }

    /**
     * Display the specified resource.
     */
    public function show()
    {
        return view('user.profile');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function editName(string $id)
    {
        if ($id != Auth::id()) {
            return redirect()->route('403.custom')->with('message', 'Il vaut mieux prendre un verre de vin au lieu de modifier le compte de ses amis.');
        }
        return view('user.edit-name');
    }

    /**
     * Update the specified resource in storage.
     */
    public function updateName(Request $request, string $id)
    {
        if ($id != Auth::id()) {
            return redirect()->route('403.custom')->with('message', 'Il vaut mieux prendre un verre de vin au lieu de modifier le compte de ses amis.');
        }
        $request->validate([
            'name' => 'required|string||min:2|max:255'
        ],[
            'name.required' => 'Le champ nom est obligatoire.',
            'name.string'   => 'Le nom doit être une chaîne de caractères.',
            'name.min'      => 'Le nom doit contenir au moins :min caractères.',
            'name.max'      => 'Le nom ne peut pas dépasser :max caractères.'
        ]);

        $user = User::where('id', Auth::id())->first();
        $user->name = $request->name;
        $user->save();

        return redirect()->route('user.show')->with('success', 'nom modifié');
    }

    public function editPassword(string $id)
    {
        if ($id != Auth::id()) {
            return redirect()->route('403.custom')->with('message', 'Il vaut mieux prendre un verre de vin au lieu de modifier le compte de ses amis.');
        }
        return view('user.edit-password');
    }

    /**
     * Update the specified resource in storage.
     */
    public function updatePassword(Request $request, string $id)
    {
        if ($id != Auth::id()) {
            return redirect()->route('403.custom')->with('message', 'Il vaut mieux prendre un verre de vin au lieu de modifier le compte de ses amis.');
        }
        $request->validate([
            'password' => 'required|min:6|max:255|string|regex:/[a-z]/|regex:/[A-Z]/|regex:/[0-9]/',
            'password_confirmation' =>  'required|min:6|max:255|string|same:password'
        ],[
            'password.required' => 'Le champ mot de passe est obligatoire.',
            'password.min'      => 'Le mot de passe doit avoir au moins :min caractères.',
            'password.max'      => 'Le mot de passe ne peut pas dépasser :max caractères.',
            'password.string'   => 'Le mot de passe doit être une chaîne de caractères.',
            'password.regex'    => 'Le mot de passe doit contenir au moins une majuscule, une minuscule et un chiffre.',

            'password_confirmation.required' => 'Veuillez confirmer votre mot de passe.',
            'password_confirmation.min'      => 'La confirmation du mot de passe doit avoir au moins :min caractères.',
            'password_confirmation.max'      => 'La confirmation du mot de passe ne peut pas dépasser :max caractères.',
            'password_confirmation.string'   => 'La confirmation du mot de passe doit être une chaîne de caractères.',
            'password_confirmation.same'     => 'Le mot de passe et sa confirmation ne correspondent pas.'
        ]);

        $password_encrypted = Hash::make($request->password);
        $user = User::where('id', Auth::id())->first();
        $user->password = $password_encrypted;
        $user->save();

        return redirect()->route('user.show')->with('success', 'mot de passe modifié');
    }

    public function setCellarDefault(string $cellar_id)
    {
        $cellar = Cellar::where('id', $cellar_id)->where('user_id', Auth::id())->first();

        if (!$cellar) {
            return redirect()->route('403.custom')->with('message', 'Ce cellier ne vous appartient pas.');
        }

        $user = Auth::user();
        $user->cellar_id = $cellar_id;
        $user->save();

        return redirect()->route('cellars.index')->with('success', 'cellier défaut modifié');
    }



    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if ($id != Auth::id()) {
            return redirect()->route('index');
        }

        $user = User::find($id);

        if ($user) {
            $user->delete();
            Auth::logout();
            Session::flush();

            return redirect()->route('login')->with('success', 'utilisateur supprimé');
        } else {
            return redirect()->route('profil');
        }
    }
}
