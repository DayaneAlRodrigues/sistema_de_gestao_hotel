# 🏨 Sistema de Gestão de Hotel

Sistema de gestão de hotel desenvolvido como projeto acadêmico com foco em **desenvolvimento backend**, **Programação Orientada a Objetos**, **PHP**, **PostgreSQL** e **PDO**.

O projeto permite gerenciar hóspedes, quartos, reservas e serviços, utilizando operações de **CRUD**, consultas SQL, relacionamentos entre tabelas e integração entre aplicação PHP e banco de dados PostgreSQL.

> **Nota:** O frontend base foi fornecido pela professora. O desenvolvimento realizado neste projeto contempla principalmente a **modelagem do banco de dados, scripts SQL e implementação do backend em PHP**.

---

## 🚀 Tecnologias utilizadas

* **PHP**
* **PostgreSQL**
* **PDO**
* **SQL**
* **Programação Orientada a Objetos (POO)**
* **HTML5**
* **CSS3**
* **Bootstrap**
* **Git**

---

## 🎯 Objetivos do projeto

Este projeto foi desenvolvido com o objetivo de praticar conceitos importantes do desenvolvimento backend, incluindo:

* Modelagem de banco de dados relacional
* Criação e relacionamento de tabelas
* Chaves primárias e estrangeiras
* Consultas SQL
* Operações CRUD
* Utilização de PDO para acesso ao banco
* Programação Orientada a Objetos em PHP
* Organização do código em classes
* Validação e tratamento de dados
* Utilização de `JOIN`, `COUNT`, `INSERT`, `UPDATE` e `DELETE`
* Manipulação de datas com `DateTime`
* Integração entre frontend e backend

---

## 📌 Funcionalidades

### 👤 Hóspedes

* Cadastro de hóspedes
* Listagem de hóspedes
* Edição de dados
* Exclusão de hóspedes
* Cadastro e relacionamento de telefones

### 🛏️ Quartos

* Cadastro de quartos
* Listagem de quartos
* Edição de quartos
* Exclusão de quartos
* Associação com tipos de quarto

### 📅 Reservas

* Cadastro de reservas
* Listagem de reservas
* Edição de reservas
* Exclusão de reservas
* Associação entre hóspedes e quartos
* Controle de data de entrada e saída
* Controle de quantidade de hóspedes
* Controle de status da reserva

### 🛎️ Serviços

* Cadastro de serviços
* Listagem de serviços
* Edição de serviços
* Exclusão de serviços
* Associação de serviços às reservas

### 💳 Pagamentos

Estrutura preparada para gerenciamento dos pagamentos relacionados às reservas.

---

## 🗄️ Banco de Dados

O banco de dados foi modelado para representar os principais relacionamentos de um sistema de gestão hoteleira.

Entre as entidades utilizadas estão:

* `hospedes`
* `telefones`
* `tipos_de_quartos`
* `quartos`
* `reservas`
* `servicos`
* `servicos_reservas`
* `pagamentos`

O projeto utiliza **chaves primárias, chaves estrangeiras e relacionamentos entre as entidades**, garantindo a integridade dos dados.

O modelo entidade-relacionamento está disponível em:

```text
modelo/er.pdf
```

---

## 🏗️ Arquitetura e organização

O backend foi organizado separando as responsabilidades entre configuração do banco, classes de domínio e operações de cada recurso.

```text
sistema_de_gestao_hotel/
│
├── banco/
│   ├── 01_criacao.sql
│   ├── 02_dados.sql
│   └── 03_consultas.sql
│
├── modelo/
│   └── er.pdf
│
├── config/
│   └── Database.php
│
├── classes/
│   ├── Hospede.php
│   ├── Quarto.php
│   ├── Servico.php
│   ├── Reserva.php
│   └── Pagamento.php
│
├── hospedes/
│   ├── salvar.php
│   ├── atualizar.php
│   └── excluir.php
│
├── quartos/
│   ├── salvar.php
│   ├── atualizar.php
│   └── excluir.php
│
├── servicos/
│   ├── salvar.php
│   ├── atualizar.php
│   └── excluir.php
│
├── reservas/
│   ├── salvar.php
│   ├── atualizar.php
│   └── excluir.php
│
├── front_end_base/
│   └── front_hotel_base/
│       ├── hospede.php
│       ├── index.php
│       ├── quartos.php
│       ├── reservas.php
│       ├── servicos.php
│       └── css/
│           └── style.css
│
└── index.php
```

