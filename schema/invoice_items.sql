drop table if exists invoice_items;
create table invoice_items(
	id serial primary key,
	invoice_id int,
	name varchar(100),
	description text,
	amount decimal(10,2),
	quantity int
);