<?php

	class Controller extends Bootstrap
	{

		protected $response = null;


		public function __construct()
		{
			$this->response = new Response();
			$this->request  = new Request();
		}
		
		public function model($model)
		{
			return _loadModel($model);
		}
		
	}