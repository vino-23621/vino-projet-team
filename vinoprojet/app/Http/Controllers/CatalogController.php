<?php

namespace App\Http\Controllers;

use App\Models\Cellar;
use App\Models\Bottle;
use App\Models\Cellar_Has_Bottle;


use Illuminate\Http\Request;

class CatalogController extends Controller
{
    public function addWineFromCatalog(Request $request)
    {
        $request->validate([
            'bottle_id' => 'required|exists:bottles,id',
            'quantity' => 'nullable|integer|min:1'
        ]);

        $cellarId = session('active_cellar_id') ?? auth()->user()->cellar_id;
        $bottleId = $request->input('bottle_id');
        $quantity = $request->input('quantity', 1);

        Cellar_Has_Bottle::updateOrCreate(
            [
                'cellar_id' => $cellarId,
                'bottle_id' => $bottleId
            ],
            []
        )->increment('quantity', $quantity);

        return redirect()->back()->with('success', 'Bottle added to cellar.');
    }
}
