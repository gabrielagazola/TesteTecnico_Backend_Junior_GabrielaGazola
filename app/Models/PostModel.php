<?php

namespace App\Models;

use CodeIgniter\Model;

class PostModel extends Model
{
    protected $table            = 'posts'; // Nome da tabela no BD
    protected $primaryKey       = 'id'; 
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;

    // Campos permitidos para inserção/atualização
    protected $allowedFields    = ['title', 'content']; 

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    // Ativar timestamps automáticos
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    // Validação dos dados
    protected $validationRules = [
        'title'   => 'required|min_length[3]|max_length[255]',
        'content' => 'required|min_length[5]'
    ];

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
    
    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = ['setTimestamps'];
    protected $beforeUpdate   = ['setUpdatedTimestamp'];

    // Callback para definir timestamps automaticamente
    protected function setTimestamps(array $data)
    {
        $data['data']['created_at'] = date('Y-m-d H:i:s');
        $data['data']['updated_at'] = date('Y-m-d H:i:s');
        return $data;
    }

    protected function setUpdatedTimestamp(array $data)
    {
        $data['data']['updated_at'] = date('Y-m-d H:i:s');
        return $data;
    }
}
