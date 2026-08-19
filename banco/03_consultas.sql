--Reservas por período
--Apresentar hóspede, quarto, tipo do quarto, entrada, saída e status, permitindo filtrar o período.

SELECT 

    hospedes.nome AS hospede,
    reservas.quarto_id AS quarto,
    tipo.nome AS tipo_do_quarto,
    reservas.data_entrada,
    reservas.data_saida,
    reservas.status    
    
FROM reservas

INNER JOIN  hospedes
ON hospedes.cpf = reservas.hospede_cpf

INNER JOIN quartos
ON quartos.id_quarto = reservas.quarto_id

INNER JOIN tipos_de_quartos AS tipo
ON tipo.id_tipo_de_quarto = quartos.tipo_id

WHERE reservas.data_entrada >= '2026-08-01'
  AND reservas.data_entrada < '2026-09-01'

ORDER BY reservas.data_entrada ASC;

--Quartos ocupados
--Apresentar os quartos ocupados em determinada data, com quarto, tipo, hóspede, entrada e saída.

SELECT 
    quartos.id_quarto AS quarto,
    tipo.nome AS tipo_do_quarto,
    hospedes.nome AS hospede,
    reservas.data_entrada,
    reservas.data_saida
FROM reservas

INNER JOIN  hospedes
ON hospedes.cpf = reservas.hospede_cpf

INNER JOIN quartos
ON quartos.id_quarto = reservas.quarto_id

INNER JOIN tipos_de_quartos AS tipo
ON tipo.id_tipo_de_quarto = quartos.tipo_id

WHERE quartos.status = 'Ocupado'
AND  reservas.data_entrada <= '2026-08-13'
AND reservas.data_saida >= '2026-08-15'

ORDER BY reservas.data_entrada ASC;

--Faturamento por tipo de quarto
--Apresentar tipo de quarto, quantidade de reservas, quantidade de diárias e faturamento, ordenando pelo maior faturamento.

SELECT 
    tipo.nome AS tipo_do_quarto,
    COUNT(reservas.id_reserva) AS quantidade_reservas,
    SUM(reservas.data_saida::date - reservas.data_entrada::date) AS quantidade_diárias,
    SUM(pagamentos.valor) AS faturamento

FROM pagamentos

INNER JOIN reservas
ON reservas.id_reserva = pagamentos.reserva_id

INNER JOIN quartos
ON quartos.id_quarto = reservas.quarto_id

INNER JOIN tipos_de_quartos AS tipo
ON tipo.id_tipo_de_quarto = quartos.tipo_id

GROUP BY tipo.nome

ORDER BY faturamento DESC;

--Serviços mais utilizados
--Apresentar serviço, quantidade de utilizações, quantidade total e valor gerado.

SELECT
    servicos.nome AS servico,
    COUNT(sr.id_servico_reserva) AS quantidade_utilizacoes,
    SUM(sr.quantidade_utilizada) AS quantidade_total,
    SUM(sr.quantidade_utilizada * servicos.preco) AS valor_gerado 

FROM servicos

INNER JOIN servicos_reservas AS sr
ON sr.servico_id = servicos.id_servico

GROUP BY servicos.id_servico,servicos.nome

ORDER BY quantidade_total DESC;

