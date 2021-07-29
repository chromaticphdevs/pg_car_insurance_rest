drop table if exists subscriptions;
create table subscriptions(
	id serial primary key,
	subscription_type_id int,
	car_id int ,
	referral_id int,
	subscription_date date,
	created_by int,
	status enum('Active' , 'Terminated' , 'Cancelled'),
	created_at timestamp default now()
);

/*
create 5 cars with subscription
*/