<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Post extends Model
{
    use HasFactory;

    protected $table = 'posts';

    protected $fillable = [
        'title',
        'content',
        'image',
        'activationDate',
        'deactivationDate',
        'slug',
    ];

    protected $casts = [
        'activationDate' => 'datetime',
        'deactivationDate' => 'datetime',
    ];

    // Relationships
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }
    // Automatic slug generation
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($post) {
            if (!$post->slug) {
                $post->slug = Str::slug($post->title, '-');
            }
        });
    }
}
