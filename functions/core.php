<?php
	/*
	*Core functions always starts with '_' prefix
	*/

	function _returnAndRequire($path, $file)
	{
		$source = $path.DS.$file.'.php';
        if(file_exists($source))
            return require_once $source;
	}


	function _curl($url , $data)
	{
		//url-ify the data for the POST
		$fields_string = http_build_query($data);

		//open connection
		$ch = curl_init();

		//set the url, number of POST vars, POST data
		curl_setopt($ch,CURLOPT_URL, $url);
		curl_setopt($ch,CURLOPT_POST, 1);
		curl_setopt($ch,CURLOPT_POSTFIELDS, $fields_string);

		//execute post
		$result = curl_exec($ch);
		//close connection
		curl_close($ch);
		
		return $result;
	}

	function _loadModel($model)
	{
		$model = ucwords($model);
		$fullPath = PATH_MODELS.DS.$model.'.php';

		if( !file_exists($fullPath) )
			echo die("MODEL:{$model} does not exists");

		require_once $fullPath;

		$model = new $model();
		
		return $model;
	}

	function _error($errors = [])
	{
		print_r($errors);
		die();
	}
?>