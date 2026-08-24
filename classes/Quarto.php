<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

class Quarto
{
    private int $numero;
    private int $capacidade;
    private float $valorDiaria;
    private string $status;
    private string $tipoId;

    public function __construct(
        int $numero,
        int $capacidade,
        float $valorDiaria,
        string $status,
        string $tipoId
    ) {
        $this->numero = $numero;
        $this->capacidade = $capacidade;
        $this->valorDiaria = $valorDiaria;
        $this->status = $status;
        $this->tipoId = $tipoId;
    }
    public function geNumero(): int
    {
        return $this->numero;
    }
    public function getCapacidade(): int
    {
        return $this->capacidade;
    }
    public function getValorDiaria(): float
    {
        return $this->valorDiaria;
    }
    public function getStatus(): string
    {
        return $this->status;
    }
    public function getTipoId(): int
    {
        return $this->tipoId;
    }
    public function cadastrar(PDO $pdo): bool
    {
        try {
            $pdo->beginTransaction();
            //verificar qual o id do tipo de quarto corresponde a string 
            $sqlTipo = "SELECT id_tipo_de_quarto
                        FROM tipos_de_quartos
                        WHERE nome=:nome";
            $stmtTipo = $pdo->prepare($sqlTipo);
            $stmtTipo->execute([
                ':nome' => $this->tipoId
            ]);

            $idTipo = $stmtTipo->fetchColumn();

            $sqlQuarto = "INSERT INTO quartos (id_quarto,capacidade, valor_diaria, status, tipo_id)
                    VALUES (:numero,:capacidade, :valor_diaria, :status, :tipo_id)";
            $stmt = $pdo->prepare($sqlQuarto);
            $stmt->execute([
                ':numero' => $this->numero,
                ':capacidade' => $this->capacidade,
                ':valor_diaria' => $this->valorDiaria,
                ':status' => $this->status,
                ':tipo_id' => $idTipo
            ]);

            $pdo->commit();
            return true;

        } catch (PDOException $e) {
            $pdo->rollBack();
            var_dump($e->errorInfo);
        }
    }

    public static function listar(PDO $pdo): array
    {
        try {
            $sql = "SELECT 
                        q.id_quarto AS numero, 
                        t.nome AS tipo,
                        q.capacidade, 
                        q.valor_diaria, 
                        q.status
                    FROM quartos AS q
                    
                    LEFT JOIN tipos_de_quartos AS t
                    ON t.id_tipo_de_quarto = q.tipo_id;";
            $stmt = $pdo->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            die("Erro parar buscar quartos." . $e->getMessage());

        }
    }

}

?>