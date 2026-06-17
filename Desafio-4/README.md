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

*-- 5 - Listar todos os registros cadastrados.*
select * from tb_inscricoes_cnh_social;

*-- 6 - Consultar apenas nome_completo, cpf, cidade e categoria_desejada.*
select nome_completo, 
cpf, 
cidade,
categoria_desejada
from tb_inscricoes_cnh_social;

*-- 7- Listar todos os candidatos da cidade de São Luís.*
select * from tb_inscricoes_cnh_social where cidade = 'São Luís' and bairro = 'Vicente Fialho' order by nome_completo asc;

*-- 8-  Listar candidatos que desejam categoria B.*
select * from tb_inscricoes_cnh_social where categoria_desejada = 'B';

*-- 9-   Listar candidatos que são PCD.*
select * from tb_inscricoes_cnh_social where eh_pcd = '1';

*-- 10-   Listar candidatos cujo e-mail já foi enviado.*
select * from tb_inscricoes_cnh_social where status_email = '1';

*-- 11. Ordenar os candidatos por nome_completo em ordem alfabética.*
select * from tb_inscricoes_cnh_social order by nome_completo ASC;

*-- 12. Consultar candidatos nascidos após 01/01/2000.*

*-- 13. Consultar candidatos maiores de idade.*

*-- 14. Consultar candidatos cadastrados no dia 03/10/2025.*
select * from tb_inscricoes_cnh_social where created_at = '03/10/2025';

*-- 15. Consultar candidatos que receberam e-mail no dia 06/10/2025.*
select * from tb_inscricoes_cnh_social where data_email = '06/10/2025';

*-- 16. Exibir nome, data de nascimento e idade aproximada de cada candidato.*

*-- 17. Contar quantos candidatos existem por cidade.*

*-- 18. Contar quantos candidatos existem por bairro.*

*-- 19. Contar quantos candidatos existem por categoria desejada.*

*-- 20. Contar quantos candidatos tiveram e-mail enviado e quantos não tiveram.*

*-- 21. Contar quantos candidatos são PCD e quantos não são.*

*-- 22. Verificar se existe CPF duplicado.*

*-- 23. Verificar se existe NIS duplicado.*

*-- 24. Verificar se existe número de protocolo duplicado.*

*-- 25. Listar registros com telefone vazio ou inválido.*

*-- 26. Listar registros com e-mail vazio ou sem @.*

*-- 27. Listar registros com CEP fora do padrão esperado.*

*-- 28. Criar consulta exibindo Nome, CPF, Cidade, Bairro, Categoria e Situação do E-mail utilizando CASE.*

*-- 29. Criar relatório por cidade contendo Total de Inscritos, Total PCD e Total de E-mails Enviados.*

*-- 30. Criar consulta para identificar candidatos prioritários (PCD, maiores de idade, com email enviado e categoria preenchida).*
