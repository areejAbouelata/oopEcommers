<?php $newBusiness = new Business () ;
      $business = $newBusiness->getBusiness() ; 

      $newcat = new Catalogue ();
      $cats = $newcat->getCategories() ;
 ?>


<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>header</title>
	<link rel="stylesheet" href="/css/bootstrap.min.css">
	<link rel="stylesheet" href="/css/style.css">
</head>
<body>
<nav class="navbar navbar-default">
  <div class="container-fluid">
    <div class="navbar-header">
      <!-- <a class="navbar-brand" href="#">shop</a> -->
      <h1 class="container"><?php echo $business['name'] ; ?></h1>

    </div>
    
  </div>
</nav>

<div class="navigation">
  


  
 <h3 id="activea" ><a id="activeh" href="#">Categories</a></h3>


 <ul class="nav navbar-nav">
    <?php 
    if (!empty($cats)) {


// page=catalogue&category=2

      foreach ($cats as $cat) {
echo "<li> <a href=\"/?page=catalogue&category=".$cat['id']."\""; 
echo Helper::getActive(array('category'=>$cat['id']));

echo ">";
echo htmlentities($cat['name'] );

echo "</a> </li>";
    }
    
    }


     ?> 
      
    </ul>
</div>





