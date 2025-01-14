<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Filament\Tables\Columns\ImageColumn;

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

    // Accessor for image URL
    /*public function getImageUrlAttribute()
    {
        return $this->image ? asset('storage/' . $this->image) : null;
    }*/

    // Query scope for active posts
    public function scopeActive($query)
    {
        return $query->where('activationDate', '<=', now())
                     ->where(function ($q) {
                         $q->whereNull('deactivationDate')->orWhere('deactivationDate', '>', now());
                     });
    }

    // Automatically generate slug
    protected static function boot()
    {
        parent::boot();

        static::saving(function ($post) {
            if (empty($post->slug)) {
                $post->slug = Str::slug($post->title);
            }
        });
    }

    // Relationships
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
