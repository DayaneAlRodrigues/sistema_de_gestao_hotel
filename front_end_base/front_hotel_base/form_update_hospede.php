<?php

require_once '../../config/Database.php';
require_once '../../classes/Hospede.php';

if (!isset($_GET['cpf'])) {
    die("CPF do hóspede não informado.");
}

$cpf = $_GET['cpf'];

$hospede = Hospede::buscarPorCpf($pdo, $cpf);

if ($hospede === null) {
    die("Hóspede não encontrado.");
}

?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Editar Hóspede | Hotel Admin</title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >

    <link rel="stylesheet" href="../front_end_base/front_hotel_base/css/style.css">
</head>

<body>

<div id="form-update-hospede" class="card form-card p-4">

    <h2 class="h5">Editar hóspede</h2>

    <form action="../../hospedes/atualizar.php" method="post">

        <div class="row g-3">

            <div class="col-md-6">
                <label class="form-label">Nome</label>

                <input
                    class="form-control"
                    name="nome"
                    value="<?= htmlspecialchars($hospede->getNome()) ?>"
                    required
                >
            </div>

            <div class="col-md-6">
                <label class="form-label">CPF</label>

                <input
                    class="form-control"
                    name="cpf"
                    value="<?= htmlspecialchars($hospede->getCpf()) ?>"
                    readonly
                >
            </div>

            <div class="col-md-6">
                <label class="form-label">Telefone</label>

                <input
                    class="form-control"
                    name="telefone"
                    value="<?= htmlspecialchars($hospede->getTelefone()) ?>"
                >
            </div>

            <div class="col-md-6">
                <label class="form-label">E-mail</label>

                <input
                    class="form-control"
                    type="email"
                    name="email"
                    value="<?= htmlspecialchars($hospede->getEmail()) ?>"
                >
            </div>

        </div>

        <button class="btn btn-hotel mt-4" type="submit">
            Atualizar hóspede
        </button>

    </form>

</div>

</body>
</html>