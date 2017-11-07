<?php

class userController extends Controller {

	public function index(){
		$user=$this->model->load();
		$this->setResponce($user);
	}
	
	public function view($data){
		$user=$this->model->load($data['id']);
		$this->setResponce($user);
	}

	public function add(){
		if(isset($_POST['id']) && isset($_POST['name']) & isset($_POST['score'])){
			$dataToSave=array(
				'id'=>$_POST['id'],
				'name'=>$_POST['name'],
				'score'=>$_POST['score'],
			);
			$user=$this->model->create($dataToSave);
			$this->setResponce($user);
		}
	}
	
	public function edit($id){
		$inputString = file_get_contents('php://input');
		$data = array();
		parse_str($inputString, $data);
		if(isset($data['id']) && isset($data['name']) & isset($data['score'])){
			$user=$this->model->save($id['id'], $data);
			$this->setResponce($user);
		}
	}
	
	public function delete($id){
		$user=$this->model->delete($id['id']);
		$this->setResponce($user);
	}
	
}
