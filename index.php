<?php
require_once 'PacienteRepository.php';

$pdo = new PDO("sqlite:clinica.db");
$pdo->exec("CREATE TABLE IF NOT EXISTS pacientes (id INTEGER PRIMARY KEY AUTOINCREMENT, nome TEXT, cpf TEXT)");

$repo = new PacienteRepository($pdo);

$repo->salvar("Antônio", "12345678901");
$repo->salvar("Arthur", "98765432102");
$repo->salvar("Amélia", "11122233344");

$pacientes = $repo->recuperar();

echo "<h2>Lista de Pacientes - Pasta Única</h2>";
foreach ($pacientes as $p) {
    echo "ID: " . $p->getId() . " | Nome: " . $p->getNome() . " | CPF: " . $p->getCpf() . "<br>";
}