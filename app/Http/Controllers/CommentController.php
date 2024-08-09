<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Tweet;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Tweet $tweet)
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Tweet $tweet)
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Tweet $tweet)
    {
        $validated = $request->validate([
            "message" => 'required|string|max:255'
        ]);
        $tweet_id = $request->get("tweet_id");
        $message = $request->get("message");

        $comment = new Comment();
        $comment->user_id = auth()->user()->id;
        $comment->tweet_id = $tweet_id;
        $comment->message = $message;
        $comment->save();

        return redirect()->route("tweets.show", $tweet_id);
    }

    /**
     * Display the specified resource.
     */
    public function show(Tweet $tweet, Comment $comment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Tweet $tweet, Comment $comment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Tweet $tweet, Comment $comment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tweet $tweet, Comment $comment)
    {
        //
    }
}
