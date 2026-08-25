<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');
require_once '../../config/Database.php';
require_once '../../classes/Reserva.php';

if (!isset($_GET['id_reserva'])) {
    die("Id da reserva não informado.");
}

$id_reserva = $_GET['id_reserva'];

$reserva = Reserva::buscarPorId($pdo, (int) $id_reserva);

if ($reserva === null) {
    die("Reserva não encontrada.");
}


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



        <div id="form-reserva" class="card form-card p-4">
            <h2 class="h5">Editar reserva</h2>

            <form action="../../reservas/atualizar.php" method="post">

                <input type="hidden" name="id_reserva" value="<?= htmlspecialchars($id_reserva) ?>">
                 <input type="hidden" name="hospede_nome" value="<?= htmlspecialchars($reserva->getHospedeNome()) ?>">


                <div class="row g-3">

                    <div class="col-md-6">
                        <label class="form-label">Hóspede</label>

                        <select class="form-select" name="hospede_cpf" required>

                            <option value="">
                                Selecione o hóspede...
                            </option>

                            <option value="<?= htmlspecialchars($reserva->gethospedeCpf()) ?>" selected>
                                <?= htmlspecialchars($reserva->getHospedeNome()) ?>
                            </option>

                        </select>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Quarto</label>

                        <select class="form-select" name="quarto_id" required>

                            <option value="">
                                Selecione o quarto...
                            </option>

                            <option value="<?= htmlspecialchars($reserva->getquartoId()) ?>" selected>
                                <?= htmlspecialchars($reserva->getquartoId()) ?>
                            </option>

                        </select>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">
                            Data de entrada
                        </label>

                        <input class="form-control" type="datetime-local" name="data_entrada" required 
                        value="<?= htmlspecialchars($reserva->getDataEntrada()->format('Y-m-d\TH:i')) ?>">
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">
                            Data de saída
                        </label>

                        <input class="form-control" type="datetime-local" name="data_saida" required 
                        value="<?= htmlspecialchars($reserva->getDataSaida()->format('Y-m-d\TH:i')) ?>">
                    </div>

                    <div class="col-md-4">
                        <label class="form-label">
                            Quantidade de hóspedes
                        </label>

                        <input class="form-control" type="number" min="1" name="quantidade_hospedes" required
                            value="<?= htmlspecialchars($reserva->getQuantidade()) ?>">
                    </div>

                    <div class="col-md-4">
                        <label class="form-label">
                            Status
                        </label>

                        <select class="form-select" name="status">

                            <option value="Reservada" <?= $reserva->getStatus() === 'Reservada' ? 'selected' : '' ?>>
                                Reservada
                            </option>

                            <option value="Hospedado" <?= $reserva->getStatus() === 'Hospedado' ? 'selected' : '' ?>>
                                Hospedado
                            </option>

                            <option value="Finalizada" <?= $reserva->getStatus() === 'Finalizada' ? 'selected' : '' ?>>
                                Finalizada
                            </option>

                            <option value="Cancelada" <?= $reserva->getStatus() === 'Cancelada' ? 'selected' : '' ?>>
                                Cancelada
                            </option>

                        </select>
                    </div>

                    <div class="col-12">
                        <label class="form-label">
                            Observação
                        </label>

                        <textarea class="form-control" name="observacao"
                            rows="3">
                            <?= htmlspecialchars($reserva->getObservacao()) ?>
                        </textarea>
                    </div>

                </div>

                <button class="btn btn-gold mt-4">
                    Atualizar reserva
                </button>

            </form>
        </div>

    </main>
    <footer class="container pb-4 text-center">
        Base de front-end para o exercício de PHP + PostgreSQL + PDO
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>