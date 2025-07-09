<?php

namespace App\Http\Controllers;

use App\Models\Bottle;
use App\Models\Identity;
use App\Models\Country;
use App\Models\Cellar;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CellarController extends Controller
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
        return view('cellar.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|min:10|max:255',

        ]);

        Cellar::create([
            'name' => $request->name,
            'user_id' => Auth::id()
        ]);

        return redirect()->route('cellar.index')->with('success', 'Cellar créée avec succès');
    }

    /**
     * Display the specified resource.
     */
    public function show(Cellar $cellar)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Cellar $cellar)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Cellar $cellar)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cellar $cellar)
    {
        //
    }
}
