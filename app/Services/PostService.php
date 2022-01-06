<?php

namespace App\Services;

use DB;
use App\Exceptions\PostException;
use App\Repositories\PostRepository;

class PostService
{
    private $postRepo;
    private $exception;

    public function __construct(
        PostRepository $postRepo,
        PostException $exception
    ) {
        $this->postRepo  = $postRepo;
        $this->exception = $exception;
    }

    public function getPostListFilterByFiledId(int $filedId)
    {
        $filter = [
            'field_id' => $filedId,
        ];
        return $this->postRepo->listByFilter($filter);
    }

    public function getPost(int $postId)
    {
        $postData = $this->postRepo->findById($postId);
        // 判斷文章是否存在
        empty($postData) && $this->exception->error(30002);
        return $postData;
    }

    /**
     * create post
     * @param array $inputDataAry
     * @return mixed
     */
    public function createPost(array $inputDataAry)
    {
        $createData = [
            'title'    => $inputDataAry['title'],
            'content'  => $inputDataAry['content'],
            'user_id'  => $inputDataAry['user_id'],
            'field_id' => $inputDataAry['field_id'],
        ];

        DB::beginTransaction();
        try {
            $post = $this->postRepo->create($createData);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            $this->exception->error(30001, $e->getMessage());
        }

        return $post;
    }

    /**
     * update post
     * @param array $inputDataAry
     * @param int $postId
     * @return mixed
     */
    public function updatePostById(array $inputDataAry, int $postId)
    {
        $updateData = [
            'title'    => $inputDataAry['title'],
            'content'  => $inputDataAry['content'],
        ];

        DB::beginTransaction();
        try {
            $post = $this->postRepo->update($updateData, $postId);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            $this->exception->error(30003, $e->getMessage());
        }

        return $post;
    }

    /**
     * delete post
     * @param int $postId
     * @return mixed
     */
    public function deletePost(int $postId)
    {
        return $this->postRepo->delete($postId);
    }
}
