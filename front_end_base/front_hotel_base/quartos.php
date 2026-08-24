<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once '../../config/Database.php';
require_once '../../classes/Quarto.php';

$quartos = Quarto :: listar($pdo);
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
        <li class="nav-item"><a class="nav-link " href="index.html">Início</a></li>
        <li class="nav-item"><a class="nav-link " href="hospedes.html">Hóspedes</a></li>
        <li class="nav-item"><a class="nav-link active" href="quartos.html">Quartos</a></li>
        <li class="nav-item"><a class="nav-link " href="servicos.html">Serviços</a></li>
        <li class="nav-item"><a class="nav-link " href="reservas.html">Reservas</a></li>
      </ul>
    </div>
  </div>
</nav>

<main class="container py-4 py-lg-5">

<div class="d-flex justify-content-between align-items-center mb-4">
  <div><h1 class="page-title h2 mb-1">Quartos</h1><p class="text-muted mb-0">Controle de quartos e tipos de acomodação.</p></div>
  <a href="#form-quarto" class="btn btn-hotel">+ Novo quarto</a>
</div>

<div class="card mb-4">
  <div class="card-header bg-white fw-semibold">Quartos cadastrados</div>
  <div class="table-responsive">
    <table class="table table-hover mb-0">
      <thead><tr><th>Número</th><th>Tipo</th><th>Capacidade</th><th>Diária</th><th>Status</th><th class="text-end">Ações</th></tr></thead>
      <tbody>
        <?php foreach ($quartos as $quarto) : ?>
        <tr><td>
          <?= htmlspecialchars($quarto['numero']) ?>
          
      </td><td>
        <?= htmlspecialchars($quarto['tipo']) ?>
      </td>
      <td>
        <?= htmlspecialchars($quarto['capacidade']) ?>
      </td>
      <td>
        <?= htmlspecialchars($quarto['valor_diaria']) ?>
      </td>
      <td><span class="badge text-bg-success">
        <?= htmlspecialchars($quarto['status']) ?>
      </span></td>
      <td class="text-end"><button class="btn btn-sm btn-outline-primary">Editar</button> 
      <button class="btn btn-sm btn-outline-danger">Excluir</button></td></tr>
      <?php endforeach; ?>
      </tbody>
    </table>
  </div>
</div>

<div id="form-quarto" class="card form-card p-4">
  <h2 class="h5">Cadastrar quarto</h2>
  <div class="endpoint mb-3">POST /quartos/salvar.php — ajuste o action para o seu backend.</div>
  <form action="../../quartos/salvar.php" method="post">
    <div class="row g-3">
      <div class="col-md-4"><label class="form-label">Número</label><input class="form-control" name="numero" required></div>
      <div class="col-md-4"><label class="form-label">Tipo</label><select class="form-select" name="tipo_id" required><option value="">Selecione...</option><option>Individual</option><option>Duplo</option><option>Triplo</option><option>Suíte</option></select></div>
      <div class="col-md-4"><label class="form-label">Capacidade</label><input class="form-control" type="number" min="1" name="capacidade" required></div>
      <div class="col-md-6"><label class="form-label">Valor da diária</label><input class="form-control" type="number" min="0" step="0.01" name="valor_diaria" required></div>
      <div class="col-md-6"><label class="form-label">Status</label><select class="form-select" name="status"><option>Disponível</option><option>Ocupado</option><option>Manutenção</option></select></div>
    </div>
    <button class="btn btn-hotel mt-4">Salvar quarto</button>
  </form>
</div>

</main>
<footer class="container pb-4 text-center">
  Base de front-end para o exercício de PHP + PostgreSQL + PDO
</footer>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>