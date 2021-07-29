<?php

	class User extends Controller
	{	
		private $links = [];

		public function __construct()
		{
			parent::__construct();

			$this->user = $this->model('UserModel');

			$url = URL.DS.'User'.DS;

			$this->links = [
				$url.'create',
				$url.'getAll',
				$url.'get/{$id}',
				$url.'getAllComplete',
				$url.'getComplete/{$id}'
			];
		}

		public function index()
		{
			return $this->getAll();
		}


		public function create()
		{
			$retVal = [];

			$post = $this->request->posts();
			$res = $this->user->create($post['data']);

			if( !$res )
				return $this->response->json(false, [
					'errors' => $this->user->getErrors()
				]);
			return $this->response->json("User Registered" , [
				'links' => $this->links,
				'viewUser' => URL.DS.'User/get/'.$res,
				'userId' => $res
			]);
		}

		public function getAll()
		{
			$users = $this->user->getAll();

			$this->response->json($users , [
				'links' => $this->links
			]);
		}


		public function get($id)
		{
			$user= $this->user->get($id);

			$this->response->json($user , [
				'links' => $this->links
			]);
		}

		public function getAllComplete()
		{
			$users = $this->user->getAllComplete();

			$this->response->json($users , [
				'links' => $this->links
			]);
		}

		public function getWithCars($id)
		{
			$user = $this->user->getWithCars($id);

			return $this->response->json($user);
		}

		public function getComplete($id)
		{
			$user = $this->user->getComplete($id);

			$this->response->json($user);
		}
	}