<?php

namespace App\Traits;

use App\Like;

trait Likeability {

    public function like()
    {
        $like = new Like(['user_id' => auth()->id()]);

        $this->likes()->save($like);
    }


    public function unlike()
    {
        $this->likes()->where('user_id', auth()->id())->delete();
    }


    public function toggleLike()
    {
        return ($this->isLiked()) ? $this->unlike() : $this->like();
    }


    public function isLiked()
    {
        return !! $this->likes()
                        ->where('user_id', auth()->id())
                        ->count();
    }
    

    public function getLikesCountAttribute() // magic syntax for likesCount getter method
    {
        return $this->likes()->count();
    }
}
