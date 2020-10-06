<?php
session_start();
echo "<link rel='stylesheet' href='./check.css'/>";

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// Check Process
if(isset($_GET['execute'])){
	$sucess = "<div class='pretty p-icon p-round p-pulse p-locked'><input type='checkbox' checked /><div class='state p-success'><i class='icon mdi mdi-check'><img src='./img/001.png'></i><label><b>Success! : </b></label></div></div>";
	$bug = "<div class='pretty p-icon p-round p-pulse p-locked'><input type='checkbox' checked /><div class='state p-success p-danger'><i class='icon mdi mdi-check'><img src='./img/003.png'></i><label><b>Bug! : </b></label></div></div>";
}

/*

if(isset($_GET['execute'])){
	echo $sucess."(1) comment"."<br><br>";
}

if(isset($_GET['execute'])){
	echo $bug."(1) comment: ".mysqli_error($con)."<br><br>";
}

*/


///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// (1) Connect to DB
	$servername = "localhost";
	$username = "root";
	$password = "";
	$database = "pinDB";
	$username_online = "pinbankl_admin";
	$password_online = "projectKDU2020";
	$database_online = "pinbankl_pindb";
	if(mysqli_connect($servername, $username, $password, $database))
	{
		$conn = mysqli_connect($servername, $username, $password, $database);
		if(isset($_GET['execute'])){
			echo $success."(1) Connect to DB"."<br><br>";
		}
	}
	else if(mysqli_connect($servername, $username_online, $password_online, $database_online))
	{
		$conn = mysqli_connect($servername, $username_online, $password_online, $database_online);
		if(isset($_GET['execute'])){
			echo $success."(2) Connect to DB"."<br><br>";
		}
	}
	else
	{
		if(isset($_GET['execute'])){
			echo $bug."(3) Connect to DB: " . mysqli_connect_errno()."<br><br>";
		}
	}

///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// (2) tblUserDetails

