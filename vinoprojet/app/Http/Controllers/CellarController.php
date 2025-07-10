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
        $cellar = Cellar::where('user_id', Auth::id())->get();
        return view('cellar.index', compact('cellar'));
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
            'image' => 'nullable|image|mimes:jpeg,png,jpg,svg,webp|max:1048',
        ]);

        $imagePath = null;

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('cellar_images', 'public');
            $filename = basename($path);
        }

        Cellar::create([
            'name' => $request->name,
            'image' => $filename,
            'user_id' => Auth::user()->id,

        ]);

        return redirect()->route('cellars.index')->with('success', 'Cellar créée avec succès');
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
        return view('cellars.edit', ['cellar' => $cellar]);
    }

    /**
     * Update the specified resource in storage
     */
    public function update(Request $request, Cellar $cellar)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,svg,webp|max:1048',
        ]);

        $imagePath = $cellar->image;

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('cellar_images', 'public');
            $filename = basename($path);
        }

        $cellar->update([
            'name' => $request->name,
            'image' => $filename,
        ]);

        return redirect()->route('cellars.index', $cellar->id)->with('success', 'Cellier modifié avec succès!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cellar $cellar)
    {
        $target = $cellar->name;
        $cellar->delete();
        return redirect()->route('cellars.index')->with('success', 'Le Cellar: ' . $target . 'a été effacé!');
    }
}
