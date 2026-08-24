<?php
    require_once '../config/Database.php';
    require_once '../classes/Reserva.php';
    if(isset($_GET['id_reserva'])) {
        $id_reserva = $_GET['id_reserva'];

        $reserva = Reserva::buscarPorId($pdo,$id_reserva);

        if($reserva === null) {
            die('Reserva não encontrada');
        }


        if ($reserva->excluir($pdo)) {
            header('Location: ../front_end_base/front_hotel_base/reservas.php');
            exit;
        } else {
            echo "Erro ao excluir a reserva.";
        }

    }
?>