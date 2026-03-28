<?php

require_once 'Paciente.php'; 

class PacienteRepository {
    private $pdo;

    public function __construct(PDO $pdo) {
        $this->pdo = $pdo;
    }

    private function validarCPF($cpf) {
        $cpf = preg_replace('/[^0-9]/', '', $cpf);
        return strlen($cpf) === 11;
    }

    public function recuperar() {
        $stmt = $this->pdo->query("SELECT * FROM pacientes");
        $dados = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        $pacientes = [];
        foreach ($dados as $linha) {
            $pacientes[] = new Paciente($linha['id'], $linha['nome'], $linha['cpf']);
        }
        return $pacientes;
    }

    public function salvar($nome, $cpf) {
        if ($this->validarCPF($cpf)) {
            $stmt = $this->pdo->prepare("INSERT INTO pacientes (nome, cpf) VALUES (?, ?)");
            $stmt->execute([$nome, $cpf]);
        }
    }
}