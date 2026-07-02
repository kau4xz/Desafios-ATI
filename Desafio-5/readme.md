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
select id, cpf,  nome_completo, data_nascimento  from tb_inscricoes_cnh_social
WHERE data_nascimento >= DATE_SUB(CURDATE(), INTERVAL 24 YEAR)
	AND data_nascimento <= DATE_SUB(CURDATE(), INTERVAL 18 YEAR)  
ORDER BY data_nascimento DESC ;

-- 7. Exibir os candidatos com idade acima de 60 anos.
select * from tb_inscricoes_cnh_social
WHERE data_nascimento <= date_sub(curdate(), INTERVAL 60 year) 
order by data_nascimento desc

-- 8. Listar os 100 primeiros registros cadastrados.
select * from tb_inscricoes_cnh_social
ORDER BY created_at ASC 
LIMIT 100;

-- 9. Exibir todas as inscrições realizadas em uma data específica.

select * 
from tb_inscricoes_cnh_social
where date(created_at) = '2025-10-09' 
order by date(created_at) asc 
limit 100

-- 10. Contar quantas inscrições ocorreram em cada dia.

select date(created_at) AS dias_cadastros, count(*) as total
from tb_inscricoes_cnh_social
group BY dias_cadastros
order by total desc;




-- Parte 2 - Agrupamentos

-- 11. Quantidade de inscrições por município.

select cidade, count(*) as inscricoes
from tb_inscricoes_cnh_social
group by cidade
order by inscricoes desc;

-- 12. Quantidade de inscrições por faixa etária.

select
case
	when data_nascimento >= DATE_SUB(CURDATE(), INTERVAL 24 YEAR) and data_nascimento  <= DATE_SUB(CURDATE(), INTERVAL 18 YEAR) then '18 a 24'
  	when data_nascimento >= DATE_SUB(CURDATE(), INTERVAL 34 YEAR) and data_nascimento  <= DATE_SUB(CURDATE(), INTERVAL 25 YEAR) then '25 a 34'
    when data_nascimento >= DATE_SUB(CURDATE(), INTERVAL 44 YEAR) and data_nascimento  <= DATE_SUB(CURDATE(), INTERVAL 35 YEAR) then '35 a 44'
    when data_nascimento >= DATE_SUB(CURDATE(), INTERVAL 59 YEAR) and data_nascimento  <= DATE_SUB(CURDATE(), INTERVAL 45 YEAR) then '45 a 59'
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

select date(created_at) as dias, count(*) as total_inscricoes, round((count(*) * 100.0) / (select count(*) from tb_inscricoes_cnh_social), 2) as percentual
from tb_inscricoes_cnh_social
group by dias
order by percentual desc

-- 21. Calcular o percentual de inscrições por faixa etária.

SELECT 
    CASE
      	when data_nascimento >= DATE_SUB(CURDATE(), INTERVAL 24 YEAR) and data_nascimento  <= DATE_SUB(CURDATE(), INTERVAL 18 YEAR) then '18 a 24'
	  	when data_nascimento >= DATE_SUB(CURDATE(), INTERVAL 34 YEAR) and data_nascimento  <= DATE_SUB(CURDATE(), INTERVAL 25 YEAR) then '25 a 34'
	    when data_nascimento >= DATE_SUB(CURDATE(), INTERVAL 44 YEAR) and data_nascimento  <= DATE_SUB(CURDATE(), INTERVAL 35 YEAR) then '35 a 44'
	    when data_nascimento >= DATE_SUB(CURDATE(), INTERVAL 59 YEAR) and data_nascimento  <= DATE_SUB(CURDATE(), INTERVAL 45 YEAR) then '45 a 59'
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
        when data_nascimento >= DATE_SUB(CURDATE(), INTERVAL 24 YEAR) and data_nascimento  <= DATE_SUB(CURDATE(), INTERVAL 18 YEAR) then '18 a 24'
	  	when data_nascimento >= DATE_SUB(CURDATE(), INTERVAL 34 YEAR) and data_nascimento  <= DATE_SUB(CURDATE(), INTERVAL 25 YEAR) then '25 a 34'
	    when data_nascimento >= DATE_SUB(CURDATE(), INTERVAL 44 YEAR) and data_nascimento  <= DATE_SUB(CURDATE(), INTERVAL 35 YEAR) then '35 a 44'
	    when data_nascimento >= DATE_SUB(CURDATE(), INTERVAL 59 YEAR) and data_nascimento  <= DATE_SUB(CURDATE(), INTERVAL 45 YEAR) then '45 a 59'
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
SELECT
	cidade AS municipio,
	count(*) AS total_inscritos,
	round(count(*) * 100 / sum(count(*)) OVER(), 2) AS percentual
FROM tb_inscricoes_cnh_social
GROUP BY cidade
ORDER BY total_inscritos DESC;

-- 27. Gerar relatório contendo Faixa etária, Quantidade e Percentual. 
	

-- 28. Gerar relatório diário de inscrições contendo Data, Quantidade e Percentual sobreo total.
SELECT 
	date(created_at), count(*) AS total_inscricoes,
	round(count(*) * 100 / sum(count(*)) OVER (), 2) AS percentual
