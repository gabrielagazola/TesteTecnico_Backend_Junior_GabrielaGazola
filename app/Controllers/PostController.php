<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use App\Services\PostService;

class PostController extends ResourceController 
{
    protected $postService;

    public function __construct()
    {
        $this->postService = new PostService();
    }

    // 1. Listar todos os posts (GET /posts)
    public function index()
    {
        return $this->respond($this->postService->getAllPosts());
    }

    // 2. Obter um post específico (GET /posts/{id})
    public function show($id = null)
    {
        try {
            return $this->respond($this->postService->getPostById($id));
        } catch (\Exception $e) {
            return $this->failNotFound($e->getMessage());
        }
    }

    // 3. Criar um novo post (POST /posts)
    public function create()
    {
        try {
            $data = $this->request->getJSON(true);
            return $this->respondCreated([
                'message' => 'Post criado com sucesso!',
                'data' => $this->postService->createPost($data)
            ]);
        } catch (\Exception $e) {
            // Decodifica a mensagem de erro para garantir que seja um JSON válido
            return $this->respond(json_decode($e->getMessage(), true), 400);



        }
    }

    // 4. Atualizar um post (PUT /posts/{id})
    public function update($id = null)
    {
        try {
            $data = $this->request->getJSON(true);
            return $this->respond([
                'message' => 'Post atualizado com sucesso!',
                'data' => $this->postService->updatePost($id, $data)
            ]);
        } catch (\Exception $e) {
            return $this->fail($e->getMessage(), $e->getCode());
        }
    }

    // 5. Excluir um post (DELETE /posts/{id})
    public function delete($id = null)
    {
        try {
            $this->postService->deletePost($id);
            return $this->respondDeleted(["message" => "Post excluído com sucesso!"]);
        } catch (\Exception $e) {
            return $this->failNotFound($e->getMessage());
        }
    }
}