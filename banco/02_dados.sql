INSERT INTO hospedes (cpf,nome,email) VALUES
    ('00012320900','Carlos Cunha','carloscunha@gmail.com'),
    ('12345678901', 'Ana Paula Martins', 'anapaula.martins@gmail.com'),
    ('23456789012', 'Bruno Henrique Silva', 'bruno.silva@gmail.com'),
    ('34567890123', 'Camila Oliveira Souza', 'camila.souza@gmail.com'),
    ('45678901234', 'Daniel Ferreira Costa', 'daniel.costa@gmail.com'),
    ('56789012345', 'Eduarda Santos Lima', 'eduarda.lima@gmail.com'),
    ('67890123456', 'Felipe Almeida Rocha', 'felipe.rocha@gmail.com'),
    ('78901234567', 'Gabriela Rodrigues Alves', 'gabriela.alves@gmail.com'),
    ('89012345678', 'Henrique Barbosa Dias', 'henrique.dias@gmail.com'),
    ('90123456789', 'Isabela Martins Pereira', 'isabela.pereira@gmail.com'),
    ('01234567890', 'João Victor Mendes', 'joao.mendes@gmail.com');

INSERT INTO tipos_de_quartos (nome,descricao) VALUES
    ('Individual', 'Quarto destinado para uma pessoa com uma cama de solteiro.'),
    ('Duplo', 'Quarto com duas camas de solteiro ou uma de casal.'),
    ('Triplo', 'Quarto com 3 camas de solteiro ou, uma de casal e uma de solteiro'),
    ('Suite',  'Quarto duplo com suite integrada');

INSERT INTO quartos (capacidade,valor_diaria,status,tipo_id) VALUES
    (1,70.00,'Disponível',1),
    (1,70.00, 'Ocupado',1),
    (1,70.00, 'Manutenção', 1),
    (2, 110.00,'Disponível', 2),
    (2, 110.00,'Ocupado', 2),
    (2, 110.00,'Manutenção', 2),
    (3, 130.00,'Disponível', 3),
    (3, 130.00,'Ocupado', 3),
    (2,150.00,'Disponível',4),
    (2, 150.00,'Manutenção', 4);

INSERT INTO reservas (data_entrada, data_saida, quantidade_hospedes, status, observacao, hospede_cpf, quarto_id) VALUES
    (now() - INTERVAL '5 days', now() - INTERVAL '2 days', 2, 'Finalizada',
    'Hospedagem de final de semana', '00012320900', 1),

    (now() - INTERVAL '3 days', now() - INTERVAL '1 day', 1, 'Finalizada',
    'Viagem a trabalho', '12345678901', 2),

    (now() - INTERVAL '1 day', now() + INTERVAL '2 days', 2, 'Hospedado',
    'Hospedagem com café da manhã', '23456789012', 3),

    (now() - INTERVAL '2 days', now() + INTERVAL '1 day', 3, 'Hospedado',
    'Família em viagem', '34567890123', 4),

    (now() + INTERVAL '1 day', now() + INTERVAL '4 days', 1, 'Reservada',
    'Reserva para viagem de trabalho', '45678901234', 1),

    (now() + INTERVAL '2 days', now() + INTERVAL '5 days', 2, 'Reservada',
    'Hospedagem de férias', '56789012345', 2),

    (now() + INTERVAL '5 days', now() + INTERVAL '8 days', 4, 'Reservada',
    'Viagem em família', '67890123456', 4),

    (now() - INTERVAL '10 days', now() - INTERVAL '7 days', 2, 'Finalizada',
    'Estadia de três dias', '78901234567', 3),

    (now() - INTERVAL '4 days', now() - INTERVAL '2 days', 1, 'Finalizada',
    'Hospedagem individual', '89012345678', 1),

    (now() + INTERVAL '7 days', now() + INTERVAL '10 days', 3, 'Reservada',
    'Reserva para evento', '90123456789',4),

    (now() + INTERVAL '3 days', now() + INTERVAL '6 days', 2, 'Cancelada',
    'Reserva cancelada pelo hóspede', '01234567890', 3),

    (now() - INTERVAL '2 days', now() + INTERVAL '1 day', 1, 'Hospedado',
    'Hóspede em viagem de negócios', '00012320900', 2),

    (now() + INTERVAL '10 days', now() + INTERVAL '13 days', 2, 'Reservada',
    'Reserva de férias', '34567890123', 2),

    (now() - INTERVAL '8 days', now() - INTERVAL '5 days', 4, 'Finalizada',
    'Hospedagem em grupo', '45678901234', 3),

    (now() + INTERVAL '15 days', now() + INTERVAL '18 days', 1, 'Cancelada',
    'Cancelamento solicitado pelo cliente', '00012320900', 1);

