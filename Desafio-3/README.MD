# Desafio-3
### 1 - Tabela 1: Pessoas (ID,  Nome, CPF, Data de nascimento, Endereço) 

## SQL:
create table pessoas (
	id_pessoa INT primary key,
	nome_pessoa VARCHAR(50),
	cpf_pessoa VARCHAR(14),
	datanasc_pessoa DATE,
	endereco_pessoa VARCHAR(50)
);

### 2 - Tabela 2: (Documentos da Pessoal, ID, ID da pessoa, Comprovante de residência, Currículo, Certidão de nascimento)

## SQL:
create table documentos (
	id_documentos INT primary key,
	id_pessoas INT,
	comprovanteResidencia_documentos VARCHAR(50),
	curriculo_documentos VARCHAR(50),
	certNasc_documentos VARCHAR(50), 
	foreign key(id_pessoas) references pessoas (id_pessoas)
);

### 3 - Inserir pelo menos 3 pessoas.

##S SQL: 
INSERT INTO pessoas (id_pessoas, nome_pessoa, cpf_pessoa, datanasc_pessoa, endereco_pessoa)
VALUES
(1, 'Kauã Galeno', '123.456.789-20', '2003-10-09', 'Av. Brasil, 67'),
(2, 'Ana Maria', '321.789.456-30', '1992-09-10', 'Av. Colômbia, 76'),
(3, 'Kaneda Kakashi', '123.654.789-40', '1989-04-19', 'Av. Konoha, 60');

### 4 - Inserir os documentos correspondentes a cada pessoa.

## SQL:
insert into documentos (id_documentos, id_pessoas, comprovantResidencia_documentos curriculo_documentos, certNasc_documentos)
values
(1, 1, '/arquivos/comp_residencia_1.pdf', '/arquivos/curriculo_1.pdf', '/arquivos/certidao_1.pdf'),
(2, 2, '/arquivos/comp_residencia_2.pdf', '/arquivos/curriculo_2.pdf', '/arquivos/certidao_2.pdf'),
(3, 3, '/arquivos/comp_residencia_3.pdf', '/arquivos/curriculo_3.pdf', '/arquivos/certidao_3.pdf');

### 5 - Criar uma consulta SQL que retorne os dados da pessoa juntamente com seus documentos.

*nota: imagino que deva ser um select * com todos as colunas + todas as colunas de documentos*

## SQL: 
*SELECT
FROM pessoas
INNER JOIN documentos
ON pessoas.id_pessoas = documentos.id_pessoas*
