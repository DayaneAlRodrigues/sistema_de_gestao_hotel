# sistema_de_gestao_hotel
Sistema de gestão de hotel para praticar o backend com 
O front-end foi fornecido pela professora e desenvolvi: a modelagem do banco, criação dos scripts sql e o back end.

## 📁 Estrutura do Projeto

```text
hotel-pousada/
│
├── README.md
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
│       │
│       └── css/
│           └── style.css
│
└── index.php
