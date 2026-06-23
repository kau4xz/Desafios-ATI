use db_cnh_social


-- Parte 1 - Consultas Básicas

-- 1. Listar todos os registros ordenados pela data de inscrição mais recente.
select * 
from tb_inscricoes_cnh_social
order by created_at desc

-- 2. Contar o total de inscrições.
select count(*) 
from tb_inscricoes_cnh_social

-- 3. Exibir quantos municípios distintos existem na base.
select count(distinct cidade) as total_municipios 
from tb_inscricoes_cnh_social;

-- 4. Listar apenas candidatos PCD.

select *
from tb_inscricoes_cnh_social
where eh_pcd = 1
order by nome_completo

-- 5. Listar apenas candidatos não PCD.
select *
from tb_inscricoes_cnh_social
where eh_pcd = 0
order by nome_completo

-- 6. Exibir os candidatos com idade entre 18 e 24 anos.
select * from tb_inscricoes_cnh_social
where str_to_date(data_nascimento, '%d/%m/%Y') >= date_sub(CURDATE(), interval 24 YEAR)
	and str_to_date(data_nascimento, '%d/%m/%Y') <= date_sub(CURDATE(), interval 18 YEAR); 

-- 7. Exibir os candidatos com idade acima de 60 anos.
select * from tb_inscricoes_cnh_social
where str_to_date(data_nascimento, '%d/%m/%Y') <= date_sub(CURDATE(), interval 60 YEAR)
order by STR_TO_DATE(data_nascimento, '%d/%m/%Y') desc

-- 8. Listar os 100 primeiros registros cadastrados.
select * from tb_inscricoes_cnh_social
ORDER BY STR_TO_DATE(created_at, '%d/%m/%Y %H:%i:%s') ASC 
LIMIT 100;

-- 9. Exibir todas as inscrições realizadas em uma data específica.

select * 
from tb_inscricoes_cnh_social
where STR_TO_DATE(created_at, '%d/%m/%Y') = '2025-10-09' 
order by created_at asc 
limit 100

-- 10. Contar quantas inscrições ocorreram em cada dia.

select STR_TO_DATE(created_at, '%d/%m/%Y') as data_cadastro, count(*) as total
from tb_inscricoes_cnh_social
group by data_cadastro
order by data_cadastro asc;




-- Parte 2 - Agrupamentos

-- 11. Quantidade de inscrições por município.

select cidade, count(*) as inscricoes
from tb_inscricoes_cnh_social
group by cidade
order by inscricoes desc;

-- 12. Quantidade de inscrições por faixa etária.

select
case
	when STR_TO_DATE(data_nascimento, '%d/%m/%Y') >= DATE_SUB(CURDATE(), INTERVAL 24 YEAR) and STR_TO_DATE(data_nascimento, '%d/%m/%Y') <= DATE_SUB(CURDATE(), INTERVAL 18 YEAR) then '18 a 24'
  	when STR_TO_DATE(data_nascimento, '%d/%m/%Y') >= DATE_SUB(CURDATE(), INTERVAL 34 YEAR) and STR_TO_DATE(data_nascimento, '%d/%m/%Y') <= DATE_SUB(CURDATE(), INTERVAL 25 YEAR) then '25 a 34'
    when STR_TO_DATE(data_nascimento, '%d/%m/%Y') >= DATE_SUB(CURDATE(), INTERVAL 44 YEAR) and STR_TO_DATE(data_nascimento, '%d/%m/%Y') <= DATE_SUB(CURDATE(), INTERVAL 35 YEAR) then '35 a 44'
    when STR_TO_DATE(data_nascimento, '%d/%m/%Y') >= DATE_SUB(CURDATE(), INTERVAL 59 YEAR) and STR_TO_DATE(data_nascimento, '%d/%m/%Y') <= DATE_SUB(CURDATE(), INTERVAL 45 YEAR) then '45 a 59'
  else '60 ou mais'
end as faixa_etaria, COUNT(*) as total_faixa_etaria
from tb_inscricoes_cnh_social
group by faixa_etaria;



-- 13. Quantidade de inscrições por categoria desejada (A ou B).

select categoria_desejada, count(*) as inscricoes
from tb_inscricoes_cnh_social
group by categoria_desejada
order by inscricoes desc;

-- 14. Quantidade de inscrições por sexo.

-- 15. Quantidade de inscrições por condição PCD.
select eh_pcd, count(*) as inscricoes
from tb_inscricoes_cnh_social
group by eh_pcd
order by inscricoes desc;

-- 16. Exibir os 10 municípios com mais inscrições.
select cidade, count(*) as inscricoes
from tb_inscricoes_cnh_social
group by cidade
order by inscricoes desc
limit 10

-- 17. Exibir os 10 municípios com menos inscrições.
select cidade, count(*) as inscricoes
from tb_inscricoes_cnh_social
group by cidade
order by inscricoes asc
limit 10

-- 18. Calcular a média de inscrições por município.

SELECT 
    cidade, 
    COUNT(*) AS inscricoes,
    AVG(COUNT(*)) OVER() AS media_geral
