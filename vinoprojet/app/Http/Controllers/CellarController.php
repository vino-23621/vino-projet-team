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
        $cellars = Cellar::where('user_id', Auth::id())->get();
        return view('cellars.index', compact('cellars'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('cellars.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        Cellar::create([
            'name' => $request->name,
            'user_id' => Auth::id()
        ]);

        return redirect()->route('cellars.index')->with('success', 'Cellar créée avec succès');
    }

    /**
     * Display the specified resource.
     */
    public function show(Cellar $cellar)
    {
        $this->authorize('view', $cellar);

        return view('cellars.show', compact('cellar'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Cellar $cellar)
    {
        $this->authorize('update', $cellar);
        return view('cellars.edit', compact('cellar'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Cellar $cellar)
    {
        $this->authorize('update', $cellar);

        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $cellar->update([
            'name' => $request->name,
        ]);

        return redirect()->route('cellars.index')->with('success', 'Cellar modifiée avec succès');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cellar $cellar)
    {
        $this->authorize('delete', $cellar);

        $cellar->delete();

        return redirect()->route('cellars.index')->with('success', 'Cellar supprimée');
    }
}
