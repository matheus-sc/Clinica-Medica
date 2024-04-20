<?php

require "conexao-mysql.php";
$pdo = conexaoMysql();

try {

    $sql = <<<SQL
    SELECT p.nome, p.sexo, p.email, p.telefone 
    FROM pessoa p INNER JOIN funcionario f ON p.codigo = f.codigo
    SQL;

    $stmt = $pdo->query($sql);
    $listagem = $stmt->fetchAll();
} catch (Exception $e) {
    exit('Ocorreu uma falha: ' . $e->getMessage());
}

header("Content-type: application/json; charset=UTF-8");
echo json_encode($listagem);
