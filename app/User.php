<?php

namespace App;

use Cog\Contracts\Love\Liker\Models\Liker as LikerContract;
use Cog\Laravel\Love\Liker\Models\Traits\Liker;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\App;
use Laratrust\Traits\LaratrustUserTrait;
use Laravel\Scout\Searchable;
use Overtrue\LaravelFollow\Traits\CanBeLiked;
use Overtrue\LaravelFollow\Traits\CanFollow;
use Overtrue\LaravelFollow\Traits\CanBeFollowed;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\Models\Media;


class User extends Authenticatable implements HasMedia,LikerContract
{
    use LaratrustUserTrait;
    use Notifiable;
    use CanFollow, CanBeFollowed;
    use liker;
    use Searchable;
    use HasMediaTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'username',
        'avatar_id',
        'birthday',
        'bio',
        'gender',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function posts(){
        $this->hasMany(Post::class);
    }

    public function registerMediaConversions(Media $media = null)
    {
        $this->addMediaConversion('thumb')
            ->width(180)
            ->height(180);
        $this->addMediaConversion('card')
            ->width(400)
            ->height(240);
    }

    public function avatar(){
       return  $this->hasOne(Media::class,'id','avatar_id');
    }

    public function getAvatarUrlAttribute()
    {
        return $this->avatar->getUrl('thumb');
    }


    public function searchableAs()
    {
        return 'name';
    }

    public function toSearchableArray()
    {
        /**
         * Load the categories relation so that it's available
         *  in the laravel toArray method
         */
        $this->avatar;
        return $this->toArray();
    }
}
