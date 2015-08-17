<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Events\ShameWasUpdated;
use App\Http\Requests\StoreShameRequest;
use App\Notification;
use App\Shame;
use App\Tag;
use Auth;

use App\Http\Requests;
use Carbon\Carbon;
use Event;
use Illuminate\Http\Request;
use Parsedown;

class ShameController extends Controller
{
    /**
     * Instantiate a new ShamesController instance.
     */
    public function __construct()
    {
        $this->middleware('auth', ['only' => ['index', 'create', 'store']]);
    }

    /**
     * Display a listing of shames the logged in user posts.
     *
     * @return $this
     */
    public function index()
    {
        $shames = Shame::where('user_id', '=', Auth::user()->id)
            ->with('user','tags','upvotes')
            ->get();
        $title = 'Posted Shames';
        return view('shame.index')->with(['shames' => $shames, 'title' => $title]);
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
            'js_tags' => json_encode($tags),
            'tags_text' => ''
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

    /**
     * Show the form for editing the shame.
     *
     * @param $id
     * @return $this
     */
    public function edit($id)
    {
        $shame = Shame::findOrFail($id);
        if (Auth::check() && Auth::user()->id == $shame->user_id) {
            $shame_tags = $shame->tags()->get();
            $tags_text = '';
            foreach ($shame_tags as $tag) {
                $tags_text .= $tag->title . ', ';
            }
            $tags = [];
            foreach (Tag::all() as $tag) {
                array_push($tags, $tag->title);
            }
            return view('shame.edit')->with([
                'shame' => $shame,
                'js_tags' => json_encode($tags),
                'tags_text' => $tags_text,
                'shame_tags' => $shame_tags
            ]);
        }
        else
        {
            return redirect()->back();
        }
    }

    /**
     * Update the specified comment.
     *
     * @param  StoreShameRequest  $request
     * @param  int  $id
     * @return Response
     */
    public function update(StoreShameRequest $request, $id)
    {
        $shame = Shame::findOrFail($id);
        if (Auth::check() && Auth::user()->id == $shame->user_id) {
            $shame->title = $request->title;
            $shame->markdown = $request->markdown;
            $shame->is_anonymous = $request->is_anonymous;
            $shame->save();
            $tag_titles = explode(', ', $request->tags);
            $tag_ids = [];
            foreach ($tag_titles as $tag_title) {
                $tag = Tag::where('title', $tag_title)->first();
                if ($tag) {
                    $tag_id = $tag->id;
                    array_push($tag_ids, $tag_id);
                }
            }
            $shame->tags()->sync($tag_ids);

            // Fire ShameWasUpdated event
            Event::fire(new ShameWasUpdated($shame));
        }
        return redirect()->route('shames.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        $shame = Shame::findOrFail($id);

        if (Auth::check() && Auth::user()->id == $shame->user_id) {
            $shame->tags()->detach();
            $shame->upvotes()->detach();
            $shame->follows()->detach();

            $notifications = Notification::where('shame_id', '=', $id)->get();
            foreach ($notifications as $notification) {
                $notification->delete();
            }

            $comments = Comment::where('shame_id', '=', $id)
                ->with('upvotes')
                ->get();

            foreach($comments as $comment) {
                $comment->upvotes()->detach();
                $comment->delete();
            }
            $shame->delete();
        }
        return redirect()->route('shames.index');
    }

    /**
     * Display a listing of shames with the most upvotes in the last 24 hours.
     *
     * @return $this
     */
    public function featuredShames()
    {
        $shames = Shame::where('created_at', '>=', Carbon::now()
            ->subHour(24))
            ->with('user','tags','upvotes')
            ->get()
            ->sortByDesc(function($shame)
            {
                return $shame->upvotes->count();
            })
            ->take(10);
        $title = 'Featured Shames';
        return view('shame.list')->with(['shames' => $shames, 'title' => $title]);
    }

    /**
     * Display a listing of the shames with the most upvotes overall.
     *
     * @return $this
     */
    public function topShames()
    {
        $shames = Shame::with('user','tags','upvotes')
            ->get()
            ->sortByDesc(function($shame){
                return $shame->upvotes->count();
            })
            ->take(10);
        $title = 'Top Shames';
        return view('shame.list')->with(['shames' => $shames, 'title' => $title]);
    }

    /**
     * Display a listing of the newest shames.
     *
     * @return $this
     */
    public function newShames()
    {
        $shames = Shame::with('user','tags','upvotes')
            ->orderby('created_at', 'desc')
            ->get()
            ->take(10);
        $title = 'New Shames';
        return view('shame.list')->with(['shames' => $shames, 'title' => $title]);
    }

    /**
     * Display a listing of random shames.
     *
     * @return $this
     */
    public function randomShames()
    {
        $shames = Shame::with('user','tags','upvotes')
            ->orderByRaw("RAND()")
            ->get()
            ->take(10);
        $title = 'Random Shames';
        return view('shame.list')->with(['shames' => $shames, 'title' => $title]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        $shame = Shame::findOrFail($id);
        $parsedown = new Parsedown();
        $parsedown->setBreaksEnabled(true)->setMarkupEscaped(true);
        $shame->markdown = $parsedown->text($shame->markdown);
        $comments = Comment::with('user','upvotes')->where('shame_id','=',$id)->get();
        return view('shame.show')->with(['shame' => $shame,'comments' =>$comments]);
    }

    public function upvote(Request $request)
    {
        $shame = Shame::findOrFail($request->shame_id);
        if (Auth::check()) {
            $upvotes = $shame->upvotes()->where('user_id', Auth::user()->id);
            if ($upvotes->count() == 0) {
                $shame->upvotes()->attach(Auth::user()->id);
            } else {
                $shame = Shame::find($request->shame_id);
                $shame->upvotes()->detach(Auth::user()->id);
            }
        }
        return redirect()->back();
    }

    public function follow(Request $request)
    {
        $shame = Shame::findOrFail($request->shame_id);
        if (Auth::check()) {
            $follow = $shame->follows()->where('user_id', Auth::user()->id);
            if ($follow->count() == 0) {
                $shame->follows()->attach(Auth::user()->id);
            } else {
                $shame = Shame::find($request->shame_id);
                $shame->follows()->detach(Auth::user()->id);
            }
        }
        return redirect()->back();
    }
}
