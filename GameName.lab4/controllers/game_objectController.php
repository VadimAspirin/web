<?php

class game_objectController extends Controller {

	public function index(){
		$game_object=$this->model->load();
		$this->setResponse($game_object);
	}
	
	public function view($data){
		$game_object=$this->model->load($data['id']);
		$this->setResponse($game_object);
	}

	public function add(){
		$data = json_decode(file_get_contents('php://input'), TRUE);		
		if(isset($data['id']) && isset($data['name']) && isset($data['image']) && isset($data['speed'])){
			$dataToSave=array(
				'id'=>$data['id'],
				'name'=>$data['name'],
				'image'=>$data['image'],
				'speed'=>$data['speed'],
			);
			$user=$this->model->create($dataToSave);
			$this->setResponse($user);
		}
	}
	
	public function edit($id){
		$data = json_decode(file_get_contents('php://input'), TRUE);
		if(isset($data['id']) && isset($data['name']) && isset($data['image']) && isset($data['speed'])){
			$user=$this->model->save($id['id'], $data);
			$this->setResponse($user);
		}
	}
	
	public function delete($id){
		$user=$this->model->delete($id['id']);
		$this->setResponse($user);
	}
	
}
