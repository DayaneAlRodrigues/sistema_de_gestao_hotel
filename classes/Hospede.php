<?php
require_once '../config/Database.php';
$sql = "SELECT cpf, nome, email FROM hospedes";

$stmt = $pdo->query($sql);

$hospedes = $stmt->fetchAll(PDO::FETCH_ASSOC);

foreach ($hospedes as $hospede) {
    echo $hospede['nome'] . "<br>";
}
?>