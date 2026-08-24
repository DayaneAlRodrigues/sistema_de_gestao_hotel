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
    private string $tipo;

    public function __construct(
        int $numero,
        int $capacidade,
        float $valorDiaria,
        string $status,
        string $tipo
    ) {
        $this->numero = $numero;
        $this->capacidade = $capacidade;
        $this->valorDiaria = $valorDiaria;
        $this->status = $status;
        $this->tipo = $tipo;
    }
    public function getNumero(): int
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
    public function getTipo(): string
    {
        return $this->tipo;
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
                ':nome' => $this->tipo
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

    public static function buscarPorNumero(PDO $pdo, int $numero): ?Quarto
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
                    ON t.id_tipo_de_quarto = q.tipo_id
                    
                    WHERE q.id_quarto = :numero; 
                        ";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([
                ":numero" => $numero
            ]);
            $dados = $stmt->fetch(PDO::FETCH_ASSOC);

            if (!$dados) {
                return null;
            }

            return new Quarto(
                (int) $dados['numero'],
                (int) $dados['capacidade'],
                (float) $dados['valor_diaria'],
                $dados['status'],
                $dados['tipo']
            );
        } catch (PDOException $e) {
            die("Erro ao buscar quarto. " . $e->getMessage());
        }

    }

    public function atualizar(PDO $pdo): bool
    {
        try {
            $pdo->beginTransaction();
            //verificar qual o id do tipo de quarto corresponde a string 
            $sqlTipo = "SELECT id_tipo_de_quarto
                        FROM tipos_de_quartos
                        WHERE nome=:nome";
            $stmtTipo = $pdo->prepare($sqlTipo);
            $stmtTipo->execute([
                ':nome' => $this->tipo
            ]);

            $idTipo = $stmtTipo->fetchColumn();

            $sql = "UPDATE quartos
                    SET capacidade=:capacidade,
                        valor_diaria=:valor_diaria, 
                        status=:status, 
                        tipo_id=:tipo
                    WHERE id_quarto=:numero;";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([
                ":capacidade" => $this->capacidade,
                ":valor_diaria" => $this->valorDiaria,
                ":status" => $this->status,
                ":tipo" => $idTipo,
                ":numero"=> $this->numero
            ]);
            $pdo->commit();
            return true;
        } catch (PDOException $e) {
            if ($pdo->inTransaction()) {
                $pdo->rollBack();
            }

            return false;
        }

    }

}

?>