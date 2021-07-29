drop table if exists subscription_types;

create TYPE types as enum('Basic' , 'VIP' , 'Premium');
create table subscription_types(
	id serial primary key,
	type types,
	description text,
	base_price decimal(10 ,2),
	created_at timestamp default now(),
	updated_at timestamp default now()
);

