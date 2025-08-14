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

        $query = Bottle::whereIn('id', Wishlist::where('users_id', Auth::id())->pluck('bottles_id'));

        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }



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

        $bottles = $query->paginate(10);

        return view('wishlist.index', compact('bottles', 'identities', 'countries'));
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
        $validated = $request->validate([
            'users_id' => 'required|exists:users,id',
            'bottles_id' => 'required|exists:bottles,id',
            'quantity' => 'required|integer|min:1'
        ]);

        $bottleId = $validated['bottles_id'];
        $quantityInitial = $validated['quantity'];
        $userId = $validated['users_id'];

        $wishlist = Wishlist::firstOrCreate(
            ['users_id' => $userId, 'bottles_id' => $bottleId],
            ['quantity' => 0]
        );

        $wishlist->quantity += $quantityInitial;
        $wishlist->save();

        return redirect()->route('wishlist.index')->with('success', "Bouteille ajoutée à la liste d'achats.");
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
