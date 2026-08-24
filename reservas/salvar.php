<?php

require_once '../config/Database.php';
require_once '../classes/Reserva.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $dataEntrada = new DateTime($_POST['data_entrada']);
    $dataSaida = new DateTime($_POST['data_saida']);

    $quantidade = (int) $_POST['quantidade_hospedes'];

    $status = $_POST['status'];

    $observacao = $_POST['observacao'];

    $hospedeCpf = $_POST['hospede_cpf'];

    $quartoId = (int) $_POST['quarto_id'];


    $reserva = new Reserva(
        $dataEntrada,
        $dataSaida,
        $quantidade,
        $status,
        $observacao,
        $hospedeCpf,
        $quartoId
    );


    if ($reserva->cadastrar($pdo)) {

        header(
            'Location: ../front_end_base/front_hotel_base/reservas.php'
        );

        exit;

    } else {

        echo "Erro ao cadastrar reserva.";

    }
}