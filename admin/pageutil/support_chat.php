<style>
*{
    margin:0px;
    padding:0px;
}

#mainChatArea{
    /*border:1px solid black;*/
    /*width:500px;*/
    height:750px;
    /*margin:24px auto;*/
}
#message_area{
    /*width:98%;*/
    /*border:1px solid blue;*/
    height:690px;
    padding:0% 1%;
    overflow: auto; 
}
</style>

<?php 
require_once './pageutil/head.php';
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

<script src="../js/jquery-chat.js"></script>
<script>
    $(document).ready(function(){
         $("#message_area").load("./pageutil/support_chat_fetch.php");
        setInterval(function() {
            $("#message_area").load("./pageutil/support_chat_fetch.php");
        }, 1000);
    });
</script>


<div class="card social-card text-white bg-c-pink">
    <div class="card-block">
    	<div class="row align-items-center">
			<div class="col">
		        <div id="mainChatArea">                   
					<div id="message_area">  

					</div>
				</div>
		    </div>
		</div>
    </div>
</div>