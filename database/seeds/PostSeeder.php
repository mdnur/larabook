<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $users =factory(App\User::class,1)->create();

        // $users->each(function ($user) {
        //     $user->roles()->attach(2);
        //      factory(\App\Post::class,1)->create(['user_id' => $user->id])->each(function ($post) use ($user){
        //          factory(\App\Comment::class,5)->create(['post_id' => $post->id,'user_id' => $user->id]);
        //          $post->tags()->save(factory(\App\Tag::class)->make());
        //      });
        // });
    }


}
