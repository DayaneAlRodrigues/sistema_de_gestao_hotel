<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
class Servico
{
    private ?int $idServico = null;
    private string $nome;
    private string $descricao;
    private float $preco;
    private bool $situacao;

    public function __construct(
        string $nome,
        string $descricao,
        float $preco,
        bool $situacao
    ) {
        $this->nome = $nome;
        $this->descricao = $descricao;
        $this->preco = $preco;
        $this->situacao = $situacao;
    }
    public function getIdServico(): int
    {
        return $this->idServico;
    }
    public function getNome(): string
    {
        return $this->nome;
    }
    public function getDescricao(): string
    {
        return $this->descricao;
    }
    public function getPreco(): float
    {
        return $this->preco;
    }
    public function getsituacao(): bool
    {
        return $this->situacao;
    }
    public function setIdServico(int $idServico): void
    {
        $this->idServico = $idServico;
    }
    public function cadastrar(PDO $pdo): bool
    {

        try {
            $pdo->beginTransaction();
            $sqlServico = "INSERT INTO servicos (nome, descricao, preco, situacao)
                VALUES (:nome, :descricao, :preco, :situacao)
                RETURNING id_servico;";

            $stmt = $pdo->prepare($sqlServico);
            $stmt->execute([
                ':nome' => $this->nome,
                ':descricao' => $this->descricao,
                ':preco' => $this->preco,
                ':situacao' => $this->situacao
            ]);
            $this->idServico = (int) $stmt->fetchColumn();

            $pdo->commit();
            return true;
        } catch (PDOException $e) {
            $pdo->rollBack();
            return false;
        }
    }

    public static function listar(PDO $pdo): array
    {
        try {
            $sql = "SELECT 
                        id_servico, 
                        nome, 
                        descricao, 
                        preco, 
                        situacao
                    FROM servicos

                    ORDER BY nome ASC;";
            $stmt = $pdo->query($sql);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            die("Erro parar buscar dados de serviços." . $e->getMessage());
        }
    }

    public static function buscarPorId(PDO $pdo, string $id): ?Servico
    {
        try {
            $sql = "SELECT 
                        id_servico, 
                        nome, 
                        descricao, 
                        preco, 
                        situacao
                    FROM servicos
                    WHERE id_servico = :id";

            $stmt = $pdo->prepare($sql);

            $stmt->execute([
                ':id' => $id
            ]);

            $dados = $stmt->fetch(PDO::FETCH_ASSOC);

            if (!$dados) {
                return null;
            }

            $servico = new Servico(
                $dados['nome'],
                $dados['descricao'],
                $dados['preco'],
                $dados['situacao']
            );

            $servico->idServico = (int) $dados['id_servico'];
            return $servico;

        } catch (PDOException $e) {
            die("Erro ao buscar serviço. " . $e->getMessage());
        }
    }

    public function atualizar(PDO $pdo): bool
    {
        try {
            $pdo->beginTransaction();

            $sqlHospede = "UPDATE servicos
                       SET nome = :nome,
                           descricao=:descricao, 
                           preco=:preco, 
                           situacao=:situacao
                           
                       WHERE id_servico = :id_servico";

            $stmt = $pdo->prepare($sqlHospede);

            $stmt->execute([
                ':nome' => $this->nome,
                ':descricao' => $this->descricao,
                ':preco' => $this->preco,
                ':situacao' => $this->situacao,
                ':id_servico' => $this->idServico
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

    public function excluir(PDO $pdo): bool
    {
        try {

            $pdo->beginTransaction();

            // Verifica se existem reservas com servicos
            $sqlReserva = "SELECT COUNT(*)
                       FROM servicos_reservas
                       WHERE servico_id = :id";

            $stmtReserva = $pdo->prepare($sqlReserva);

            $stmtReserva->execute([
                ':id' => $this->idServico
            ]);

            $quantidadeReservas = $stmtReserva->fetchColumn();

            if ($quantidadeReservas > 0) {
                $pdo->rollBack();
                echo "Serviço possui reservas, não é possível excluir-lo. <br>";
                return false;
            }

            $sqlTelefone = "DELETE FROM servicos
                            WHERE id_servico= :id";

            $stmtTelefone = $pdo->prepare($sqlTelefone);

            $stmtTelefone->execute([
                ':id' => $this->idServico
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
    public static function contar(PDO $pdo): int
    {
        $sql = "SELECT COUNT(*) FROM servicos";

        $stmt = $pdo->query($sql);

        return (int) $stmt->fetchColumn();
    }



}

?>