<style>
*{
	margin:0px;
	padding:0px;
}

#main{
	border:1px solid black;
	width:500px;
	height:500px;
	/*margin:24px auto;*/
}
#message_area{
	width:98%;
	/*border:1px solid blue;*/
	height:440px;
	padding:0% 1%;
	overflow: auto; 
}
</style>

<body>

<?php 
session_start();   //to start the php session

if(isset($_SESSION['chatEmail'])){   //to set the session variable

	$lastnamesaved = $_SESSION["lastnamesaved"];
	/*echo 'Welcome '.$lastnamesaved;
	echo '<br>';
	echo '<a href="../signut.php">LOGOUT</a>';*/
}
else{
	header("location: ../signin.php"); //to redirect
}
?>

<script src="./js/jquery-chat.js"></script>
<script>
    $(document).ready(function(){
		 $("#message_area").load("support_chat_fetch.php");
        setInterval(function() {
            $("#message_area").load("support_chat_fetch.php");
        }, 1000);
    });
</script>

<div id="main">                   
	<div id="message_area">  

	<?php
		require_once '../db_class/dbClass.php'; 
		if(isset($_POST['submit'])){
			$message = $_POST['message'];
			$q='INSERT INTO tblmessage (message,email,lName)VALUES("'.$message.'", "'.$_SESSION['chatEmail'].'", "'.$lastnamesaved.'")';
			
			
			if(!isset($message) || trim($message) == ''){
				echo '<script language="javascript">';
				echo 'alert("Please Check again")';
				echo '</script>';
			}
			else if(mysqli_query($conn, $q)){
				echo '<h4 style="color:red;">'.$_SESSION['lastnamesaved'].'</h4>';
				echo '<p>'.$message.'</p>';
			}
		}


	?> 
	</div>

	<form method="POST">
	<input type="text" name="message" style="width:420px;height:50px;margin-top:2px;"  placeholder="Say something..." />
	<input type="submit" name="submit" style="width:70px;height:50px;" value="Send" />
	</form>


</div>
</body>
</html>