<?php 

class Dbase {

private $_host = "localhost" ;

private $_user = "root" ;
private $_name = 'ecommers' ;
private $_password = "1" ;
private $_conndb = false ;

public $last_query = null ;
public $affected_rows = 0 ;

public $insert_key = array() ;
public $insert_values = array() ;
public $update_set = array() ;
public $id ;

public function __construct()
{
	$this->connection();
}

		private function connection () {

		$this->_conndb = mysqli_connect($this->_host , $this->_user , $this->_password);
		/////// db connection failed validation
		if (! $this->_conndb) {

		die("data base connection failed <br/>". mysql_error());
			
		}else{

		$_select = mysqli_select_db( $this->_conndb , $this->_name )	; 

		if (!$_select) {
		  	die("Database selection is Failed <br/>" .mysqli_error());
		  }  
		}
		mysqli_set_charset($this->_conndb , "utf8"  ) ;
			
		}


/// close function  
public function close (){

if (!mysqli_close()) {
	die("failed to connect");
}
}
//////////// /
// injction preventing
//==============

/*
mysqli_real_escape_string==== function escapes special characters in a string for use in an SQL statement.
===========================================================

The stripslashes() function removes backslashes added by the addslashes() function.

Tip: This function can be used to clean up data retrieved from a database or from an HTML form.
=====================================================================
The mysqli_set_charset() function specifies the default character set to be used when sending data from and to the database server.

mysqli_set_charset(connection,charset);
=====================================================================


get_magic_quotes_gpc() is a function that checks the configuration (php.ini) and returns 0 if magic_quotes_gpc is off (otherwise it returns 1).

When magic_quotes are on, all ' (single-quote), " (double quote), \ (backslash) and NULs are escaped with a backslash automatically. This is to prevent all sorts of injection security issues.

In your case the code checks if the setting is off and adds slashes to properly escape the content to prevent SQL injection.

Like you said - this feature is deprecated and will certainly be removed in the future (in fact they removed it in PHP6).

The alternative is to escape the data at runtime as needed
==================================================================
*/


public function escape ($value) {

	if (function_exists("mysqli_real_escape_string")) {
		if (get_magic_quotes_gpc()) {
			$value = stripcslashes($value);
		}
	$value = mysqli_real_escape_string($this->_conndb , $value) ;
	}else{
      if (! get_magic_quotes_gpc()) {
      	$value = addcslashes($value);
      }

	}
	return $value;
}

/*query function 
1==== mysqli_query(<conection>, "sql statement" ) function performs a query against the database.

2====the mysqli_affected_rows(connection) function returns the number of affected rows in the previous SELECT, INSERT, UPDATE, REPLACE, or DELETE query.


*/ 
	public function query ($sql){

	$this->last_query = $sql ;

	$result = mysqli_query($this->_conndb , $sql) ;

	$this->displayQuery($result) ;

	return $result ;

	}
/// display result of query

	public function displayQuery($result) {
	if (!$result) {

	$output = "Database Query Failed". mysqli_error()."<br>" ;

	die($output);

	}else{

	 $this->affected_rows = mysqli_affected_rows($this->_conndb);

	}

	}

////// function to fetch all

// fetch assoc retrive amysql row to associative array

// mysqli_free_result($result); free the memory from the array of the fetch assoc function

 public  function  fetchAll($sql)
 {
 	$result = $this->query($sql) ; // perform the Query
   
   	$output = array() ;
    
    while ($row = mysqli_fetch_assoc($result)) {
    	$output[]= $row ; 
    }
      mysqli_free_result($result);

     return $output;

 }

/* Remove the first element (red) from an array, and return the value of the removed element:
*/
		public function fetchOne ($sql) {

			$output = $this->fetchAll($sql) ;

			return array_shift($output);
		}

	public function lastID (){

	return mysql_insert_id($this->_conndb) ;

	}








}







 ?>