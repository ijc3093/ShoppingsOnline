<?php 

 if(isset($_Get['action'])){
		if(!empty($_SESSION['cart'])){
		foreach($_POST['quantity'] as $key => $val){
			if($val==0){
				unset($_SESSION['cart'][$key]);
			}else{
				$_SESSION['cart'][$key]['quantity']=$val;
			}
		}
		}
	}
?>
<!-- Humberger Begin -->
    <div class="humberger__menu__overlay"></div>
    <div class="humberger__menu__wrapper">
        <div class="humberger__menu__logo">
            <a href="#"><img src="img/logo.png" alt=""></a>
        </div>
        <div class="humberger__menu__cart">
            <ul>
                <li><a href="#"><i class="fa fa-heart"></i> <span>1</span></a></li>
                <li><a href="#"><i class="fa fa-shopping-bag"></i> <span>3</span></a></li>
            </ul>
            <div class="header__cart__price">item: <span>$150.00</span></div>
        </div>
        <div class="humberger__menu__widget">
            <div class="header__top__right__language">
                <img src="img/language.png" alt="">
                <div>English</div>
                <span class="arrow_carrot-down"></span>
                <ul>
                    <li><a href="#">Spanis</a></li>
                    <li><a href="#">English</a></li>
                </ul>
            </div>
            <div class="header__top__right__auth">
                <a href="#"><i class="fa fa-user"></i> Login</a>
            </div>
        </div>
        <nav class="humberger__menu__nav mobile-menu">
            <ul>
                <li class="active"><a href="./index.php">Home</a></li>
                <li><a href="./shop-grid.php">Shop</a></li>
                <li><a href="#">Pages</a>
                    <ul class="header__menu__dropdown">
                        <li><a href="./shop-details.php">Shop Details</a></li>
                        <li><a href="./shoping-cart.php">Shoping Cart</a></li>
                        <li><a href="./checkout.php">Check Out</a></li>
                        <li><a href="./blog-details.php">Blog Details</a></li>
                    </ul>
                </li>
                <li><a href="./blog.php">Blog</a></li>
                <li><a href="./contact.php">Contact</a></li>
            </ul>
        </nav>
        <div id="mobile-menu-wrap"></div>
        <div class="header__top__right__social">
            <a href="#"><i class="fa fa-facebook"></i></a>
            <a href="#"><i class="fa fa-twitter"></i></a>
            <a href="#"><i class="fa fa-linkedin"></i></a>
            <a href="#"><i class="fa fa-pinterest-p"></i></a>
        </div>
        <div class="humberger__menu__contact">
            <ul>
                <li><i class="fa fa-envelope"></i><?php if(strlen($_SESSION['login'])){?>
				            <li><i class="icon fa fa-user"></i>Welcome -<?php echo htmlentities($_SESSION['username']);?></li>
				    <?php }?>
                
                </li>
                <li>Free Shipping for all Order of $99</li>
            </ul>
        </div>
    </div>
    <!-- Humberger End -->

    <!-- Header Section Begin -->
    <header class="header">
        <div class="header__top">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 col-md-6">
                        <div class="header__top__left">
                            <ul>
                                <li><i class="fa fa-envelope"></i> 
                                    <?php if(strlen($_SESSION['login'])){?>
				                    <li><i class="icon fa fa-user"></i>Welcome -<?php echo htmlentities($_SESSION['username']);?></li>
				                    <?php }?>
                                </li>
                                <li><a href="http://localhost/My-Web-sites/Management-System/Shopping_php/admin">Admin</a></li>
                                <li>Free Shipping for all Order of $99</li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6">
                        <div class="header__top__right">
                            <div class="header__top__right__social">
                                <a href="#"><i class="fa fa-facebook"></i></a>
                                <a href="#"><i class="fa fa-twitter"></i></a>
                                <a href="#"><i class="fa fa-linkedin"></i></a>
                                <a href="#"><i class="fa fa-pinterest-p"></i></a>
                            </div>
                            <div class="header__top__right__language">
                                <img src="img/language.png" alt="">
                                <div>English</div>
                                <span class="arrow_carrot-down"></span>
                                <ul>
                                    <li><a href="#">Spanis</a></li>
                                    <li><a href="#">English</a></li>
                                </ul>
                                
                            </div>
                            <div class="header__top__right__auth">
                                <?php if(strlen($_SESSION['login'])==0){?>
                                    <a href="login.php"><i class="fa fa-user"></i>Login</a>
                    
                                <?php }else{?>
                                    <a href="logout.php"><i class="fa fa-user"></i>Logout</a>
                                <?php }?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <div class="header__logo">
                        <a href="./index.php"><img src="img/logo.png" alt=""></a>
                    </div>
                </div>
                <div class="col-lg-6">
                    <nav class="header__menu">
                        <ul>
                            <li class="active"><a href="./index.php">Home</a></li>
                            <li><a href="./shop-grid.php">Shop</a></li>
                            <li><a href="#">Pages</a>
                                <ul class="header__menu__dropdown">
                                    <li><a href="./shop-details.php">Shop Details</a></li>
                                    <li><a href="./shoping-cart.php">Shoping Cart</a></li>
                                    <li><a href="./checkout.php">Check Out</a></li>
                                    <li><a href="./blog-details.php">Blog Details</a></li>
                                </ul>
                            </li>
                            <li><a href="./blog.php">Blog</a></li>
                            <li><a href="./contact.php">Contact</a></li>
