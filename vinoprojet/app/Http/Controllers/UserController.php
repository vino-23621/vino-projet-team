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
            'name' => 'required|string||min:2|max:255',
            'cellar_name' => 'required|string||min:2|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|max:255|string|regex:/[a-z]/|regex:/[A-Z]/|regex:/[0-9]/',
            'password_confirmation' =>  'required|min:6|max:255|string|same:password'
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

        return redirect()->route('login');
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
        ]);

        $user = User::where('id', Auth::id())->first();
        $user->name = $request->name;
        $user->save();

        return redirect()->route('user.show');
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
        ]);

        $password_encrypted = Hash::make($request->password);
        $user = User::where('id', Auth::id())->first();
        $user->password = $password_encrypted;
        $user->save();

        return redirect()->route('user.show');
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

            return redirect()->route('login');
        } else {
            return redirect()->route('profil');
        }
    }
}
