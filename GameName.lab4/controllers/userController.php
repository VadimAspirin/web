<?php

class userController extends Controller {

	public function index(){
		$user=$this->model->load();
		$this->setResponse($user);
	}
	
	public function view($data){
		$user=$this->model->load($data['id']);
		$this->setResponse($user);
	}

	public function add(){
		$data = json_decode(file_get_contents('php://input'), TRUE);		
		if(isset($data['id']) && isset($data['name']) && isset($data['score'])){
			$dataToSave=array(
				'id'=>$data['id'],
				'name'=>$data['name'],
				'score'=>$data['score'],
			);
			$user=$this->model->create($dataToSave);
			$this->setResponse($user);
		}
	}
	
	public function edit($id){
		$data = json_decode(file_get_contents('php://input'), TRUE);
		if(isset($data['id']) && isset($data['name']) && isset($data['score'])){
			$user=$this->model->save($id['id'], $data);
			$this->setResponse($user);
		}
	}
	
	public function delete($id){
		$user=$this->model->delete($id['id']);
		$this->setResponse($user);
	}
	
}
