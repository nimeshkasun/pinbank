<!-- Page Preloder -->
<div id="preloder">
	<div class="loader"></div>
</div>

<!-- Header section -->
<header class="header-section clearfix">
	<div class="container-fluid">
		<a href="index.php" class="site-logo">
			<img src="img/logo.png" alt="">
		</a>
		<div class="responsive-bar"><i class="fa fa-bars"></i></div>
		
		<?php
		session_start();
		if(!isset($_SESSION['loggedIn'])){
			echo "<a href='./signin.php' class='user'><i class='fa fa-user'></i></a>";
			echo "<a href='./signin.php' class='site-btn'>Sign In / Sign Up</a>";
		}if(isset($_SESSION['loggedIn'])){
			echo "<a href='./signout.php' class='user'><i class='fa fa-user'></i></a>";
			echo "<a href='./signout.php' class='site-btn'>Sign Out</a>";
		}
		?>
		<nav class="main-menu">
			<ul class="menu-list">
				<li><a href="index.php">Home</a></li>
				<li><a href="features.php">Features</a></li>
				<li><a href="about.php">About</a></li>
				<li><a href="contact.php">Contact</a></li>
				<?php
					if(isset($_SESSION['loggedIn'])){
						if($_SESSION['userTypesaved'] == "staAdmin" || $_SESSION['userTypesaved'] == "staLocal" || $_SESSION['userTypesaved'] == "staSupp"){
							echo "<li><a href='./admin/'>My Account</a></li>";
						}else{
							echo "<li><a href='./myaccount/'>My Account</a></li>";
						}
					}
				?>
			</ul>
		</nav>
	</div>
</header>
<!-- Header section end -->