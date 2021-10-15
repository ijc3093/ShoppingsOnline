<?php 
session_start();
error_reporting(0);
include('includes/config.php');

// Submit
if(isset($_POST['submit'])){
		if(!empty($_SESSION['cart'])){
		foreach($_POST['quantity'] as $key => $val){
			if($val==0){
				unset($_SESSION['cart'][$key]);
			}else{
				$_SESSION['cart'][$key]['quantity']=$val;

			}
		}
			//echo "<script>alert('Your Cart has been Updated');</script>";
		}
}

// Remove a Product from Cart
if(isset($_POST['remove_code'])){

    if(!empty($_SESSION['cart'])){
		foreach($_POST['remove_code'] as $key){
			
				unset($_SESSION['cart'][$key]);
		}
			//echo "<script>alert('Your Cart has been Updated');</script>";
	}
}


// Insert product in order table
if(isset($_POST['ordersubmit'])){
    if(strlen($_SESSION['login'])==0){   
        header('location:login.php');
    }
    else{
	$quantity=$_POST['quantity'];
	$pdd=$_SESSION['pid'];
	$value=array_combine($pdd,$quantity);

		foreach($value as $qty=> $val34){
            mysqli_query($con,"insert into orders(userId,productId,quantity) values('".$_SESSION['id']."','$qty','$val34')");
            header('location:payment-method.php');
        }
    }
}

// Billing address updation
	if(isset($_POST['update'])){
		$baddress=$_POST['billingaddress'];
		$bstate=$_POST['bilingstate'];
		$bcity=$_POST['billingcity'];
		$bpincode=$_POST['billingpincode'];
		$query=mysqli_query($con,"update users set billingAddress='$baddress',billingState='$bstate',billingCity='$bcity',billingPincode='$bpincode' where id='".$_SESSION['id']."'");
		if($query){
            echo "<script>alert('Billing Address has been updated');</script>";
		}
	}


// Shipping address updation
	if(isset($_POST['shipupdate'])){
		$saddress=$_POST['shippingaddress'];
		$sstate=$_POST['shippingstate'];
		$scity=$_POST['shippingcity'];
		$spincode=$_POST['shippingpincode'];
		$query=mysqli_query($con,"update users set shippingAddress='$saddress',shippingState='$sstate',shippingCity='$scity',shippingPincode='$spincode' where id='".$_SESSION['id']."'");
		if($query){
            echo "<script>alert('Shipping Address has been updated');</script>";
		}
	}

