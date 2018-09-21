<?php 
class Paging {

private $_recored ;

private $number_of_recored ;

public $_max_pp ;

private $_number_of_pages ;

private $_current ;

private $_off_set = 0;

private static $_key = 'pg';

public $url; 


public function __construct ($rows , $max = 10){

	$this->_recored = $rows ;

	$this->number_of_recored = count($this->_recored);

	$this->_max_pp = $max ;

	$this->url =Url::getCurenturl(self::$_key);

	$current = Url::getParam(self::$_key) ;

	$this->_current = !empty($current)? $current: 1 ;

	$this->numberOfPages();

	$this->getOffset();
}

private function numberOfPages () {
	$this->_number_of_pages = ceil($this->number_of_recored / $this->_max_pp );
}
// (current - 1) * max_pp

private function getOffset () {

	$this->_off_set = ($this->_current - 1) * $this->_max_pp ;	

}
// =========================
public function getRecords () {

	$out = array() ;

	if ($this->_number_of_pages > 1 ) {

		$last = ($this->_off_set + $this->_max_pp) ;


			   for ($i = $this->_off_set ; $i < $last  ; $i++) {

					   	if ($i <  $this->number_of_recored) {

					   		$out[] = $this->_recored[$i] ;
					   	}

			   }
    }
   else{

		   	$out = $this->_recored ;
		  
	}

	 return $out ;
}


private function  getLinks () {

	if ($this->_number_of_pages  > 1 ) {
		$out = array() ;
    // === first link ==========

		if ($this->_current > 1 ) {

			$out [] = "<a href=\"".$this->url ."\">First</a>" ;

		}else {
			$out[] = "<span>First</span>" ;
		}
 	// ======= privious link ===========
		if ($this->_current > 1) {
			$id = ($this->_current - 1 ) ;

			$url= $id >1 ? $this->url."&".self::$_key . "=".$id :
			 $this->url ;

			 $out[] = "<a href=\"{$url} \">Privious</a>";
			
		} else {
			$out [] = "<span>Privious</span>" ;
		}

		// === next link ========
		if ($this->_current != $this->_number_of_pages ) {

			$id = ($this->_current + 1) ;

			$url = $this->url . "&".self::$_key ."=".$id ;

			$out[] = "<a href=\"{$url} \">next</a>";
	
		}else {
			$out[] = "<span>Next</span>";
		}

	// =========== last link limte ===========
		if ($this->_current != $this->_number_of_pages) {
			
			$url = $this->url . "&" . self::$_key ."=" .
			 $this->_number_of_pages ;

			 $out [] ="<a  href=\" {$url}\"> Last</a>";
		} else {
			$out[] = "<span>Last</span>" ;
		}

		return "<li>" .implode("<li>", $out)."</li>";

	}
}

public function getPages (){
	$links = $this->getLinks() ;
	if (!empty($links) ) {
		$out ="<ul class = 'pagination'>";
 		$out .= $links ;
 		$out  .= "</ul>";
		return $out ;
	}
}





}

 ?>