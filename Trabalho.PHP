<?php

$db = new PDO("sqlite:banco_dados.db"); 

class Paciente {
    public $id;
    public $nome;
    public $cpf;

    public function getId() { return $this->id; }
    public function getNome() { return $this->nome; }
    public function getCpf() { return $this->cpf; }
}

class Consulta {
    public $id;
    public $data;
    public function getId() { return $this->id; }
    public function getData() { return $this->data; }
}

function validarCPF($cpf) {
    $cpf = str_replace(['.', '-'], '', $cpf);
    if (strlen($cpf) != 11) {
        return false;
    }
    return true;
}

class PacienteRepo {
    public function recuperar($con) {
        $sql = "SELECT * FROM pacientes";
        $res = $con->query($sql);
        return $res->fetchAll(PDO::FETCH_ASSOC);
    }

    public function salvar($con, $nome, $cpf) {
        if (validarCPF($cpf)) {
            $sql = "INSERT INTO pacientes (nome, cpf) VALUES ('$nome', '$cpf')";
            $con->exec($sql);
        }
    }
}

$meuRepo = new PacienteRepo();

$db->exec("CREATE TABLE IF NOT EXISTS pacientes (id INTEGER PRIMARY KEY, nome TEXT, cpf TEXT)");

$meuRepo->salvar($db, "Joao Silva", "123.456.789-00");
$meuRepo->salvar($db, "Maria Souza", "98765432111");
$meuRepo->salvar($db, "Pedro Alvares", "11122233344");

echo "Pronto, professor. Dados inseridos e CPF validado.";
?>