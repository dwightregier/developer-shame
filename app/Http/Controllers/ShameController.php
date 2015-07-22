<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreShameRequest;
use App\Shame;
use App\Tag;
use Auth;

use App\Http\Requests;

class ShameController extends Controller
{
    /**
     * Instantiate a new ShamesController instance.
     */
    public function __construct()
    {
        $this->middleware('auth', ['only' => ['create', 'store']]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return $this
     */
    public function create()
    {
        $tags = [];
        foreach (Tag::all() as $tag) {
            array_push($tags, $tag->title);
        }

        return view('shame.create')->with([
            'js_tags' => json_encode($tags)
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreShameRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreShameRequest $request)
    {
        $shame = new Shame;
        $shame->title = $request->title;
        $shame->markdown = $request->markdown;
        $shame->is_anonymous = $request->is_anonymous;
        $shame->user_id = Auth::user()->id;
        $shame->save();

        $tag_titles = explode(', ', $request->tags);
        foreach ($tag_titles as $tag_title) {
            $tag = Tag::where('title', $tag_title)->first();

            if ($tag) {
                $shame->tags()->attach($tag);
            }
        }

        return redirect()->route('home');
    }
}