//This is for wishlist
    $pid=intval($_GET['pid']);
        if(isset($_GET['pid']) && $_GET['action']=="wishlist" ){
            if(strlen($_SESSION['login'])==0){   
        header('location:login.php');
        }
        else{
        mysqli_query($con,"insert into wishlist(userId,productId) values('".$_SESSION['id']."','$pid')");
        echo "<script>alert('Product aaded in wishlist');</script>";
        header('location:my-wishlist.php');
            
        }
    }
    //This is for submit
    if(isset($_POST['submit'])){
        $qty=$_POST['quality'];
        $price=$_POST['price'];
        $value=$_POST['value'];
        $name=$_POST['name'];
        $summary=$_POST['summary'];
        $review=$_POST['review'];
        mysqli_query($con,"insert into productreviews(productId,quality,price,value,name,summary,review) values('$pid','$qty','$price','$value','$name','$summary','$review')");
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
    <section class="hero hero-normal">
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
                </div>
            </div>
        </div>
    </section>
    <!-- Hero Section End -->

    <!-- Breadcrumb Section Begin -->
<!--
    <section class="breadcrumb-section set-bg" data-setbg="img/breadcrumb.jpg">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="breadcrumb__text">
                        <h2>Shopping Cart</h2>
                        <div class="breadcrumb__option">
                            <a href="./index.html">Home</a>
                            <span>Shopping Cart</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
-->
    <!-- Breadcrumb Section End -->

    <!-- Shoping Cart Section Begin -->
    <section class="shoping-cart spad">
        <div class="container">
            <form name="cart" method="post">        
                    <?php
                        if(!empty($_SESSION['cart'])){
	                ?>
                
            <div class="row">
                <div class="col-lg-12">
                    <div class="shoping__cart__table">
                        <table>
                            <thead>
                                <tr>
                                    <th>Image</th>
                                    <th>Name</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th>Total</th>
                                    <th>Romove</th>
                                </tr>
                            </thead>
                            
                            <?php
                                $pdtid=array();
                                $sql = "SELECT * FROM products WHERE id IN(";
                                        foreach($_SESSION['cart'] as $id => $value){
                                            $sql .=$id. ",";
                                        }
                                            $sql=substr($sql,0,-1) . ") ORDER BY id ASC";
                                            $query = mysqli_query($con,$sql);
                                            $totalprice=0;
                                            $totalqunty=0;
                                            $total_subtotal=0;
                                            $sum_subtotal=0;
    
                                            if(!empty($query)){
                                                while($row = mysqli_fetch_array($query)){
                                                    //total shows only
                                                    $quantity=$_SESSION['cart'][$row['id']]['quantity'];
                                                    
                                                    $subtotal= $_SESSION['cart'][$row['id']]['quantity']*$row['productPrice']+$row['shippingCharge']+2.59+1.69;
                                                    
                                                    $totalprice += $subtotal;
                                                    $_SESSION['qnty']=$totalqunty+=$quantity;
                                                    
                                                    //subtotal shows only
                                                    $total_subtotal = $_SESSION['cart'][$row['id']]['quantity']*$row['productPrice'];
                                                    
                                                    $sub += $total_subtotal;
                                                    $_SESSION['qnty']=$totalqunty+=$quantity;

                                                    array_push($pdtid,$row['id']);
                                                    //print_r($_SESSION['pid'])=$pdtid;exit;
                               ?>
                            
                            
                                
                                <!-- Product Image -->
                                <tr>
                                    <td class="shoping__product">
                                        <img src="admin/images/<?php echo $row['id'];?>/<?php echo $row['Image1'];?>" alt="" width="80" height="100">
                                    </td>
                                    
                                    <!-- Product Name-->
                                    <td class="shoping__product">
                                        <h7><a href='javascript:;'><a href="shop-details.php?pid=<?php echo htmlentities($pd=$row['id']);?>" ><?php echo $row['productName'];
                                        $_SESSION['sid']=$pd;
						              ?></a></a></h7>
                                    </td>
                                    
                                    <!-- Product Price -->
                                    <td class="shoping__product">
                                        <?php echo "$"." ".$row['productPrice']; ?>.00
                                    </td>
                                    
                                    <!-- Product Qunatity -->
                                    <td class="shoping__product">
                                        <div class="quantity">
                                            <div class="pro-qty">
<!--                                                <input type="text" value="1">-->
                                                
                                                <input type="text" value="<?php echo $_SESSION['cart'][$row['id']]['quantity']; ?>" name="quantity[<?php echo $row['id']; ?>]">
                                            </div>
                                        </div>
                                    </td>
                                    
                                    <!-- Total Price for quantity -->
                                    <td class="shoping__product">
                                        $<?php echo ($_SESSION['cart'][$row['id']]['quantity']*$row['productPrice']+$row['shippingCharge']); ?>.00
                                    </td>
                                    
                                    <!-- Remove -->
                                    <td class="shoping__product">
                                        <button name="remove_code[]" value="<?php echo htmlentities($row['id']);?>">X</button>
                                    </td>
                                </tr>
                                <?php } }
                                $_SESSION['pid']=$pdtid;
				            ?>
         
                        </table>
                                <div class="shoping__cart__btns">
                                    <a href="index.php" class="primary-btn cart-btn">CONTINUE SHOPPING</a>
                                    <input  type="submit" name="submit" value="Update shopping cart" class="primary-btn cart-btn cart-btn-right">
                                </div>
                    </div>
                </div>
            </div>
                
            <?php } else {
            echo "Your shopping Cart is empty";
            }?>
            </form> 
            
        </div>
    </section>
    <!-- Shoping Cart Section End -->

    
    <!-- Checkout Section Begin -->
    <section class="checkout spad">
        <div class="container">
            <div class="checkout__form">
                <h4>Billing Information</h4>
                <form action="#">
                    <div class="row">
                        <div class="col-lg-5 col-md-6">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="checkout__input">
                                        <p>Fist Name<span>*</span></p>
                                        <input type="text">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="checkout__input">
                                        <p>Last Name<span>*</span></p>
                                        <input type="text">
                                    </div>
                                </div>
                            </div>
                            <div class="checkout__input">
                                <p>Country<span>*</span></p>
                                <input type="text">
                            </div>
                            <div class="checkout__input">
                                <p>Address<span>*</span></p>
                                <input type="text" placeholder="Street Address" class="checkout__input__add">
                                <input type="text" placeholder="Apartment, suite, unite ect (optinal)">
                            </div>
                            <div class="checkout__input">
                                <p>Town/City<span>*</span></p>
                                <input type="text">
                            </div>
                            <div class="checkout__input">
                                <p>Country/State<span>*</span></p>
                                <input type="text">
                            </div>
                            <div class="checkout__input">
                                <p>Postcode / ZIP<span>*</span></p>
                                <input type="text">
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="checkout__input">
                                        <p>Phone<span>*</span></p>
                                        <input type="text">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="checkout__input">
                                        <p>Email<span>*</span></p>
                                        <input type="text">
                                    </div>
                                </div>
                            </div>
                            <div class="checkout__input__checkbox">
                                <label for="acc">
                                    Create an account?
                                    <input type="checkbox" id="acc">
                                    <span class="checkmark"></span>
                                </label>
                            </div>
                            <p>Create an account by entering the information below. If you are a returning customer
                                please login at the top of the page</p>
                            <div class="checkout__input">
                                <p>Account Password<span>*</span></p>
                                <input type="text">
                            </div>
                            <div class="checkout__input__checkbox">
                                <label for="diff-acc">
                                    Ship to a different address?
                                    <input type="checkbox" id="diff-acc">
                                    <span class="checkmark"></span>
                                </label>
                            </div>
                            <div class="checkout__input">
                                <p>Order notes<span>*</span></p>
                                <input type="text"
                                    placeholder="Notes about your order, e.g. special notes for delivery.">
                            </div>
                        </div>
                        
                        <?php
                        if(!empty($_SESSION['cart'])){
	                       ?>
                            <div class="col-lg-7">
                                <div class="shoping__checkout">
                                    <h5>Cart Total</h5>
                                    <ul>
                                        <li>Subtotal <span>$<?php echo $_SESSION['tp']="$sub". ".00"; ?></span></li>
                                        
                                        <li>Shopping cost <span>$20</span></li> 

                                        <li>Tax cost <span>$2.59</span></li>

                                        <li>Warrent cost <span>$1.69</span></li>

                                        <li>All total <span>$<?php echo $_SESSION['tp']="$totalprice". ".00"; ?></span></li>

                                    </ul>
                                    
                                    <div class="checkout__input__checkbox">
                                            <label for="acc-or">
                                                Create an account?
                                                <input type="checkbox" id="acc-or">
                                                <span class="checkmark"></span>
                                            </label>
                                        </div>
                                        <p>Lorem ipsum dolor sit amet, consectetur adip elit, sed do eiusmod tempor incididunt
                                            ut labore et dolore magna aliqua.
                                        </p>
                                        <div class="checkout__input__checkbox">
                                            <label for="payment">
                                                Check Payment
                                                <input type="checkbox" id="payment">
                                                <span class="checkmark"></span>
                                            </label>
                                        </div>
                                        <div class="checkout__input__checkbox">
                                            <label for="paypal">
                                                Paypal
                                                <input type="checkbox" id="paypal">
                                                <span class="checkmark"></span>
                                            </label>
                                        </div>
                                    <a href="cart_To_check.php?cart_check_id=<?php echo htmlentities($row['id']);?>" class="primary-btn">PROCESS TO CHECKOUT</a>
                                </div>
                                
                                
                                <br>
                        <div class="row">
                            <div class="col-lg-10">
                                <div class="shoping__continue">
                                    <div class="shoping__discount">
                                        <h5>Discount Codes</h5>
                                        <form action="#">
                                            <input type="text" placeholder="Enter your coupon code">
                                            <button type="submit" class="site-btn">APPLY COUPON</button>
                                        </form>
                                        <br>
                                        <div class="shoping__cart__btns">
                                            <a href="index.php" class="primary-btn cart-btn">CONTINUE SHOPPING</a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                            </div>
                        
                        
                        <?php } 
                            else {?>
                                    <div class="col-lg-7">
                               <div class="shoping__checkout">
                                    <h5>Cart Total</h5>
                                    <ul>
                                        <li>Subtotal <span>$00.00</span></li>
                                        
                                        <li>Shopping cost <span>$00.00</span></li> 

                                        <li>Tax cost <span>$00.00</span></li>

                                        <li>Warrent cost <span>$00.00</span></li>

                                        <li>All total <span>$00.00</span></li>

                                    </ul>
                                    
                                    <div class="checkout__input__checkbox">
                                            <label for="acc-or">
                                                Create an account?
                                                <input type="checkbox" id="acc-or">
                                                <span class="checkmark"></span>
                                            </label>
                                        </div>
                                        <p>Lorem ipsum dolor sit amet, consectetur adip elit, sed do eiusmod tempor incididunt
                                            ut labore et dolore magna aliqua.
                                        </p>
                                        <div class="checkout__input__checkbox">
                                            <label for="payment">
                                                Check Payment
                                                <input type="checkbox" id="payment">
                                                <span class="checkmark"></span>
                                            </label>
                                        </div>
                                        <div class="checkout__input__checkbox">
                                            <label for="paypal">
                                                Paypal
                                                <input type="checkbox" id="paypal">
                                                <span class="checkmark"></span>
                                            </label>
                                        </div>
                                    <a class="primary-btn">PROCESS TO CHECKOUT</a>
                                </div>
                                
                                
                                <br>
                        <div class="row">
                            <div class="col-lg-10">
                                <div class="shoping__continue">
                                    <div class="shoping__discount">
                                        <h5>Discount Codes</h5>
                                        <form action="#">
                                            <input type="text" placeholder="Enter your coupon code">
                                            <button class="site-btn">APPLY COUPON</button>
                                        </form>
                                        <br>
                                        <div class="shoping__cart__btns">
                                            <a href="index.php" class="primary-btn cart-btn">CONTINUE SHOPPING</a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                            </div>
                            <?php 
                                 }
                                ?>
                        
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
    <!-- Checkout Section End -->
    <!-- Footer Section Begin -->
    <footer class="footer spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="footer__about">
                        <div class="footer__about__logo">
                            <a href="./index.html"><img src="img/logo.png" alt=""></a>
                        </div>
                        <ul>
                            <li>Address: 60-49 Road 11378 New York</li>
                            <li>Phone: +65 11.188.888</li>
                            <li>Email: hello@colorlib.com</li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-6 offset-lg-1">
                    <div class="footer__widget">
                        <h6>Useful Links</h6>
                        <ul>
                            <li><a href="#">About Us</a></li>
                            <li><a href="#">About Our Shop</a></li>
                            <li><a href="#">Secure Shopping</a></li>
                            <li><a href="#">Delivery infomation</a></li>
                            <li><a href="#">Privacy Policy</a></li>
                            <li><a href="#">Our Sitemap</a></li>
                        </ul>
                        <ul>
                            <li><a href="#">Who We Are</a></li>
                            <li><a href="#">Our Services</a></li>
                            <li><a href="#">Projects</a></li>
                            <li><a href="#">Contact</a></li>
                            <li><a href="#">Innovation</a></li>
                            <li><a href="#">Testimonials</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-4 col-md-12">
                    <div class="footer__widget">
                        <h6>Join Our Newsletter Now</h6>
                        <p>Get E-mail updates about our latest shop and special offers.</p>
                        <form action="#">
                            <input type="text" placeholder="Enter your mail">
                            <button type="submit" class="site-btn">Subscribe</button>
                        </form>
                        <div class="footer__widget__social">
                            <a href="#"><i class="fa fa-facebook"></i></a>
                            <a href="#"><i class="fa fa-instagram"></i></a>
                            <a href="#"><i class="fa fa-twitter"></i></a>
                            <a href="#"><i class="fa fa-pinterest"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="footer__copyright">
                        <div class="footer__copyright__text"><p><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
  Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made with <i class="fa fa-heart" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a>
  <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. --></p></div>
                        <div class="footer__copyright__payment"><img src="img/payment-item.png" alt=""></div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- Footer Section End -->

    <!-- Js Plugins -->
    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.nice-select.min.js"></script>
    <script src="js/jquery-ui.min.js"></script>
    <script src="js/jquery.slicknav.js"></script>
    <script src="js/mixitup.min.js"></script>
    <script src="js/owl.carousel.min.js"></script>
    <script src="js/main.js"></script>


</body>

</html>