FROM tb_inscricoes_cnh_social
GROUP BY cidade
ORDER BY inscricoes ASC;

-- 19. Identificar o município com maior número de inscrições.
select cidade, count(*) as inscricoes
from tb_inscricoes_cnh_social
group by cidade
order by inscricoes desc
limit 1

-- 20. Identificar o município com menor número de inscrições
select cidade, count(*) as inscricoes
from tb_inscricoes_cnh_social
group by cidade
order by inscricoes asc
limit 1



-- Parte 3- Percentuais


-- EXTRA: percentual de inscricoes por dia

select str_to_date(created_at, '%d/%m/%Y') as dias, count(*) as total_inscricoes, round((count(*) * 100.0) / (select count(*) from tb_inscricoes_cnh_social), 5) as percentual
from tb_inscricoes_cnh_social
group by dias
order by percentual desc

-- 21. Calcular o percentual de inscrições por faixa etária.

SELECT 
    CASE
        WHEN STR_TO_DATE(data_nascimento, '%d/%m/%Y') >= DATE_SUB(CURDATE(), INTERVAL 24 YEAR) AND STR_TO_DATE(data_nascimento, '%d/%m/%Y') <= DATE_SUB(CURDATE(), INTERVAL 18 YEAR) THEN '18 a 24'
        WHEN STR_TO_DATE(data_nascimento, '%d/%m/%Y') >= DATE_SUB(CURDATE(), INTERVAL 34 YEAR) AND STR_TO_DATE(data_nascimento, '%d/%m/%Y') <= DATE_SUB(CURDATE(), INTERVAL 25 YEAR) THEN '25 a 34'
        WHEN STR_TO_DATE(data_nascimento, '%d/%m/%Y') >= DATE_SUB(CURDATE(), INTERVAL 44 YEAR) AND STR_TO_DATE(data_nascimento, '%d/%m/%Y') <= DATE_SUB(CURDATE(), INTERVAL 35 YEAR) THEN '35 a 44'
        WHEN STR_TO_DATE(data_nascimento, '%d/%m/%Y') >= DATE_SUB(CURDATE(), INTERVAL 59 YEAR) AND STR_TO_DATE(data_nascimento, '%d/%m/%Y') <= DATE_SUB(CURDATE(), INTERVAL 45 YEAR) THEN '45 a 59'
        ELSE '60 ou mais'
    END AS faixa_etaria,
    COUNT(*) AS inscritos_faixa_etaria,
    ROUND((COUNT(*) * 100.0) / (SELECT COUNT(*) FROM tb_inscricoes_cnh_social), 2) AS percentual_faixa_etaria
FROM tb_inscricoes_cnh_social
GROUP BY faixa_etaria
ORDER BY faixa_etaria;

-- 22. Calcular o percentual de inscritos PCD e Não PCD.

select eh_pcd, count(*) as total_eh_pcd, round((count(*) * 100.0) / (select count(*) from tb_inscricoes_cnh_social), 2) as percentual
from tb_inscricoes_cnh_social
group by eh_pcd 

-- 23. Calcular o percentual de inscrições por município.
select cidade, count(*) as total_inscricoes, round((count(*) * 100.0) / (select count(*) from tb_inscricoes_cnh_social), 5) as percentual
from tb_inscricoes_cnh_social
group by cidade
order by percentual desc

-- 24.Identificar qual faixa etária representa a maior parcela dos inscritos.

SELECT 
    CASE
        WHEN STR_TO_DATE(data_nascimento, '%d/%m/%Y') >= DATE_SUB(CURDATE(), INTERVAL 24 YEAR) AND STR_TO_DATE(data_nascimento, '%d/%m/%Y') <= DATE_SUB(CURDATE(), INTERVAL 18 YEAR) THEN '18 a 24'
        WHEN STR_TO_DATE(data_nascimento, '%d/%m/%Y') >= DATE_SUB(CURDATE(), INTERVAL 34 YEAR) AND STR_TO_DATE(data_nascimento, '%d/%m/%Y') <= DATE_SUB(CURDATE(), INTERVAL 25 YEAR) THEN '25 a 34'
        WHEN STR_TO_DATE(data_nascimento, '%d/%m/%Y') >= DATE_SUB(CURDATE(), INTERVAL 44 YEAR) AND STR_TO_DATE(data_nascimento, '%d/%m/%Y') <= DATE_SUB(CURDATE(), INTERVAL 35 YEAR) THEN '35 a 44'
        WHEN STR_TO_DATE(data_nascimento, '%d/%m/%Y') >= DATE_SUB(CURDATE(), INTERVAL 59 YEAR) AND STR_TO_DATE(data_nascimento, '%d/%m/%Y') <= DATE_SUB(CURDATE(), INTERVAL 45 YEAR) THEN '45 a 59'
        ELSE '60 ou mais'
    END AS faixa_etaria,
    COUNT(*) AS inscritos_faixa_etaria,
    ROUND((COUNT(*) * 100.0) / (SELECT COUNT(*) FROM tb_inscricoes_cnh_social), 2) AS percentual_faixa_etaria
