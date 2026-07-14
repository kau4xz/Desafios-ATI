<?php


$querys = [
    1 => [
        "titulo" => "1. Listar todos os registros ordenados pela data de inscrição mais recente",
        "sql" => <<<SQL
            SELECT id, nome_completo, cpf, data_nascimento, categoria_desejada
            FROM tb_inscricoes_cnh_social
            ORDER BY created_at DESC
            LIMIT 100
SQL
    ],
    2 => [
        "titulo" => "2. Contar o total de inscrições",
        "sql" => <<<SQL
            SELECT count(*) as total_inscricoes
            FROM tb_inscricoes_cnh_social
SQL
    ],
    3 => [
        "titulo" => "3. Exibir quantos municípios distintos existem na base",
        "sql" => <<<SQL
            SELECT count(distinct cidade) as total_municipios 
            FROM tb_inscricoes_cnh_social
SQL
    ],
    4 => [
        "titulo" => "4. Listar apenas candidatos PCD",
        "sql" => <<<SQL
            SELECT id, nome_completo, cpf, data_nascimento, categoria_desejada, eh_pcd
            FROM tb_inscricoes_cnh_social
            WHERE eh_pcd = 1
            ORDER BY nome_completo
            limit 100
SQL
    ],
    5 => [
        "titulo" => "5. Listar apenas candidatos não PCD",
        "sql" => <<<SQL
            SELECT id, nome_completo, cpf, data_nascimento, categoria_desejada, eh_pcd
            FROM tb_inscricoes_cnh_social
            WHERE eh_pcd = 0
            ORDER BY nome_completo
SQL
    ],
    6 => [
        "titulo" => "6. Exibir os candidatos com idade entre 18 e 24 anos",
        "sql" => <<<SQL
            SELECT id, cpf, nome_completo, data_nascimento  
            FROM tb_inscricoes_cnh_social
            WHERE data_nascimento >= DATE_SUB(CURDATE(), INTERVAL 24 YEAR)
              AND data_nascimento <= DATE_SUB(CURDATE(), INTERVAL 18 YEAR)  
            ORDER BY data_nascimento DESC
SQL
    ],
    7 => [
        "titulo" => "7. Exibir os candidatos com idade acima de 60 anos",
        "sql" => <<<SQL
            SELECT id, nome_completo, cpf, data_nascimento, categoria_desejada FROM tb_inscricoes_cnh_social
            WHERE data_nascimento <= date_sub(curdate(), INTERVAL 60 year) 
            ORDER BY data_nascimento DESC
            limit 100
SQL
    ],
    8 => [
        "titulo" => "8. Listar os 100 primeiros registros cadastrados",
        "sql" => <<<SQL
            SELECT id, nome_completo, cpf, data_nascimento, categoria_desejada, eh_pcd
            FROM tb_inscricoes_cnh_social
            ORDER BY created_at ASC 
            LIMIT 100
SQL
    ],
    9 => [
        "titulo" => "9. Exibir todas as inscrições realizadas em uma data específica (09/10/2025)",
        "sql" => <<<SQL
            SELECT id, nome_completo, cpf, data_nascimento, categoria_desejada, eh_pcd
            FROM tb_inscricoes_cnh_social
            WHERE date(created_at) = '2025-10-09' 
            ORDER BY date(created_at) ASC 
            LIMIT 100
SQL
    ],
    10 => [
        "titulo" => "10. Contar quantas inscrições ocorreram em cada dia",
        "sql" => <<<SQL
            SELECT date(created_at) AS dias_cadastros, count(*) as total
            FROM tb_inscricoes_cnh_social
            GROUP BY dias_cadastros
            ORDER BY total DESC
SQL
    ],

    11 => [
        "titulo" => "11. Quantidade de inscrições por município",
        "sql" => <<<SQL
            SELECT cidade, count(*) as inscricoes
            FROM tb_inscricoes_cnh_social
            GROUP BY cidade
            ORDER BY inscricoes DESC
SQL
    ],
    12 => [
        "titulo" => "12. Quantidade de inscrições por faixa etária",
        "sql" => <<<SQL
            SELECT
                CASE
                    WHEN data_nascimento >= DATE_SUB(CURDATE(), INTERVAL 24 YEAR) AND data_nascimento <= DATE_SUB(CURDATE(), INTERVAL 18 YEAR) THEN '18 a 24'
                    WHEN data_nascimento >= DATE_SUB(CURDATE(), INTERVAL 34 YEAR) AND data_nascimento <= DATE_SUB(CURDATE(), INTERVAL 25 YEAR) THEN '25 a 34'
                    WHEN data_nascimento >= DATE_SUB(CURDATE(), INTERVAL 44 YEAR) AND data_nascimento <= DATE_SUB(CURDATE(), INTERVAL 35 YEAR) THEN '35 a 44'
                    WHEN data_nascimento >= DATE_SUB(CURDATE(), INTERVAL 59 YEAR) AND data_nascimento <= DATE_SUB(CURDATE(), INTERVAL 45 YEAR) THEN '45 a 59'
                    ELSE '60 ou mais'
                END as faixa_etaria, 
                COUNT(*) as total_faixa_etaria
            FROM tb_inscricoes_cnh_social
            GROUP BY faixa_etaria
SQL
    ],
    13 => [
        "titulo" => "13. Quantidade de inscrições por categoria desejada (A ou B)",
        "sql" => <<<SQL
            SELECT categoria_desejada, count(*) as inscricoes
            FROM tb_inscricoes_cnh_social
            GROUP BY categoria_desejada
            ORDER BY inscricoes DESC
SQL
    ],
    14 => [
        "titulo" => "14. Quantidade de inscrições por sexo",
        "sql" => <<<SQL
            SELECT sexo, count(*) as inscricoes
            FROM tb_inscricoes_cnh_social
            GROUP BY sexo
            ORDER BY inscricoes DESC
SQL
    ],
    15 => [
        "titulo" => "15. Quantidade de inscrições por condição PCD",
        "sql" => <<<SQL
            SELECT eh_pcd, count(*) as inscricoes
            FROM tb_inscricoes_cnh_social
            GROUP BY eh_pcd
            ORDER BY inscricoes DESC
SQL
    ],
    16 => [
        "titulo" => "16. Exibir os 10 municípios com mais inscrições",
        "sql" => <<<SQL
            SELECT cidade, count(*) as inscricoes
            FROM tb_inscricoes_cnh_social
            GROUP BY cidade
            ORDER BY inscricoes DESC
            LIMIT 10
SQL
    ],
    17 => [
        "titulo" => "17. Exibir os 10 municípios com menos inscrições",
        "sql" => <<<SQL
            SELECT cidade, count(*) as inscricoes
            FROM tb_inscricoes_cnh_social
            GROUP BY cidade
            ORDER BY inscricoes ASC
            LIMIT 10
SQL
    ],
    18 => [
        "titulo" => "18. Calcular a média de inscrições por município",
        "sql" => <<<SQL
            SELECT 
                cidade, 
                COUNT(*) AS inscricoes,
                AVG(COUNT(*)) OVER() AS media_geral
            FROM tb_inscricoes_cnh_social
            GROUP BY cidade
            ORDER BY inscricoes ASC
SQL
    ],
    19 => [
        "titulo" => "19. Identificar o município com maior número de inscrições",
        "sql" => <<<SQL
            SELECT cidade, count(*) as inscricoes
            FROM tb_inscricoes_cnh_social
            GROUP BY cidade
            ORDER BY inscricoes DESC
            LIMIT 1
SQL
    ],
    20 => [
        "titulo" => "20. Identificar o município com menor número de inscrições",
        "sql" => <<<SQL
            SELECT cidade, count(*) as inscricoes
            FROM tb_inscricoes_cnh_social
            GROUP BY cidade
            ORDER BY inscricoes ASC
            LIMIT 1
SQL
    ],

    // ==========================================
    // PARTE 3 - Percentuais
    // ==========================================
    200 => [
        "titulo" => "EXTRA: Percentual de inscrições por dia",
        "sql" => <<<SQL
            SELECT 
                date(created_at) as dias, 
                count(*) as total_inscricoes, 
                round((count(*) * 100.0) / (select count(*) from tb_inscricoes_cnh_social), 2) as percentual
            FROM tb_inscricoes_cnh_social
            GROUP BY dias
            ORDER BY percentual DESC
SQL
    ],
    21 => [
        "titulo" => "21. Calcular o percentual de inscrições por faixa etária",
        "sql" => <<<SQL
            SELECT 
                CASE
                    WHEN data_nascimento >= DATE_SUB(CURDATE(), INTERVAL 24 YEAR) AND data_nascimento <= DATE_SUB(CURDATE(), INTERVAL 18 YEAR) THEN '18 a 24'
                    WHEN data_nascimento >= DATE_SUB(CURDATE(), INTERVAL 34 YEAR) AND data_nascimento <= DATE_SUB(CURDATE(), INTERVAL 25 YEAR) THEN '25 a 34'
                    WHEN data_nascimento >= DATE_SUB(CURDATE(), INTERVAL 44 YEAR) AND data_nascimento <= DATE_SUB(CURDATE(), INTERVAL 35 YEAR) THEN '35 a 44'
                    WHEN data_nascimento >= DATE_SUB(CURDATE(), INTERVAL 59 YEAR) AND data_nascimento <= DATE_SUB(CURDATE(), INTERVAL 45 YEAR) THEN '45 a 59'
                    ELSE '60 ou mais'
                END AS faixa_etaria,
                COUNT(*) AS inscritos_faixa_etaria,
                ROUND((COUNT(*) * 100.0) / (SELECT COUNT(*) FROM tb_inscricoes_cnh_social), 2) AS percentual_faixa_etaria
            FROM tb_inscricoes_cnh_social
            GROUP BY faixa_etaria
            ORDER BY faixa_etaria
SQL
    ],
    22 => [
        "titulo" => "22. Calcular o percentual de inscritos PCD e Não PCD",
        "sql" => <<<SQL
            SELECT 
                eh_pcd, 
                count(*) as total_eh_pcd, 
                round((count(*) * 100.0) / (select count(*) from tb_inscricoes_cnh_social), 2) as percentual
            FROM tb_inscricoes_cnh_social
            GROUP BY eh_pcd
SQL
    ],
    23 => [
        "titulo" => "23. Calcular o percentual de inscrições por município",
        "sql" => <<<SQL
            SELECT 
                cidade, 
                count(*) as total_inscricoes, 
                round((count(*) * 100.0) / (select count(*) from tb_inscricoes_cnh_social), 5) as percentual
            FROM tb_inscricoes_cnh_social
            GROUP BY cidade
            ORDER BY percentual DESC
SQL
    ],
    24 => [
        "titulo" => "24. Identificar qual faixa etária representa a maior parcela dos inscritos",
        "sql" => <<<SQL
            SELECT 
                CASE
                    WHEN data_nascimento >= DATE_SUB(CURDATE(), INTERVAL 24 YEAR) AND data_nascimento <= DATE_SUB(CURDATE(), INTERVAL 18 YEAR) THEN '18 a 24'
                    WHEN data_nascimento >= DATE_SUB(CURDATE(), INTERVAL 34 YEAR) AND data_nascimento <= DATE_SUB(CURDATE(), INTERVAL 25 YEAR) THEN '25 a 34'
                    WHEN data_nascimento >= DATE_SUB(CURDATE(), INTERVAL 44 YEAR) AND data_nascimento <= DATE_SUB(CURDATE(), INTERVAL 35 YEAR) THEN '35 a 44'
                    WHEN data_nascimento >= DATE_SUB(CURDATE(), INTERVAL 59 YEAR) AND data_nascimento <= DATE_SUB(CURDATE(), INTERVAL 45 YEAR) THEN '45 a 59'
                    ELSE '60 ou mais'
                END AS faixa_etaria,
                COUNT(*) AS inscritos_faixa_etaria,
                ROUND((COUNT(*) * 100.0) / (SELECT COUNT(*) FROM tb_inscricoes_cnh_social), 2) AS percentual_faixa_etaria
            FROM tb_inscricoes_cnh_social
            GROUP BY faixa_etaria
            ORDER BY percentual_faixa_etaria DESC
            LIMIT 1
SQL
    ],
    25 => [
        "titulo" => "25. Calcular a participação percentual dos 5 municípios mais inscritos",
        "sql" => <<<SQL
            SELECT 
                cidade, 
                count(*) as total_inscricoes, 
                round((count(*) * 100.0) / (select count(*) from tb_inscricoes_cnh_social), 5) as percentual
            FROM tb_inscricoes_cnh_social
            GROUP BY cidade
            ORDER BY percentual DESC
            LIMIT 5
SQL
    ],

    // ==========================================
    // PARTE 4 - Relatórios
    // ==========================================
    26 => [
        "titulo" => "26. Relatório: Município, Total de inscritos e Percentual",
        "sql" => <<<SQL
            SELECT
                cidade AS municipio,
                count(*) AS total_inscritos,
                round(count(*) * 100 / sum(count(*)) OVER(), 2) AS percentual
            FROM tb_inscricoes_cnh_social
            GROUP BY cidade
            ORDER BY total_inscritos DESC
SQL
    ],
    27 => [
        "titulo" => "27. Relatório: Faixa etária, Quantidade e Percentual",
        "sql" => <<<SQL
            SELECT 
                CASE
                    WHEN data_nascimento >= DATE_SUB(CURDATE(), INTERVAL 24 YEAR) AND data_nascimento <= DATE_SUB(CURDATE(), INTERVAL 18 YEAR) THEN '18 a 24'
                    WHEN data_nascimento >= DATE_SUB(CURDATE(), INTERVAL 34 YEAR) AND data_nascimento <= DATE_SUB(CURDATE(), INTERVAL 25 YEAR) THEN '25 a 34'
                    WHEN data_nascimento >= DATE_SUB(CURDATE(), INTERVAL 44 YEAR) AND data_nascimento <= DATE_SUB(CURDATE(), INTERVAL 35 YEAR) THEN '35 a 44'
                    WHEN data_nascimento >= DATE_SUB(CURDATE(), INTERVAL 59 YEAR) AND data_nascimento <= DATE_SUB(CURDATE(), INTERVAL 45 YEAR) THEN '45 a 59'
                    ELSE "60 ou mais"
                END AS faixa_etaria,
                COUNT(*) AS inscritos_faixa_etaria,
                ROUND((COUNT(*) * 100.0) / (SELECT COUNT(*) FROM tb_inscricoes_cnh_social), 2) AS percentual_faixa_etaria
            FROM tb_inscricoes_cnh_social
            GROUP BY faixa_etaria
            ORDER BY percentual_faixa_etaria DESC
SQL
    ],
    28 => [
        "titulo" => "28. Relatório diário de inscrições: Data, Quantidade e Percentual",
        "sql" => <<<SQL
            SELECT 
                date(created_at) as data_inscricao, 
                count(*) AS total_inscricoes,
                round(count(*) * 100 / sum(count(*)) OVER (), 2) AS percentual
            FROM tb_inscricoes_cnh_social
            GROUP BY date(created_at)
            ORDER BY total_inscricoes DESC
SQL
    ],
    29 => [
        "titulo" => "29. Municípios que possuem mais de 5.000 inscrições",
        "sql" => <<<SQL
            SELECT 
                cidade AS municipio, 
                count(*) AS total_municipio 
            FROM tb_inscricoes_cnh_social
            GROUP BY cidade
            HAVING count(*) > 5000
            ORDER BY total_municipio DESC
SQL
    ],
    30 => [
        "titulo" => "30. Municípios que possuem menos de 1.000 inscrições",
        "sql" => <<<SQL
            SELECT 
                cidade AS municipio, 
                count(*) AS total_municipio 
            FROM tb_inscricoes_cnh_social
            GROUP BY cidade
            HAVING count(*) < 1000
            ORDER BY total_municipio DESC
SQL
    ],

    // ==========================================
    // PARTE 5 - CASE e Regras de Negócio
    // ==========================================
    31 => [
        "titulo" => "31. Coluna calculada: faixa_etaria utilizando CASE",
        "sql" => <<<SQL
            SELECT
                CASE
                    WHEN data_nascimento >= DATE_SUB(CURDATE(), INTERVAL 24 YEAR) AND data_nascimento <= DATE_SUB(CURDATE(), INTERVAL 18 YEAR) THEN '18 a 24'
                    WHEN data_nascimento >= DATE_SUB(CURDATE(), INTERVAL 34 YEAR) AND data_nascimento <= DATE_SUB(CURDATE(), INTERVAL 25 YEAR) THEN '25 a 34'
                    WHEN data_nascimento >= DATE_SUB(CURDATE(), INTERVAL 44 YEAR) AND data_nascimento <= DATE_SUB(CURDATE(), INTERVAL 35 YEAR) THEN '35 a 44'
                    WHEN data_nascimento >= DATE_SUB(CURDATE(), INTERVAL 59 YEAR) AND data_nascimento <= DATE_SUB(CURDATE(), INTERVAL 45 YEAR) THEN '45 a 59'
                    ELSE '60 ou mais'
                END as faixa_etaria, 
                COUNT(*) as total_faixa_etaria
            FROM tb_inscricoes_cnh_social
            GROUP BY faixa_etaria
SQL
    ],
    32 => [
        "titulo" => "32. Coluna calculada: situacao_pcd",
        "sql" => <<<SQL
            SELECT 
                eh_pcd, 
                CASE 
                    WHEN eh_pcd = true THEN 'PCD'
                    ELSE 'Não PCD'
                END AS situacao_pcd,
                COUNT(*) AS total_eh_pcd, 
                ROUND((COUNT(*) * 100.0) / (SELECT COUNT(*) FROM tb_inscricoes_cnh_social), 2) AS percentual
            FROM tb_inscricoes_cnh_social
            GROUP BY eh_pcd
SQL
    ],
    33 => [
        "titulo" => "33. Classificar municípios (Grande, Médio e Pequeno Porte)",
        "sql" => <<<SQL
            SELECT 
                cidade, 
                COUNT(*) AS total_inscritos,
                CASE 
                    WHEN COUNT(*) <= 1000 THEN 'Pequeno Porte'
                    WHEN COUNT(*) BETWEEN 1001 AND 20000 THEN 'Médio Porte'
                    ELSE 'Grande Porte'
                END AS porte_cidade
            FROM tb_inscricoes_cnh_social
            GROUP BY cidade
            ORDER BY porte_cidade
SQL
    ],
    34 => [
        "titulo" => "34. Exibir apenas municípios de Grande Porte",
        "sql" => <<<SQL
            SELECT 
                cidade, 
                COUNT(*) AS total_inscritos,
                CASE 
                    WHEN COUNT(*) <= 1000 THEN 'Pequeno Porte'
                    WHEN COUNT(*) BETWEEN 1001 AND 20000 THEN 'Médio Porte'
                    ELSE 'Grande Porte'
                END AS porte_cidade
            FROM tb_inscricoes_cnh_social
            GROUP BY cidade
            HAVING count(*) > 20000
            ORDER BY porte_cidade
SQL
    ],
    35 => [
        "titulo" => "35. Contar municípios em cada classificação de porte",
        "sql" => <<<SQL
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
            ORDER BY total_municipios DESC
SQL
    ],

    // ==========================================
    // PARTE 6 - Desafios Avançados
    // ==========================================
    36 => [
        "titulo" => "36. Ranking dos municípios por quantidade de inscrições",
        "sql" => <<<SQL
            SELECT 
                cidade, 
                count(*) AS total_inscricoes,
                RANK() OVER (ORDER BY count(*) desc) AS ranking_cidades
            FROM tb_inscricoes_cnh_social 
            GROUP BY cidade
            ORDER BY ranking_cidades
SQL
    ],
    37 => [
        "titulo" => "37. Os 5 municípios com maior concentração de inscritos",
        "sql" => <<<SQL
            SELECT cidade, count(*) as inscricoes
            FROM tb_inscricoes_cnh_social
            GROUP BY cidade
            ORDER BY inscricoes DESC
            LIMIT 5
SQL
    ],
    38 => [
        "titulo" => "38. Média diária de inscrições",
        "sql" => <<<SQL
            WITH InscricoesPorDia AS (
                SELECT DATE(created_at) AS dia, COUNT(*) AS total_dia
                FROM tb_inscricoes_cnh_social
                GROUP BY DATE(created_at)
            )       
            SELECT ROUND(AVG(total_dia), 2) AS media_diaria
            FROM InscricoesPorDia
SQL
    ],
    39 => [
        "titulo" => "39. Dia com maior número de inscrições",
        "sql" => <<<SQL
            SELECT DATE(created_at) AS dia, count(*) AS inscricoes
            FROM tb_inscricoes_cnh_social
            GROUP BY dia
            ORDER BY inscricoes DESC
            LIMIT 1
SQL
    ],
    40 => [
        "titulo" => "40. Dia com menor número de inscrições",
        "sql" => <<<SQL
            SELECT DATE(created_at) AS dia, COUNT(*) AS inscricoes
            FROM tb_inscricoes_cnh_social
            GROUP BY DATE(created_at)
            ORDER BY inscricoes ASC
            LIMIT 1
SQL
    ],
    41 => [
        "titulo" => "41. Acumulado de inscrições por dia",
        "sql" => <<<SQL
            WITH SomaInscricoes AS (
                SELECT 
                    date(created_at) AS data_inscricoes,
                    COUNT(*) AS inscricoes
                FROM tb_inscricoes_cnh_social
                GROUP BY date(created_at)
            )
            SELECT 
                data_inscricoes, 
                inscricoes,
                sum(inscricoes) OVER (ORDER by data_inscricoes) AS total_acumulado
            FROM SomaInscricoes
            ORDER BY data_inscricoes
SQL
    ],
    42 => [
        "titulo" => "42. Comparar cada município com a média estadual de inscrições",
        "sql" => <<<SQL
            WITH InscricoesCidade AS (
                SELECT cidade, COUNT(id) AS total_municipio
                FROM tb_inscricoes_cnh_social
                GROUP BY cidade
            ),
            MediaGeral AS (
                SELECT AVG(total_municipio) AS media_geral
                FROM InscricoesCidade 
            )
            SELECT 
                c.cidade,
                c.total_municipio,
                ROUND(m.media_geral, 2) AS media_geral,
                ROUND(c.total_municipio - m.media_geral, 2) AS diferenca_media 
            FROM InscricoesCidade c 
            CROSS JOIN MediaGeral m
            ORDER BY c.cidade
SQL
    ],
    43 => [
        "titulo" => "43. Municípios acima da média estadual",
        "sql" => <<<SQL
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
            ORDER BY c.quantidade_inscricoes DESC
SQL
    ],
    44 => [
        "titulo" => "44. Municípios abaixo da média estadual",
        "sql" => <<<SQL
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
            ORDER BY c.quantidade_inscricoes DESC
SQL
    ]
];
?>