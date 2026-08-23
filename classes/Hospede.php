<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
class Hospede
{
    private string $cpf;
    private string $nome;
    private string $telefone;
    private string $email;

    public function __construct(
        string $cpf,
        string $nome,
        string $telefone,
        string $email
    ) {
        $this->cpf = $cpf;
        $this->nome = $nome;
        $this->telefone = $telefone;
        $this->email = $email;
    }
    public function getCpf(): string
    {
        return $this->cpf;
    }
    public function getNome(): string
    {
        return $this->nome;
    }
    public function getTelefone(): string
    {
        return $this->telefone;
    }
    public function getEmail(): string
    {
        return $this->email;
    }
    public function cadastrar(PDO $pdo): bool​
    {

        try {
            $pdo->beginTransaction();
            $sqlHospedes = "INSERT INTO hospedes (cpf,nome,email)
                VALUES (:cpf, :nome, :email);";

            $stmt = $pdo->prepare($sqlHospedes);
            $stmt->execute([
                ':cpf' => $this->cpf,
                ':nome' => $this->nome,
                ':email' => $this->email
            ]);

            $sqlTelefone = "INSERT INTO telefones (numero, hospede_cpf)
                VALUES (:telefone, :cpf);";
            $stmtTel = $pdo->prepare($sqlTelefone);
            $stmtTel->execute([
                ":telefone" => $this->telefone,
                ":cpf" => $this->cpf
            ]);
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
                        h.cpf, 
                        h.nome, 
                        t.numero,
                        h.email 
                    FROM hospedes AS h
        
                    LEFT JOIN telefones AS t
                    ON t.hospede_cpf = h.cpf
        
                    ORDER BY h.nome ASC";
            $stmt = $pdo->query($sql);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            die("Erro parar buscar dados de hospedes." . $e->getMessage());
        }
    }

    public static function buscarPorCpf(PDO $pdo, string $cpf): ?Hospede
    {
        try {
            $sql = "SELECT
                    h.cpf,
                    h.nome,
                    t.numero,
                    h.email
                FROM hospedes AS h
                LEFT JOIN telefones AS t
                    ON t.hospede_cpf = h.cpf
                WHERE h.cpf = :cpf";

            $stmt = $pdo->prepare($sql);

            $stmt->execute([
                ':cpf' => $cpf
            ]);

            $dados = $stmt->fetch(PDO::FETCH_ASSOC);

            if (!$dados) {
                return null;
            }

            return new Hospede(
                $dados['cpf'],
                $dados['nome'],
                $dados['numero'] ?? '',
                $dados['email']
            );

        } catch (PDOException $e) {
            die("Erro ao buscar hospede. " . $e->getMessage());
        }
    }

    public function atualizar(PDO $pdo): bool
    {
        try {
            $pdo->beginTransaction();

            $sqlHospede = "UPDATE hospedes
                       SET nome = :nome,
                           email = :email
                       WHERE cpf = :cpf";

            $stmt = $pdo->prepare($sqlHospede);

            $stmt->execute([
                ':nome' => $this->nome,
                ':email' => $this->email,
                ':cpf' => $this->cpf
            ]);

            $sqlTelefone = "UPDATE telefones
                        SET numero = :telefone
                        WHERE hospede_cpf = :cpf";

            $stmtTel = $pdo->prepare($sqlTelefone);

            $stmtTel->execute([
                ':telefone' => $this->telefone,
                ':cpf' => $this->cpf
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

            // Verifica se existem reservas para o hóspede
            $sqlReserva = "SELECT COUNT(*)
                       FROM reservas
                       WHERE hospede_cpf = :cpf";

            $stmtReserva = $pdo->prepare($sqlReserva);

            $stmtReserva->execute([
                ':cpf' => $this->cpf
            ]);

            $quantidadeReservas = $stmtReserva->fetchColumn();

            if ($quantidadeReservas > 0) {
                $pdo->rollBack();
                echo "Hóspede possui reservas, não é possível excluir-lo. <br>";
                return false;
            }

            $sqlTelefone = "DELETE FROM telefones
                        WHERE hospede_cpf = :cpf";

            $stmtTelefone = $pdo->prepare($sqlTelefone);

            $stmtTelefone->execute([
                ':cpf' => $this->cpf
            ]);

            $sqlHospede = "DELETE FROM hospedes
                       WHERE cpf = :cpf";

            $stmtHospede = $pdo->prepare($sqlHospede);

            $stmtHospede->execute([
                ':cpf' => $this->cpf
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