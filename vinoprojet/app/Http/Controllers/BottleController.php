<?php

namespace App\Http\Controllers;

use App\Models\Bottle;
use App\Models\Identity;
use App\Models\Country;
use App\Models\Cellar;
use Illuminate\Http\Request;

class BottleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $bottles = Bottle::all();
        return view('catalog.index', ['bottles' => $bottles]);
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
    public function show(Bottle $bottle)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Bottle $bottle)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Bottle $bottle)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Bottle $bottle)
    {
        //
    }
}
