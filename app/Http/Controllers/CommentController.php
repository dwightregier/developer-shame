<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Events\CommentWasAdded;
use Auth;
use Event;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class CommentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['only' => ['index', 'store', 'edit', 'update', 'destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $comments = Comment::with('user')->where('user_id','=',Auth::user()->id)->get();
        return view('comment.index')->with(['comments' => $comments]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        $comment = new Comment;
        $comment->text = $request->text;
        $comment->user_id = Auth::user()->id;
        $comment->shame_id = $request->shame_id;
        $comment->save();

        Event::fire(new CommentWasAdded($comment));

        return redirect()->route('shames.show', ['id' => $comment->shame_id]);
        //return redirect()->back();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $comment = Comment::findOrFail($id);
        if (Auth::check() && Auth::user()->id == $comment->user_id) {
            return view('comment.edit')->with(['comment' => $comment]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        $comment = Comment::findOrFail($id);

        if (Auth::check() && Auth::user()->id == $comment->user_id) {
            $comment->update($request->all());
        }

        return redirect()->route('comments.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        $comment = Comment::find($id);

        if (Auth::check() && Auth::user()->id == $comment->user_id) {
            $comment->upvotes()->detach();
            $comment->delete();
        }

        return redirect()->route('comments.index');
    }

    public function upvote(Request $request)
    {
        //$upvotedComments = UpvoteComment::where('comment_id','=',$request->comment_id)
        //  ->where('user_id','=',Auth::user()->id)->get();

        $comment = Comment::findOrFail($request->comment_id);
        $upvotes = $comment->upvotes()->where('user_id', Auth::user()->id);

        if($upvotes->count() == 0) {
            $comment->upvotes()->attach(Auth::user()->id);

        }
        else
        {
            $comment = Comment::find($request->comment_id);
            $comment->upvotes()->detach(Auth::user()->id);
        }
        return redirect()->back();
    }
}
