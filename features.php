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
			<h2>Features</h2>
			<div class="site-beradcamb">
				<a href="./">Home</a>
				<span><i class="fa fa-angle-right"></i> Features</span>
			</div>
		</div>
	</section>
	<!-- Page info end -->
	<!-- About section -->
	<?php
	require_once "rootpageutil/whatispin.php";
	?>
	<!-- About section end -->
	<!-- Features section -->
	<?php
	require_once "rootpageutil/ourfeatures.php";
	?>
	<!-- Features section end -->
	<!-- Review section -->
	<?php
		//require_once "rootpageutil/reviewsection.php";
	?>
	<!-- Review section end -->
	<!-- Newsletter section -->
	<?php
		//require_once "rootpageutil/newslettersubscription.php";
	?>
	<!-- Newsletter section end -->
	<!-- Footer section -->
	<?php
	require_once "src/footer.php";
	?>
</body>
</html>