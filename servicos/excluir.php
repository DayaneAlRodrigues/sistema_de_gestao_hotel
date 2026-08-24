<?php
    require_once '../config/Database.php';
    require_once '../classes/Servico.php';
    if(isset($_GET['id_servico'])) {
        $id = $_GET['id_servico'];

        $servico = Servico::buscarPorId($pdo,$id);

        if($servico === null) {
            die('Serviço não encontrado');
        }


        if ($servico->excluir($pdo)) {
            header('Location: ../front_end_base/front_hotel_base/servicos.php');
            exit;
        } else {
            echo "Erro ao excluir o serviço.";
        }

    }
?>