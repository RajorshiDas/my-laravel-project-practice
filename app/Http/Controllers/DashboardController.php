<?php

namespace App\Http\Controllers;
use App\Models\Post; // Ensure you have the correct namespace for Post
use Illuminate\Support\Facades\Auth; // Correct namespace for Auth
use Illuminate\Routing\Controller; // Correct base controller
use Illuminate\Http\Request;
use App\Models\User;


class DashboardController extends Controller
{
    public function __construct()
    {
        // Apply the 'auth' middleware to all methods in this controller
        $this->middleware('auth');
    }

    public function index()
    {

        $posts = Auth::user()->posts()->latest()->paginate(6);

        return view('users.dashboard', ['posts' => $posts]);


    }

    public function userPosts(User $user)
    {


        $userPosts = $user->posts()->latest()->paginate(6);

         return view('users.posts',[
            'posts' => $userPosts,
            'user' => $user
        ]);
    }
}
