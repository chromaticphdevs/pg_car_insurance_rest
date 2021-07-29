drop table if exists cars;
create table cars(
	id serial primary key,
	owner_id int,
	plate_number varchar(25),
	brand_id int,
	model varchar(100),
	color varchar(100),
	condition enum('brand new' , 'used'),
	created_at timestamp default now(),
	updated_at timestamp default now()
);