<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    // I have added unguarded property in AppServiceProvider.

    /*
    |   with method will reduce the no of queries needed to be executed
    |   by your application and improve its performance.
    */

    protected $with = ['category', 'author'];

    public function scopeFilter($query, array $filters) //Just call it as filter(), because laravel is smart.
    {
        $query->when($filters['search'] ?? false, function ($query, $search) {

            $query->where(fn ($query) =>
            $query->where('title', 'like', '%' . $search . '%')
                ->orWhere('body', 'like', '%' . $search . '%'));
        });

        $query->when($filters['category'] ?? false, function ($query, $category) {

            $query->whereHas('category', fn ($query) =>
            $query->where('slug', $category));
        });

        $query->when($filters['author'] ?? false, function ($query, $author) {

            $query->whereHas('author', fn ($query) =>
            $query->where('username', $author));
        });
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}
