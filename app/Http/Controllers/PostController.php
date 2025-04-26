<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
use App\Models\Post;
use App\Http\Middleware\Middleware;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controller;
use App\Models\User;
use App\Http\Requests\PostRequest;
use App\Mail\WelcomeMail;
use Illuminate\Support\Facades\Mail;
use App\Events\UserSubscribed;







class PostController extends Controller{
    public function __construct()
    {
        $this->middleware(['auth', 'verified'])->except(['index', 'show']);
    }


    /**
     * Display a listing of the resource.
     */
    public function index()
    {


       $posts = Post::latest()->paginate(10);
        return view('post.index', ['posts' => $posts]);
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


        // Validate the request data
        $field = $request->validate([
            'title' => ['required', 'max:255'],
            'body' => ['required'],
            'image' => ['nullable', 'file', 'max:3000', 'mimes:webp,png,jpg']
        ]);

        $path = null;
        if ($request->hasFile('image')) {
            $path = Storage::disk('public')->put('posts_images', $request->image);
        }

        // Create a new post
       $post = Auth::user()->posts()->create([
            'title' => $field['title'],
            'body' => $field['body'],
            'image' => $path,
        ]);

        // Send email when users create a post (for practice)
        Mail::to(Auth::user())->send(new WelcomeMail(Auth::user(), $post));

        //Redirect to the posts index page

        return back()->with('success', 'Post created successfully');
        }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        return view('post.show', ['post' => $post]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {

        Gate::authorize('modify', $post);
        return view('post.edit', ['post' => $post]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {

        Gate::authorize('modify', $post);
        // Validate the request data
        $feild = $request->validate([
            'title' => ['required', 'max:255'],
            'body' => ['required'],
            'image' => ['nullable', 'file', 'max:3000', 'mimes:webp,png,jpg']
        ]);


        $path = $post->image ?? null;
        if ($request->hasFile('image')) {
            // Delete the old image if it exists
            if ($post->image) {
                Storage::disk('public')->delete($post->image);
            }
            // Store the new image
          $path = Storage::disk('public')->put('posts_images', $request->image);
        }



        // Update the post

        $post->update([
            'title' => $feild['title'],
            'body' => $feild['body'],
            'image' => $path,
        ]);

        //Redirect to the posts index page

       return redirect()->route('dashboard')->with('success', 'Post updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        Gate::authorize('modify', $post);
        if($post->image)
        Storage::disk('public')->delete($post->image);
        $post->delete();
        return back()->with('delete', 'Post deleted successfully');
    }
}
