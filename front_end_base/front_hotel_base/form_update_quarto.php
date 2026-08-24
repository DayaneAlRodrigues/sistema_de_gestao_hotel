<?php

require_once '../../config/Database.php';
require_once '../../classes/Quarto.php';

if (!isset($_GET['numero'])) {
  die("Numero do quarto não informado.");
}

$numero = $_GET['numero'];

$quarto = Quarto::buscarPorNumero($pdo, (int) $numero);

if ($quarto === null) {
  die("Quarto não encontrado.");
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
    <div id="form-quarto" class="card form-card p-4">
      <h2 class="h5">Editar quarto</h2>
      <form action="../../quartos/atualizar.php" method="post">
        <div class="row g-3">
          <div class="col-md-4"><label class="form-label">Número</label>
            <input class="form-control" name="numero" required value="<?= htmlspecialchars($quarto->getNumero()) ?>">
          </div>
          <div class="col-md-4"><label class="form-label">Tipo</label><select class="form-select" name="tipo"
              required value="<?= htmlspecialchars($quarto->getTipo()) ?>">
              <option>Individual</option>
              <option>Duplo</option>
              <option>Triplo</option>
              <option>Suíte</option>
            </select></div>
          <div class="col-md-4"><label class="form-label">Capacidade</label>
            <input class="form-control" type="number" min="1" name="capacidade" required
              value="<?= htmlspecialchars($quarto->getCapacidade()) ?>">
          </div>
          <div class="col-md-6"><label class="form-label">Valor da diária</label>
            <input class="form-control" type="number" min="0" step="0.01" name="valor_diaria" required
              value="<?= htmlspecialchars($quarto->getValorDiaria()) ?>">
          </div>
          <div class="col-md-6"><label class="form-label">Status</label>
            <select class="form-select" name="status" value="<?= htmlspecialchars($quarto->getStatus()) ?>">
              <option>Disponível</option>
              <option>Ocupado</option>
              <option>Manutenção</option>
            </select>
          </div>
        </div>
        <button class="btn btn-hotel mt-4">Salvar quarto</button>
      </form>
    </div>
  </main>