<?php
session_start();
error_reporting(0);
include('includes/config.php');

// Code user Registration
if(isset($_POST['submit'])){
    $name=$_POST['fullname'];
    $email=$_POST['emailid'];
    $contactno=$_POST['contactno'];
    $password=md5($_POST['password']);
    $query=mysqli_query($con,"insert into users(name,email,contactno,password) values('$name','$email','$contactno','$password')");
    if($query){
        echo "<script>alert('You are successfully register');</script>";
    }
    else{
    echo "<script>alert('Not register something went worng');</script>";
    }
}

// Code for User login
if(isset($_POST['login'])){
   $email=$_POST['email'];
   $password=md5($_POST['password']);
    $query=mysqli_query($con,"SELECT * FROM users WHERE email='$email' and password='$password'");
    $num=mysqli_fetch_array($query);

    if($num>0){
        $extra="index.php";
        $_SESSION['login']=$_POST['email'];
        $_SESSION['id']=$num['id'];
        $_SESSION['username']=$num['name'];
        $uip=$_SERVER['REMOTE_ADDR'];
        $status=1;
        $log=mysqli_query($con,"insert into userlog(userEmail,userip,status) values('".$_SESSION['login']."','$uip','$status')");
        $host=$_SERVER['HTTP_HOST'];
        $uri=rtrim(dirname($_SERVER['PHP_SELF']),'/\\');
        header("location:http://$host$uri/$extra");
        exit();
    }

        else{
        $extra="login.php";
        $email=$_POST['email'];
        $uip=$_SERVER['REMOTE_ADDR'];
        $status=0;
        $log=mysqli_query($con,"insert into userlog(userEmail,userip,status) values('$email','$uip','$status')");
        $host  = $_SERVER['HTTP_HOST'];
        $uri  = rtrim(dirname($_SERVER['PHP_SELF']),'/\\');
        header("location:http://$host$uri/$extra");
        $_SESSION['errmsg']="Invalid email id or Password";
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Ogani Template">
    <meta name="keywords" content="Ogani, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>DevicE-M | Shop</title>

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200;300;400;600;900&display=swap" rel="stylesheet">

    <!-- Css Styles -->
    <link rel="stylesheet" href="css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="css/font-awesome.min.css" type="text/css">
    <link rel="stylesheet" href="css/elegant-icons.css" type="text/css">
    <link rel="stylesheet" href="css/nice-select.css" type="text/css">
    <link rel="stylesheet" href="css/jquery-ui.min.css" type="text/css">
    <link rel="stylesheet" href="css/owl.carousel.min.css" type="text/css">
    <link rel="stylesheet" href="css/slicknav.min.css" type="text/css">
    <link rel="stylesheet" href="css/style.css" type="text/css">
    
    <script type="text/javascript">
    function valid(){
     if(document.register.password.value!= document.register.confirmpassword.value){
            alert("Password and Confirm Password Field do not match  !!");
            document.register.confirmpassword.focus();
            return false;
        }
        return true;
    }
    </script>
    
    <script>
    function userAvailability() {
        $("#loaderIcon").show();
        jQuery.ajax({
        url: "check_availability.php",
        data:'email='+$("#email").val(),
        type: "POST",
        success:function(data){
        $("#user-availability-status1").html(data);
        $("#loaderIcon").hide();
        },
        error:function (){}
        });
    }
    </script>
    
</head>

<body>
    <!-- Page Preloder -->
    <div id="preloder">
        <div class="loader"></div>
    </div>
    <?php include('includes/top.php');?>
    <!-- Humberger Begin -->
    <div class="humberger__menu__overlay"></div>
    
    <!-- Hero Section Begin -->
    <section class="hero hero-normal">
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <div class="hero__categories">
                        <div class="hero__categories__all">
                            <i class="fa fa-bars"></i>
                            <span>All departments</span>
                        </div>
                        <ul>
                            <li><a href="#">Fresh Meat</a></li>
                            <li><a href="#">Vegetables</a></li>
                            <li><a href="#">Fruit & Nut Gifts</a></li>
                            <li><a href="#">Fresh Berries</a></li>
                            <li><a href="#">Ocean Foods</a></li>
                            <li><a href="#">Butter & Eggs</a></li>
                            <li><a href="#">Fastfood</a></li>
                            <li><a href="#">Fresh Onion</a></li>
                            <li><a href="#">Papayaya & Crisps</a></li>
                            <li><a href="#">Oatmeal</a></li>
                            <li><a href="#">Fresh Bananas</a></li>
                        </ul>
                    </div>
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

    <!-- Checkout Section Begin -->
    <section class="checkout spad">
        <div class="container">
            <div class="checkout__form">
                
                    
                    <div class="row">           
                        <div class="col-lg-6">
                            <h4>Login</h4>
                            <p>
                                All fields are required.
                            </p>
                            
                            <form method="post">
                                <?php
                                    echo htmlentities($_SESSION['errmsg']);
                                    ?>
                                    <?php
                                    echo htmlentities($_SESSION['errmsg']="");
                                ?>
                                    <div class="checkout__input">
                                        <label for="exampleInputEmail1">Email Address<span>*</span>
                                        </label>
                                        <input type="email" name="email" id="exampleInputEmail" value="" placeholder="Email Address">
                                    </div>
                                    
                                    <div class="checkout__input">
                                        <label for="exampleInputPassword1">Password<span>*</span>
                                        </label>
                                        <input type="password" name="password" id="exampleInputPassword1" value="" placeholder="Password">
                                    </div>
                                    
                                    <div class="radio outer-xs">
		  	                           <a href="forgot-password.php" class="forgot-password pull-right">Forgot your Password?</a>
		                            </div> 
                                    
                                    <div class="checkout__input">
                                        <button type="submit" name="login" class="btn btn-primary">Login</button>
                                    </div>  
                                </form>
                                </div>
                                           
                        
                        <div class="col-lg-6">
                            <h4>Create a new account</h4>
                        <p>
                    		All fields are required.
                    	</p>
                            
                            <form role="form" method="post" name="register" onSubmit="return valid();">
                                <div class="checkout__input">
                                <label for="fullname">Full Name<span>*</span></label>
                                <input type="text" id="fullname" name="fullname" required="required" value="" placeholder="Full Name">
                            </div>
                                    
                            <div class="checkout__input">
                                <label for="exampleInputEmail2">Email Address<span>*</span></label>
                                <input type="email" id="email" onBlur="userAvailability()" placeholder="Email Address" name="emailid" required><span id="user-availability-status1" style="font-size:12px;"></span>
                            </div>
                            
                            <div class="checkout__input">
                                <label for="contactno">Contract No.<span>*</span></label>
                                <input type="text" id="contactno" value="" name="contactno" maxlength="10" required placeholder="Contact Number">
                            </div>
                            
                            <div class="checkout__input">
                                <label for="password">Password<span>*</span></label>
                                <input type="password" id="password" value="" placeholder="Password" id="password" name="password"  required>
                            </div>
                            
                            <div class="checkout__input">
                                <label for="confirmpassword">Confirm Password<span>*</span></label>
                                <input type="password" id="confirmpassword" value="" placeholder="Password" name="confirmpassword" required>
                            </div>
                            
                            
                            <div class="checkout__input">
                                <button type="submit" name="submit" class="btn btn-primary" id="submit">Create</button>
                            </div>
                            </form>
                            
                        </div>
                    </div>
                
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