<?php

namespace App\Repositories;

use App\Models\PostModel;

class PostRepository
{
    protected $postModel;

    public function __construct()
    {
        $this->postModel = new PostModel();
    }

    public function getAll()
    {
        return $this->postModel->findAll();
    }

    public function getById($id)
    {
        return $this->postModel->find($id);
    }

    public function create($data)
    {
        return $this->postModel->insert($data);
    }

    public function update($id, $data)
    {
        return $this->postModel->update($id, $data);
    }

    public function delete($id)
    {
        return $this->postModel->delete($id);
    }
}
