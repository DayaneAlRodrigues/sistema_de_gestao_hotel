<?php
    require_once '../config/Database.php';
    require_once '../classes/Servico.php';
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $id = $_POST['id_servico'];
        $nome = $_POST['nome'];
        $preco = $_POST['preco'];
        $descricao = $_POST['descricao'];
        $status = $_POST['ativo'];
        
        $servicoAtualizado = new Servico($nome,$descricao,$preco, $status);
        $servicoAtualizado->setIdServico($id);

        if ($servicoAtualizado->atualizar($pdo)) {
            header('Location: ../front_end_base/front_hotel_base/servicos.php');
            exit;
        } else {
            echo "Erro ao atualizar servico.";
        }

    }
?>