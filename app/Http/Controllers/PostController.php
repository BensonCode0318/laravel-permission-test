<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Resources\BaseJsonResource;
use App\Http\Resources\GetPostResource;
use App\Http\Resources\GetPostListCollection;

use App\Services\PostService;

class PostController extends Controller
{
    private $postService;

    public function __construct(
        PostService $postService
    ) {
        $this->postService = $postService;
    }


    public function index(Request $request)
    {
        $inputDataAry = $request->all();
        $postData     = $this->postService->getPostListFilterByFiledId($inputDataAry['field_id']);
        return new GetPostListCollection($postData);
    }

    /**
     * show post
     * @param int $postId
     * @return \GetPostResource
     */
    public function show($postId)
    {
        $postData = $this->postService->getPost($postId);
        
        return new GetPostResource($postData);
    }

    /**
     * create post
     *
     * @return \BaseJsonResource
     */
    public function create(Request $request)
    {
        $inputDataAry = $request->all();
        $validateRule = [
            'title'    => 'required|string',
            'content'  => 'required|string',
        ];
        $this->validateByRule($inputDataAry, $validateRule);

        $this->postService->createPost($inputDataAry);
        return new BaseJsonResource(null);
    }

    /**
     * update post
     *
     * @return \BaseJsonResource
     */
    public function update(Request $request, $postId)
    {
        $inputDataAry            = $request->all();
        $inputDataAry['post_id'] = $postId;
        $validateRule = [
            'title'    => 'required|string',
            'content'  => 'required|string',
            'post_id'  => 'required|int'
        ];
        $this->validateByRule($inputDataAry, $validateRule);

        $this->postService->updatePostById($inputDataAry, $postId);
        return new BaseJsonResource(null);
    }

    /**
     * delete post
     * @param int $postId
     * @return \BaseJsonResource
     */
    public function delete($postId)
    {
        $this->postService->deletePost($postId);
        
        return new BaseJsonResource(null);
    }
}
