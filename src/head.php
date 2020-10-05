	<title>Pin - Smart, Secure and Convenient way to Bank</title>
	<meta charset="UTF-8">
	<meta name="description" content="Cryptocurrency Landing Page Template">
	<meta name="keywords" content="cryptocurrency, unica, creative, html">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<!-- Favicon -->
	<link href="img/favicon.ico" rel="shortcut icon"/>

	<!-- Google Fonts -->
	<link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet">

	<!-- Stylesheets -->
	<link rel="stylesheet" href="css/bootstrap.min.css"/>
	<link rel="stylesheet" href="css/font-awesome.min.css"/>
	<link rel="stylesheet" href="css/themify-icons.css"/>
	<link rel="stylesheet" href="css/animate.css"/>
	<link rel="stylesheet" href="css/owl.carousel.css"/>
	<link rel="stylesheet" href="css/style.css"/>
	<link rel="stylesheet" href="./css/alert.css">

	<link rel="stylesheet" href="./css/intlTelInput.css">
	<!--<link rel="stylesheet" href="./css/demo.css">-->
	<?php
	try{
		require_once './db_class/dbClass.php';
	}catch(Exception $e){
		try{
			require_once '../db_class/dbClass.php';
		}catch(Exception $e){
			try{
				require_once '../../db_class/dbClass.php';
			}catch(Exception $e){
				require_once '../../../db_class/dbClass.php';
			}
		}
	}
	
	
	?>
	<!--[if lt IE 9]>
	  <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
	  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->