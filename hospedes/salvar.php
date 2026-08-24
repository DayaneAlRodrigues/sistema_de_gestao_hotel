<?php
    require_once '../config/Database.php';
    require_once '../classes/Hospede.php';
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $cpf = $_POST['cpf'];
        $nome = $_POST['nome'];
        $telefone = $_POST['telefone'];
        $email = $_POST['email'];
        
        $novoHospede = new Hospede($cpf,$nome,$telefone,$email);

        if($novoHospede->cadastrar($pdo)){
            header('Location: ../front_end_base/front_hotel_base/hospedes.php');
            exit;
        } else {
            echo "Erro ao cadastrar hóspede.";
        }


    }
?>