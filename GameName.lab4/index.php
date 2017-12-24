<?php

error_reporting(E_ALL);
ini_set("display_errors", 1);

spl_autoload_register(function ($class_name) {
	foreach ( array('./app/', './controllers/','./models/') as $k=>$v) {
		$fname=$v.$class_name.'.php';
		if(file_exists($fname)){
			include ($fname);
			break;	
		} 
	}
});

define('BASE_DIR', dirname(__FILE__));
define('DS', DIRECTORY_SEPARATOR);
define('DATA_FOLDER',BASE_DIR.DS.'data');

$app = new App();
$response = $app->run($status);

if($status == 1){
	echo $response;
}else if($status == 0){
	header('Content-Type: application/json');
	echo json_encode($response);
}else if($status == -1){
	header("HTTP/1.0 404 Not Found");
}
