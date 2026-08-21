<?php
class Hospede {
    private string $cpf;​
​    private string $nome;​
​    private string $telefone;​
​    private string $email;​

    public function __construct(string $cpf, string $nome, 
    string $telefone, string $email){
        $this->cpf = $cpf;
        $this->nome = $nome;
        $this->telefone = $telefone;
        $this->email = $email;
    }
    public function cadastrar(PDO $pdo): bool​{
        
        try{
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
                ":telefone"=> $this->telefone,
                ":cpf"=>$this->cpf
                ]);
            $pdo->commit();
            return true;
        }catch(PDOException $e){    
            $pdo->rollBack();
            return false;
        }
    }

    /*public static function listar(PDO $pdo): array​
    public static function buscarPorId(PDO $pdo, int $id): ?Hospede​
    public function atualizar(PDO $pdo): bool​
    public function excluir(PDO $pdo): bool*/
    }
?>