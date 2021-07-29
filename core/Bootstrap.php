<?php
	
	/*
	*This class controlls the routing of the system
	*extracts url to get the request
	*/
	class Bootstrap
	{
		private $controller = BOOTSTRAP_BASE_CONTROLLER;
		private $method = BOOTSTRAP_BASE_METHOD;


		private $url = null;

		public function __construct()
		{
			$url = $this->getURL();

			//check if controller exists
			if( isset($url[0]) )
				$this->controller = ucwords($url[0]);

			//check if controller exists in file
			$controllerFullPath = PATH_CONTROLLERS.DS.$this->controller.'.php';

			if( !file_exists( $controllerFullPath ) )
				return _error("Controller : {$this->controller} Not found!");
			
			/*incluce controller fullpath*/
			require_once $controllerFullPath;
			unset($url[0]);
			//initialize controller
			$this->controller = new $this->controller;

			//check if method exists
			if( isset( $url[1]) ){
				$this->method = $url[1];
				unset($url[1]);
			}

			$this->params = $url ? array_values($url) : [];

			try{
				if( !method_exists($this->controller, $this->method))
					throw new Exception("api end point does not exists!", 1);
				call_user_func_array([$this->controller , $this->method], $this->params);
			}catch(Exception $e){
				_error( $e->getMessage() );
			}
		}

		/*
		*fetch url and converts it to array
		*domain.com/controller/method
		*this parameters will be stored in GET GLOBAL named 'url' as defined in HTACCESS
		*/
		private function getURL()
		{

			if(isset($_GET['url'])){

				$url = $_GET['url']; $url = rtrim($url , '/');

	            $url = filter_var($url , FILTER_SANITIZE_URL); 
	            $url = explode('/',$url);

	            return $url;
			}

			else{
				return FALSE;
			}
		}
	}