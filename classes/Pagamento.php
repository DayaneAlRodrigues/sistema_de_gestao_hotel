<?php
class Pagamento {
    private int $idPagamento;
    private float $valor;
    private DateTime $data;
    private string $formaPagamento;
    private string $situacao;
    private int $reservaId;

    public function __construct(
        float $valor,
        DateTime $data,
        string $formaPagamento,
        string $situacao,
        int $reservaId) {
            $this->valor = $valor;
            $this->data = $data;
            $this->formaPagamento = $formaPagamento;
            $this->situacao = $situacao;
            $this->reservaId = $reservaId;
        }

        public function getIdPagamento(): int {
            return $this->idPagamento;
        }
        public function getValor():float{
            return $this->valor;
        }
        public function getData(): DateTime {
            return $this->data;
        }
        public function getForPagamento(): string {
            return $this->formaPagamento;
        }
        public function getsituacao(): string {
            return $this->situacao;
        }
        public function getreservaId(): int {
            return $this->reservaId;
        }
        public function setIdPagamento(int $idPagamento): void {
            $this->idPagamento = $idPagamento;
        }
        
}
?>