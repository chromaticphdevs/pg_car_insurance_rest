/*
*Automatically created by the system
*to be sent on car_owners
*/

drop table if exists invoices;
create table invoices(
	id serial primary key,
	owner_id int,
	car_id int,
	amount decimal(10 ,2),
	release_date date,
	due_date date,
	created_at timestamp default now()
);