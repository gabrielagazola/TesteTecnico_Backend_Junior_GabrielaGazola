<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class PostSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'title'   => 'Primeiro Post',
                'content' => 'Conteúdo do primeiro post.'
            ],
            [
                'title'   => 'Segundo Post',
                'content' => 'Conteúdo do segundo post.'
            ],
            [
                'title'   => 'Terceito Post',
                'content' => 'Conteúdo do terceiro post.'
            ]
        ];

        $this->db->table('posts')->insertBatch($data);
    }
}
