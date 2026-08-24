<?php
    require_once '../config/Database.php';
    require_once '../classes/Quarto.php';
    if(isset($_GET['numero'])) {
        $numero = $_GET['numero'];

        $quarto = Quarto::buscarPorNumero($pdo,$numero);

        if($quarto === null) {
            die('Quarto não encontrado');
        }


        if ($quarto->excluir($pdo)) {
            header('Location: ../front_end_base/front_hotel_base/quartos.php');
            exit;
        } else {
            echo "Erro ao excluir o quarto.";
        }

    }
?>