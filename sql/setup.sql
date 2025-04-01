-- Criação do banco de dados
CREATE DATABASE IF NOT EXISTS minha_api_db;

-- Selecionar o banco de dados
USE minha_api_db;

-- Criação da tabela de posts
CREATE TABLE IF NOT EXISTS posts (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    content TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);