INSERT INTO servicos (nome, descricao, preco, situacao) VALUES
    ('Café da Manhã', 'Café da manhã completo servido das 07:00 às 10:00.', 35.00, 'Ativo'),
    ('Estacionamento', 'Vaga de estacionamento privativa para hóspedes.', 25.00, 'Ativo'),
    ('Lavanderia', 'Serviço de lavagem e secagem de roupas dos hóspedes.', 40.00, 'Ativo'),
    ('Traslado Aeroporto', 'Transporte entre o hotel e o aeroporto mediante agendamento.', 80.00, 'Ativo'),
    ('Passeio Turístico', 'Passeio turístico pela cidade com guia especializado.', 120.00, 'Inativo'),
    ('Serviço de Quarto', 'Serviço de alimentação e bebidas diretamente no quarto.', 15.00, 'Ativo');

INSERT INTO servicos_reservas (servico_id,reserva_id,quantidade_utilizada) VALUES
    (1,3,2),
    (1,1,5),
    (2,7,5),
    (3,8,3),
    (4,9,2),
    (6,2,3),
    (5,14,1);

INSERT INTO pagamentos (valor, data, forma_pagamento, situacao, reserva_id) VALUES

    -- Reserva 1: 3 diárias x R$ 70,00 + serviços
    (245.00, now() - INTERVAL '2 days', 'Cartão de Crédito', 'Pago', 1),

    -- Reserva 2: 2 diárias x R$ 70,00 + serviço de quarto
    (170.00, now() - INTERVAL '1 day', 'PIX', 'Pago', 2),

    -- Reserva 3: 3 diárias x R$ 70,00 + café da manhã
    (245.00, now(), 'Cartão de Débito', 'Pago', 3),

    -- Reserva 4: 3 diárias x R$ 110,00
    (330.00, now(), 'PIX', 'Pago', 4),

    -- Reserva 5: reserva futura - 3 diárias x R$ 70,00
    (210.00, now(), 'Cartão de Crédito', 'Pendente', 5),

    -- Reserva 6: reserva futura - 3 diárias x R$ 70,00
    (210.00, now(), 'PIX', 'Pendente', 6),

    -- Reserva 7: reserva futura - 3 diárias x R$ 110,00 + estacionamento
    (355.00, now(), 'Cartão de Crédito', 'Pendente', 7),

    -- Reserva 8: 3 diárias x R$ 70,00 + lavanderia
    (250.00, now() - INTERVAL '5 days', 'Dinheiro', 'Pago', 8),

    -- Reserva 9: 2 diárias x R$ 70,00 + traslado
    (220.00, now() - INTERVAL '2 days', 'PIX', 'Pago', 9),

    -- Reserva 10: reserva futura - 3 diárias x R$ 110,00
    (330.00, now(), 'Cartão de Crédito', 'Pendente', 10),

    -- Reserva 11: cancelada
    (0.00, now(), 'PIX', 'Cancelado', 11),

    -- Reserva 12: 3 diárias x R$ 70,00 + serviço de quarto
    (225.00, now(), 'Cartão de Débito', 'Pago', 12),

    -- Reserva 13: reserva futura - 3 diárias x R$ 70,00
    (210.00, now(), 'PIX', 'Pendente', 13),

    -- Reserva 14: 3 diárias x R$ 130,00 + passeio turístico
    (510.00, now() - INTERVAL '5 days', 'Cartão de Crédito', 'Pago', 14),

    -- Reserva 15: cancelada
    (0.00, now(), 'Cartão de Crédito', 'Cancelado', 15);