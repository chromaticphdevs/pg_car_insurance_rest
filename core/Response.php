<?php

	class Response
	{	
		public $test = 'tite';

		public function json($data , $attributes = [])
		{
			header('Content-Type: application/json');

			$retVal = [];

			$retVal['result'] = $data;

			$retVal = array_merge($retVal , $attributes);

			echo json_encode($retVal);
		}
	}