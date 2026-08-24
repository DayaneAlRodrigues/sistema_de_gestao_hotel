<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once '../../config/Database.php';
require_once '../../classes/Servico.php';

$servicos = Servico::listar($pdo);
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
        <li class="nav-item"><a class="nav-link " href="index.php">Início</a></li>
        <li class="nav-item"><a class="nav-link " href="hospedes.php">Hóspedes</a></li>
        <li class="nav-item"><a class="nav-link " href="quartos.php">Quartos</a></li>
        <li class="nav-item"><a class="nav-link active" href="servicos.php">Serviços</a></li>
        <li class="nav-item"><a class="nav-link " href="reservas.php">Reservas</a></li>
      </ul>
    </div>
  </div>
</nav>

<main class="container py-4 py-lg-5">

<div class="d-flex justify-content-between align-items-center mb-4">
  <div><h1 class="page-title h2 mb-1">Serviços</h1><p class="text-muted mb-0">Serviços adicionais oferecidos pela pousada.</p></div>
  <a href="#form-servico" class="btn btn-hotel">+ Novo serviço</a>
</div>

<div class="card mb-4">
  <div class="card-header bg-white fw-semibold">Serviços cadastrados</div>
  <div class="table-responsive">
    <table class="table table-hover mb-0">
      <thead><tr><th>ID</th><th>Nome</th><th>Descrição</th><th>Preço</th><th>Status</th><th class="text-end">Ações</th></tr></thead>
      <tbody>
        <?php foreach ($servicos as $servico) : ?> 
        <tr><td>
          <?= htmlspecialchars($servico['id_servico']) ?>
        </td><td>
          <?= htmlspecialchars($servico['nome']) ?>
        </td><td>
          <?= htmlspecialchars($servico['descricao']) ?>
        </td><td>
          <?= htmlspecialchars($servico['preco']) ?>
        </td><td><span class="badge text-bg-success">
          <?= htmlspecialchars($servico['situacao']) ?></span>
        </td><td class="text-end">
          <button class="btn btn-sm btn-outline-primary">
            <a href="form_update_servico.php?id_servico=<?= $servico['id_servico'] ?>">
            Editar
          </a></button> 
            <button class="btn btn-sm btn-outline-danger">
              <a href="../../servicos/excluir.php?id_servico=<?= $servico['id_servico'] ?>">
              Excluir
            </a></button></td></tr>
        
      <?php endforeach; ?>
      </tbody>
    </table>
  </div>
</div>

<div id="form-servico" class="card form-card p-4">
  <h2 class="h5">Cadastrar serviço</h2>
  <div class="endpoint mb-3">POST /servicos/salvar.php — ajuste o action para o seu backend.</div>
  <form action="../../servicos/salvar.php" method="post">
    <div class="row g-3">
      <div class="col-md-6"><label class="form-label">Nome</label><input class="form-control" name="nome" required></div>
      <div class="col-md-6"><label class="form-label">Preço</label><input class="form-control" type="number" min="0" step="0.01" name="preco" required></div>
      <div class="col-12"><label class="form-label">Descrição</label><textarea class="form-control" name="descricao" rows="3"></textarea></div>
      <div class="col-md-4"><label class="form-label">Status</label><select class="form-select" name="ativo"><option value="1">Ativo</option><option value="0">Inativo</option></select></div>
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