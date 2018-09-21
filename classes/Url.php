<?php 
/**
* 
*/
class  Url 
{
	public static $_page = "page" ;

	public static $_folder = PAGES_DIR ;

	public static $_params = array();

	public static function getparam($para){

	return isset($_GET[$para])&& $_GET[$para]!=""?$_GET[$para]:null ;   

	}
// currnt page 

	public static function cPage () {

	return isset($_GET[self::$_page])?$_GET[self::$_page] : 'index' ;

	}

// ===========================
	public static function getPage () {
		$page = self::$_folder . DS .self::cPage(). ".php" ;

		$error = self::$_folder . DS ."error.php" ;

	return is_file($page)? $page : $error;


}
//============================
//get all 
//=========================
	public static function getall (){
		if (!empty($_GET)) {
			
			foreach ($_GET as $key => $value) {  //page=>about
				
				if (!empty($value)) {

					self::$_params[$key] = $value ;
	 			
	 			}
			}
			
		}
	}


public static function getCurenturl($remove = null)	{
	self::getall() ;
	$out = array() ;
	if (!empty($remove)) {
		$remove = !is_array($remove) ? array($remove) :$remove ;
		foreach (self::$_params as $key => $value) {
			if (in_array($key, $remove)) {
				unset(self::$_params[$key]) ;
			}
		}
	}
foreach (self::$_params as $key => $value) {
	$out[] = $key ."=".$value ;

}
return "/?" . implode("&", $out );

}

}



 ?>