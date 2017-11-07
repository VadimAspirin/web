<?php

class userModel extends Model {

/*
	// Если нужен поиск по внутреннему id, а не порядок следования в json
	
	public function load($id=false){
		$data=file_get_contents($this->dataFileName);
		$data=json_decode($data);

		if($id===false){
			return $data;
		}else{
			
			foreach ($data as $value){
				$buf = json_decode(json_encode($value), true);
				if(array_key_exists('id', $buf)){
					if($buf['id'] == $id){			
						return $buf;
						}
				}
			}
		}
		return false;
	}
*/
}
