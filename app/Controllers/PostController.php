<?php

namespace App\Controllers;

use App\Models\PostModel;
use CodeIgniter\RESTful\ResourceController;

class PostController extends ResourceController 
{
    protected $modelName = 'App\Models\PostModel';
    protected $format    = 'json';

    // 1. Listar todos os posts (GET /posts)
    public function index()
    {
        $posts = $this->model->findAll();
        return $this->respond($posts);
    }

    // 2. Obter um post especifico (GET /posts/{id})
    public function show($id = null)
    {
        $post = $this->model->find($id);
        return $post ? $this->respond($post) : $this->failNotFound("Post nao encontrado.");
    }

    // 3. Criar um novo post (POST /posts)
    public function create()
    {
        $data = $this->request->getJSON(true);

        // Validação dos dados através do Model
        if (!$this->model->validate($data)) {
            // Retornar erros de validação
            return $this->failValidationErrors($this->model->errors());
        }
        
        if (!$this->model->insert($data)) {
            return $this->failValidationErrors($this->model->errors());
        }

        return $this->respondCreated([
            'message' => 'Post criado com sucesso!',
            'data' => $data
        ]);
    }

    // 4. Atualizar um post (PUT /posts/{id})
    public function update($id = null)
    {
        $post = $this->model->find($id);
        if (!$post) {
            return $this->failNotFound("Post nao encontrado.");
        }

        $data = $this->request->getJSON(true);

        if (!$this->model->update($id, $data)) {
            return $this->failValidationErrors($this->model->errors());
        }

        return $this->respond([
            'message' => 'Post atualizado com sucesso!',
            'data' => $data
        ]);
    }

    // 5. Excluir um post (DELETE /posts/{id})
    public function delete($id = null)
    {
        if (!$this->model->find($id)) {
            return $this->failNotFound("Post nao encontrado.");
        }

        $this->model->delete($id);
        return $this->respondDeleted(["message" => "Post excluido com sucesso!"]);
    }
}
