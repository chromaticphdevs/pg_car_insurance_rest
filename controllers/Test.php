<?php 

	class Test extends Controller
	{
		public function index()
		{
			$tst = $this->request->posts();

			var_dump($tst);
		}
	}