FROM tb_inscricoes_cnh_social
GROUP BY date(created_at)
ORDER BY total_inscricoes DESC; 

-- 29. Exibir os municípios que possuem mais de 5.000 inscrições.
SELECT 
	cidade AS municipio, count(*) AS total_municipio 
FROM tb_inscricoes_cnh_social
GROUP BY cidade
HAVING count(*) > 5000
ORDER BY total_municipio DESC;


-- 30. Exibir os municípios que possuem menos de 1.000 inscrições.
SELECT 
	cidade AS municipio, count(*) AS total_municipio 
FROM tb_inscricoes_cnh_social
GROUP BY cidade
HAVING count(*) < 1000
ORDER BY total_municipio DESC;



-- Parte 5 - CASE e Regras de Negócio

-- 31. Criar uma coluna calculada chamada faixa etaria utilizando CASE.

SELECT
case
	when data_nascimento >= DATE_SUB(CURDATE(), INTERVAL 24 YEAR) and data_nascimento  <= DATE_SUB(CURDATE(), INTERVAL 18 YEAR) then '18 a 24'
  	when data_nascimento >= DATE_SUB(CURDATE(), INTERVAL 34 YEAR) and data_nascimento  <= DATE_SUB(CURDATE(), INTERVAL 25 YEAR) then '25 a 34'
    when data_nascimento >= DATE_SUB(CURDATE(), INTERVAL 44 YEAR) and data_nascimento  <= DATE_SUB(CURDATE(), INTERVAL 35 YEAR) then '35 a 44'
    when data_nascimento >= DATE_SUB(CURDATE(), INTERVAL 59 YEAR) and data_nascimento  <= DATE_SUB(CURDATE(), INTERVAL 45 YEAR) then '45 a 59'
  else '60 ou mais'
end as faixa_etaria, COUNT(*) as total_faixa_etaria
from tb_inscricoes_cnh_social
group by faixa_etaria;

-- 32. Criar uma coluna calculada chamada situacao_pcd.
SELECT 
    eh_pcd, 
    CASE 
        WHEN eh_pcd = true THEN 'PCD'
        ELSE 'Não PCD'
    END AS situacao_pcd,
    COUNT(*) AS total_eh_pcd, 
    ROUND((COUNT(*) * 100.0) / (SELECT COUNT(*) FROM tb_inscricoes_cnh_social), 2) AS percentual
FROM 
    tb_inscricoes_cnh_social
GROUP BY 
    eh_pcd;

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

WITH CidadesClassificadas AS (
    SELECT 
        cidade,
        CASE 
            WHEN COUNT(*) <= 1000 THEN 'Pequeno Porte'
            WHEN COUNT(*) BETWEEN 1001 AND 20000 THEN 'Médio Porte'
            ELSE 'Grande Porte'
        END AS porte_cidade
    FROM tb_inscricoes_cnh_social
    GROUP BY cidade
)
SELECT 
    porte_cidade, 
    COUNT(cidade) AS total_municipios
FROM CidadesClassificadas
GROUP BY porte_cidade
ORDER BY total_municipios DESC;

-- Parte 6 - Desafios Avançados

-- 36. Criar uma consulta que exiba o ranking dos municípios por quantidade de inscrições.


SELECT cidade, 
	count(*) AS total_inscricoes,
	RANK() OVER (ORDER BY count(*) desc) AS ranking_cidades
FROM tb_inscricoes_cnh_social 
GROUP BY cidade
ORDER BY ranking_cidades;


-- 37. Exibir os 5 municípios que representam a maior concentração de inscritos. 
select cidade, count(*) as inscricoes
from tb_inscricoes_cnh_social
group by cidade
order by inscricoes desc
limit 5

-- 38. Calcular a média diária de inscrições.
WITH InscricoesPorDia AS (
    SELECT DATE(created_at) AS dia, COUNT(*) AS total_dia
    FROM tb_inscricoes_cnh_social
    GROUP BY DATE(created_at)
)       
SELECT ROUND(AVG(total_dia), 2) AS media_diaria
FROM InscricoesPorDia;

-- 39. Identificar o dia com maior número de inscrições.
SELECT DATE(created_at) AS dia, count(*) AS	inscricoes
FROM tb_inscricoes_cnh_social
GROUP BY  dia
order by inscricoes DESC
LIMIT 1


-- 40. Identificar o dia com menor número de inscrições.
SELECT 
    DATE(created_at) AS dia, 
    COUNT(*) AS inscricoes
FROM tb_inscricoes_cnh_social
GROUP BY DATE(created_at)
ORDER BY inscricoes ASC
LIMIT 1;

--- 41. Calcular o acumulado de inscrições por dia.	
WITH SomaInscricoes AS (
 SELECT 
 	date(created_at) AS data_inscricoes,
 	COUNT(*) AS inscricoes
 FROM tb_inscricoes_cnh_social
 GROUP BY date(created_at)
)

SELECT 
	data_inscricoes, inscricoes,
	sum(inscricoes) OVER (ORDER by data_inscricoes) AS total_acumulado
FROM SomaInscricoes
ORDER BY data_inscricoes 

