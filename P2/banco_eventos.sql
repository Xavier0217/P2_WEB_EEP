-- sql inguagen de consulta estruturada
-- Structured Query Languge

Create Database Eventos_Escola; -- criar um banco de dados com nome Eventos_Escola
Use Eventos_Escola; -- selecionar o banco Eventos_Escola para uso

-- criar tabela usuarios 
create table Usuarios
(
   id int auto_increment primary key,
   nome varchar(100),
   email varchar(100),
   senha varchar(20)
);

-- criar tabela eventtos
create table Eventos
(
   id int auto_increment primary key,
   titulo varchar(100),
   descricao varchar(200),
   localizacao varchar(100),
   data_evento int,
   horario int,
   categoria varchar(50),
   imagem varchar(255),
   usuario_id int,
   FOREIGN KEY (usuario_id) REFERENCES usuarios(id)
);  