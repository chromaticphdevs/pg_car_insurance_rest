<?php 

	require_once 'functions/core.php';
	require_once 'config/env.php';

	$url = URL;

	/*
	*will be used to access api 
	*/
	$access = [
		'key' => 'MARK_GONZALES',
		'secret' => 'YOU_ARE_HIRED!!!'
	];
	/*
	*************************
	*UNCOMMENT TO TEST FUNCTIONALITY
	*************************/

	//create new user

	$data =[
		'access' => $access,

		'data' => [
			'first_name' => 'Steve',
			'last_name'  => 'Jobs',
			'email'      => 'stevejobs@gmail.com',
			'password'   => '1111'
		] 
	];

	$res = _curl("{$url}/user/create" , $data);
	
	
	//Create new car
	
	$data =[
		'access' => $access,

		'data' => [
			'owner_id' => 1,
			'plate_number'  => 'NDHA-312',
			'brand_id'      => '1',
			'model'   => '2016 Ford Mustang',
			'color'   => 'Matt Black',
			'condition' => 'brand new'
		] 
	];

	$res = _curl("{$url}/car/create" , $data);

	/*
	*UPDATE CAR
	*/

	// $data =[
	// 	'access' => $access,

	// 	'data' => [
	// 		'owner_id' => '52',
	// 		'plate_number'  => '661231',
	// 		'brand_id'      => '3',
	// 		'model'   => '1965 Ford Futura',
	// 		'color'   => 'Red & white',
	// 		'condition' => 'used',
	// 		'id'   => 4
	// 	],
	// ];

	// $res = _curl("{$url}/car/update" , $data);


	/*
	*DELETE CAR
	*/

	// $data =[
	// 	'access' => $access,
	// 	'data' => [
	// 		'id'   => 4
	// 	],
	// ];

	// $res = _curl("{$url}/car/delete" , $data);
	