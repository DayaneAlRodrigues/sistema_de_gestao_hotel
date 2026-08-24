<?php
    require_once '../config/Database.php';
    require_once '../classes/Servico.php';
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $nome = $_POST['nome'];
        $preco = $_POST['preco'];
        $descricao = $_POST['descricao'];
        $status = $_POST['ativo'];
                
        $novoServico = new Servico($nome,$descricao,$preco,$status);

        if ($novoServico->cadastrar($pdo)) {
            header('Location: ../front_end_base/front_hotel_base/servicos.php');
            exit;
        } else {
            echo "Erro ao cadastrar serviço.";
        }


    }
?>