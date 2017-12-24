<?php

class App{

	private $controller='index';
	private $action='index';
	
	private $request=array();
	private $response=array();
	
	public function __construct(){
		if(isset($_GET['controller'])){
			$this->controller=$_GET['controller'];
		}
		
		switch ($_SERVER["REQUEST_METHOD"]) {
			case 'GET':
				if(isset($_GET['id'])){
					$this->action='view';	
				}else{
					$this->action='index';	
				}
				break;
			case 'POST':
				$this->action='add';
				break;
			case 'PUT':
				$this->action='edit';
				break;
			case 'DELETE':
				$this->action='delete';
				break;
			default:
				$this->action='index';
				break;
		}
		
		unset($_GET['controller']);
		$this->request=$_GET;
	}

	public function run(&$status = 0){
		$controllerName=$this->controller.'Controller';
		
		$modelName=$this->controller;
		$controllerInstanse = new $controllerName($modelName);
		$action=$this->action;
		
		if(method_exists($controllerInstanse, $action)){
			$controllerInstanse->$action($this->request);
			$this->response=$controllerInstanse->getResponse();
		}else{
			$status = -1;
			$this->response=false;
		}
		if($this->controller == "index")
			$status = 1;
		
		return $this->response;
	}

}
