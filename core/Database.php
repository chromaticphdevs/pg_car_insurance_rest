<?php

	class Database 
	{

		private $host = 'localhost';
		private $db = 'postgres';
		private $user = 'postgres';
		private $password = 'root';

		/*
		*so any model who will extends db will have an acessto the connection
		*/
		private $conn;
		/*
		*Main Database
		*/
		private $dbPrefix = 'car_insurance';

		private $stmt = null;

		private $stringHelper;

		public function __construct()
		{
			$this->stringHelper = new StringHelper();

			try
			{
				$dsn = "pgsql:host={$this->host};port=5432;dbname={$this->db};";

				$this->conn = new PDO($dsn , $this->user, $this->password , [
					PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
				]);

				$this->conn->query("SET search_path TO {$this->dbPrefix}");

			}catch(Exception $e)
			{
				_error("Datbase Error: " . $e->getMessage());
			}

			return $this;
		}


		public function update($tableName , $fieldsAndValues , $where = null)
		{
			$fields = array_keys($fieldsAndValues);
			//clean values
			$values = [];

			if( is_null($where) )
				return _error("Database: Where must be instanciated , update error");

			foreach($fields as $key => $field) 
			{
				//clean inserts for database insert
				$cleanValue = $this->stringHelper->clean( $fieldsAndValues[$field] , FILTER_SANITIZE_STRING);
				array_push($values,  $cleanValue);
			}

			$sql = "UPDATE $tableName SET ";

			$counter = 0;

			foreach($fields as $index => $field)
			{
				if( $counter > 0)
					$sql .=",";
				$sql .= "{$field} = '{$values[$index]}'";
				$counter++;
			}

			$WHERE = ' WHERE ';

			if( is_array($where) ){
				$WHERE .= $this->conditionEqual($where);
			}else{
				$WHERE .= $where;
			}

			$sql .= "{$WHERE}";

			$this->query($sql);
			try{
				return $this->execute();
			}catch(Exception $e)
			{
				_error( $e->getMessage() );
			}
		}
		
		public function insert($tableName , $fieldsAndValues)
		{
			$fields = array_keys($fieldsAndValues);

			$values = array_values($fieldsAndValues);

			$cleansedValues = [] ;
			$retVal = [];

			foreach($values as $key => $val) {
				$cleansedValues[] = $this->stringHelper->clean($val , FILTER_SANITIZE_STRING);
			}

			foreach($fields as $key => $field) {
				$retVal[$field] = $cleansedValues[$key]; 
			}

			$sql = "INSERT INTO $tableName(".implode(",", $fields).")
				VALUES('".implode("','", $cleansedValues)."')";

			$this->query($sql);
			
			try{
				$this->execute();
				return $this->lastInsertId();
			}catch(Exception $e) {
				_error( $e->getMessage() );
			}
		}

		public function delete($tableName , $id)
		{
			$this->query(
				"DELETE FROM {$tableName}
					WHERE id = '{$id}'"
			);
			return $this->execute();
		}

		public function getCon(){
			return $this->conn;
		}

		public function query( $sql ){
			$this->stmt = $this->conn->prepare($sql);
		}

		//execute statement
        public function execute(){
        	return $this->stmt->execute();
        }

        public function lastInsertId()
        {
            return $this->conn->lastInsertId();
        }

        public function getRows()
        {
          $this->execute();
          return $this->stmt->fetchAll(PDO::FETCH_OBJ);
        }

        public function getRow()
        {
            $this->execute();
            return $this->stmt->fetch(PDO::FETCH_OBJ);
        }

        public function conditionEqual($fieldsAndValues = [])
		{
			$sql = "";

			$counter = 0;

			foreach($fieldsAndValues as $field => $key) 
			{
				if( $counter > 1)
					$sql .= "&";

				$sql .= "{$field} = '{$key}'";
				$counter++;
			}

			return $sql;
		}
	}