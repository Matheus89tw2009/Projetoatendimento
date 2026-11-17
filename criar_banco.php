<?php

try {
    // Conecta ao MySQL sem selecionar nenhum banco pré-existente
    $pdo = new PDO('mysql:host=127.0.0.1;port=3306', 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Cria o banco de dados caso ele não exista
    $pdo->exec("CREATE DATABASE IF NOT EXISTS helpdesk_db CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;");

    echo "✅ Banco de dados 'helpdesk_db' criado/verificado com sucesso!";
} catch (PDOException $e) {
    echo "❌ Erro ao criar o banco de dados: " . $e->getMessage();
}