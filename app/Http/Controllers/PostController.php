<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Services\PostService;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Http\Resources\PostResource;
use App\DataTransferObjects\PostDTO;
use App\Http\Requests\PostRequest;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    protected $postService;

    public function __construct(PostService $postService)
    {
        $this->postService = $postService;
    }

    public function index()
    {
        return $this->postService->getAllPosts();
    }

    public function store(PostRequest $request)
    {  

        $data = $request->validated();
        $postDTO = new PostDTO($data['title'],$data['body']);
     
        return response()->json($this->postService->createPost($postDTO));   
    }

    public function update(PostRequest $request, $id)
    {
        $data = $request->validated();
        $postDTO = new PostDTO($data['title'], $data['body']);

        return $this->postService->updatePost($id, $postDTO);    }


    public function destroy($id)
    {
       
       return $this->postService->deletePost($id);

    }

}
