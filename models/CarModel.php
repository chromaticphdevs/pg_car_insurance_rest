<?php

	class CarModel extends Model
	{
		public $table = 'cars';


		private $validFields = [
			'owner_id' , 'plate_number',
			'brand_id' , 'model',
			'color'    , 'condition'
		];

		private $requiredFields = [
			'plate_number' , 'brand_id' ,
			'model' , 'color' , 'condition'
		];

		public function create($carData)
		{
			$validateInsert = $this->validateInsertFields($this->validFields , $carData , $this->requiredFields);

			if( !$validateInsert ) return false;

			/*
			*check if car already exists
			*/
			$car = $this->getByPlate( $carData['plate_number'] );

			if( $car) {
				$this->addError("Car with '{$car->plate_number}' plate number already exists!");
				return false;
			}

			/*
			*check if car owner really exists
			*/

			//load user model
			$userModel = _loadModel("UserModel");
			$user = $userModel->get($carData['owner_id']);

			if( !$user ){
				$this->addError("Car owner does not exists!");
				return false;
			}

			return $this->insert( $carData );
		}

		public function updateComplete($carData , $where = null)
		{
			/*
			*Include id on required fields
			*/
			$validFields = array_merge($this->validFields, ['id']);

			$validateInsert = $this->validateInsertFields($validFields , $carData , $this->requiredFields);

			if( !$validateInsert ) return false;

			return $this->updateWithId($carData , $carData['id']);
		}


		public function delete($carId)
		{
			$car = $this->get($carId);

			if(!$car){
				$this->addError("Car does not exists");
				return false;
			}
			return $this->database->delete( $this->table , $carId);
		}

		public function getByPlate($plateNumber)
		{
			return $this->getRow([
				'plate_number' => $plateNumber
			]);
		}

		public function getAll()
		{
			return $this->getRows();
		}

		public function getByOwner($ownerId)
		{
			return $this->getRows([
				'owner_id' => $ownerId
			]);
		}

		public function getWithSubscription($carId)
		{
			$car = $this->get($carId);

			if(!$car){
				$this->addError("Car does not exist");
				return false;
			}

			/*load subscription model*/
			$subscriptionModel = _loadModel('SubscriptionModel');

			$car->subscription = $subscriptionModel->getByCar($car->id);


			return $car;
		}
	}