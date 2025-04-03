<?php

namespace App\Repositories;

use App\Models\PostModel;

/**
 * Classe responsável por gerenciar as operações no banco de dados 
 * relacionadas à Post, utilizando o modelo PostModel.
 */
class PostRepository
{
    protected $postModel;

    /**
     * Construtor da classe, inicializa o modelo PostModel.
     */
    public function __construct()
    {
        $this->postModel = new PostModel();
    }

    /**
     * Retorna todos os registros da tabela de posts.
     *
     * @return array 
     */
    public function getAll()
    {
        return $this->postModel->findAll();
    }

    /**
     * Retorna um post específico pelo ID.
     *
     * @param int $id ID do post
     * @return array|null Retorna os dados do post ou null se não encontrado
     */
    public function getById($id)
    {
        return $this->postModel->find($id);
    }

    /**
     * Cria um novo post no banco de dados.
     *
     * @param array $data Dados do post a ser criado
     * @return bool|int Retorna true ou o ID do novo post se bem-sucedido, false em caso de erro
     */
    public function create($data)
    {
        $postModel = new \App\Models\PostModel();

        if (!$postModel->insert($data)) {
            
            $errors = $postModel->errors();
            log_message('error', 'Erro de validação ao criar post: ' . json_encode($errors));

            // Lança uma exceção para que o PostService capture
            throw new \Exception(json_encode($errors), 400);
        }

        return $postModel->insertID();
    }

    /**
     * Atualiza um post existente pelo ID.
     *
     * @param int 
     * @param array 
     * @return bool Retorna true se a atualização for bem-sucedida, false caso contrário
     */
   
    public function update($id, $data)
    {
        $postModel = new \App\Models\PostModel();

        if (!$postModel->update($id, $data)) {
            
            $errors = $postModel->errors();
            log_message('error', 'Erro de validação ao atualizar post: ' . json_encode($errors));

            // Lança uma exceção para que o PostService capture
            throw new \Exception(json_encode($errors), 400);
        }

        return true;
    }


    /**
     * Exclui um post do banco de dados pelo ID.
     *
     * @param int 
     * @return bool 
     */
    public function delete($id)
    {
        return $this->postModel->delete($id);
    }
}
