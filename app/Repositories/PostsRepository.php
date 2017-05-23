<?php

namespace App\Repositories;

use App\Post;

class PostsRepository
{
    public function all()
    {
        return Post::orderBy('created_at', 'desc')
            ->filter(request(['month', 'year']))
            ->get();
    }
}