-- 42. Comparar cada município com a média estadual de inscrições.

WITH InscricoesCidade AS (
	SELECT  cidade, COUNT(id) AS total_municipio
	FROM tb_inscricoes_cnh_social
	GROUP BY cidade
),
MediaGeral AS (
	SELECT 
        AVG(total_municipio) AS media_geral
	FROM InscricoesCidade 
)
SELECT 
	c.cidade,
	c.total_municipio,
	ROUND(m.media_geral, 2) AS media_geral,
	ROUND(c.total_municipio - m.media_geral, 2) AS diferenca_media 
FROM InscricoesCidade c 
CROSS JOIN MediaGeral m
ORDER BY c.cidade;
	


-- 43. Exibir municípios acima da média estadual.
WITH InscricoesPorCidade AS (
    SELECT cidade, COUNT(id) AS quantidade_inscricoes
    FROM tb_inscricoes_cnh_social
    GROUP BY cidade
),
MediaGeral AS (
    SELECT AVG(quantidade_inscricoes) AS media_geral
    FROM InscricoesPorCidade
)
SELECT 
    c.cidade,
    c.quantidade_inscricoes,
    ROUND(m.media_geral, 2) AS media_geral
FROM InscricoesPorCidade c
CROSS JOIN MediaGeral m
WHERE c.quantidade_inscricoes > m.media_geral
ORDER BY c.quantidade_inscricoes DESC;



-- 44. Exibir municípios abaixo da média estadual.
WITH InscricoesPorCidade AS (
    SELECT cidade, COUNT(id) AS quantidade_inscricoes
    FROM tb_inscricoes_cnh_social
    GROUP BY cidade
),
MediaGeral AS (
    SELECT AVG(quantidade_inscricoes) AS media_geral
    FROM InscricoesPorCidade
)
SELECT 
    c.cidade,
    c.quantidade_inscricoes,
    ROUND(m.media_geral, 2) AS media_geral
FROM InscricoesPorCidade c
CROSS JOIN MediaGeral m
WHERE c.quantidade_inscricoes < m.media_geral
ORDER BY c.quantidade_inscricoes DESC;

-- 45. Produzir um relatório final semelhante aos gráficos apresentados no estudo da CNH Social.





































-- ALTERAÇÃO DE DADOS DE DATA EM VARCHAR PARA DATE/DATETIME
-- PASSO 1: ADICIONAR COLUNAS TEMPORÁRIAS COM OS TIPOS CORRETOS
-- Criamos colunas provisórias para armazenar os dados convertidos sem afetar as originais.
ALTER TABLE tb_inscricoes_cnh_social 
    ADD COLUMN temp_data_nascimento DATE,
    ADD COLUMN temp_created_at DATETIME,
    ADD COLUMN temp_updated_at DATETIME,
    ADD COLUMN temp_data_email DATETIME;


-- PASSO 2: CONVERTER E ATUALIZAR OS DADOS
-- Lemos as strings antigas, convertemos e guardamos nas colunas temporárias.
-- O NULLIF('N') é crucial para evitar o erro de truncamento se houver caracteres inválidos como 'N'.
UPDATE tb_inscricoes_cnh_social 
SET 
    temp_data_nascimento = STR_TO_DATE(NULLIF(data_nascimento, 'N'), '%d/%m/%Y'),
    temp_created_at      = STR_TO_DATE(NULLIF(created_at, 'N'), '%d/%m/%Y %H:%i:%s'),
    temp_updated_at      = STR_TO_DATE(NULLIF(updated_at, 'N'), '%d/%m/%Y %H:%i:%s'),
    temp_data_email      = STR_TO_DATE(NULLIF(data_email, 'N'), '%d/%m/%Y %H:%i:%s');


-- PASSO 3: VERIFICAÇÃO (OPCIONAL, MAS ALTAMENTE RECOMENDADA)
-- Executa este SELECT para garantir que os dados das colunas temp_ foram preenchidos corretamente 
-- e não ficaram todos NULL (o que indicaria que a máscara '%d/%m/%Y' estava incorreta).
SELECT data_nascimento, temp_data_nascimento FROM tb_inscricoes_cnh_social LIMIT 10;


-- PASSO 4: DESCARTAR AS COLUNAS ORIGINAIS (VARCHAR)
-- Uma vez garantido que os dados estão seguros nas colunas temporárias, apagamos as antigas.
ALTER TABLE tb_inscricoes_cnh_social 
    DROP COLUMN data_nascimento,
    DROP COLUMN created_at,
    DROP COLUMN updated_at,
    DROP COLUMN data_email;


-- PASSO 5: RENOMEAR AS COLUNAS TEMPORÁRIAS PARA OS NOMES ORIGINAIS
-- Agora, renomeamos as colunas DATE/DATETIME para assumirem o lugar das originais.
ALTER TABLE tb_inscricoes_cnh_social 
    RENAME COLUMN temp_data_nascimento TO data_nascimento,
    RENAME COLUMN temp_created_at TO created_at,
    RENAME COLUMN temp_updated_at TO updated_at,
    RENAME COLUMN temp_data_email TO data_email;
