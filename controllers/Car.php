<?php 

	class Car extends Controller
	{

		private $links;

		public function __construct()
		{
			parent::__construct();

			$this->car = $this->model('CarModel');

			$url = URL.DS.'Car'.DS;

			$this->links = [
				$url.'getAll',
				$url.'create',
				$url.'get/{$id}',
				$url.'getAllComplete',
				$url.'getComplete/{$id}'
			];
		}

		public function index()
		{
			$this->getAll();
		}


		public function get($id)
		{
			$car = $this->car->getWithSubscription($id);

			if(!$car) 
				return $this->response->json(false, [
					'error' => 'Car does not exists',
					'links' => $this->links
				]);

			return $this->response->json($car , [
				'links' => $this->links
			]);
		}


		public function create()
		{
			$post = $this->request->posts();

			$res = $this->car->create($post['data']);

			if(!$res)
				return $this->response->json(false, [
					'error' => $this->car->getErrors()
				]);

			return $this->response->json("Car Created" , [
				'carId' => $res,
				'links' => $this->links
			]);
		}

		public function update()
		{
			$post = $this->request->posts();
			$res = $this->car->updateComplete( $post['data'] );

			return $this->response->json($res , [
				'errors' => $this->car->getErrors()
			]);
		}


		public function delete()
		{
			$post = $this->request->posts();
			
			if( !isset($post['data']['id']) )
				return $this->response->json(false , [
					'errors' => 'Invalid request',
					'links' => $this->links
				]);

			$res = $this->car->delete( $post['data']['id'] );

			if(!$res)
				return $this->response->json(false , [
					'errors' => $this->car->getErrors()
				]);

			return $this->response->json("Car Deleted" , [
				'links' => $this->links
			]);
		}


		public function getAll()
		{
			$cars = $this->car->getAll();

			return $this->response->json($cars);
		}
	}