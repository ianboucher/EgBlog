<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['title', 'body'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function scopeFilter($query, $filters)
    {
        if ($filters['month']) {
            $query->whereMonth('created_at', Carbon::parse($filters['month'])->month);
        }

        if ($filters['year']) {
            $query->whereYear('created_at', $filters['year']);
        }
    }

    public static function archives()
    {
        return static::selectRaw('year(created_at)year, monthname(created_at)month, count(*)published')
            ->groupBy('year', 'month')
            ->orderByRaw('min(created_at)', 'desc')
            ->get()
            ->toArray(); // casting to array makes this easier to test
    }
}
