<?php

namespace App\Services;

use App\Repositories\PostRepository;

class PostService
{
    protected $postRepository;

    public function __construct()
    {
        $this->postRepository = new PostRepository();
    }

    public function getAllPosts()
    {
        return $this->postRepository->getAll();
    }

    public function getPostById($id)
    {
        $post = $this->postRepository->getById($id);
        if (!$post) {
            throw new \Exception("Post não encontrado", 404);
        }
        return $post;
    }

    public function createPost($data)
    {
        if (empty($data['title']) || empty($data['content'])) {
            throw new \Exception("Título e conteúdo são obrigatórios", 400);
        }
        return $this->postRepository->create($data);
    }

    public function updatePost($id, $data)
    {
        if (!$this->postRepository->getById($id)) {
            throw new \Exception("Post não encontrado", 404);
        }
        return $this->postRepository->update($id, $data);
    }

    public function deletePost($id)
    {
        if (!$this->postRepository->getById($id)) {
            throw new \Exception("Post não encontrado", 404);
        }
        return $this->postRepository->delete($id);
    }
}
