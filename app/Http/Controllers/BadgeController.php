<?php

namespace App\Http\Controllers;

use App\User;
use Auth;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class BadgeController extends Controller
{
    /**
     * Instantiate a new BadgeController instance.
     */
    public function __construct()
    {
        $this->middleware('auth', ['only' => 'index']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $user = User::findOrFail(Auth::user()->id);
        $badges = $user->badges()->get();
        return view('badge.index')->with(['badges' => $badges]);
    }
}
