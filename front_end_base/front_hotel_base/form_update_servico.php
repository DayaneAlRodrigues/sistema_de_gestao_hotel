<?php

require_once '../../config/Database.php';
require_once '../../classes/Servico.php';

if (!isset($_GET['id_servico'])) {
    die("Id do serviço não informado.");
}

$id = $_GET['id_servico'];

$servico = Servico::buscarPorId($pdo, $id);

if ($servico === null) {
    die("Serviço não encontrado.");
}

?>
<!doctype html>
<html lang="pt-BR">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Serviços | Hotel Admin</title>
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
        <li class="nav-item"><a class="nav-link " href="index.html">Início</a></li>
        <li class="nav-item"><a class="nav-link " href="hospedes.html">Hóspedes</a></li>
        <li class="nav-item"><a class="nav-link " href="quartos.html">Quartos</a></li>
        <li class="nav-item"><a class="nav-link active" href="servicos.html">Serviços</a></li>
        <li class="nav-item"><a class="nav-link " href="reservas.html">Reservas</a></li>
      </ul>
    </div>
  </div>
</nav>

<main class="container py-4 py-lg-5">
<div id="form-servico" class="card form-card p-4">
  <h2 class="h5">Editar serviço</h2>
  <div class="endpoint mb-3">POST /servicos/salvar.php — ajuste o action para o seu backend.</div>
  <form action="../../servicos/atualizar.php" method="post">
    <input type="hidden" name="id_servico" value="<?= htmlspecialchars($servico->getIdServico()) ?>">
    <div class="row g-3">
      <div class="col-md-6"><label class="form-label">Nome</label>
      <input class="form-control" name="nome" required value="<?= htmlspecialchars($servico->getNome()) ?>"></div>
      <div class="col-md-6"><label class="form-label">Preço</label><input class="form-control" type="number" min="0" step="0.01" name="preco" required
      value="<?= htmlspecialchars($servico->getPreco()) ?>"></div>
      <div class="col-12"><label class="form-label">Descrição</label><textarea class="form-control" name="descricao" rows="3"
      ><?= htmlspecialchars($servico->getDescricao()) ?></textarea></div>
      <div class="col-md-4"><label class="form-label">Status</label><select class="form-select" name="ativo"
      value="<?= htmlspecialchars($servico->getsituacao()) ?>"><option value="1">Ativo</option><option value="0">Inativo</option></select></div>
    </div>
    <button class="btn btn-hotel mt-4">Salvar serviço</button>
  </form>
</div>
</main>
<footer class="container pb-4 text-center">
  Base de front-end para o exercício de PHP + PostgreSQL + PDO
</footer>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>