create database amazing;
use amazing;

create table cliente(
    id int auto_increment,
    nome varchar(120) not null,
    nome_usuario varchar(20),
    
    estado char(2) not null,
    cidade varchar(20) not null,
    bairro varchar(20) not null,
    rua varchar(20) not null,
    
    nro_cartao bigint not null,
    nro_seguranca int not null,
    nome_cartao varchar(120) not null,
    data_validade_cartao date not null,
    
    primary key(id)
);

create table compra(
    id int auto_increment,
    idCliente int,
    dataCompra datetime not null,
    foreign key(idCliente) references cliente(id),
    primary key(id)
);

create table produto(
    id int auto_increment,
    nome varchar(20) not null,
    qtdEstoque int not null,
    preco double not null,
    descricao text not null,
    primary key(id)
);

create table produtos_compra(
    id int auto_increment,
    idCompra int,
    idProduto int,
    qtdProduto int not null,
    foreign key(idCompra) references compra(id),
    foreign key(idProduto) references produto(id),
    primary key(id)
);
INSERT INTO produto(nome, qtdEstoque, preco, descricao) VALUES("Maçã", 20, 3, "É uma maçã");
INSERT INTO produto(nome, qtdEstoque, preco, descricao) VALUES("Goiaba", 15, 2.50, "É uma goiaba");
INSERT INTO produto(nome, qtdEstoque, preco, descricao) VALUES("Pera", 2, 9, "É uma pera");
INSERT INTO produto(nome, qtdEstoque, preco, descricao) VALUES("Banana", 5, 6, "É uma banana");
INSERT INTO produto(nome, qtdEstoque, preco, descricao) VALUES("Uva", 7, 10, "É uma uva");
INSERT INTO cliente (nome, nome_usuario, estado, cidade, bairro, rua, nro_cartao, nro_seguranca, nome_cartao, data_validade_cartao) 
VALUES 
('João Silva', 'joaosilva', 'SP', 'São Paulo', 'Centro', 'Rua A', 1234567890123456, 123, 'João Silva', '2023-12-31'),
('Maria Souza', 'mariasouza', 'RJ', 'Rio de Janeiro', 'Copacabana', 'Rua B', 9876543210987654, 456, 'Maria Souza', '2024-10-15'),
('Pedro Oliveira', 'pedro123', 'MG', 'Belo Horizonte', 'Barro Preto', 'Rua C', 4567123409871234, 789, 'Pedro Oliveira', '2023-07-20'),
('Ana Santos', 'aninha22', 'RS', 'Porto Alegre', 'Moinhos de Vento', 'Rua D', 5678123498762345, 234, 'Ana Santos', '2024-04-28'),
('Luiz Costa', 'luizcosta', 'PR', 'Curitiba', 'Batel', 'Rua E', 9876123409875678, 567, 'Luiz Costa', '2023-11-30');
INSERT INTO compra (idCliente, dataCompra) 
VALUES 
(1, '2023-10-05 08:30:00'),
(3, '2023-09-15 14:20:00'),
(2, '2023-10-20 10:45:00'),
(4, '2023-08-07 16:00:00'),
(5, '2023-11-02 12:10:00');
INSERT INTO produto (nome, qtdEstoque, preco, descricao) 
VALUES 
('Camisa', 50, 29.99, 'Camisa de algodão'),
('Calça', 30, 49.99, 'Calça jeans'),
('Tênis', 40, 79.99, 'Tênis esportivo'),
('Boné', 20, 14.99, 'Boné de baseball'),
('Saia', 35, 39.99, 'Saia elegante');
INSERT INTO produtos_compra (idCompra, idProduto, qtdProduto) 
VALUES 
(1, 2, 3),
(1, 3, 2),
(2, 1, 1),
(3, 4, 4),
(4, 5, 2);