<?php 
/**
* 
*/
class Helper
{

	public static function getActive ($page = null) {

		if (!empty($page)) {
			if (is_array($page)) {
				$error = array();

				foreach ($page as $key => $value) {
					if (Url::getparam($key) != $value) {
						array_push($error, $key);
					}
				}
			return empty($error)?"class=\"active\"" :null ;
			}
		}
		return $page == Url::cPage()?"class=\"active\"" :null ;

	}
	

public function getImageSize ($image , $case) {
if (is_file($image)) {
	$size = getimagesize($image) ;
	return $size[$case];
}

}
/*function to check char length*/ 

public static function stringshort($string , $length = 150 ) {

	if (strlen($string) >$length) {

		$string = trim(substr($string, 0 , $length));
		$string = substr($string, 0  , strrpos($string, " "))	;
		
	}
	else {

		$string .= "&hellip" ;
	}
	return $string ;
}




}



 ?>