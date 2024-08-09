<?php

namespace App\Http\Controllers;

use App\Models\Tweet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class TweetController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view("tweets.index", [
            'tweets' => Tweet::with('user')->get(),
        ]);
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
        $validated = $request->validate([
            'message' => 'required|string|max:255',
        ]);

        $request->user()->tweets()->create($validated);

        return redirect()->route('tweets.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Tweet $tweet)
    {
        //
        return view("tweets.show", [
            'tweet' => $tweet,
            'comments' => $tweet->comments()->get(),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Tweet $tweet)
    {
        return view('tweets.edit', [
            'tweet' => $tweet
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Tweet $tweet)
    {
        Gate::authorize('update', $tweet);

        $validated = $request->validate([

            'message' => 'required|string|max:255',
        ]);

        $tweet->update($validated);

        // $tweet->message = $request->get('message');
        // $tweet->save();

        return redirect()->route('tweets.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tweet $tweet)
    {
        Gate::authorize('delete', $tweet);

        $tweet->delete();

        return redirect()->route('tweets.index');
    }
}
