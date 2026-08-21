# sistema_de_gestao_hotel
Sistema de gestão de hotel para praticar o backend com php

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
│   ├── TipoQuarto.php
│   ├── Servico.php
│   ├── Reserva.php
│   └── Pagamento.php
│
├── hospedes/
│   ├── index.php
│   ├── salvar.php
│   ├── editar.php
│   ├── atualizar.php
│   └── excluir.php
│
├── quartos/
│   ├── index.php
│   ├── salvar.php
│   ├── editar.php
│   ├── atualizar.php
│   └── excluir.php
│
├── tipos-quartos/
│   ├── index.php
│   ├── salvar.php
│   ├── editar.php
│   ├── atualizar.php
│   └── excluir.php
│
├── servicos/
│   ├── index.php
│   ├── salvar.php
│   ├── editar.php
│   ├── atualizar.php
│   └── excluir.php
│
├── reservas/
│   ├── index.php
│   ├── salvar.php
│   ├── editar.php
│   ├── atualizar.php
│   └── excluir.php
│
├── pagamentos/
│   ├── index.php
│   ├── salvar.php
│   ├── editar.php
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
