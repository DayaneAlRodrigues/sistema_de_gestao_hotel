<?php
require_once '../../config/Database.php';
$sql = "SELECT 
            h.cpf, 
            h.nome, 
            t.numero,
            h.email 
        FROM hospedes AS h
        
        LEFT JOIN telefones AS t
        ON t.hospede_cpf = h.cpf
        
        ORDER BY h.nome ASC";

$stmt = $pdo->query($sql);

?>
<!doctype html>
<html lang="pt-BR">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Hóspedes | Hotel Admin</title>
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
        <li class="nav-item"><a class="nav-link active" href="hospedes.html">Hóspedes</a></li>
        <li class="nav-item"><a class="nav-link " href="quartos.html">Quartos</a></li>
        <li class="nav-item"><a class="nav-link " href="servicos.html">Serviços</a></li>
        <li class="nav-item"><a class="nav-link " href="reservas.html">Reservas</a></li>
      </ul>
    </div>
  </div>
</nav>

<main class="container py-4 py-lg-5">

<div class="d-flex justify-content-between align-items-center mb-4">
  <div><h1 class="page-title h2 mb-1">Hóspedes</h1><p class="text-muted mb-0">Listagem e cadastro de hóspedes.</p></div>
  <a href="#form-hospede" class="btn btn-hotel">+ Novo hóspede</a>
</div>

<div class="card mb-4">
  <div class="card-header bg-white fw-semibold">Hóspedes cadastrados</div>
  <div class="table-responsive">
    <table class="table table-hover mb-0">
      <thead><tr><th>Nome</th><th>CPF</th><th>Telefone</th><th>E-mail</th><th class="text-end">Ações</th></tr></thead>
      <tbody>
        <?php while ($row =$stmt->fetch(PDO::FETCH_ASSOC)) : ?> 
        <tr><td>
          <?= htmlspecialchars($row['nome']) ?>
        </td>
        <td>
          <?= htmlspecialchars($row['cpf']) ?>
        </td>
        <td>
          <?= htmlspecialchars($row['numero']) ?>
        </td>
        <td>
          <?= htmlspecialchars($row['email']) ?>
        </td>
        <td class="text-end">
        <button class="btn btn-sm btn-outline-primary">
          Editar
        </button> 
        <button class="btn btn-sm btn-outline-danger">
          Excluir
        </button>
        </td></tr>
          <?php endwhile; ?>
      </tbody>
    </table>
  </div>
</div>

<div id="form-hospede" class="card form-card p-4">
  <h2 class="h5">Cadastrar hóspede</h2>
  <div class="endpoint mb-3">POST /hospedes/salvar.php — ajuste o action para o seu backend.</div>
  <form action="../../hospedes/salvar.php" method="post">
    <div class="row g-3">
      <div class="col-md-6"><label class="form-label">Nome</label><input class="form-control" name="nome" required></div>
      <div class="col-md-6"><label class="form-label">CPF</label><input class="form-control" name="cpf" required></div>
      <div class="col-md-6"><label class="form-label">Telefone</label><input class="form-control" name="telefone"></div>
      <div class="col-md-6"><label class="form-label">E-mail</label><input class="form-control" type="email" name="email"></div>
    </div>
    <button class="btn btn-hotel mt-4">Salvar hóspede</button>
  </form>
</div>

</main>
<footer class="container pb-4 text-center">
  Base de front-end para o exercício de PHP + PostgreSQL + PDO
</footer>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>