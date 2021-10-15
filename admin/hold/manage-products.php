
<?php
session_start();
include('include/config.php');
if(strlen($_SESSION['alogin'])==0){	
    //This is sending all data for item into index.php when you insert. 
    header('location:index.php');
}
else{
// Attributes(orange) are holded by array. They are using "submit" as inserting data into index.php
if(isset($_POST['submit'])){
	$category=$_POST['category'];
	$subcat=$_POST['subcategory'];
	$productname=$_POST['productName'];
	$productcompany=$_POST['productCompany'];
	$productprice=$_POST['productprice'];
	$productpricebd=$_POST['productpricebd'];
	$productdescription=$_POST['productDescription'];
	$productscharge=$_POST['productShippingcharge'];
	$productavailability=$_POST['productAvailability'];
	$productimage1=$_FILES["productimage1"]["name"];
	$productimage2=$_FILES["productimage2"]["name"];
	$productimage3=$_FILES["productimage3"]["name"];
    
//for getting product id
$query=mysqli_query($con,"select max(id) as pid from products");
	$result=mysqli_fetch_array($query);
    $productid=$result['pid']+1;
	$dir="productimages/$productid";
if(!is_dir($dir)){
		mkdir("productimages/".$productid);
	}

    //upload uses as sending the image from compute to the browser
	move_uploaded_file($_FILES["productimage1"]["tmp_name"],"productimages/$productid/".$_FILES["productimage1"]["name"]);
    
	move_uploaded_file($_FILES["productimage2"]["tmp_name"],"productimages/$productid/".$_FILES["productimage2"]["name"]);
    
	move_uploaded_file($_FILES["productimage3"]["tmp_name"],"productimages/$productid/".$_FILES["productimage3"]["name"]);
    
    $sql=mysqli_query($con,"insert into products(category,subCategory,productName,productCompany,productPrice,productDescription,shippingCharge,productAvailability,productImage1,productImage2,productImage3,productPriceBeforeDiscount) values('$category','$subcat','$productname','$productcompany','$productprice','$productdescription','$productscharge','$productavailability','$productimage1','$productimage2','$productimage3','$productpricebd')");
    
    $_SESSION['msg']="Product Inserted Successfully !!";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Admin| Insert Product</title>
	<link type="text/css" href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
	<link type="text/css" href="bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet">
	<link type="text/css" href="css/theme.css" rel="stylesheet">
	<link type="text/css" href="images/icons/css/font-awesome.css" rel="stylesheet">
	<link type="text/css" href='http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,400,600' rel='stylesheet'>
<script src="http://js.nicedit.com/nicEdit-latest.js" type="text/javascript"></script>
    
<!--    For top.php-->
    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200;300;400;600;900&display=swap" rel="stylesheet">

    <!-- Css Styles -->
    
    <link rel="stylesheet" href="css/font-awesome.min.css" type="text/css">
    <link rel="stylesheet" href="css/elegant-icons.css" type="text/css">
    <link rel="stylesheet" href="css/nice-select.css" type="text/css">
    <link rel="stylesheet" href="css/jquery-ui.min.css" type="text/css">
    <link rel="stylesheet" href="css/owl.carousel.min.css" type="text/css">
    <link rel="stylesheet" href="css/slicknav.min.css" type="text/css">
    <link rel="stylesheet" href="css/style.css" type="text/css">
    
    
<script type="text/javascript">bkLib.onDomLoaded(nicEditors.allTextAreas);</script>

<!--
<script>
    function getSubcat(val) {
            $.ajax({
                type: "POST",
                url: "get_subcat.php",
                data:'cat_id='+val,
                success: function(data){
                    $("#subcategory").html(data);
                }
            });
    }
    function selectCountry(val) {
        $("#search-box").val(val);
        $("#suggesstion-box").hide();
    }
</script>	
-->
</head>
    
<body>
<?php include('include/header.php');?>
<?php include('include/top.php');?>
    
    
<div class="wrapper">
    <div class="container">
        <div class="row">
<?php include('include/sidebar.php');?>				
        <div class="span9">
        <div class="content">
            
<div class="module">
    <div class="module-head">
        <h3>Manage Products</h3>
    </div>
        
        
<div class="module-body table">
    <!-- Well done! when you add data to the list after alert -->
        <?php if(isset($_GET['del'])){?>
            <div class="alert alert-error">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <strong>Oh snap!</strong> 	<?php echo htmlentities($_SESSION['delmsg']);?><?php echo htmlentities($_SESSION['delmsg']="");?>
            </div>
        <?php } ?>
    <br />
    <!-- Look at datatable-1 for show, entries, and search. datatable-1 from javascript below -->
        <table cellpadding="0" cellspacing="0" border="0" class="datatable-1 table table-bordered table-striped	 display" width="100%">
            <thead>
				<tr>
				    <th>#</th>
				    <th>Product Name</th>
				    <th>Category </th>
				    <th>Subcategory</th>
				    <th>Company Name</th>
				    <th>Product Creation Date</th>
				    <th>Action</th>
				</tr>
            </thead>
            <tbody>

                <?php $query=mysqli_query($con,"select products.*,category.categoryName,subcategory.subcategory from products join category on category.id=products.category join subcategory on subcategory.id=products.subCategory");
                $cnt=1; // currently add new data to the list in the table when you insert data in the box.
                while($row=mysqli_fetch_array($query)){
                ?>
                    <tr>
                        <td><?php echo htmlentities($cnt);?></td>
                        <td><?php echo htmlentities($row['productName']);?></td>
                        <td><?php echo htmlentities($row['categoryName']);?></td>
                        <td> <?php echo htmlentities($row['subcategory']);?></td>
                        <td><?php echo htmlentities($row['productCompany']);?></td>
                        <td><?php echo htmlentities($row['postingDate']);?></td>
                        <td>
                        <!--Look at update method at edit-category.php"-->
                        <a href="edit-products.php?id=<?php echo $row['id']?>" ><i class="icon-edit"></i></a>
                        <!--Look at "del" that from delete method "-->
                        <a href="manage-products.php?id=<?php echo $row['id']?>&del=delete" onClick="return confirm('Are you sure you want to delete?')"><i class="icon-remove-sign"></i></a>
                        </td>
                    </tr>
                <?php $cnt=$cnt+1; } ?>
            </tbody>
        </table>
</div>
</div>
            
            
</div><!--/.content-->
</div><!--/.span9-->
</div>
</div><!--/.container-->
</div><!--/.wrapper-->

<?php include('include/footer.php');?>

	<script src="scripts/jquery-1.9.1.min.js" type="text/javascript"></script>
	<script src="scripts/jquery-ui-1.10.1.custom.min.js" type="text/javascript"></script>
	<script src="bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
	<script src="scripts/flot/jquery.flot.js" type="text/javascript"></script>
	<script src="scripts/datatables/jquery.dataTables.js"></script>
    
	<script>
		$(document).ready(function() {
			$('.datatable-1').dataTable();
			$('.dataTables_paginate').addClass("btn-group datatable-pagination");
			$('.dataTables_paginate > a').wrapInner('<span />');
			$('.dataTables_paginate > a:first-child').append('<i class="icon-chevron-left shaded"></i>');
			$('.dataTables_paginate > a:last-child').append('<i class="icon-chevron-right shaded"></i>');
		} );
	</script>
</body>
<?php } ?>