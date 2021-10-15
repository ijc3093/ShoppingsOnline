<div class="hero__categories">
<!--        <h6>Shop by</h6>-->
        <div class="hero__categories__all">
            <i class="fa fa-bars"></i>
                <span>Category</span>
        </div>
            <!-- Look at category from sql-->
            <?php $sql=mysqli_query($con,"select id,categoryName from category");
            while($row=mysqli_fetch_array($sql)){
            ?>
                <ul>
                <li><a href="category.php?cid=<?php echo $row['id'];?>"><?php echo $row['categoryName'];?></a></li>
                </ul>
            <?php } ?>
</div>