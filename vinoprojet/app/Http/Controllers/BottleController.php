<?php

namespace App\Http\Controllers;

use App\Models\Bottle;
use App\Models\Identity;
use App\Models\Country;
use App\Models\Cellar;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BottleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $bottles = Bottle::paginate(20);
        $cellar = Cellar::where('user_id', auth()->id())->get();
        $cellarId = $request->query('cellar_id');
        return view('catalog.index', compact('bottles', 'cellar', 'cellarId'));
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

        return view('bottle.show', compact('bottle'));
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


    public function comment(Cellar $cellar, Bottle $bottle)
    {

        return view('comment.form', compact('cellar', 'bottle'));
    }


    public function addcomment(Cellar $cellar, Request $request, Bottle $bottle)
    {
        $request->validate([
            'comment' => 'required|string|max:500',
            'notation' => 'nullable|integer|min:0|max:5',
        ]);

        $user = Auth::user();


        $comment = Comment::create([
            'user_id' => $user->id,
        ]);

        $bottle->comments()->attach($comment->id, [
            'comment' => $request->input('comment'),
            'notation' => $request->input('notation', 0),
        ]);

        return redirect()->route('cellars.show', $cellar->id)->with('success', 'Commentaire ajouté');
    }

    public function destroyComment($commentId, $bottleId)
    {
        $comment = Comment::findOrFail($commentId);

        $comment->bottles()->detach($bottleId);
        $comment->delete();

        return redirect()->back()->with('success', 'Commentaire supprimé.');
    }
}
