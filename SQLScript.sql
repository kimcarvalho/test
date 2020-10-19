-- creating a new database (clientes)
create database database_name;

-- using database for create tables
use database_name;

-- creating table cliente into dabase clientes
create table db_client.client(
	id int auto_increment primary key,
    name varchar(60) not null,
    status char(1) not null check(status = 0 or status = 1)
);

select * from db_client.client;
delete from db_client.client where id > 0;

-- creating table tel_cliente for add all telephones of client
create table db_client.tel_client(
	id int not null primary key auto_increment,
    client_code int not null,
    tel varchar(11) not null,
    
    foreign key (client_code) 
    references db_client.client(id)
);

select * from db_client.tel_client;
delete from db_client.tel_client where id > 0;

-- creating table amail_cliente for add all e-mails of a client
create table db_client.email_client(
	id int not null primary key auto_increment,
    client_code int not null,
    email varchar(50) not null,
    
    foreign key (client_code) 
    references db_client.client(id)
);

-- select all info of client -------------------------------------------------

-- select emails 
select ec.email from 
db_client.client c, 
db_client.email_client ec
where c.id = 29 
and c.id = ec.client_code;

-- select tels 
select tc.tel from 
db_client.client c, 
db_client.tel_client tc
where c.id = 29 
and c.id = tc.client_code; 
