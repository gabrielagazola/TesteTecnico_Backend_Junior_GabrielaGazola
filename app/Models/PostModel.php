<?php

namespace App\Models;

use CodeIgniter\Model;

/**
 * Modelo PostModel responsável pela interação com a tabela 'posts' no banco de dados.
 */
class PostModel extends Model
{
    // Nome da tabela no banco de dados
    protected $table = 'posts'; 

    protected $primaryKey = 'id'; 
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $useSoftDeletes = false;
    protected $protectFields = true;
    protected $allowedFields = ['title', 'content']; // Define os campos permitidos para inserção/atualização
    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    // Configuração de timestamps automáticos
    protected $useTimestamps = true;  
    protected $dateFormat = 'datetime'; 
    protected $createdField = 'created_at'; 
    protected $updatedField = 'updated_at'; 

    // Regras de validação para os dados antes da inserção/atualização
    protected $validationRules = [
        'title'   => 'required|min_length[3]|max_length[255]', // O título deve ter entre 3 e 255 caracteres
        'content' => 'required|min_length[5]' // O conteúdo deve ter pelo menos 5 caracteres
    ];

    // Mensagens de erro para validação
    protected $validationMessages = [
        'title'   => [
            'required'   => 'O título é obrigatório.',
            'min_length' => 'O título deve ter pelo menos 3 caracteres.',
            'max_length' => 'O título não pode ter mais que 255 caracteres.'
        ],
        'content' => [
            'required'   => 'O conteúdo é obrigatório.',
            'min_length' => 'O conteúdo deve ter pelo menos 5 caracteres.'
        ]
    ];
    
    protected $allowCallbacks = true;
    protected $beforeInsert = ['setTimestamps']; 
    protected $beforeUpdate = ['setUpdatedTimestamp']; 
    /**
     * Callback que define os timestamps automaticamente antes da inserção.
     *
     * @param array $data Dados do registro a ser inserido.
     * @return array Retorna os dados com timestamps atualizados.
     */
    protected function setTimestamps(array $data)
    {
        $data['data']['created_at'] = date('Y-m-d H:i:s'); 
        $data['data']['updated_at'] = date('Y-m-d H:i:s'); 
        return $data;
    }

    /**
     * Callback que atualiza o timestamp de 'updated_at' antes de uma atualização.
     *
     * @param array 
     * @return array 
     */
    protected function setUpdatedTimestamp(array $data)
    {
        $data['data']['updated_at'] = date('Y-m-d H:i:s'); // Atualiza o timestamp
        return $data;
    }
}
