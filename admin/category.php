
<?php
session_start();
include('include/config.php');

// send data to index.php when you insert.
if(strlen($_SESSION['alogin'])==0){	
    //This is sending all data for item into index.php when you insert. 
    header('location:index.php');
}
else{
//Insert 
    if(isset($_POST['submit'])){
        $category=$_POST['category'];
        $description=$_POST['description'];
        $sql=mysqli_query($con,"insert into category(categoryName,categoryDescription) values('$category','$description')");
        $_SESSION['msg']="Category Created !!";
    }

    //Delete
    if(isset($_GET['del'])){
        mysqli_query($con,"delete from category where id = '".$_GET['id']."'");
        $_SESSION['delmsg']="Category deleted !!";
    }

?>

<!DOCTYPE html>
<html lang="en">

    <?php include('include/head.php');?>
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
            <h3>Create Category</h3>
        </div>
        <div class="module-body">
            
            <!-- Well done! when you add data to the list after alert -->
            <?php if(isset($_POST['submit'])){?>
            <div class="alert alert-success">
                <button type="button" class="close" data-dismiss="alert">×</button>
				<strong>Well done!</strong>	<?php echo htmlentities($_SESSION['msg']);?><?php echo htmlentities($_SESSION['msg']="");?>
            </div>
            <?php } ?>
            
            
            <!-- Oh snap! when you delete data from the list after alert -->
            <?php if(isset($_GET['del']))
            {?>
                <div class="alert alert-error">
				<button type="button" class="close" data-dismiss="alert">×</button>
				<strong>Oh snap!</strong> 	<?php echo htmlentities($_SESSION['delmsg']);?><?php echo htmlentities($_SESSION['delmsg']="");?>
				</div>
                <?php } ?>
            <br />

<!--Look at "post" that from insert method "-->
<form class="form-horizontal row-fluid" name="Category" method="post" >

    <!-- Product Price After Discount(Selling Price) -->
    <!--Look at "category" that from insert method "-->
    <div class="control-group">
        <label class="control-label" for="basicinput">Category Name</label>
        <div class="controls">
        <input type="text" placeholder="Enter category Name"  name="category" class="span8 tip" required>
        </div>
    </div>

    <!--Look at "description" that from insert method "-->
    <div class="control-group">
        <label class="control-label" for="basicinput">
             Description
        </label>
        <div class="controls">
            <textarea class="span8" name="description" rows="5"></textarea>
        </div>
    </div>
    
	<!--Look at "submit" that from insert method "-->
    <div class="control-group">
        <div class="controls">
            <button type="submit" name="submit" class="btn">
                Create
            </button>
        </div>
    </div>
    
</form>
</div>
</div>
            
<div class="module">
            
     <div class="module-head">
         <h3>Manage Categories</h3>
    </div>       
</div>       
    <!-- Look at datatable-1 for show, entries, and search. datatable-1 from javascript below -->
            
<div class="module-body table">
    <table cellpadding="0" cellspacing="0" border="0" class="datatable-1 table table-bordered table-striped	 display" width="100%">
       <thead>
           <tr>
				<th>NO.</th>
				<th>Category</th>
				<th>Description</th>
				<th>Creation date</th>
				<th>Last Updated</th>
				<th>Action</th>
           </tr>
        </thead> 
        
        
        <tbody>
            <?php $query=mysqli_query($con,"select * from category");
            $cnt=1; // currently add new data to the list in the table when you insert data in the box.
            while($row=mysqli_fetch_array($query)){
        ?>									
            <tr>
                <td><?php echo htmlentities($cnt);?>
                </td>
                <td><?php echo htmlentities($row['categoryName']);?></td>
                <td><?php echo htmlentities($row['categoryDescription']);?>
                </td>
                <td> <?php echo htmlentities($row['creationDate']);?></td>
                <td><?php echo htmlentities($row['updationDate']);?></td>
                <td>
                <!--Look at update method at edit-category.php"-->
                <a href="edit-category.php?id=<?php echo $row['id']?>" ><i class="icon-edit"></i></a>
                <!--Look at "del" that from delete method "-->
                <a href="category.php?id=<?php echo $row['id']?>&del=delete" onClick="return confirm('Are you sure you want to delete?')"><i class="icon-remove-sign"></i></a>
                </td>
            </tr>
            <?php $cnt=$cnt+1; } ?>
        </tbody>
    </table>     
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