<?php 

if (!isset($_SESSION)) {
	session_start() ;
}

// constant 

defined("SITE_URL")|| define("SITE_URL", "http://".$_SERVER['SERVER_NAME']);

// DIRCTORY SEPARATOR 
defined("DS")|| define("DS", DIRECTORY_SEPARATOR );

// root path
defined("ROOT_PATH")|| define("ROOT_PATH",
 realpath(dirname( __FILE__ ).DS."".DS) );
// pages folder 
defined("PAGES_DIR")||define("PAGES_DIR", "pages") ;

// class folder 
defined("CLASS_DIR")||define("CLASS_DIR", "classes") ;

// moduls folder 
defined("MOD_DIR")||define("MOD_DIR", "mod") ;

// inc folder 
defined("INC_DIR")||define("INC_DIR", "include") ;

// templet folder 
defined("TMP_DIR")||define("TMP_DIR", "tmps");

// Emails folder 
defined("EMAIL_DIR")||define("EMAIL_DIR", ROOT_PATH .DS."emails") ;
// cataloge image folder 
defined("CATALOGUE_PATH")||define("CATALOGUE_PATH", ROOT_PATH .DS."media".DS."catalogue") ;

// adding all abouve directories in include path 
set_include_path(implode(PATH_SEPARATOR, array(
   			realpath(CLASS_DIR) ,
   			realpath(PAGES_DIR) ,	
   			realpath(MOD_DIR) ,
   			realpath(INC_DIR) ,
   			realpath(TMP_DIR) ,
   			get_include_path() 
	) 
))	;





 ?>