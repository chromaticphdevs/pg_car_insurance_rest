<?php

	class Model
	{

		protected $database;
		protected $stringHelper;

		protected $errors = [];

		public function __construct()
		{
			$this->database = new Database();
		}

		/*
		*valid fields and user input must be an array
		*/
		protected function validateInsertFields($validFields = [], $userInput = [] , $requiredFields = [])
		{
			$errors = [];

			if( !is_array($validFields) && !is_array($userInput))
				echo die("INVALID PARAMETER VALUES");

			$userInputFields = array_keys($userInput);

			foreach($userInputFields as $inputKey)
			{
				if ( ! in_array($inputKey , $validFields) )
					$errors [] = "{$inputKey} is not a valid input key";
			}

			/*
			*if required field is set then
			*check if all required fields are filled in
			*/
			if( !empty($requiredFields) )
			{
				foreach($requiredFields as $reqField) {
					if( !in_array($reqField , $userInputFields))
						$errors[] = "{$reqField} is a required field!";
				}
			}

			if( !empty($errors) )
			{
				$this->errors = $errors;
				return false;
			}
			return true;
		}

		/*
		*shorthand of database->insert
		*/

		public function insert($data)
		{
			return $this->database->insert( $this->table , $data);
		}

		/*
		*shorthand of database->update
		*/

		public function update($fieldsAndValues , $where = null)
		{
			return $this->database->update( $this->table , $fieldsAndValues , $where);
		}

		/*
		*shorthand of database->update
		*where using as id
		*/
		public function updateWithId($fieldsAndValues , $id)
		{
			return $this->update( $fieldsAndValues , [
				'id' => $id
			]);
		}

		/*
		*get a single data using 
		*id column
		*/
		public function get($id)
		{	
			return $this->getRow([
				'id' => $id
			]);
		}


		/*
		*Use to get single data
		*/
		public function getRow($where = null)
		{	
			$WHERE = $this->createWhereCondition($where);
			$this->database->query( "SELECT * FROM {$this->table} {$WHERE}" );
			return $this->database->getRow();
		}

		/*
		*use to get multiple rows
		*returns array of object
		*/
		public function getRows($where = null , $orderBy = null)
		{
			$WHERE = $this->createWhereCondition($where);
			$this->database->query( "SELECT * FROM {$this->table} {$WHERE}");
			return $this->database->getRows();
		}

		public function createWhereCondition( $where = null)
		{
			$WHERE_SQL = null;

			if( !is_null($where))
			{
				if( is_array( $where) ) 
				{
					$WHERE_SQL = " WHERE ";
					$WHERE_SQL .= $this->database->conditionEqual($where);
				}else{
					$WHERE_SQL = "WHERE {$where}";
				}
			}

			return $WHERE_SQL;
		}

		public function addError($err)
		{
			$this->errors [] = $err;
		}

		public function getErrors()
		{
			return $this->errors;
		}


		public function getErrorMessage()
		{
			return implode(',',$this->errors);
		}
	}