<?php

	class Request
	{
		/*
		*TEMPORARY
		*VALID KEY AND SECRET
		*/
		private $validKey = 'MARK_GONZALES';
		private $validSecret = 'YOU_ARE_HIRED!!!';

		public function __construct()
		{
			$this->request = $_REQUEST;
			$this->method  = $_SERVER['REQUEST_METHOD'];

			$this->runTimeVars = [
				'url' , 'phpsessid' , ''
			];
		}


		/*
		*Post request checks if
		*access parameter is set
		*then verify if values are correct
		*/
		public function posts()
		{
			$method = $this->method;

			if(strtolower($method) !== 'post')
				echo die("Invalid Request!");

			$requestParams = $this->getRequestParameters();

			if( !isset( $requestParams['access']))
			{
				//kill the page if request does not exist
				_error([
					"REQUEST: Request access must be instanciated",
					$requestParams
				]);
			}

			$this->checkAccess( $requestParams['access'] );


			return $requestParams;
		}

		private function getRequestParameters()
		{	
			$method = strtolower($this->method);

			//holds return data
			$retVal = [];

			$fields = [];

			if(strtolower($method) === 'post'){
				$fields = $_POST;
			}else if( $method === 'get'){
				$fields = $_GET;
			}else{
				_error([
					"Invalid Request!"
				]);
			}

			foreach($_POST as $key => $row) 
			{
				/*
				*skip runtine variables
				*/
				if( in_array(strtolower($key) , $this->runTimeVars ))
					continue;

				$retVal[$key] = $row;
			}

			return $retVal;
		}

		/*
		*secret and key
		*/
		private function checkAccess($access = [])
		{
			$key = $access['key'] ?? '';
			$secret = $access['secret'] ?? '';

			if( $key == $this->validKey && $secret == $this->validSecret)
				return true;

			_error([
				"Invalid Request Access!!",
				$access
			]);
			
			return false;
		}
	}