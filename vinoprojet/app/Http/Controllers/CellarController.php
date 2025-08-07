<?php

namespace App\Http\Controllers;

use App\Models\Bottle;
use App\Models\Identity;
use App\Models\Country;
use App\Models\Cellar;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;


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
        return view('cellar.index', compact('cellars'));
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
            'name' => 'required|string|max:100',
        ]);

        Cellar::create([
            'name' => $request->name,
            'user_id' => Auth::user()->id,
        ]);

        return redirect()->route('cellars.index')->with('success', 'Cellar créée avec succès');
    }

    /**
     * Display the specified resource.
     */
    public function show(Cellar $cellar)
    {

        session(['active_cellar_id' => $cellar->id]);
        $cellar->load('bottles');
        

        $bottles = $cellar->bottles()->paginate(10);

        return view('cellar.show', compact('cellar', 'bottles'));

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Cellar $cellar)
    {
        return view('cellars.edit', ['cellar' => $cellar]);
    }

    /**
     * Update the specified resource in storage
     */
    public function update(Request $request, Cellar $cellar)
    {
        $request->validate([
            'name' => 'nullable|string|max:100',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,svg,webp|max:1048',
        ]);

        $data = [];

        if ($request->filled('name')) {
            $data['name'] = $request->name;
        }

        if ($request->hasFile('image')) {

            if ($cellar->image) {
                Storage::disk('public')->delete('cellar_images/' . $cellar->image);
            }

            $path = $request->file('image')->store('cellar_images', 'public');
            $filename = basename($path);
            $data['image'] = $filename;
        }

        if (!empty($data)) {
            $cellar->update($data);
        }

        return redirect()->route('cellars.index')->with('success', 'Cellier modifié avec succès!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cellar $cellar)
    {

        $user = auth()->user();

        if ($user->cellar_id === $cellar->id) {
            return redirect()->route('cellars.index')
                ->with('error', 'Vous ne pouvez pas supprimer votre cellier par défaut.');
        }

        $target = $cellar->name;

        \DB::table('cellar__has__bottles')->where('cellar_id', $cellar->id)->delete();

        $cellar->delete();
        return redirect()->route('cellars.index')->with('success', 'Le Cellar: ' . $target . 'a été effacé!');
    }


    public function addBottle(Request $request)
    {
        $validated = $request->validate([
            'bottle_id' => 'required|exists:bottles,id',
            'cellar_id' => 'required|exists:cellars,id',
            'quantity' => 'required|integer|min:1',
        ]);


        $cellar = Cellar::where('id', $validated['cellar_id'])
            ->where('user_id', auth()->id())->firstOrFail();

        $bottleId = $validated['bottle_id'];
        $quantityInitial = $validated['quantity'];

        $existingBottle = $cellar->bottles()->where('bottle_id', $bottleId)->exists();

        if ($existingBottle) {

            $cellar->bottles()->updateExistingPivot($bottleId, [
                'quantity' => DB::raw('quantity +' . $quantityInitial)
            ]);
        } else {
            $cellar->bottles()->attach($bottleId, ['quantity' => $quantityInitial]);
        }

        return redirect()->route('cellars.show', $cellar->id)->with('success', 'Bouteille ajoutée au cellier.');
    }


    public function removeBottle(Cellar $cellar, Bottle $bottle)
    {
        $cellar->bottles()->detach($bottle->id);
        return redirect()->back()->with('success', 'Bouteille supprimée du cellier.');
    }
}
