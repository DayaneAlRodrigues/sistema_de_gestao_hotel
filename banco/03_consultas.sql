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

ORDER BY reservas.data_entrada;
