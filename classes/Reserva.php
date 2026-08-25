<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
class Reserva
{
    private ?int $idReserva = null;
    private DateTime $dataEntrada;
    private DateTime $dataSaida;
    
    private int $quantidade;
    private string $status;
    private string $observacao;
    private string $hospedeCpf;
    private int $quartoId;
    private string $hospedeNome;

    public function __construct(
        DateTime $dataEntrada,
        DateTime $dataSaida,
        int $quantidade,
        string $status,
        string $observacao,
        string $hospedeCpf,
        int $quartoId
    ) {
        $this->dataEntrada = $dataEntrada;
        $this->dataSaida = $dataSaida;
        $this->quantidade = $quantidade;
        $this->status = $status;
        $this->observacao = $observacao;
        $this->hospedeCpf = $hospedeCpf;
        $this->quartoId = $quartoId;
    }
    public function getIdReserva(): int
    {
        return $this->idReserva;
    }
    public function getDataEntrada(): DateTime
    {
        return $this->dataEntrada;
    }
    public function getDataSaida(): DateTime
    {
        return $this->dataSaida;
    }
    public function getQuantidade(): int
    {
        return $this->quantidade;
    }
    public function getStatus(): string
    {
        return $this->status;
    }
    public function getObservacao(): string{
        return $this->observacao;
    }
    public function gethospedeCpf(): string{
        return $this->hospedeCpf;
    }
    public function getquartoId(): int{
        return $this->quartoId;
    }

    public function getHospedeNome():string{
        return $this->hospedeNome;
    }
    public function setIdReserva(int $idReserva): void
    {
        $this->idReserva = $idReserva;
    }

    public function setHospedeNome(string $hospedeNome): void{
        $this->hospedeNome = $hospedeNome;
    }
    public function cadastrar(PDO $pdo): bool
    {

        try {
            $pdo->beginTransaction();
            $sql = "INSERT INTO reservas
                (data_entrada, data_saida, quantidade_hospedes,
                 status, observacao, hospede_cpf, quarto_id)
                VALUES(:dataEntrada, :dataSaida,:quantidade, :status,
                :observacao,:hospede_cpf,:quarto_id)
                RETURNING id_reserva;";

            $stmt = $pdo->prepare($sql);
            $stmt->execute([
                ':dataEntrada' => $this->dataEntrada->format('Y-m-d H:i:s'),
                ':dataSaida'   => $this->dataSaida->format('Y-m-d H:i:s'),
                ':quantidade' => $this->quantidade,
                ':status' => $this->status,
                ':observacao'=>$this->observacao,
                ':hospede_cpf'=> $this->hospedeCpf,
                ':quarto_id'=>$this->quartoId
            ]);
            $this->idReserva = (int) $stmt->fetchColumn();
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
                    r.id_reserva,
                    r.data_entrada,
                    r.data_saida,
                    r.quantidade_hospedes,
                    r.status,
                    r.observacao,
                    r.hospede_cpf,
                    r.quarto_id,
                    h.nome AS hospede_nome,
                    q.id_quarto AS quarto_numero
                FROM reservas AS r

                INNER JOIN hospedes AS h
                    ON h.cpf = r.hospede_cpf

                INNER JOIN quartos AS q
                    ON q.id_quarto = r.quarto_id

                ORDER BY r.data_entrada ASC";

        $stmt = $pdo->query($sql);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);

    } catch (PDOException $e) {
        die("Erro ao buscar dados das reservas: " . $e->getMessage());
    }
}
    public static function buscarPorId(PDO $pdo, string $id): ?Reserva
    {
        try {
            $sql = "SELECT 
                    r.id_reserva,
                    r.data_entrada,
                    r.data_saida,
                    r.quantidade_hospedes,
                    r.status,
                    r.observacao,
                    r.hospede_cpf,
                    r.quarto_id,
                    h.nome AS hospede_nome,
                    q.id_quarto AS quarto_numero
                FROM reservas AS r

                INNER JOIN hospedes AS h
                    ON h.cpf = r.hospede_cpf

                INNER JOIN quartos AS q
                    ON q.id_quarto = r.quarto_id

                WHERE r.id_reserva = :id

                ORDER BY r.data_entrada ASC";
                    

            $stmt = $pdo->prepare($sql);

            $stmt->execute([
                ':id' => $id
            ]);

            $dados = $stmt->fetch(PDO::FETCH_ASSOC);

            if (!$dados) {
                return null;
            }

            $reserva = new Reserva(
                new DateTime($dados['data_entrada']),
                new DateTime($dados['data_saida']),
                $dados['quantidade_hospedes'],
                $dados['status'],
                $dados['observacao'],
                $dados['hospede_cpf'],
                $dados['quarto_id']
            );

            $reserva->setIdReserva($dados['id_reserva']);
            $reserva->setHospedeNome($dados['hospede_nome']);
            return $reserva;

        } catch (PDOException $e) {
            die("Erro ao buscar reserva. " . $e->getMessage());
        }
    }

    public function atualizar(PDO $pdo): bool
    {
        try {
            $pdo->beginTransaction();

            $sql= "UPDATE reservas
                    SET data_entrada=:data_entrada, 
                        data_saida=:data_saida, 
                        quantidade_hospedes=:quantidade, 
                        status=:status, 
                        observacao=:observacao, 
                        hospede_cpf=:hospede, 
                        quarto_id=:quarto
                    WHERE id_reserva=:id_reserva;";

            $stmt = $pdo->prepare($sql);

            $stmt->execute([
                ':data_entrada' => $this->dataEntrada->format('Y-m-d H:i:s'),
                ':data_saida' => $this->dataSaida->format('Y-m-d H:i:s'),
                ':quantidade' => $this->quantidade,
                ':status' => $this->status,
                ':observacao' => $this->observacao,
                ':hospede'=> $this->hospedeCpf,
                ':quarto'=>$this->quartoId,
                ':id_reserva'=> $this->idReserva
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

            $sql = "DELETE FROM reservas
                    WHERE id_reserva= :id";

            $stmt = $pdo->prepare($sql);

            $stmt->execute([
                ':id' => $this->idReserva
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