<?php 
 
/* have ane object from class database*/ 

class Application {
  public $db ;

  public function __construct ()
  {
  	$db = new Dbase();

  	$this->db = $db;
  	

  }
  

}














 ?>