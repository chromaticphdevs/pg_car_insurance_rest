<?php

	class UserModel extends Model
	{

		protected $table = 'users';

		private $validFields = [
			'first_name' , 'last_name',
			'email' , 'password'
		];

		public function create($userData = [])
		{	

			$validateInsert = $this->validateInsertFields($this->validFields , $userData);

			if( !$validateInsert ) return false;

			if( isset($userData['password']) )
				$userData['password'] = password_hash($userData['password'], PASSWORD_DEFAULT);

			$user = $this->getByEmail( $userData['email']);

			if( $user ){
				$this->addError("Email already used");
				return false;
			}

			$res = $this->insert($userData );

			return $res;
		}


		public function getByEmail($email)
		{
			return $this->getRow([
				'email' => $email
			]);
		}


		public function getAll()
		{
			return $this->getRows();
		}

		public function getAllComplete()
		{
			$users = $this->getAll();

			if(!$users){
				$this->addError("No users found");
				return false;
			}
			
			$carModel = _loadModel('CarModel');

			foreach($users as $user) {
				$user->cars = $carModel->getByOwner($user->id);
			}

			return $users;
		}


		public function getWithCars($id)
		{
			$user = $this->get($id);

			if(!$user){
				$this->addError("User not found!");
				return false;
			}
			$carModel = _loadModel('CarModel');
			/*
			*get user cars
			*/
			$cars = $carModel->getByOwner($user->id);
			//store cars
			$user->cars = $cars;
			return $user;
		}

		public function getComplete($id)
		{
			$user = $this->get($id);

			if(!$user){
				$this->addError("User not found!");
				return false;
			}
			$carModel = _loadModel('CarModel');
			/*
			*get user cars
			*/
			$cars = $carModel->getByOwner($user->id);
			//store cars
			$user->cars = $cars;

			$user->bills = [
				"Comming Soon"
			];

			$user->payments = [
				"Comming Soon"
			];

			return $user;
		}
	}