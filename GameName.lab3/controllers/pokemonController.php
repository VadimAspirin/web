<?php

class pokemonController extends Controller {

	public function index(){
		$pokemon=$this->model->load();
		$this->setResponce($pokemon);
	}
	
	public function view($data){
		$pokemon=$this->model->load($data['id']);
		$this->setResponce($pokemon);
	}

	public function add(){
		if(isset($_POST['id']) && isset($_POST['name']) & isset($_POST['image']) & isset($_POST['power']) & isset($_POST['speed'])){
			$dataToSave=array(
				'id'=>$_POST['id'],
				'name'=>$_POST['name'],
				'image'=>$_POST['image'],
				'power'=>$_POST['power'],
				'speed'=>$_POST['speed'],
			);
			$pokemon=$this->model->create($dataToSave);
			$this->setResponce($pokemon);
		}
	}
	
	public function edit($id){
		$inputString = file_get_contents('php://input');
		$data = array();
		parse_str($inputString, $data);
		if(isset($data['id']) && isset($data['name']) & isset($data['image']) & isset($data['power']) & isset($data['speed'])){
			$user=$this->model->save($id['id'], $data);
			$this->setResponce($user);
		}
	}
	
	public function delete($id){
		$user=$this->model->delete($id['id']);
		$this->setResponce($user);
	}
	
}