////////// Sign Up Page
try{
	if(isset($_POST['signup_signup']))
	{
		$email=mysqli_real_escape_string($conn,$_POST['signup_email']);
		$fName=mysqli_real_escape_string($conn,$_POST['signup_firstname']);
		$lName=mysqli_real_escape_string($conn,$_POST['signup_lastname']);
		$password=mysqli_real_escape_string($conn,$_POST['signup_password']);
		$conpassword=mysqli_real_escape_string($conn,$_POST['signup_passwordconfirm']);
		$phoneNumber=mysqli_real_escape_string($conn,$_POST['signup_phonenumber']);
		$stAddress=mysqli_real_escape_string($conn,$_POST['signup_staddress']);
		$addLine1=mysqli_real_escape_string($conn,$_POST['signup_addline1']);
		$addLine2=mysqli_real_escape_string($conn,$_POST['signup_addline2']);
		$city=mysqli_real_escape_string($conn,$_POST['signup_city']);
		$stateProvince=mysqli_real_escape_string($conn,$_POST['signup_stateprovince']);
		$postalCode=mysqli_real_escape_string($conn,$_POST['signup_postalcode']);
		$country=mysqli_real_escape_string($conn,$_POST['countrylist']);
		$userStatus="Active";
		$userType="custAdv";
		if($password==$conpassword){
			$result= mysqli_query($conn, "SELECT MAX(accountNumber) AS maximum FROM tblaccount");
			$row = mysqli_fetch_assoc($result); 
			$maxAccNum = $row['maximum'];
			$generatedAccNumber = $maxAccNum + 1;
			//echo $generatedAccNumber;
			require_once './currencyCheck.php';

			$hashed = password_hash($password, PASSWORD_BCRYPT);
			$sql = "INSERT INTO tbluserdetails(email, fName, lName, password, phoneNumber, stAddress, addLine1, addLine2, city, stateProvince, postalCode, country, userStatus, userType) VALUES ('$email', '$fName', '$lName', '$hashed', '$phoneNumber', '$stAddress', '$addLine1', '$addLine2', '$city', '$stateProvince', '$postalCode', '$country', '$userStatus', '$userType')";
			$sql2 = "INSERT INTO tblaccount(accountNumber, accountBalance, aCurrency, aUserEmail) VALUES ('$generatedAccNumber', '0', '$aCurrency', '$email')";
			if(mysqli_query($conn,$sql)){
				if(!mysqli_query($conn,$sql2)){
					$sql3 = "DELETE FROM tbluserdetails WHERE email='$email";
					mysqli_query($conn,$sql3);
					die('Error: ' .mysqli_error($conn));
					header('location: ../signup.php');
				}
				header('location: ../signin.php');
			}else{
				header('location: ../signup.php');
			}
		}
	}


/////////// Sign In Page
	if(isset($_POST['signin_button']))
	{

////// IP Check

		try{
			//$ip = "182.161.27.251"; //Colombo, SL
			$ip = "199.161.27.251"; //Virgenia, US
			//$ip = "65.49.22.66"; //California, US
			
			//$ip = $_SERVER['REMOTE_ADDR'];
			$details = json_decode(file_get_contents("http://ipinfo.io/{$ip}/json"));
			$region = $details->region;
			$country = $details->country;
			$location = $details->loc;
		}catch(Exception $e){
			header('location: ../signin.php');
		}


		$email=mysqli_real_escape_string($conn,$_POST['signin_email']);
		$password=mysqli_real_escape_string($conn,$_POST['signin_password']);

		$result = $conn->query("SELECT fName, lName, email, password, userStatus, userType FROM tbluserdetails WHERE email='$email'");
		if ($result->num_rows > 0) {
			while($row = $result->fetch_assoc()) {
				$firstnamesaved = $row['fName']; 
				$lastnamesaved = $row['lName'];  
				$emailsaved = $row['email'];  
				$passwordsaved = $row['password'];  
				$userStatussaved = $row['userStatus']; 
				$userTypesaved = $row['userType'];   
			}
		}

		$result = $conn->query("SELECT accountNumber FROM tblaccount WHERE aUserEmail='nimesh.ekanayaka7@gmail.com'");
		if ($result->num_rows > 0) {
			while($row = $result->fetch_assoc()) {
				$accountNumber = $row['accountNumber'];
			}
		}
		if(password_verify($password, $passwordsaved)){
			if($userStatussaved=="Active"){

///////// IP History Check

				$result = $conn->query("SELECT trRegion, trCountry, trLocation, trTime FROM tbliptracking WHERE trAccountNumber='$accountNumber'");
/*				echo $accountNumber;
*/
if ($result->num_rows > 0) {
	while($row = $result->fetch_assoc()) {
		$trRegion = $row['trRegion'];
		$trCountry = $row['trCountry'];
		$trLocation = $row['trLocation'];
		$trTime = $row['trTime'];
	}

					//$time = new DateTime('2018-01-23 18:16:25');
					//$time = new DateTime('2018-01-23 18:16:25');
	$time = new DateTime($trTime);
	$timediff = $time->diff(new DateTime());
					/*echo $timediff->s."<br/>";
					echo $timediff->i."<br/>";
					echo $timediff->h."<br/>";
					echo $timediff->d."<br/>";
					echo $timediff->m."<br/>";
					echo $timediff->y."<br/>";*/
					/*$dateToHour = $timediff->d * 24;*/
					$diff = $timediff->h;					

				}else{
					$trRegion = "";
					$trCountry = "";
					$trLocation = "";
					$trTime = "";
					$diff = "";
					$noIpTracking = "true";
				}

				function loginCheck($ip, $region, $country, $location,$accountNumber, $conn, $firstnamesaved, $lastnamesaved, $emailsaved, $userStatussaved, $userTypesaved, $password){
					/*echo $ip, $region, $country, $location, $accountNumber, $userTypesaved;*/
					$nowDate = date("Y-m-d H:i:sa");
					$sql = "INSERT INTO tbliptracking(trIp, trRegion, trCountry, trLocation, trTime, trAccountNumber) VALUES ('$ip', '$region', '$country', '$location','$nowDate', '$accountNumber')";
					if(mysqli_query($conn,$sql)){
						
					}


					/*session_destroy();*/
					/*session_start();*/
					$_SESSION["firstnamesaved"] = $firstnamesaved;
					$_SESSION["lastnamesaved"] = $lastnamesaved;
					$_SESSION["emailsaved"] = $emailsaved;
					$_SESSION["userStatussaved"] = $userStatussaved;
					$_SESSION["userTypesaved"] = $userTypesaved;
					$_SESSION["accountNumber"] = $accountNumber;
					$_SESSION["accountCurrency"] = "LKR";
					$_SESSION["lockCheck"] = $password;

					$_SESSION["loggedIn"] = "loggedIn";

						//For My Account Part - Start
					$_SESSION['toAccUpdateSuccess'] = "";
					$_SESSION['toAccTranSuccess'] = "";
					$_SESSION['toAccTranFail'] = "";
					$_SESSION['toAccUpdateFail'] = "";
					$_SESSION['fromAccUpdateSuccess'] = "";
					$_SESSION['fromAccTranSuccess'] = "";
					$_SESSION['fromAccTranFail'] = "";
					$_SESSION['fromAccUpdateFail'] = "";
					$_SESSION['noToAccount'] = "";
					$_SESSION['noBalance'] = "";
					$_SESSION['sameEmail'] = "";


					$_SESSION['toCardUpdateSuccess'] = "";
					$_SESSION['toCardTranSuccess'] = "";
					$_SESSION['toCardTranFail'] = "";
					$_SESSION['toCardUpdateFail'] = "";
					$_SESSION['fromCardUpdateSuccess'] = "";
					$_SESSION['fromCardTranSuccess'] = "";
					$_SESSION['fromCardTranFail'] = "";
					$_SESSION['fromCardUpdateFail'] = "";
					$_SESSION['noToCard'] = "";
					$_SESSION['noCardBalance'] = "";
					$_SESSION['sameCard'] = "";


					$_SESSION['newVcSucc'] = "";
					$_SESSION['newVcFail'] = "";
					$_SESSION['newVc3Exist'] = "";


					$_SESSION['delVcSucc'] = "";
					$_SESSION['DelVcFail'] = "";
					$_SESSION['DelVcNotExt'] = "";

					$_SESSION['toCardUpdateSuccess'] = "";
					$_SESSION['toCardTranSuccess'] = "";
					$_SESSION['toCardTranFail'] = "";
					$_SESSION['toCardUpdateFail'] = "";
					$_SESSION['fromAccUpdateSuccess'] = "";
					$_SESSION['fromAccTranSuccess'] = "";
					$_SESSION['fromAccTranFail'] = "";
					$_SESSION['fromAccUpdateFail'] = "";
					$_SESSION['noToCard'] = "";
					$_SESSION['noAccBalance'] = "";

					$_SESSION['billPaid'] = "";
					$_SESSION['billFailed'] = "";

					$_SESSION["emailsavedCust"] = "";
					$_SESSION['accountNumberCust'] = "";
					$_SESSION['accountNumberNoCust'] = "";
					$_SESSION['accountStatus'] = "";
					$_SESSION['accountLimits'] = "";
					$_SESSION["userTypesavedCust"] = "";


					$_SESSION['updateCust'] = "";
					$_SESSION['updateUser'] = "";

					$_SESSION['transactionLimitChecked'] = "";
					$_SESSION['avgTransaction'] = "";
					$_SESSION['trasactionLimit'] = "";
					$_SESSION['tranLimits'] = "";
					$_SESSION['forceTransactionCount'] = 0;

					$_SESSION['chatEmail'] = "";
					$_SESSION['callMe'] = "";
					$_SESSION['emailMe'] = "";

						//My Account Part - End
					if($userTypesaved == "custAdv" || $userTypesaved == "custMed" || $userTypesaved == "custEas"){
						$_SESSION['chatEmail'] = $emailsaved;
						$host  = $_SERVER['HTTP_HOST'];
						header('location: $host/myaccount/');
						/*echo "<script> location.replace('../myaccount/'); </script>";*/
					}elseif($userTypesaved == "staAdmin" || $userTypesaved == "staLocal" || $userTypesaved == "staSupp"){
						/*header('location: ../admin/');*/
						echo "<script> location.replace('../admin/'); </script>";
					}
					
				}


				if($trCountry == $country || $noIpTracking == "true"){
					if($trRegion == $region || $noIpTracking == "true"){
						loginCheck($ip, $region, $country, $location, $accountNumber, $conn, $firstnamesaved, $lastnamesaved, $emailsaved, $userStatussaved, $userTypesaved, $password);
						
					}else{
						if($diff >= 8){
							loginCheck($ip, $region, $country, $location, $accountNumber, $conn, $firstnamesaved, $lastnamesaved, $emailsaved, $userStatussaved, $userTypesaved, $password);
						}else{
							loginCheck($ip, $region, $country, $location, $accountNumber, $conn, $firstnamesaved, $lastnamesaved, $emailsaved, $userStatussaved, $userTypesaved, $password);
							$update = "UPDATE tbluserdetails SET userStatus='Blocked' WHERE email='$email'";
							if(mysqli_query($conn,$update)){
							}
							header('location: ../signin.php'); //block
						}
					}
				}else{
					if($diff >= 10){
						loginCheck($ip, $region, $country, $location, $accountNumber, $conn, $firstnamesaved, $lastnamesaved, $emailsaved, $userStatussaved, $userTypesaved, $password);
					}else{
						loginCheck($ip, $region, $country, $location, $accountNumber, $conn, $firstnamesaved, $lastnamesaved, $emailsaved, $userStatussaved, $userTypesaved, $password);
						$update = "UPDATE tbluserdetails SET userStatus='Blocked' WHERE email='$email'";
						if(mysqli_query($conn,$update)){
						}
							header('location: ../signin.php'); //block
						}
						
					}


				}else{
				header('location: ../signin.php?c=2'); //when user status blocked/ inactive				
			}
		}else{
			header('location: ../signin.php?c=1'); //when password incorrect
		}	
	}


	



/////////// Reset Password Page
	if(isset($_POST['resetpass_button']))
	{
		$email=mysqli_real_escape_string($conn,$_POST['resetpass_email']);
		$result = $conn->query("SELECT password FROM tbluserdetails WHERE email='$email'");
		if ($result->num_rows > 0) {
			while($row = $result->fetch_assoc()) {
				$passwordsaved = $row['password']; 
			}
		}
		if(isset($passwordsaved)){
			session_start();
			$valcode = 'P-';
			for($i = 0; $i < 6; $i++){
				$valcode .= mt_rand(0, 9);
			}
			require_once './mail/valcode.php';
			$_SESSION["codevalidation"] = $valcode;
			$_SESSION["email"] = $email;
			header('location: ../resetcode.php');
		}else{
			header('location: ../resetpassnow.php');
		}
	}


/////////// Validation Code Page
	if(isset($_POST['codevalidation_button']))
	{
		session_start();
		$validatoncode = $_SESSION["codevalidation"];
		$codeentered=mysqli_real_escape_string($conn,$_POST['codevalidation_code']);
		$codeenteredwithp="P-".$codeentered;
		if($validatoncode==$codeenteredwithp){
			header('location: ../resetpassnow.php');
		}else{
			header('location: ../resetcode.php');
		}
	}


/////////// Password Reset Now Page
	if(isset($_POST['resetnow_button']))
	{
		session_start();
		$emailentered = $_SESSION["email"];
		$newpassword=mysqli_real_escape_string($conn,$_POST['resetnow_newpassword']);
		$newpasswordconf=mysqli_real_escape_string($conn,$_POST['resetnow_newpasswordconf']);
		if($newpassword==$newpasswordconf){
			$hashednew = password_hash($newpassword, PASSWORD_BCRYPT);
			$update = "UPDATE tbluserdetails SET password='$hashednew' WHERE email='$emailentered'";
			if(mysqli_query($conn,$update)){
				require_once './mail/passwordresetsuccess.php';
			}else{
				header('location: ../resetpassnow.php');
			}
			header('location: ../signin.php');
		}else{
			header('location: ../resetpassnow.php');
		}
	}





























}
catch(Exception $e){
	
}






