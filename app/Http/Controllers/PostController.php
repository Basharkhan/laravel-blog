<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::query()
            ->with(['user', 'categories'])
            ->where('active', true)
            ->where('published_at', '<', Carbon::now())
            ->orderBy('published_at', 'desc')
            ->paginate(10);
        
        return view('home', compact('posts'));
    }    

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        if(!$post->active || $post->published_at > Carbon::now()) {
            throw new NotFoundHttpException();
        }

        $prev = Post::query()
                    ->where('active', true)
                    ->whereDate('published_at', '<', Carbon::now())
                    ->whereDate('published_at', '>', $post->published_at)
                    ->orderBy('published_at', 'asc')
                    ->limit(1)
                    ->first();

        $next = Post::query()
                    ->where('active', true)
                    ->whereDate('published_at', '<', Carbon::now())
                    ->whereDate('published_at', '<', $post->published_at)
                    ->orderBy('published_at', 'desc')
                    ->limit(1)
                    ->first();        

        return view('post.view', compact('post', 'prev', 'next'));
    }

    public function byCategory(Category $category) {
        $posts = $category->posts()
            ->where('active', true)
            ->whereDate('published_at', '<=', Carbon::now())
            ->orderBy('published_at', 'desc')
            ->paginate(10);

        return view('home', compact('posts'));
    }
}
