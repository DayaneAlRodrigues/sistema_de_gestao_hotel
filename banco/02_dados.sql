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

INSERT INTO telefones (numero, hospede_cpf) VALUES
    ('51987654321', '00012320900'),
    ('51991234567', '12345678901'),
    ('51982345678', '23456789012'),
    ('51993456789', '34567890123'),
    ('51984567890', '45678901234'),
    ('51995678901', '56789012345'),
    ('51986789012', '67890123456'),
    ('51997890123', '78901234567'),
    ('51988901234', '89012345678'),
    ('51999012345', '90123456789'),
    ('51980123456', '01234567890');

INSERT INTO tipos_de_quartos (nome,descricao) VALUES
    ('Individual', 'Quarto destinado para uma pessoa com uma cama de solteiro.'),
    ('Duplo', 'Quarto com duas camas de solteiro ou uma de casal.'),
    ('Triplo', 'Quarto com 3 camas de solteiro ou, uma de casal e uma de solteiro'),
    ('Suite',  'Quarto duplo com suite integrada');

INSERT INTO quartos (capacidade, valor_diaria, status, tipo_id) VALUES

    (1, 70.00, 'Disponível',
        (SELECT id_tipo_de_quarto FROM tipos_de_quartos WHERE nome = 'Individual')),

    (1, 70.00, 'Ocupado',
        (SELECT id_tipo_de_quarto FROM tipos_de_quartos WHERE nome = 'Individual')),

    (1, 70.00, 'Manutenção',
        (SELECT id_tipo_de_quarto FROM tipos_de_quartos WHERE nome = 'Individual')),

    (2, 110.00, 'Disponível',
        (SELECT id_tipo_de_quarto FROM tipos_de_quartos WHERE nome = 'Duplo')),

    (2, 110.00, 'Ocupado',
        (SELECT id_tipo_de_quarto FROM tipos_de_quartos WHERE nome = 'Duplo')),

    (2, 110.00, 'Manutenção',
        (SELECT id_tipo_de_quarto FROM tipos_de_quartos WHERE nome = 'Duplo')),

    (3, 130.00, 'Disponível',
        (SELECT id_tipo_de_quarto FROM tipos_de_quartos WHERE nome = 'Triplo')),

    (3, 130.00, 'Ocupado',
        (SELECT id_tipo_de_quarto FROM tipos_de_quartos WHERE nome = 'Triplo')),

    (2, 150.00, 'Disponível',
        (SELECT id_tipo_de_quarto FROM tipos_de_quartos WHERE nome = 'Suite')),

    (2, 150.00, 'Manutenção',
        (SELECT id_tipo_de_quarto FROM tipos_de_quartos WHERE nome = 'Suite'));

