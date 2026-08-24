<?php
    require_once '../config/Database.php';
    require_once '../classes/Quarto.php';
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $numero = $_POST['numero'];
        $tipo = $_POST['tipo'];
        $capacidade = $_POST['capacidade'];
        $valor_diaria = $_POST['valor_diaria'];
        $status = $_POST['status'];
        
        $quartoAtualizado = new Quarto($numero,$capacidade,$valor_diaria,$status,$tipo);

        if ($quartoAtualizado->atualizar($pdo)) {
            header('Location: ../front_end_base/front_hotel_base/quartos.php');
            exit;
        } else {
            echo "Erro ao atualizar quarto.";
        }

    }
?>