---

## 🔧 Backend

O backend foi desenvolvido utilizando **PHP com Programação Orientada a Objetos**.

As principais entidades possuem classes próprias:

```text
classes/
├── Hospede.php
├── Quarto.php
├── Servico.php
├── Reserva.php
└── Pagamento.php
```

As classes concentram regras e operações relacionadas às respectivas entidades, incluindo métodos para:

* Cadastrar
* Buscar
* Listar
* Atualizar
* Excluir

O acesso ao banco é realizado utilizando **PDO**, com consultas parametrizadas para evitar a inserção direta de dados nas queries SQL.

Exemplo:

```php
$stmt = $pdo->prepare(
    "SELECT * FROM hospedes WHERE cpf = :cpf"
);

$stmt->execute([
    ':cpf' => $cpf
]);
```

---

## 🗃️ Scripts SQL

Os scripts do banco estão organizados na pasta `banco/`:

### `01_criacao.sql`

Responsável pela criação das tabelas, relacionamentos, chaves primárias e estrangeiras.

### `02_dados.sql`

Contém dados utilizados para popular o banco durante o desenvolvimento e testes.

### `03_consultas.sql`

Contém consultas SQL utilizadas para testar e obter informações do sistema, incluindo consultas com `JOIN`, filtros, agrupamentos e agregações.

---

## 🔐 Boas práticas utilizadas

Durante o desenvolvimento foram aplicados alguns conceitos importantes para um backend mais organizado:

* PDO para conexão com PostgreSQL
* Prepared Statements
* Separação entre acesso ao banco e apresentação
* Programação Orientada a Objetos
* Tipagem de parâmetros e retornos em PHP
* Uso de `DateTime` para manipulação de datas
* Uso de chaves estrangeiras para garantir integridade referencial
* Tratamento de exceções
* Organização das operações CRUD por entidade

---

## ▶️ Como executar o projeto

### 1. Clone o repositório

```bash
git clone https://github.com/SEU-USUARIO/sistema_de_gestao_hotel.git
```

### 2. Configure o PostgreSQL

Crie um banco de dados PostgreSQL para o projeto.

Exemplo:

```sql
CREATE DATABASE hotel_db;
```

### 3. Execute os scripts SQL

Execute os arquivos na seguinte ordem:

```text
01_criacao.sql
02_dados.sql
03_consultas.sql
```

### 4. Configure a conexão

Ajuste as informações de conexão no arquivo:

```text
config/Database.php
```

Exemplo:

```text
DB_HOST=localhost
DB_PORT=5432
DB_NAME=hotel_db
DB_USER=postgres
DB_PASSWORD=sua_senha
```

> Não versione informações sensíveis, como senhas e credenciais de banco de dados.

### 5. Execute o projeto

Caso esteja utilizando XAMPP, coloque o projeto dentro do diretório:

```text
htdocs/
```

Depois acesse pelo navegador:

```text
http://localhost/sistema_de_gestao_hotel/
```

---

## 📚 Aprendizados

Este projeto contribuiu para a prática de conceitos fundamentais de desenvolvimento backend, principalmente:

* Desenvolvimento de aplicações PHP
* POO
* PostgreSQL
* SQL
* PDO
* CRUD
* Modelagem de dados
* Relacionamentos entre entidades
* Integridade referencial
* Tratamento de erros
* Organização de projetos backend

Também serviu como exercício prático para compreender o fluxo completo:

```text
Frontend
   ↓
PHP
   ↓
Classes / Regras
   ↓
PDO
   ↓
PostgreSQL
   ↓
Dados
```

---

## 👩‍💻 Sobre o desenvolvimento

Projeto desenvolvido como atividade acadêmica com foco no aprendizado e prática de **desenvolvimento backend**.

O frontend base foi disponibilizado pela professora, enquanto a parte de **modelagem do banco de dados, criação dos scripts SQL e desenvolvimento do backend em PHP** foi implementada durante o desenvolvimento do projeto.

---

## 📈 Próximos passos

Possíveis melhorias planejadas para evolução do projeto:

* Implementação de autenticação e autorização
* Validações mais completas dos dados
* Criação de uma API REST
* Implementação de testes automatizados
* Melhor tratamento e registro de exceções
* Dashboard com indicadores e relatórios
* Melhorias na arquitetura do backend
* Dockerização da aplicação

---

## 📄 Licença

Projeto desenvolvido para fins acadêmicos e de estudo.
