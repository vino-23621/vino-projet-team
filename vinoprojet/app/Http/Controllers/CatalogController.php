<?php

namespace App\Http\Controllers;

use App\Models\Identity;
use App\Models\Cellar;
use App\Models\Bottle;
use App\Models\Cellar_Has_Bottle;
use App\Models\Country;



use Illuminate\Http\Request;

class CatalogController extends Controller
{

    public function index(Request $request)
    {
        $identities = Identity::all();
        $countries = Country::all();

        $query = Bottle::query();

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
                $yearMin = $request->vintage_min;
                if (strlen($yearMin) === 2) {
                    $yearMin = '20' . $yearMin;
                }
                $query->where('vintage', '>=', $yearMin);
            }

            if ($request->filled('vintage_max')) {
                $yearMax = $request->vintage_max;
                if (strlen($yearMax) === 2) {
                    $yearMax = '20' . $yearMax;
                }
                $query->where('vintage', '<=', $yearMax);
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

        $bottles = $query->paginate(12)->appends($request->query());

        return view('catalog.index', compact('bottles', 'identities', 'countries'));
    }

    public function addWineFromCatalog(Request $request)
    {
        $request->validate([
            'bottle_id' => 'required|exists:bottles,id',
            'quantity' => 'nullable|integer|min:1'
        ]);

        $cellarId = session('active_cellar_id') ?? auth()->user()->cellar_id;
        $bottleId = $request->input('bottle_id');
        $quantity = $request->input('quantity', 1);

        $record = Cellar_Has_Bottle::where('cellar_id', $cellarId)
            ->where('bottle_id', $bottleId)
            ->first();

        if ($record) {
            $record->increment('quantity', $quantity);
        } else {
            Cellar_Has_Bottle::create([
                'cellar_id' => $cellarId,
                'bottle_id' => $bottleId,
                'quantity' => $quantity,
            ]);
        }

        return redirect()->back()->with('success', 'Bottle added to cellar.');
    }



    public function apiCatalog()
    {

        $cellarHasBottles = \DB::table('cellar__has__bottles')
            ->join('bottles', 'cellar__has__bottles.bottle_id', '=', 'bottles.id')
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
