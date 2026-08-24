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

<!doctype html>
<html lang="pt-BR">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Quartos | Hotel Admin</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="css/style.css">
</head>

<body>

  <nav class="navbar navbar-expand-lg navbar-dark navbar-hotel">
    <div class="container">
      <a class="navbar-brand" href="index.html">🏨 Hotel Admin</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#nav">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="nav">
        <ul class="navbar-nav ms-auto">
          <li class="nav-item"><a class="nav-link " href="index.php">Início</a></li>
          <li class="nav-item"><a class="nav-link " href="hospedes.php">Hóspedes</a></li>
          <li class="nav-item"><a class="nav-link active" href="quartos.php">Quartos</a></li>
          <li class="nav-item"><a class="nav-link " href="servicos.php">Serviços</a></li>
          <li class="nav-item"><a class="nav-link " href="reservas.php">Reservas</a></li>
        </ul>
      </div>
    </div>
  </nav>

  <main class="container py-4 py-lg-5">
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
</main><footer class="container pb-4 text-center">
  Base de front-end para o exercício de PHP + PostgreSQL + PDO
</footer>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>