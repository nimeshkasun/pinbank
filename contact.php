<!DOCTYPE html>
<html lang="en">
<head>
	<?php
	require_once "src/head.php";
	?>
</head>
<body>
	<?php
	require_once "src/loaderlogomenu.php";
	?>
	<!-- Page info section -->
	<section class="page-info-section">
		<div class="container">
			<h2>Contact Us</h2>
			<div class="site-beradcamb">
				<a href="">Home</a>
				<span><i class="fa fa-angle-right"></i> Contact us</span>
			</div>
		</div>
	</section>
	<!-- Page info end -->
	<!-- Contact section -->
	<?php
	require_once "rootpageutil/contactform.php";

	?>
	<!-- Contact section end -->
	<!-- Newsletter section -->
	<?php
		//require_once "rootpageutil/newslettersubscription.php";
	?>
	<!-- Newsletter section end -->
	<!-- Footer section -->
	<?php
		require_once "src/footer.php";
	?>

	<!-- load for map -->
	<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB0YyDTa0qqOjIerob2VTIwo_XVMhrruxo"></script>
	<script src="js/map.js"></script>
</body>
</html>