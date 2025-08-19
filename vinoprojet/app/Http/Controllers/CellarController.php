<?php

namespace App\Http\Controllers;

use App\Models\Bottle;
use App\Models\Identity;
use App\Models\Country;
use App\Models\Comment;
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
        ], [
            'name.required' => 'Le champ nom est obligatoire.',
            'name.string'   => 'Le nom doit être une chaîne de caractères.',
            'name.max'      => 'Le nom ne peut pas dépasser :max caractères.'
        ]);

        Cellar::create([
            'name' => $request->name,
            'user_id' => Auth::user()->id,
        ]);

        return redirect()->route('cellars.index')->with('success', 'cellier créé avec succès.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, Cellar $cellar)
    {
        if ($cellar->user_id != Auth::id()) {
            return redirect()->route('403.custom')->with('message', 'Il vaut mieux prendre un verre de vin plutôt que de fouiller dans les celliers de ses amis.');
        }

        $user = Auth::user();
        $identities = Identity::all();
        $countries = Country::all();


        /**
         * Query for the cellar search.
         */

        $query = $cellar->bottles();

        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }



        /**
         * End Query for the cellar search.
         */


        session(['active_cellar_id' => $cellar->id]);
        $cellar->load('bottles');

        if ($request->filled('country')) {
            $query->where('country_id', $request->country);
        }

        if ($request->filled('identity')) {
            $query->where('identity_id', $request->identity);
        }
        if ($request->boolean('vintage_null')) {
            $query->whereNull('vintage');
        } else {
            if ($request->filled('vintage_min')) {
                $query->where('vintage', '>=', $request->vintage_min);
            }
            if ($request->filled('vintage_max')) {
                $query->where('vintage', '<=', $request->vintage_max);
            }
        }
        if ($request->filled('price_min')) {
            $query->where('price', '>=', $request->price_min);
        }
        if ($request->filled('price_max')) {
            $query->where('price', '<=', $request->price_max);
        }
        if ($request->filled('sort')) {
            switch ($request->sort) {
                case 'vintage_asc':
                    $query->orderBy('vintage', 'asc');
                    break;
                case 'vintage_desc':
                    $query->orderBy('vintage', 'desc');
                    break;
                case 'price_asc':
                    $query->orderBy('price', 'asc');
                    break;
                case 'price_desc':
                    $query->orderBy('price', 'desc');
                    break;
                case 'country_asc':
                    $query->orderBy('country_id', 'asc');
                    break;
                case 'country_desc':
                    $query->orderBy('country_id', 'desc');
                    break;
            }
        }

        $bottles = $query->paginate(12);

        $comments = Comment::where('user_id', $user->id)->with('bottles')->get();

        return view('cellar.show', compact('cellar', 'bottles', 'identities', 'countries', 'comments'));
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
        $request->validate(
            [
                'name' => 'nullable|string|max:100',
            ],
            [
                'name.required' => 'Le champ Nom est obligatoire.',
                'name.string'   => 'Le nom doit être une chaîne de caractères.',
                'name.max'      => 'Le nom ne peut pas dépasser 100 caractères.'
            ]
        );

        $data = [];

        if ($request->filled('name')) {
            $data['name'] = $request->name;
        }

        if (!empty($data)) {
            $cellar->update($data);
        }

        return redirect()->route('cellars.index')->with('success', 'Cellier modifié avec succès !');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cellar $cellar)
    {

        $user = auth()->user();
        // dd($user->cellar_id, $cellar->id);


        if ($user->cellar_id === $cellar->id) {

            return redirect()->route('cellars.index')
                ->with('error', 'Vous ne pouvez pas supprimer votre cellier par défaut.');
        }


        $target = $cellar->name;

        \DB::table('cellar__has__bottles')->where('cellar_id', $cellar->id)->delete();

        $cellar->delete();
        return redirect()->route('cellars.index')->with('success', 'le cellier: ' . $target . 'a été effacé !');
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

    public function editBottle(Cellar $cellar, Bottle $bottle)
    {
        $cellarBottle = $cellar->bottles()
            ->where('bottle_id', $bottle->id)
            ->first();

        if (!$cellarBottle) {
            abort(404, "La bouteille n’a pas été trouvée dans ce cellier.");
        }

        $quantity = $cellarBottle->pivot->quantity;

        return view('cellars.show', compact('cellar', 'bottle', 'quantity'));
    }

    public function updateQuantity(Request $request, Cellar $cellar, Bottle $bottle)
    {
        $request->validate([
            'quantity' => 'required|integer|min:0'
        ]);

        $cellar->bottles()->updateExistingPivot($bottle->id, [
            'quantity' => $request->quantity
        ]);

        return redirect()->route('cellars.show', $cellar->id)->with('success', 'Quantité mise à jour avec succès.');
    }

    public function removeBottle(Cellar $cellar, Bottle $bottle)
    {
        $cellar->bottles()->detach($bottle->id);
        return redirect()->back()->with('success', 'Bouteille supprimée du cellier.');
    }


    public function apiCellar($cellar_id)
    {

        $cellarHasBottles = \DB::table('cellar__has__bottles')
            ->join('bottles', 'cellar__has__bottles.bottle_id', '=', 'bottles.id')
            ->where('cellar__has__bottles.cellar_id', $cellar_id)
            ->select(

                'cellar__has__bottles.id as pivot_id',
                'cellar__has__bottles.quantity',
                'bottles.name',
                'bottles.image',
                'bottles.price',
                'bottles.size',
                'bottles.identity_id',
                'bottles.vintage',
                'bottles.country_id'

            )

            ->get();

        return response()->json([
            'cellar_has_bottles' => $cellarHasBottles
        ]);
    }
}
