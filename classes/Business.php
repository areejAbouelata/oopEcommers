<?php 
class  Business extends Application{

	private $table = 'business' ;

	public function getBusiness (){

		$sql = " SELECT * FROM {$this->table} WHERE id = 1 " ;
			 
		return $this->db->fetchOne ($sql) ;
	}

}



 ?>