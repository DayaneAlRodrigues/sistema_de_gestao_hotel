<?php
require_once '../../config/Database.php';
require_once '../../classes/Reserva.php';
require_once '../../classes/Hospede.php';
require_once '../../classes/Quarto.php';

$reservas = Reserva::listar($pdo);
$hospedes = Hospede::listar($pdo);
$quartos = Quarto::listar($pdo);

?>
<!doctype html>
<html lang="pt-BR">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Reservas | Hotel Admin</title>
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
          <li class="nav-item"><a class="nav-link " href="servicos.php">Serviços</a></li>
          <li class="nav-item"><a class="nav-link active" href="reservas.php">Reservas</a></li>
        </ul>
      </div>
    </div>
  </nav>

  <main class="container py-4 py-lg-5">

    <div class="d-flex justify-content-between align-items-center mb-4">
      <div>
        <h1 class="page-title h2 mb-1">Reservas</h1>
        <p class="text-muted mb-0">Controle de hospedagens e reservas.</p>
      </div>
      <a href="#form-reserva" class="btn btn-gold">+ Nova reserva</a>
    </div>

    <div class="card mb-4">
      <div class="card-header bg-white fw-semibold">Reservas cadastradas</div>
      <div class="table-responsive">
        <table class="table table-hover mb-0">
          <thead>
            <tr>
              <th>ID</th>
              <th>Hóspede</th>
              <th>Quarto</th>
              <th>Entrada</th>
              <th>Saída</th>
              <th>Status</th>
              <th class="text-end">Ações</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($reservas as $reserva): ?>
              <tr>
                <td>
                  <?= htmlspecialchars($reserva['id_reserva']) ?>
                </td>
                <td>
                  <?= htmlspecialchars($reserva['hospede_nome']) ?>
                </td>
                <td>
                  <?= htmlspecialchars($reserva['quarto_id']) ?>
                </td>
                <td>
                  <?= htmlspecialchars($reserva['data_entrada']) ?>
                </td>
                <td>
                  <?= htmlspecialchars($reserva['data_saida']) ?>
                </td>
                <td><span class="badge text-bg-primary">
                    <?= htmlspecialchars($reserva['status']) ?>
                  </span></td>
                <td class="text-end"><button class="btn btn-sm btn-outline-primary">Editar</button> 
                <button class="btn btn-sm btn-outline-danger">
                  <a href="../../reservas/excluir.php?id_reserva=<?= $reserva['id_reserva'] ?>">
                  Excluir
                </a></button></td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    </div>

    <div id="form-reserva" class="card form-card p-4">
      <h2 class="h5">Cadastrar reserva</h2>
      <form action="../../reservas/salvar.php" method="post">
        <div class="row g-3">
          <div class="col-md-6"><label class="form-label">Hóspede</label><select class="form-select" name="hospede_cpf"
              required>
              <option value="">Selecione o hóspede...</option>

              <?php foreach ($hospedes as $hospede): ?>

                <option value="<?= htmlspecialchars($hospede['cpf']) ?>">
                  <?= htmlspecialchars($hospede['nome']) ?>
                </option>

              <?php endforeach; ?>
            </select></div>
          <div class="col-md-6"><label class="form-label">Quarto</label><select class="form-select" name="quarto_id"
              required>
              <option value="">Selecione o quarto...</option>

              <?php foreach ($quartos as $quarto): ?>

                <option value="<?= htmlspecialchars($quarto['numero']) ?>">
                  Quarto <?= htmlspecialchars($quarto['numero']) ?>
                  - <?= htmlspecialchars($quarto['tipo']) ?>
                </option>

              <?php endforeach; ?>

            </select></div>
          <div class="col-md-6"><label class="form-label">Data de entrada</label><input class="form-control" type="datetime-local"
              name="data_entrada" required></div>
          <div class="col-md-6"><label class="form-label">Data de saída</label><input class="form-control" type="datetime-local"
              name="data_saida" required></div>
          <div class="col-md-4"><label class="form-label">Quantidade de hóspedes</label><input class="form-control"
              type="number" min="1" name="quantidade_hospedes" required></div>
          <div class="col-md-4"><label class="form-label">Status</label><select class="form-select" name="status">
              <option>Reservada</option>
              <option>Hospedado</option>
              <option>Finalizada</option>
              <option>Cancelada</option>
            </select></div>
          <div class="col-12"><label class="form-label">Observação</label><textarea class="form-control"
              name="observacao" rows="3"></textarea></div>
        </div>
        <button class="btn btn-gold mt-4">Salvar reserva</button>
      </form>
    </div>

  </main>
  <footer class="container pb-4 text-center">
    Base de front-end para o exercício de PHP + PostgreSQL + PDO
  </footer>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>