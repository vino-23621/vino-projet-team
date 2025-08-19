<?php

namespace App\Http\Controllers;

use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Bottle;
use App\Models\Country;
use App\Models\Identity;


class WishlistController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $bottles = Wishlist::where('users_id', Auth::id())->get()->pluck('bottle');
        $identities = Identity::all();
        $countries = Country::all();

        return view('wishlist.index', compact('bottles', 'identities', 'countries'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {

        $identities = Identity::all();
        $countries = Country::all();

        $query = Wishlist::with('bottle.identity', 'bottle.country')->where('users_id', Auth::id());

        if ($request->filled('search')) {
            $query->whereHas('bottle', function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%');
            });
        }

        if ($request->filled('country')) {
            $query->whereHas('bottle', function ($q) use ($request) {
                $q->where('country_id', $request->country);
            });
        }

        if ($request->filled('identity')) {
            $query->whereHas('bottle', function ($q) use ($request) {
                $q->where('identity_id', $request->identity);
            });
        }

        if ($request->boolean('vintage_null')) {
            $query->whereHas('bottle', function ($q) {
                $q->whereNull('vintage');
            });
        } else {
            if ($request->filled('vintage_min')) {
                $query->whereHas('bottle', function ($q) use ($request) {
                    $q->where('vintage', '>=', $request->vintage_min);
                });
            }
            if ($request->filled('vintage_max')) {
                $query->whereHas('bottle', function ($q) use ($request) {
                    $q->where('vintage', '<=', $request->vintage_max);
                });
            }
        }


        if ($request->filled('price_min')) {
            $query->whereHas('bottle', function ($q) use ($request) {
                $q->where('price', '>=', $request->price_min);
            });
        }
        if ($request->filled('price_max')) {
            $query->whereHas('bottle', function ($q) use ($request) {
                $q->where('price', '<=', $request->price_max);
            });
        }

        if ($request->filled('sort')) {
            $query->join('bottles', 'wishlist.bottles_id', '=', 'bottles.id')
                ->select('wishlist.*');

            switch ($request->sort) {
                case 'vintage_asc':
                    $query->orderBy('bottles.vintage', 'asc');
                    break;
                case 'vintage_desc':
                    $query->orderBy('bottles.vintage', 'desc');
                    break;
                case 'price_asc':
                    $query->orderBy('bottles.price', 'asc');
                    break;
                case 'price_desc':
                    $query->orderBy('bottles.price', 'desc');
                    break;
                case 'country_asc':
                    $query->orderBy('bottles.country_id', 'asc');
                    break;
                case 'country_desc':
                    $query->orderBy('bottles.country_id', 'desc');
                    break;
            }
        }

        $wishlists = $query->paginate(10);

        return view('wishlist.index', compact('wishlists', 'identities', 'countries'));
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Wishlist $wishlist)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Wishlist $wishlist)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Wishlist $wishlist)
    {
        //
    }

    /** Store bottles into the wishlist. */
    public function addToWishList(Request $request)
    {
        $validated = $request->validate(
            [
                'users_id' => 'required|exists:users,id',
                'bottles_id' => 'required|exists:bottles,id',
                'quantity' => 'required|integer|min:1'
            ],
            [
                'users_id.required'   => "L'utilisateur est requis.",
                'users_id.exists'     => "Utilisateur invalide.",
                'bottles_id.required' => "La bouteille est requise.",
                'bottles_id.exists'   => "Bouteille introuvable.",
                'quantity.required'   => "La quantité est requise.",
                'quantity.integer'    => "La quantité doit être un nombre entier.",
                'quantity.min'        => "La quantité doit être au moins :min."
            ]
        );

        $bottleId = $validated['bottles_id'];
        $quantityInitial = $validated['quantity'];
        $userId = $validated['users_id'];

        $wishlist = Wishlist::firstOrCreate(
            ['users_id' => $userId, 'bottles_id' => $bottleId],
            ['quantity' => 0]
        );

        $wishlist->quantity += $quantityInitial;
        $wishlist->save();

        return redirect()->route('wishlist.index')->with('success', "bouteille ajoutée à la liste d'achats.");
    }

    public function editBottle(Bottle $bottle)
    {
        $wishlistBottle = Wishlist::where('users_id', Auth::id())
            ->where('bottles_id', $bottle->id)
            ->first();

        if (!$wishlistBottle) {
            abort(404, 'Bouteille non trouvée dans ce cellier.');
        }

        $quantity = $wishlistBottle->quantity;

        return view('wishlist.index', compact('bottle', 'quantity'));
    }

    public function updateQuantity(Request $request, Bottle $bottle)
    {
        $request->validate([
            'quantity' => 'required|integer|min:0'
        ]);

        Wishlist::where('users_id', Auth::id())->where('bottles_id', $bottle->id)->update(['quantity' => $request->quantity]);

        return redirect()->route('wishlist.index')->with('success', 'Quantité mise à jour avec succès.');
    }

    public function removeBottle(Bottle $bottle)
    {
        Auth::user()->wishlist()->detach($bottle->id);
        return redirect()->back()->with('success', 'Bouteille retirée de la liste d’achats.');
    }
}