FROM tb_inscricoes_cnh_social
GROUP BY faixa_etaria
ORDER BY percentual_faixa_etaria desc
LIMIT 1;

-- 25. Calcular a participação percentual dos 5 municípios mais inscritos.
select cidade, count(*) as total_inscricoes, round((count(*) * 100.0) / (select count(*) from tb_inscricoes_cnh_social), 5) as percentual
from tb_inscricoes_cnh_social
group by cidade
order by percentual desc
limit 5



-- Parte 4 - Relatórios

-- 26. Gerar relatório contendo Município, Total de inscritos e Percentual em relação ao total geral.
-- 27. Gerar relatório contendo Faixa etária, Quantidade e Percentual.
-- 28. Gerar relatório diário de inscrições contendo Data, Quantidade e Percentual sobreo total.
-- 29. Exibir os municípios que possuem mais de 5.000 inscrições.
-- 30. Exibir os municípios que possuem menos de 1.000 inscrições.




-- Parte 5 - CASE e Regras de Negócio

-- 31. Criar uma coluna calculada chamada faixa etaria utilizando CASE.

SELECT
case
	when STR_TO_DATE(data_nascimento, '%d/%m/%Y') >= DATE_SUB(CURDATE(), INTERVAL 24 YEAR) and STR_TO_DATE(data_nascimento, '%d/%m/%Y') <= DATE_SUB(CURDATE(), INTERVAL 18 YEAR) then '18 a 24'
  	when STR_TO_DATE(data_nascimento, '%d/%m/%Y') >= DATE_SUB(CURDATE(), INTERVAL 34 YEAR) and STR_TO_DATE(data_nascimento, '%d/%m/%Y') <= DATE_SUB(CURDATE(), INTERVAL 25 YEAR) then '25 a 34'
    when STR_TO_DATE(data_nascimento, '%d/%m/%Y') >= DATE_SUB(CURDATE(), INTERVAL 44 YEAR) and STR_TO_DATE(data_nascimento, '%d/%m/%Y') <= DATE_SUB(CURDATE(), INTERVAL 35 YEAR) then '35 a 44'
    when STR_TO_DATE(data_nascimento, '%d/%m/%Y') >= DATE_SUB(CURDATE(), INTERVAL 59 YEAR) and STR_TO_DATE(data_nascimento, '%d/%m/%Y') <= DATE_SUB(CURDATE(), INTERVAL 45 YEAR) then '45 a 59'
  else '60 ou mais'
end as faixa_etaria, COUNT(*) as total_faixa_etaria
from tb_inscricoes_cnh_social
group by faixa_etaria;

-- 32. Criar uma coluna calculada chamada situacao_pcd.

-- 33. Classificar municípios utilizando CASE (Grande, Médio e Pequeno Porte). -- criterio utilizado: pequeno porte <= 1000 inscritos, medio porte > 1000 and <= 20000, grande porte > 20000 

SELECT cidade, COUNT(*) AS total_inscritos,
	CASE 
		WHEN COUNT(*) <= 1000 THEN 'pequeno porte'
		WHEN COUNT(*) BETWEEN  1000 AND  20000  THEN 'medio porte'
	ELSE 'Grande Porte'
END AS porte_cidade
FROM tb_inscricoes_cnh_social
GROUP BY cidade
ORDER BY porte_cidade;
 
-- 34. Exibir apenas municípios classificados como Grande Porte.

SELECT cidade, COUNT(*) AS total_inscritos,
	CASE 
		WHEN COUNT(*) <= 1000 THEN 'pequeno porte'
		WHEN COUNT(*) BETWEEN  1000 AND  20000  THEN 'medio porte'
	ELSE 'Grande Porte'
END AS porte_cidade
FROM tb_inscricoes_cnh_social
GROUP BY cidade
HAVING count(*) > 20000
ORDER BY porte_cidade;
 

-- 35. Contar quantos municípios existem em cada classificação.

-- Parte 6 - Desafios Avançados

-- 36. Criar uma consulta que exiba o ranking dos municípios por quantidade de inscrições.
-- 37. Exibir os 5 municípios que representam a maior concentração de inscritos. 
select cidade, count(*) as inscricoes
from tb_inscricoes_cnh_social
group by cidade
order by inscricoes desc
limit 5

-- 39. Identificar o dia com maior número de inscrições.
select STR_TO_DATE(created_at, '%d/%m/%Y') as data_inscricao, count(*) as inscricoes
from tb_inscricoes_cnh_social
group by data_inscricao
order by inscricoes desc
limit 1


-- 40. Identificar o dia com menor número de inscrições.
select STR_TO_DATE(created_at, '%d/%m/%Y') as data_inscricao, count(*) as inscricoes
from tb_inscricoes_cnh_social
group by data_inscricao
order by inscricoes asc
limit 1

-- 41. Calcular o acumulado de inscrições por dia.
-- 42. Comparar cada município com a média estadual de inscrições.
-- 43. Exibir municípios acima da média estadual.
-- 44. Exibir municípios abaixo da média estadual.
-- 45. Produzir um relatório final semelhante aos gráficos apresentados no estudo da CNH Social.
