drop table if exists users;

create table users(
	id serial primary key ,
	first_name varchar(100),
	last_name varchar(100),
	email varchar(100),
	password varchar(255),
	created_at timestamp default now(),
	updated_at timestamp default now()
);