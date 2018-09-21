<?php 

/**
for categouries table
* 
*/
class Catalogue extends Application
{
	private $table = 'categories' ;

	private $table_2 = 'products' ;
	public $path = 'media/catalogue/' ;

	public function getCategories (){

		$sql = "SELECT * FROM {$this->table} ORDER BY id ASC";

		return $this->db->fetchAll($sql) ;
	}

		public function getCategory($id) {

		$sql = "SELECT * FROM {$this->table} WHERE id = {$this->db->escape($id) }";

		return $this->db->fetchOne($sql);

		}

		public function getProducts ($cat) {

			$sql = "SELECT * FROM {$this->table_2} WHERE categoriesID = {$this->db->escape($cat)} ORDER BY productID DESC " ;

			return $this->db->fetchAll($sql) ;
		}




}

 ?>