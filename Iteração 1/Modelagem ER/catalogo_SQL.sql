create table produtos(
	idProduto serial primary key,
	nome varchar(50) not null,
	preco decimal(10,2) not null,
	idCategoria integer not null,
	constraint idCategoriaFK foreign key (idCategoria) references categorias(idCategoria)
);

create table categorias(
	idCategoria serial primary key,
	descricao varchar(50) not null
);

insert into produtos (nome, preco, idCategoria) values ('Bolo de Chocolate', 1.50, 1),
						       ('Pão de Queijo', 2.50, 3),
						       ('Coca-Cola', 2.00, 2),
						       ('Água Mineral - Sem Gás', 2.20, 2),
						       ('Bolo de Cenoura', 2.00, 1);

insert into categorias (descricao) values ('bolos'),
			      ('bebidas'),
			      ('salgados');