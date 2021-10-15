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
<!--
        <div class="humberger__menu__logo">
            <a href="#"><img src="img/logo.png" alt=""></a>
        </div>
-->
        <div class="humberger__menu__cart">
            <ul>
                                        
						
<!--                        <h3>Admin</h3>-->
						<li class="nav-user dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown">
								<img src="images/user.png" class="nav-avatar" />
<!--								<b class="caret"></b>-->
							</a>
                            
						</li>
                
                        <li><a href="#">Admin</a></li>
                

					</ul>
        </div>

        <nav class="humberger__menu__nav mobile-menu">
            <ul>
                <li><a href="category.php"><i class="menu-icon icon-tasks"></i> Create Category </a></li>
                
                <li><a href="subcategory.php"><i class="menu-icon icon-tasks"></i>Sub Category </a></li>
                
                <li><a href="#">Pages</a>
                    <ul class="header__menu__dropdown">
                        <li><a href="./shop-details.php">Shop Details</a></li>
                        <li><a href="./shoping-cart.php">Shoping Cart</a></li>
                        <li><a href="./checkout.php">Check Out</a></li>
                        <li><a href="./blog-details.php">Blog Details</a></li>
                    </ul>
                </li>
                
                <li><a href="insert-product.php"><i class="menu-icon icon-paste"></i>Insert Product </a></li>
                
                <li><a href="manage-products.php"><i class="menu-icon icon-table"></i>Manage Products </a></li>
                
                <li><a href="subcategory.php"><i class="menu-icon icon-tasks"></i>Login </a></li>
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
<!--
                <li><i class="fa fa-envelope"></i><?php if(strlen($_SESSION['login'])){?>
				            <li><i class="icon fa fa-user"></i>Welcome -<?php echo htmlentities($_SESSION['username']);?></li>
				    <?php }?>
                
                </li>
-->
<!--                <li>Free Shipping for all Order of $99</li>-->
            </ul>
        </div>
    </div>
    <!-- Humberger End -->

    <!-- Header Section Begin -->
    <header class="header">
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
                            <li><a href="category.php"><i class="menu-icon icon-tasks"></i> Create Category </a></li>
                            
                            <li><a href="subcategory.php"><i class="menu-icon icon-tasks"></i>Sub Category </a></li>
                            
                            <li><a href="#">Pages</a>
                                <ul class="header__menu__dropdown">
                                    <li><a href="./shop-details.php">Shop Details</a></li>
                                    <li><a href="./shoping-cart.php">Shoping Cart</a></li>
                                    <li><a href="./checkout.php">Check Out</a></li>
                                    <li><a href="./blog-details.php">Blog Details</a></li>
                                </ul>
                            </li>
                            
                            <li><a href="insert-product.php"><i class="menu-icon icon-paste"></i>Insert Product </a></li>
                            
                            <li><a href="manage-products.php"><i class="menu-icon icon-table"></i>Manage Products </a></li>

                        </ul>
                    </nav>
                </div>        
            </div>

        </div>
    </header>
    <!-- Header Section End -->