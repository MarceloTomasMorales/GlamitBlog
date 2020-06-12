<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use Illuminate\Support\Facades\Log;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home',  ['posts' => Post::all()]);
    }

    public function LikePost(Request $request){

        $post = Post::find($request->id);
        auth()->user()->toggleLike($post);

        $response = $post->likers()->count();
        Log::info($response);

        return response()->json(['success'=>$response]);
    }
}
