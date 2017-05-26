<?php

namespace App\Http\Controllers;

use App\Tag;
use App\Post;
use Illuminate\Http\Request;

class PostsTagsController extends Controller
{
    public function index(Tag $tag)
    {
        $posts = $tag->posts;

        return view('posts.index', compact('posts'));
    }

    public function store(Post $post, Tag $tag)
    {
        $post->tags()->attach($tag);

        return view('posts.index', compact('posts'));
    }
}
