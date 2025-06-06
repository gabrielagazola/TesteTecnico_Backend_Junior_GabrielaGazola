<?php

namespace App\Services;

use App\Repositories\PostRepository;

/**
 * Classe de serviço para gerenciar posts.
 * Atua como intermediário entre os controladores e o repositório.
 */
class PostService
{
    protected $postRepository;

    public function __construct()
    {
        $this->postRepository = new PostRepository();
    }

    /**
     * Obtém todos os posts.
     *
     * @return array 
     */
    public function getAllPosts()
    {
        return $this->postRepository->getAll();
    }

    /**
     * Obtém um post específico pelo ID.
     *
     * @param int 
     * @return array
     * @throws \Exception Se o post não for encontrado
     */
    public function getPostById($id)
    {
        $post = $this->postRepository->getById($id);
        if (!$post) {
            throw new \Exception("Post não encontrado", 404);
        }
        return $post;
    }

    /**
     * Cria um novo post.
     *
     * @param array 
     * @return int 
     * @throws \Exception Se os dados forem inválidos
     */
    
   
    public function createPost($data)
    {
        $postModel = new \App\Models\PostModel();

        if (!$postModel->insert($data)) {
            $errors = $postModel->errors();
            log_message('error', 'Erro de validação ao criar post: ' . json_encode($errors));

            // Retorna os erros de validação corretamente como JSON
            throw new \Exception(json_encode([
                'error' => 400,
                'messages' => $errors
            ]));

        }

        return $postModel->insertID();
    }

    /**
     * Atualiza um post existente.
     *
     * @param int 
     * @param array 
     * @return bool 
     * @throws \Exception Se o post não for encontrado
     */
    public function updatePost($id, $data)
    {
        if (!$this->postRepository->getById($id)) {
            throw new \Exception("Post não encontrado", 404);
        }
        return $this->postRepository->update($id, $data);
    }

    /**
     * Exclui um post pelo ID.
     *
     * @param int 
     * @return bool 
     * @throws \Exception Se o post não for encontrado
     */
    public function deletePost($id)
    {
        if (!$this->postRepository->getById($id)) {
            throw new \Exception("Post não encontrado", 404);
        }
        return $this->postRepository->delete($id);
    }
}