INSERT INTO reservas 
(data_entrada, data_saida, quantidade_hospedes, status, observacao, hospede_cpf, quarto_id) 
VALUES

    -- Reserva 1 - Duplo
    (now() - INTERVAL '5 days', now() - INTERVAL '2 days', 2, 'Finalizada',
    'Hospedagem de final de semana', '00012320900',
    (
        SELECT q.id_quarto
        FROM quartos q
        JOIN tipos_de_quartos t 
            ON t.id_tipo_de_quarto = q.tipo_id
        WHERE t.nome = 'Duplo'
        AND q.status = 'Ocupado'
    )),

    -- Reserva 2 - Individual
    (now() - INTERVAL '3 days', now() - INTERVAL '1 day', 1, 'Finalizada',
    'Viagem a trabalho', '12345678901',
    (
        SELECT q.id_quarto
        FROM quartos q
        JOIN tipos_de_quartos t 
            ON t.id_tipo_de_quarto = q.tipo_id
        WHERE t.nome = 'Individual'
        AND q.status = 'Ocupado'
    )),

    -- Reserva 3 - Duplo
    (now() - INTERVAL '1 day', now() + INTERVAL '2 days', 2, 'Hospedado',
    'Hospedagem com café da manhã', '23456789012',
    (
        SELECT q.id_quarto
        FROM quartos q
        JOIN tipos_de_quartos t 
            ON t.id_tipo_de_quarto = q.tipo_id
        WHERE t.nome = 'Duplo'
        AND q.status = 'Disponível'
    )),

    -- Reserva 4 - Triplo
    (now() - INTERVAL '2 days', now() + INTERVAL '1 day', 3, 'Hospedado',
    'Família em viagem', '34567890123',
    (
        SELECT q.id_quarto
        FROM quartos q
        JOIN tipos_de_quartos t 
            ON t.id_tipo_de_quarto = q.tipo_id
        WHERE t.nome = 'Triplo'
        AND q.status = 'Ocupado'
    )),

    -- Reserva 5 - Individual
    (now() + INTERVAL '1 day', now() + INTERVAL '4 days', 1, 'Reservada',
    'Reserva para viagem de trabalho', '45678901234',
    (
        SELECT q.id_quarto
        FROM quartos q
        JOIN tipos_de_quartos t 
            ON t.id_tipo_de_quarto = q.tipo_id
        WHERE t.nome = 'Individual'
        AND q.status = 'Disponível'
    )),

    -- Reserva 6 - Duplo
    (now() + INTERVAL '2 days', now() + INTERVAL '5 days', 2, 'Reservada',
    'Hospedagem de férias', '56789012345',
    (
        SELECT q.id_quarto
        FROM quartos q
        JOIN tipos_de_quartos t 
            ON t.id_tipo_de_quarto = q.tipo_id
        WHERE t.nome = 'Duplo'
        AND q.status = 'Manutenção'
    )),

    -- Reserva 7 - Suite
    (now() + INTERVAL '5 days', now() + INTERVAL '8 days', 2, 'Reservada',
    'Viagem em família', '67890123456',
    (
        SELECT q.id_quarto
        FROM quartos q
        JOIN tipos_de_quartos t 
            ON t.id_tipo_de_quarto = q.tipo_id
        WHERE t.nome = 'Suite'
        AND q.status = 'Disponível'
    )),

    -- Reserva 8 - Triplo
    (now() - INTERVAL '10 days', now() - INTERVAL '7 days', 2, 'Finalizada',
    'Estadia de três dias', '78901234567',
    (
        SELECT q.id_quarto
        FROM quartos q
        JOIN tipos_de_quartos t 
            ON t.id_tipo_de_quarto = q.tipo_id
        WHERE t.nome = 'Triplo'
        AND q.status = 'Disponível'
    )),

    -- Reserva 9 - Individual
    (now() - INTERVAL '4 days', now() - INTERVAL '2 days', 1, 'Finalizada',
    'Hospedagem individual', '89012345678',
    (
        SELECT q.id_quarto
        FROM quartos q
        JOIN tipos_de_quartos t 
            ON t.id_tipo_de_quarto = q.tipo_id
        WHERE t.nome = 'Individual'
        AND q.status = 'Manutenção'
    )),

    -- Reserva 10 - Triplo
    (now() + INTERVAL '7 days', now() + INTERVAL '10 days', 3, 'Reservada',
    'Reserva para evento', '90123456789',
    (
        SELECT q.id_quarto
        FROM quartos q
        JOIN tipos_de_quartos t 
            ON t.id_tipo_de_quarto = q.tipo_id
        WHERE t.nome = 'Triplo'
        AND q.status = 'Ocupado'
    )),

    -- Reserva 11 - Duplo
    (now() + INTERVAL '3 days', now() + INTERVAL '6 days', 2, 'Cancelada',
    'Reserva cancelada pelo hóspede', '01234567890',
    (
        SELECT q.id_quarto
        FROM quartos q
        JOIN tipos_de_quartos t 
            ON t.id_tipo_de_quarto = q.tipo_id
        WHERE t.nome = 'Duplo'
        AND q.status = 'Disponível'
    )),

    -- Reserva 12 - Individual
    (now() - INTERVAL '2 days', now() + INTERVAL '1 day', 1, 'Hospedado',
    'Hóspede em viagem de negócios', '00012320900',
    (
        SELECT q.id_quarto
        FROM quartos q
        JOIN tipos_de_quartos t 
            ON t.id_tipo_de_quarto = q.tipo_id
        WHERE t.nome = 'Individual'
        AND q.status = 'Disponível'
    )),

    -- Reserva 13 - Suite
    (now() + INTERVAL '10 days', now() + INTERVAL '13 days', 2, 'Reservada',
    'Reserva de férias', '34567890123',
    (
        SELECT q.id_quarto
        FROM quartos q
        JOIN tipos_de_quartos t 
            ON t.id_tipo_de_quarto = q.tipo_id
        WHERE t.nome = 'Suite'
        AND q.status = 'Manutenção'
    )),

    -- Reserva 14 - Triplo
    (now() - INTERVAL '8 days', now() - INTERVAL '5 days', 3, 'Finalizada',
    'Hospedagem em grupo', '45678901234',
    (
        SELECT q.id_quarto
        FROM quartos q
        JOIN tipos_de_quartos t 
            ON t.id_tipo_de_quarto = q.tipo_id
        WHERE t.nome = 'Triplo'
        AND q.status = 'Ocupado'
    )),

    -- Reserva 15 - Individual
    (now() + INTERVAL '15 days', now() + INTERVAL '18 days', 1, 'Cancelada',
    'Cancelamento solicitado pelo cliente', '00012320900',
    (
        SELECT q.id_quarto
        FROM quartos q
        JOIN tipos_de_quartos t 
            ON t.id_tipo_de_quarto = q.tipo_id
        WHERE t.nome = 'Individual'
        AND q.status = 'Ocupado'
    ));

INSERT INTO servicos (nome, descricao, preco, situacao) VALUES
    ('Café da Manhã', 'Café da manhã completo servido das 07:00 às 10:00.', 35.00, true),
    ('Estacionamento', 'Vaga de estacionamento privativa para hóspedes.', 25.00, true),
    ('Lavanderia', 'Serviço de lavagem e secagem de roupas dos hóspedes.', 40.00, true),
    ('Traslado Aeroporto', 'Transporte entre o hotel e o aeroporto mediante agendamento.', 80.00, true),
    ('Passeio Turístico', 'Passeio turístico pela cidade com guia especializado.', 120.00, false),
    ('Serviço de Quarto', 'Serviço de alimentação e bebidas diretamente no quarto.', 15.00, true);

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