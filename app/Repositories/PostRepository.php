<?php

namespace App\Repositories;

use App\Models\Post;

class PostRepository
{
    private $post;

    public function __construct(Post $post)
    {
        $this->post = $post;
    }
    
    public function create(array $data)
    {
        return $this->post->create($data);
    }

    public function findById(int $id)
    {
        return $this->post->find($id);
    }

    public function update(array $updateData, int $id)
    {
        return $this->post->findOrFail($id)->update($updateData);
    }

    public function delete(int $id)
    {
        return $this->post->findOrFail($id)->delete();
    }

    public function listByFilter(array $filter)
    {
        $query = $this->post->newQuery();

        if (isset($filter['field_id'])) {
            $query->where('field_id', $filter['field_id']);
        }

        return $query->get();
    }
}
