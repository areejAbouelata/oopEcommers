<?php 

// category ==== the id of the curnt category 
// from header.php page ====================


$catid = Url::getparam('category');

// var_dump($cat) ;
// die();

 if (empty($catid)) {

	require 'error.php';

 }
else{

$objcategory = new Catalogue();

$category = $objcategory->getCategory($catid);
$mypath = $objcategory->path ;

if (empty($category)) {

	require_once 'error.php';

}
else {

 $rows = $objcategory->getProducts($catid);

/* insttion for paging class */
$objpaging = new Paging($rows ,3) ;

$rows = $objpaging->getRecords() ;
// var_dump($objpaging->_max_pp);

require_once 'header.php';



?>


<h1>Catalogue ::  <?php echo $category['name']; ?></h1>

<?php 

   if (!empty($rows)) {
   	
		foreach ($rows as $product) {


			?>
  			<div class="catalogue_wraper container">
  			<div class="row">
  			<div class="catalogue_wraper_left col-md-3"> <!--this dive for img validation and display-->
  					<?php 
  					$image = !empty($product['image']) ? $mypath.$product['image'] : $mypath.'1.jpg' ; 

  					$width = Helper::getImageSize($image , 0) ;

  					$width = $width >120 ? 120  :$width ;


  					 ?>
			<a href="/?page=catalogue-item&category=<?php echo $category['id']; ?>&id=<?php echo $product['productID'];  ?> ">
				<img src="<?php echo $image; ?>" alt="" width="<?php echo $width ; ?>" class= "img-thumbnail">
			</a>
  				</div>

			   <div class="catalogue_wraper_right">
			   	<h4 >
			   		<a href="/?page=catalogue-item&category=<?php echo $category['id']; ?>&id=<?php echo $product['productID'];  ?> "> <?php echo htmlentities($product['productName'] , ENT_QUOTES, "UTF-8" , false); ?></a>
			   	</h4>
			   	<h4>Price :: <?php echo number_format($product['productPrice'] , 2 ); ?>$</h4>
<!-- shorter description 1==trim() 2== substring() -->
			   	<p><?php echo Helper::stringshort(htmlentities($product['description'] , ENT_QUOTES, "UTF-8")); ?></p>
			   	<p>
			   	<?php 
			   	echo Basket::activeButton($product['productID']);
			   	 ?>	
			   	</p>

			   </div>
</div>
  			</div>
			<?php
		} 

  echo  $objpaging->getPages();

	 }  /*end of if not empty */  
	 else {
			 ?>
			 <div class="container">
			 <div class="row">
			 <div class="alert alert-danger col-md-7">		
			 	<h3>no products in this category</h3>
			 	</div>
			 </div>
    </div>
<?php
	}
require 'footer.php';

}

}







 ?>