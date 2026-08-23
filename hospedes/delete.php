<?php
    require_once '../config/Database.php';
    require_once '../classes/Hospede.php';
    if(isset($_GET['cpf'])) {
        $cpf = $_GET['cpf'];

        $hospede = Hospede::buscarPorCpf($pdo,$cpf);

        if($hospede === null) {
            die('Hóspede não encontrado');
        }


        if ($hospede->excluir($pdo)) {
            header('Location: ../front_end_base/front_hotel_base/hospedes.php');
            exit;
        } else {
            echo "Erro ao excluir o hóspede.";
        }

    }
?>