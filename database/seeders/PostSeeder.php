<?php


namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Http;
use App\Models\Post;
use App\Models\User;
use Laravel\Sanctum\PersonalAccessToken;
use Illuminate\Support\Facades\Hash;


class PostSeeder extends Seeder
{
    public function run()
    {
        $dummyPosts = Http::get('https://dummyjson.com/posts')->json()['posts'];
        Post::truncate();
        User::truncate();
        PersonalAccessToken::truncate();
        //creating a test user
        $user = User::create([
            'name' => 'Nurla',
            'email' => 'nurik@example.com',
            'password' => Hash::make('Nurlybek'),
            'email_verified_at' => now(),
        ]);
 
        $post = Post::create([
          'user_id' => $user->id, 
          'dummy_post_id' => $dummyPosts[0]['id'],
        ]);
 
        foreach ($dummyPosts as $dummyPost) {
            $user = User::factory()->create();
          $post = Post::firstOrCreate(['dummy_post_id' => $dummyPost['id']],
          [
           'user_id' => $user->id
          ]
         );        
        }
    }
}
