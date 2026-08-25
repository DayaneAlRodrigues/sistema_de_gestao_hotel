<?php
    require_once '../config/Database.php';
    require_once '../classes/Reserva.php';
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $id_reserva = $_POST['id_reserva'];
        $hospede_cpf = $_POST['hospede_cpf'];
        $quarto_id = $_POST['quarto_id'];
        $data_entrada = $_POST['data_entrada'];
        $data_saida = $_POST['data_saida'];
        $quantidade = $_POST['quantidade_hospedes'];
        $status = $_POST['status'];
        $observacao = $_POST['observacao'];
        $hospede_nome = $_POST['hospede_nome'];
        
        $reservaAtualizada = new Reserva(new DateTime ($data_entrada),new DateTime ($data_saida),$quantidade,$status,$observacao,$hospede_cpf,$quarto_id);
        $reservaAtualizada->setIdReserva($id_reserva);
        $reservaAtualizada->setHospedeNome($hospede_nome);

        if ($reservaAtualizada->atualizar($pdo)) {
            header('Location: ../front_end_base/front_hotel_base/reservas.php');
            exit;
        } else {
            echo "Erro ao atualizar reserva.";
        }

    }
?>