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
AND  reservas.data_entrada <= '2026-08-12'
AND reservas.data_saida >= '2026-08-15'

ORDER BY reservas.data_entrada ASC;


    