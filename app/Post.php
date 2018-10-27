<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\App;
use Overtrue\LaravelFollow\Traits\CanBeLiked;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Post extends Model
{
    use CanBeLiked;
    use SoftDeletes;
    use HasSlug;

    protected $fillable = [
        'user_id',
        'category_id',
        'title',
        'slug',
        'status',
        'description',
        'content',
        'feature',
        'published_at',
    ];


    public function user(){
        return $this->belongsTo(User::class);
    }
    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('title')
            ->saveSlugsTo('slug');
    }


    public function tags(){
        return $this->belongsToMany(Tag::class,'post_tag');
    }

    public function category(){
        return $this->belongsTo(Category::class);
    }
}
