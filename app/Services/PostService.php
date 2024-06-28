<?php
namespace App\Services;

use App\DataTransferObjects\PostDTO;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class PostService
{

    public function getAllPosts($perPage = 10)
{
    $posts = Post::with('user')
                 ->orderBy('created_at', 'desc')
                 ->paginate($perPage);

    foreach ($posts as $post) {
        if (!empty($post->dummy_post_id)) {
            $dummyPostData = $this->fetchDummyPostData($post->dummy_post_id);
            $post->title = $dummyPostData['title'];
            $post->author_name = $dummyPostData['userId'];
            $post->description = substr($dummyPostData['body'], 0, 128);        
}    }

    return $posts;
}    
    public function createPost(PostDTO $postDTO)
    {
        $dummyPost = Http::post('https://dummyjson.com/posts/add', [
            'userId' => Auth::id(),
            'title' => $postDTO->title,
            'body' => $postDTO->body,
        ])->json();


        return $dummyPost;
    }

    public function updatePost($id, PostDTO $postDTO)
    {
        $post = Post::findOrFail($id);
        if ($post->user_id !== Auth::id()) {
            abort(403, 'You can only edit your own posts.');
        }

        

        $dummyPost = Http::put("https://dummyjson.com/posts/{$post->dummy_post_id}", [
            'title' => $postDTO->title,
            'body' => $postDTO->body,
        ])->json();


       return response()->json([
        'title' => $postDTO->title,
        'body' => $postDTO->body,
        'user_id' => $post['user_id'],
        'dummy_post_id' => $post['dummy_post_id']]);
    }

    public function deletePost($id)
    {
        $post = Post::findOrFail($id);

        if ($post->user_id !== Auth::id()) {
            abort(403, 'You can only delete your own posts.');
        }

        $dummyPost = Http::delete("https://dummyjson.com/posts/{$post->dummy_post_id}")->json();


        $data = [
            'id' => $dummyPost['id'],
            'title' => $dummyPost['title'],
            'body' => $dummyPost['body'],
            'user_id' => $dummyPost['userId'],
            'isDeleted' => $dummyPost['isDeleted'],
            'deletedOn' => $dummyPost['deletedOn'],
        ];

        $post->delete();

        return $data;
    }


    private function fetchDummyPostData($dummyPostId)
{
    $url = "https://dummyjson.com/posts/{$dummyPostId}";
    $response = Http::get($url);
    if ($response->successful()) {
        return $response->json();
    } else {
        return null;
    }
}
}
