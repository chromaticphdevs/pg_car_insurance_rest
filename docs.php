<?php
	require_once 'config/env.php';
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
	<title>Documentation</title>

	<style type="text/css">
		body
		{
			font-size: .80em;
		}

		span
		{
			padding: 1px 5px;
			border-radius: 5px;
			font-size: .75em;
		}
		.param-type
		{
			background: #D3DE32;
			
		}

		.info{
			background: #4B778D;
			color: #fff;
		}

		table h5{
			font-size: .90em;
		}
		.important
		{
			background: #BB3B0E;
			color: #fff;
		}

		#codeExample
		{
			background: #151515;
			padding: 10px;
			color: #fff;
		}
	</style>
</head>
<body>

<ul>
	<li><h4>Pages</h4></li>
	<li><a href="?view=docexp">Example Docs</a></li>
	<li><a href="?view=folderstructure">Folder Docs</a></li>
</ul>
<?php if( ($_GET['view'] ?? 'docexp')  == 'docexp') :?>
<div class="row container-fluid align-items-start">
		<div class="col-md-8">
			<section>
				<h1>Available End Points</h1>
				<div class="sec-content" id="userEpoint">
					<?php $url = URL.DS.'User'.DS?>
					<a href="#"><h3>User</h3></a>
					<div class="hidden active">
						<table class="table table-bordered">
							<thead>
								<th>Action</th>
								<th>End Point</th>
								<th>Parameters</th>
								<th>Request</th>
							</thead>

							<tbody>
								<tr>
									<td>Get Single</td>
									<td>
										<?php echo $url.'get/{id}'?>
									</td>
									<td>
										<h5>Query Parameters</h5>
										<ul>
											<li>Id <span class="param-type">Text</span> </li>
										</ul>
									</td>
									<td>
										<span class="info">GET</span>
									</td>
								</tr>

								<tr>
									<td>Get With Cars</td>
									<td>
										<?php echo $url.'getWithCars/{id}'?>
									</td>
									<td>
										<h5>Query Parameters</h5>
										<ul>
											<li>Id <span class="param-type">Text</span> </li>
										</ul>
									</td>
									<td>
										<span class="info">GET</span>
									</td>
								</tr>

								<tr>
									<td>Get Complete</td>
									<td>
										<?php echo $url.'getComplete/{id}'?>
									</td>
									<td>
										<h5>Query Parameters</h5>
										<ul>
											<li>Id <span class="param-type">Text</span> </li>
										</ul>
									</td>
									<td>
										<span class="info">GET</span>
									</td>
								</tr>


								<tr>
									<td>Get All</td>
									<td>
										<?php echo $url.'getAll'?>
									</td>
									<td></td>
									<td>
										<span class="info">GET</span>
									</td>
								</tr>

								<tr>
									<td>Create</td>
									<td>
										<?php echo URL.DS.'User/create'?>
									</td>
									<td>
										<span class="important">Required Access Param</span>
										<h5>Query Parameters</h5>
										<ul>
											<li>first_name <span class="param-type">Text</span> </li>
											<li>last_name <span class="param-type">Text</span></li>
											<li>email <span class="param-type">Text</span></li>
											<li>password <span class="param-type">Text</span></li>
										</ul>
									</td>
									<td>
										<span class="info">POST</span>
									</td>
								</tr>
								<tr>
									<td>Update</td>
									<td>
										<?php echo $url.'create'?>
									</td>
									<td>
										<span class="important">
											Required Access Param
										</span>
										<h5>Query Parameters</h5>
										<ul>
											<li>first_name <span class="param-type">Text</span> </li>
											<li>last_name <span class="param-type">Text</span></li>
											<li>email <span class="param-type">Text</span></li>
											<li>password <span class="param-type">Text</span></li>
											<li>id <span class="param-type">Text</span></li>
										</ul>
									</td>
									<td>
										<span class="info">POST</span>
									</td>
								</tr>
								<tr>
									<td>Delete</td>
									<td>
										<?php echo $url.'delete'?>
									</td>
									<td>
										<span class="important">
											Required Access Param
										</span>
										<h5>Query Parameters</h5>
										<ul>
											<li>id <span class="param-type">Text</span> </li>
										</ul>
									</td>
									<td>
										<span class="info">POST</span>
									</td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>

				<div class="sec-content" id="userEpoint">
					<?php $url = URL.DS.'Car'.DS?>
					<a href="#"><h3>Car</h3></a>
					<div class="hidden">
						<table class="table table-bordered">
							<thead>
								<th>Action</th>
								<th>End Point</th>
								<th>Parameters</th>
								<th>Request</th>
							</thead>

							<tbody>
								<tr>
									<td>Get Single</td>
									<td>
										<?php echo $url.'get/{id}'?>
									</td>
									<td>
										<h5>Query Parameters</h5>
										<ul>
											<li>Id <span class="param-type">Text</span> </li>
										</ul>
									</td>
									<td>
										<span class="info">GET</span>
									</td>
								</tr>


								<tr>
									<td>Get All</td>
									<td>
										<?php echo $url.'getAll'?>
									</td>
									<td></td>
									<td>
										<span class="info">GET</span>
									</td>
								</tr>

								<tr>
									<td>Create</td>
									<td>
										<?php echo $url.'create'?>
									</td>
									<td>
										<span class="important">Required Access Param</span>
										<h5>Query Parameters</h5>
										<ul>
											<li>owner_id <span class="param-type">Text</span> </li>
											<li>plate_number <span class="param-type">Text</span></li>
											<li>brand_id <span class="param-type">Text</span></li>
											<li>model <span class="param-type">Text</span></li>
											<li>condition <span class="param-type">Text</span></li>
										</ul>
									</td>
									<td>
										<span class="info">POST</span>
									</td>
								</tr>
								<tr>
									<td>Update</td>
									<td>
										<?php echo $url.'update'?>
									</td>
									<td>
										<span class="important">
											Required Access Param
										</span>
										<h5>Query Parameters</h5>
										<ul>
											<li>owner_id <span class="param-type">Text</span> </li>
											<li>plate_number <span class="param-type">Text</span></li>
											<li>brand_id <span class="param-type">Text</span></li>
											<li>model <span class="param-type">Text</span></li>
											<li>condition <span class="param-type">Text</span></li>
											<li>id <span class="param-type">Text</span></li>
										</ul>
									</td>
									<td>
										<span class="info">POST</span>
									</td>
								</tr>
								<tr>
									<td>Delete</td>
									<td>
										<?php echo $url.'delete'?>
									</td>
									<td>
										<span class="important">
											Required Access Param
										</span>
										<h5>Query Parameters</h5>
										<ul>
											<li>id <span class="param-type">Text</span> </li>
										</ul>
									</td>
									<td>
										<span class="info">POST</span>
									</td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
			</section>
		</div>

		<div class="col-md-4" id="codeExample">
			<h4>Request Examples</h4>					
	<pre>
		/*
		*paramter structure/format
		*/

		$data =[
			'access' => [
				'key' => 'MARK_GONZALES',
				'secret' => 'YOU_ARE_HIRED!!!'
			],

			'data' => [
				'first_name' => 'Thomp',
				'last_name'  => 'Kelson',
				'email'      => 'tueng6612631@gmail.com',
				'password'   => '551231'
			] 
		];	

		/*
		*Request API END POINT
		*/
		$url = <?php echo URL.DS.'User/create'?>

		/*
		*Create post request
		*/
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
	</pre>
	</div>
