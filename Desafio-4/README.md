USE db_cnh_social; 


CREATE TABLE tb_inscricoes_cnh_social (
    id INT PRIMARY KEY AUTO_INCREMENT,
    cpf VARCHAR(14), 
    nis VARCHAR(12),
    data_nascimento VARCHAR(50),
    nome_completo VARCHAR(100),
    endereco VARCHAR(150),
    numero VARCHAR(20),
    complemento VARCHAR(255),
    bairro VARCHAR(100),
    cep VARCHAR(20),
    cidade VARCHAR(100),
    estado VARCHAR(50),
    telefone VARCHAR(50),
    email VARCHAR(150),
    categoria_desejada VARCHAR(50),
    eh_pcd VARCHAR(20),
    numero_protocolo VARCHAR(50),
    created_at VARCHAR(50),
    updated_at VARCHAR(50),
    status_Email VARCHAR(50),
    data_email VARCHAR(50)
);


-- 5 - Listar todos os registros cadastrados.

select * 

from tb_inscricoes_cnh_social;

-- 6 - Consultar apenas nome_completo, cpf, cidade e categoria_desejada

select nome_completo, 
cpf, 
cidade,
categoria_desejada
from tb_inscricoes_cnh_social;

-- 7- Listar todos os candidatos da cidade de São Luís

select * 
from tb_inscricoes_cnh_social 
where cidade = 'São Luís' and bairro = 'São Francisco' 
order by nome_completo asc;

-- 8-  Listar candidatos que desejam categoria B

select * 
from tb_inscricoes_cnh_social 
where categoria_desejada = 'B';

-- 9-   Listar candidatos que são PCD

select * 
from tb_inscricoes_cnh_social 
where eh_pcd = '1';

-- 9-   Listar candidatos cujo e-mail já foi enviado.

select * 
from tb_inscricoes_cnh_social 
where status_email = '1';

-- 11. Ordenar os candidatos por nome_completo em ordem alfabética

select * 
from tb_inscricoes_cnh_social 
order by nome_completo ASC;

-- 12. Consultar candidatos nascidos após 01/01/2000.

select * 
from tb_inscricoes_cnh_social 
where str_to_date(data_nascimento, '%d/%m/%Y') >= '2000-01-01' 
order by data_nascimento asc;


-- 13. Consultar candidatos maiores de idade.

select * 
from tb_inscricoes_cnh_social 
where str_to_date(data_nascimento, '%d/%m/%Y') <= curdate()
order by data_nascimento desc;


-- 14. Consultar candidatos cadastrados no dia 03/10/2025.

select * 
from tb_inscricoes_cnh_social 
where str_to_date(created_at, '%d/%m/%Y') = '2025-10-03' 
order by created_at desc;


-- 15. Consultar candidatos que receberam e-mail no dia 06/10/2025.

select * 
from tb_inscricoes_cnh_social 
where str_to_date(data_email, '%d/%m/%Y') = '2025-10-06' 
order by data_email desc;

-- 16. Exibir nome, data de nascimento e idade aproximada de cada candidato.

select nome_completo, data_nascimento, timestampdiff (year, str_to_date(data_nascimento, '%d/%m/%Y'), curdate()) as idade_aproximada
from tb_inscricoes_cnh_social;


-- 17. Contar quantos candidatos existem por cidade.

select  cidade, count(*) as total
from tb_inscricoes_cnh_social
group by cidade
order by cidade asc;

SELECT sum(id) as total FROM tb_inscricoes_cnh_social;

-- 18. Contar quantos candidatos existem por bairro.

select  bairro, COUNT(*) as total
from tb_inscricoes_cnh_social
group by bairro
order by total desc;

-- 19. Contar quantos candidatos existem por categoria desejada.

select * categoria_desejada, COUNT(*) as total
from tb_inscricoes_cnh_social
group by categoria_desejada
order by total desc;

-- 20. Contar quantos candidatos tiveram e-mail enviado e quantos não tiveram.

select *  status_email, COUNT(*) as total
from tb_inscricoes_cnh_social
group by status_email
order by total desc



-- 21. Contar quantos candidatos são PCD e quantos não são.


select eh_pcd, COUNT(*) as total
from tb_inscricoes_cnh_social
group by eh_pcd
order by total desc;


-- 22. Verificar se existe CPF duplicado.]


select cpf, COUNT(*)
from tb_inscricoes_cnh_social
group by cpf
having COUNT(*) > 1;



-- 23. Verificar se existe NIS duplicado.

select nis, COUNT(*) 
from tb_inscricoes_cnh_social
group by nis
having COUNT(*) > 1;



-- 24. Verificar se existe número de protocolo duplicado.

select numero_protocolo, COUNT(*) 
from tb_inscricoes_cnh_social
group by numero_protocolo
having COUNT(*) > 1;



-- 25. Listar registros com telefone vazio ou inválido.

select * 
from tb_inscricoes_cnh_social 
where telefone is null;


-- 26. Listar registros com e-mail vazio ou sem @.


select * 
from tb_inscricoes_cnh_social
where email is null or email = '' or email not like '%@%';




-- 27. Listar registros com CEP fora do padrão esperado.




-- 28. Criar consulta exibindo Nome, CPF, Cidade, Bairro, Categoria e Situação do E-mail utilizando CASE.


-- 29. Criar relatório por cidade contendo Total de Inscritos, Total PCD e Total de E-mails Enviados.


-- 30. Criar consulta para identificar candidatos prioritários (PCD, maiores de idade, com email enviado e categoria preenchida).



