<?php

require "conexao-mysql.php";

$pdo = conexaoMysql();

$cep = htmlspecialchars($_POST["cep"]) ?? NULL;
$logradouro = htmlspecialchars($_POST["logradouro"]) ?? NULL;
$cidade = htmlspecialchars($_POST["cidade"]) ?? NULL;
$estado = htmlspecialchars($_POST["estado"]) ?? NULL;

$sql = <<<SQL
    INSERT INTO base_enderecos
    VALUES (?, ?, ?, ?);
SQL;

try {
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$cep, $logradouro, $cidade, $estado]);
    header("Location: https://ppi-matheus.infinityfreeapp.com/Clinica-Medica/cadastro-endereco.html");
} catch (PDOException $e) {
    http_response_code(500);
    header("Content-type: application/json; charset=utf-8");
    echo json_encode(["erro" => "Ocorreu um erro ao tentar cadastrar o endereço."]);
    exit();
}
