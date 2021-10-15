<?php
        session_start();
        error_reporting(0);
        include('includes/config.php');

        //This is for sending item to cart
        //Look at "action" from <div class="action"> at "Add to Cart"
        if(isset($_GET['action']) && $_GET['action']=="add"){
            $id=intval($_GET['id']);
            if(isset($_SESSION['cart'][$id])){
                $_SESSION['cart'][$id]['quantity']++;
            }else{
                $sql_p="SELECT * FROM products WHERE id={$id}";
                $query_p=mysqli_query($con,$sql_p);
                if(mysqli_num_rows($query_p)!=0){
                    $row_p=mysqli_fetch_array($query_p);
                    $_SESSION['cart'][$row_p['id']]=array("quantity" => 1, "price" => $row_p['productPrice']);

                }else{
                    $message="Product ID is invalid";
                }
            }
                //alert popup
                //echo "<script>alert('Product has been added to the cart')</script>";
            
                //alert popup said "OK"(my-cart.php)
                echo "<script type='text/javascript'> document.location ='shoping-cart.php'; </script>";
        }
?>

<!DOCTYPE html>
<html lang="zxx">

    <?php include('includes/head.php');?>
<body>
    <!-- Page Preloder -->
    <div id="preloder">
        <div class="loader"></div>
    </div>

    <?php include('includes/top.php');?>

    <!-- Hero Section Begin -->
    <section class="hero">
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <?php include('includes/side-menu.php');?>
                </div>
                <div class="col-lg-9">
                    <div class="hero__search">
                        <div class="hero__search__form">
                            <form action="#">
                                <div class="hero__search__categories">
                                    All Categories
                                    <span class="arrow_carrot-down"></span>
                                </div>
                                <input type="text" placeholder="What do yo u need?">
                                <button type="submit" class="site-btn">SEARCH</button>
                            </form>
                        </div>
                        <div class="hero__search__phone">
                            <div class="hero__search__phone__icon">
                                <i class="fa fa-phone"></i>
                            </div>
                            <div class="hero__search__phone__text">
                                <h5>+65 11.188.888</h5>
                                <span>support 24/7 time</span>
                            </div>
                        </div>
                    </div>
                    <div class="hero__item set-bg" data-setbg="admin/shopping_images/iMac-redesign.jpg">
                        <div class="hero__text">
                            <span>COMPUTER FIELD</span>
                            <h2>ELECTRIC <br />100% Organic</h2>
                            <p>Free Pickup and Delivery Available</p>
                            <a href="#" class="primary-btn">SHOP NOW</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Hero Section End -->

    <!-- Featured Section Begin -->
    <section class="featured spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title">
                        <h2>Featured Product</h2>
                    </div>
                    <div class="featured__controls">
                        <ul>
                            <li class="active" data-filter="*">All</li>
                            <li data-filter=".oranges">Oranges</li>
                            <li data-filter=".fresh-meat">Fresh Meat</li>
                            <li data-filter=".vegetables">Vegetables</li>
                            <li data-filter=".fastfood">Fastfood</li>
                        </ul>
                    </div>
                </div>
            </div>
            
            
            
            <div class="row featured__filter">
                <?php
                        $ret=mysqli_query($con,"select * from products");
                        while ($row=mysqli_fetch_array($ret)){
                            # code...
                ?>
                
                <div class="col-lg-3 col-md-4 col-sm-6 mix fastfood vegetables">
                    <div class="featured__item">
                        <div class="featured__item__pic set-bg" data-setbg="admin/images/<?php echo htmlentities($row['id']);?>/<?php echo htmlentities($row['Image1']);?>" data-echo="admin/images/<?php echo htmlentities($row['id']);?>/<?php echo htmlentities($row['Image1']);?>">
                            <ul class="featured__item__pic__hover">
                                <li><a href="#"><i class="fa fa-heart"></i></a></li>
                                <li><a href="#"><i class="fa fa-retweet"></i></a></li>
                                <li><a href="#"><i class="fa fa-shopping-cart"></i></a></li>
                            </ul>
                        </div>
                        <div class="featured__item__text">
                            <h6><a href="shop-details.php?pid=<?php echo htmlentities($row['id']);?>"><?php echo htmlentities($row['productName']);?></a></h6>
                            
                            <h5>$<?php echo htmlentities($row['productPrice']);?></h5>
                        </div>
                    </div>
                </div>
                
                <?php } ?>
            </div>
        </div>
    </section>
    <!-- Featured Section End -->

    <!-- Banner Begin -->
    <div class="banner">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-6">
                    <div class="banner__pic">
                        <img src="img/banner/banner-1.jpg" alt="">
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6">
                    <div class="banner__pic">
                        <img src="img/banner/banner-2.jpg" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Banner End -->

    <!-- Latest Product Section Begin -->
    <section class="latest-product spad">
        
    </section>
    <!-- Latest Product Section End -->
    
    <?php include('includes/footer.php');?>
</body>

</html>