<?php

class indexController extends Controller {

	public function index(){
		$message = '<!DOCTYPE html>
					<html lang="en" ng-app="gameNameModule">
					<head>
						<meta charset="UTF-8">
						<link rel="stylesheet" href="./css/styles.css">
						<script src="./js/lib/angular.min.js"></script>
						<script src="./js/lib/angular-route.min.js"></script>
						<script src="./js/lib/angular-resource.min.js"></script>
						<script src="./js/scripts.js"></script>
						<title>GameName</title>
					</head>
					<body>
						<menu></menu>
						<ng-view></ng-view>
					</body>
					</html>';
		$this->setResponse($message);
	}
		
}
