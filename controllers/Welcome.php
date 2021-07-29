<?php 

	class Welcome extends Controller
	{

		public function index()
		{
			return $this->printHTML();
		}

		private function printHTML()
		{
			$docHref = URL.DS.'docs.php';
			$testHref = URL.DS.'test.php';

			print <<<EOF
			<!DOCTYPE html>
			<html>
			<head>
				<meta charset="utf-8">
				<title></title>
			</head>
			<body>
				<h1> Welcome to car insruance REST API!</h1>
				<table>
					<thead>
						<th> Link </th>
						<th> Description </th>
					</thead>
					<tbody>
						<tr>
							<td> <a href='{$docHref}'> Docs </a> </td>
							<td> <a href='{$testHref}'> Test </a> </td>
						</tr>
					</tbody>
				</table>
			</body>
			</html>
			EOF;
		}
	}