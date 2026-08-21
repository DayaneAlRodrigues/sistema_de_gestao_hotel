<?php
    require_once '../config/Database.php';
    require_once '../classes/Hospede.php';
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $cpf = $_POST['cpf'];
        $nome = $_POST['nome'];
        $telefone = $_POST['telefone'];
        $email = $_POST['email'];
        
        $novoHospede = new Hospede($cpf,$nome,$telefone,$email);

        $novoHospede->cadastrar($pdo);

    }
?>