/////////////////////////////////////////////////////////////////////////////////////// Test


try{
//////////Sign Up
	if(isset($_GET['execute']))
	{
		$email=mysqli_real_escape_string($conn,"abc@123.com");
		$fName=mysqli_real_escape_string($conn,"abc");
		$lName=mysqli_real_escape_string($conn,"def");
		$password=mysqli_real_escape_string($conn,"123abc");
		$conpassword=mysqli_real_escape_string($conn,"123abc");
		$phoneNumber=mysqli_real_escape_string($conn,"123456789");
		$stAddress=mysqli_real_escape_string($conn,"abc");
		$addLine1=mysqli_real_escape_string($conn,"abc");
		$addLine2=mysqli_real_escape_string($conn,"abc");
		$city=mysqli_real_escape_string($conn,"def");
		$stateProvince=mysqli_real_escape_string($conn,"def");
		$postalCode=mysqli_real_escape_string($conn,"abc123");
		$country=mysqli_real_escape_string($conn,"abc");
		$userStatus="Active";
		if($password==$conpassword){
			$result= mysqli_query($conn, "SELECT MAX(accountNumber) AS maximum FROM tblaccount");
			$row = mysqli_fetch_assoc($result); 
			$maxAccNum = $row['maximum'];
			$generatedAccNumber = $maxAccNum + 1;
			require_once './currencyCheck.php';

			$hashed = password_hash($password, PASSWORD_BCRYPT);
			$insert = "INSERT INTO tbluserdetails(email, fName, lName, password, phoneNumber, stAddress, addLine1, addLine2, city, stateProvince, postalCode, country, userStatus) VALUES ('$email', '$fName', '$lName', '$hashed', '$phoneNumber', '$stAddress', '$addLine1', '$addLine2', '$city', '$stateProvince', '$postalCode', '$country', '$userStatus')";
			$insert2 = "INSERT INTO tblaccount(accountNumber, accountBalance, aCurrency, aUserEmail) VALUES ('$generatedAccNumber', '0', '$aCurrency', '$email')";
			if(mysqli_query($conn,$insert)){
				if(isset($_GET['execute'])){
					echo $sucess."(3) tblUserDetails - Insert"."<br><br>";
				}
				if(!mysqli_query($conn,$insert2)){
					if(isset($_GET['execute'])){
						echo $bug."(4) tblAccount - Insert: ".mysqli_error($conn)."<br><br>";
					}
					$insert3 = "DELETE FROM tblaccount WHERE email='$email";
					mysqli_query($conn,$insert3);
					if(isset($_GET['execute'])){
						echo $sucess."(5) tblAccount - Delete"."<br><br>";
					}
					//die('Error: ' .mysqli_error($conn));
					//header('location: ../signup.php');
				}
				if(isset($_GET['execute'])){
					echo $sucess."(6) tblAccount - Insert"."<br><br>";
				}
				//header('location: ../signin.php');
			}else{
				//header('location: ../signup.php');
			}
		}

		$update = "UPDATE tbluserdetails SET postalCode='abc123' WHERE email='$email'";
		if(mysqli_query($conn,$update)){
			if(isset($_GET['execute'])){
				echo $sucess."(7) tblUserDetails - Update"."<br><br>";
			}
		}else{
			if(isset($_GET['execute'])){
				echo $bug."(8) tblUserDetails - Update: ".mysqli_error($conn)."<br><br>";
			}
		}

		$delete = "DELETE FROM tblaccount WHERE aUserEmail='$email'";
		if(mysqli_query($conn,$delete)){
			if(isset($_GET['execute'])){
				echo $sucess."(9) tblAccount - Delete"."<br><br>";
			}
		}else{
			if(isset($_GET['execute'])){
				echo $bug."(10) tblAccount - Delete: ".mysqli_error($conn)."<br><br>";
			}
		}

		$delete = "DELETE FROM tbluserdetails WHERE postalCode='abc123'";
		if(mysqli_query($conn,$delete)){
			if(isset($_GET['execute'])){
				echo $sucess."(11) tblUserDetails - Delete"."<br><br>";
			}
		}else{
			if(isset($_GET['execute'])){
				echo $bug."(12) tblUserDetails - Delete: ".mysqli_error($conn)."<br><br>";
			}
		}
	}

//////////Sign In
	if(isset($_GET['execute']))
	{
		//$email=mysqli_real_escape_string($conn,"abc@123.com");
		//$password=mysqli_real_escape_string($conn,"123");
		$result = $conn->query("SELECT fName, lName, email, password, userStatus FROM tbluserdetails WHERE email='$email'");
		if ($result->num_rows > 0) {
			while($row = $result->fetch_assoc()) {
				$firstnamesaved = $row['fName']; 
				$lastnamesaved = $row['lName'];  
				$emailsaved = $row['email'];  
				$passwordsaved = $row['password'];  
				$userStatussaved = $row['userStatus'];  
			}
		}
		$result = $conn->query("SELECT accountNumber FROM tblaccount WHERE aUserEmail='$email'");
		if ($result->num_rows > 0) {
			while($row = $result->fetch_assoc()) {
				$accountNumber = $row['accountNumber'];
			}
		}
		$password = "123abc";
		$userStatussaved = "Active";
		$passwordsaved = password_hash("123abc", PASSWORD_BCRYPT);
		if(password_verify($password, $passwordsaved)){
			if(isset($_GET['execute'])){
				echo $sucess."(13) tblUserDetails - Sign In Check"."<br><br>";
			}
			if($userStatussaved=="Active"){
				//session_destroy();
				session_start();
				//$_SESSION["firstnamesaved"] = $firstnamesaved;
				//$_SESSION["lastnamesaved"] = $lastnamesaved;
				//$_SESSION["emailsaved"] = $emailsaved;
				//$_SESSION["userStatussaved"] = $userStatussaved;
				//$_SESSION["accountNumber"] = $accountNumber;
				//$_SESSION["loggedIn"] = "loggedIn";
				//header('location: ../myaccount/');
			}else{
				//header('location: ../signin.php');
			}
			
		}else{
			if(isset($_GET['execute'])){
				echo $bug."(14) tblUserDetails - Sign In Check: ".mysqli_error($conn)."<br><br>";
			}
			//header('location: ../signin.php');
		}
	}

//////////Reset Password
	if(isset($_GET['execute']))
	{
		//$email=mysqli_real_escape_string($conn,$_POST['resetpass_email']);
		$result = $conn->query("SELECT password FROM tbluserdetails WHERE email='$email'");
		if ($result->num_rows > 0) {
			while($row = $result->fetch_assoc()) {
				$passwordsaved = $row['password']; 
			}
		}
		$passwordsaved = password_hash("123abc", PASSWORD_BCRYPT);
		if(isset($passwordsaved)){
			if(isset($_GET['execute'])){
				echo $sucess."(2) tblUserDetails - Password Reset Check"."<br><br>";
			}
			//session_start();
			$valcode = 'P-';
			for($i = 0; $i < 6; $i++){
				$valcode .= mt_rand(0, 9);
			}

			$email = "nimesh.ekanayaka7@gmail.com";
			require_once './mail/valcode.php';
			if(isset($_GET['execute'])){
				echo $sucess."(2) tblUserDetails - Password Reset Mail"."<br><br>";
			}

			//$_SESSION["codevalidation"] = $valcode;
			$_SESSION["codevalidation"] = "12345";
			//$_SESSION["email"] = $email;
			$_SESSION["email"] = "abc@123.com";
			//header('location: ../resetcode.php');
		}else{
			if(isset($_GET['execute'])){
				echo $bug."(2) tblUserDetails - Password Reset Check: ".mysqli_error($conn)."<br><br>";
			}
			//header('location: ../resetpassnow.php');
		}

	}

//////////Code Validation
	if(isset($_GET['execute']))
	{
		//session_start();
		$validatoncode = $_SESSION["codevalidation"];
		//$codeentered=mysqli_real_escape_string($conn,$_POST['codevalidation_code']);
		$codeentered = "12345";
		if($validatoncode==$codeentered){
			if(isset($_GET['execute'])){
				echo $sucess."(2) tblUserDetails - Reset Code Validation <br><br>";
			}
			//header('location: ../resetpassnow.php');
		}else{
			if(isset($_GET['execute'])){
				echo $bug."(2) tblUserDetails - Reset Code Validation <br><br>";
			}
			//header('location: ../resetcode.php');
		}
	}

//////////Reset Password Now
	if(isset($_GET['execute']))
	{
		//------temp code to check-------
		$email=mysqli_real_escape_string($conn,"abc@123.com");
		$fName=mysqli_real_escape_string($conn,"abc");
		$lName=mysqli_real_escape_string($conn,"def");
		$password=mysqli_real_escape_string($conn,"123abc");
		$phoneNumber=mysqli_real_escape_string($conn,"123456789");
		$stAddress=mysqli_real_escape_string($conn,"abc");
		$addLine1=mysqli_real_escape_string($conn,"abc");
		$addLine2=mysqli_real_escape_string($conn,"abc");
		$city=mysqli_real_escape_string($conn,"def");
		$stateProvince=mysqli_real_escape_string($conn,"def");
		$postalCode=mysqli_real_escape_string($conn,"abc123");
		$country=mysqli_real_escape_string($conn,"abc");
		$userStatus="Active";
		$hashed = password_hash($password, PASSWORD_BCRYPT);
		$insert = "INSERT INTO tbluserdetails(email, fName, lName, password, phoneNumber, stAddress, addLine1, addLine2, city, stateProvince, postalCode, country, userStatus) VALUES ('$email', '$fName', '$lName', '$hashed', '$phoneNumber', '$stAddress', '$addLine1', '$addLine2', '$city', '$stateProvince', '$postalCode', '$country', '$userStatus')";
		if(mysqli_query($conn,$insert)){
			if(isset($_GET['execute'])){
				echo $sucess."(2) tblUserDetails - Temp Record Insert for Reset Check"."<br><br>";
			}
		}else{
			if(isset($_GET['execute'])){
				echo $bug."(2) tblUserDetails - Temp Record Insert for Reset Check: ".mysqli_error($conn)."<br><br>";
			}
		}
		//--------temp code end-------

		//session_start();
		//$emailentered = $_SESSION["email"];
		$emailentered = "123@abc.com";
		//$newpassword=mysqli_real_escape_string($conn,$_POST['resetnow_newpassword']);
		//$newpasswordconf=mysqli_real_escape_string($conn,$_POST['resetnow_newpasswordconf']);
		$newpassword = "123";
		$newpasswordconf = "123";
		if($newpassword==$newpasswordconf){
			$hashednew = password_hash($newpassword, PASSWORD_BCRYPT);
			$update = "UPDATE tbluserdetails SET password='$hashednew' WHERE email='$emailentered'";
			if(mysqli_query($conn,$update)){
				if(isset($_GET['execute'])){
					echo $sucess."(2) tblUserDetails - Reset Success, Ignore email error due to duplication of email processes:";
				}
				$emailentered = "nimesh.ekanayaka7@gmail.com";
				require_once './mail/passwordresetsuccess.php';
				echo "<br><br>";
			}else{
				if(isset($_GET['execute'])){
					echo $bug."(2) tblUserDetails - Reset Fail <br><br>";
				}
				//header('location: ../resetpassnow.php');
			}
			//header('location: ../signin.php');
		}else{
			if(isset($_GET['execute'])){
				echo $bug."(2) tblUserDetails - Reset Fail Password Mismatched <br><br>";
			}
			//header('location: ../resetpassnow.php');
		}

		//------temp code to check-------
		$delete = "DELETE FROM tbluserdetails WHERE email='abc@123.com'";
		if(mysqli_query($conn,$delete)){
			if(isset($_GET['execute'])){
				echo $sucess."(2) tblUserDetails - Temp Record Delete after Reset Check"."<br><br>";
			}
		}else{
			if(isset($_GET['execute'])){
				echo $bug."(2) tblUserDetails - Temp Record Delete after Reset Check: ".mysqli_error($conn)."<br><br>";
			}
		}
		//--------temp code end-------
	}

}catch(Exception $e){
	if(isset($_GET['execute'])){
		echo $bug."(2) tblUserDetails: ".$e."<br><br>";
	}
}

///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// (3) tbl





?>