</div>
<?php endif?>

<?php if( ($_GET['view'] ?? '')  == 'folderstructure') :?>
	<div class="container">
		<h1>Folder Documentation</h1>

		<table class="table">
			<table class="table">
				<thead>
					<th>Folder</th>
					<th>File</th>
					<th>Description</th>
				</thead>

				<tbody>
					<tr>
						<td>Config</td>
						<td> <span class="important">env.php</span> </td>
						<td>
							Stores all information about the system environment,
							including base paths and base routes
						</td>
					</tr>

					<tr>
						<td>Core</td>
						<td></td>
						<td>
							These folder houses main engine of the mini-framework,
							it has Controller class , Database , Request , String Helper,
							Bootstrap files that will be discussed below.
						</td>
					</tr>

					<tr>
						<td>Functions</td>
						<td></td>
						<td>
							stores small functions like , curl request loading model others..
						</td>
					</tr>

					<tr>
						<td>Core</td>
						<td> 
							<span class="important">Bootstrap.php</span>
						</td>
						<td>
							Bootstrap is the one who reads the request , converts it
							to call the correct controller for your request.
						</td>
					</tr>
					<tr>
						<td>Core</td>
						<td><span class="important">Controller.php</span></td>
						<td>
							Loads model functions,
							Request and response, 
							controller models must extend this model to run properly.
						</td>
					</tr>

					<tr>
						<td>Core</td>
						<td>
							<span class="important">Model.php</span>
						</td>
						<td>
							Loads functionality for database , it has the shorthand functions for the database
						</td>
					</tr>

					<tr>
						<td>Core</td>
						<td><span class="important">Request.php</span></td>
						<td>
							Reads the request if its post or get,
							when a request is post , it calls a functions
							to check if access token is specified and correct
						</td>
					</tr>

					<tr>
						<td>Core</td>
						<td><span class="important">Response.php</span></td>
						<td>
							Prints a json encoded response
						</td>
					</tr>
				</tbody>
			</table>
		</table>
	</div>
<?php endif?>
</body>
</html>