<!--
                            <li><a href="./category.php">Category</a></li>
                            <li><a href="./sub-category.php">Sub-Category</a></li>
-->
                        </ul>
                    </nav>
                </div>
                <div class="col-lg-3">
                    <?php
                        if(!empty($_SESSION['cart'])){
                    ?>
                    <div class="header__cart">
                        
                        <?php
                            $pdtid=array();
                            $sql = "SELECT * FROM products WHERE id IN(";
                            foreach($_SESSION['cart'] as $id => $value){
                            $sql .=$id. ",";
                            }
                            $sql=substr($sql,0,-1) . ") ORDER BY id ASC";
                            $query = mysqli_query($con,$sql);
                            $totalprice=0;
                            
    
                            if(!empty($query)){
                            while($row = mysqli_fetch_array($query)){
                            $quantity=$_SESSION['cart'][$row['id']]['quantity'];
                            $subtotal= $_SESSION['cart'][$row['id']]['quantity']*$row['productPrice']+$row['shippingCharge'];
                            $totalprice += $subtotal;
                            $_SESSION['qnty']=$totalqunty+=$quantity;
                            array_push($pdtid,$row['id']);
                            //print_r($_SESSION['pid'])=$pdtid;exit;
                        ?>
                        
                        <?php } }
                            $_SESSION['pid']=$pdtid;
				        ?>
                        <ul>
                            <li><a href="#"><i class="fa fa-heart"></i> <span>0</span></a>
                            </li>
                            
                            <li><a href="shoping-cart.php"><i class="fa fa-shopping-bag"></i> 
                                    <!-- Count number with red circle in the tab. Look at cart in the tab-->
                                    <?php
                                    if(!empty($_SESSION['cart'])){
                                    ?><span class="count"><?php echo $_SESSION['qnty'];?>
                                        </span>
                                    
                                    <?php } ?>
                                </a>
                            </li>
                        </ul>

                        <div class="header__cart__price">item: <span>$<?php echo $_SESSION['tp']="$totalprice". ".00"; ?></span>
                        </div>
                        
                        <?php }
                    
                        else { ?>
                            <div class="header__cart">
                            <ul>
                                <li><a href="#"><i class="fa fa-heart"></i> <span>0</span></a>
                                </li>

                                <li><a href="shoping-cart.php"><i class="fa fa-shopping-bag"></i><span>0</span>
                                    </a>
                                </li>
                            </ul>

                                <div class="header__cart__price">item: <span>$00.00</span></div>
                            </div>
                            
                        
                        
                        <?php 
                            }
                        ?>
                    </div>
                </div>
                
                
            </div>
            <div class="humberger__open">
                <i class="fa fa-bars"></i>
            </div>
        </div>
    </header>
    <!-- Header Section End -->