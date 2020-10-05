<?php
session_start();
    if($_SESSION['loggedIn']!="loggedIn"){
     header('Location: ../');
 } 
echo "<link rel='stylesheet' href='../db_class/check.css'/>";

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// Check Process
if(isset($_GET['execute'])){
	$success = "<div class='pretty p-icon p-round p-pulse p-locked'><input type='checkbox' checked /><div class='state p-success'><i class='icon mdi mdi-check'><img src='../db_class/img/001.png'></i><label><b>Success! : </b></label></div></div>";
	$bug = "<div class='pretty p-icon p-round p-pulse p-locked'><input type='checkbox' checked /><div class='state p-success p-danger'><i class='icon mdi mdi-check'><img src='../db_class/img/003.png'></i><label><b>Bug! : </b></label></div></div>";
}

/*

if(isset($_GET['execute'])){
	echo $success."(1) comment"."<br><br>";
}
	
if(isset($_GET['execute'])){
	echo $bug."(1) comment: ".mysqli_error($con)."<br><br>";
}


//Notification
if(isset($_SESSION['loggedIn'])){
	echo "<script>$(document).ready(function(){
    test('top','right','','success','','','Card Transfer');
	});
	</script>";
} 
*/

require_once '../db_class/dbConn.php';

try{
/////////////////////////////////////////////////////////////////////////////////////////////////////// Dashboard

/////////////////////////////////////////// Account and Card Balance
	/*session_start();
	$email = $_SESSION['emailsaved'];
	$result = $conn->query("SELECT accountBalance, aCurrency FROM tblAccount WHERE aUserEmail='$email'");
	if ($result->num_rows > 0) {
		while($row = $result->fetch_assoc()) {
			$accountBalance = $row['accountBalance'];
			$aCurrency = $row['aCurrency'];
		}
	}*/


//Avoid Tesing - start
	if(!isset($_GET['execute'])){
		//session_start();
		$accountNumber = $_SESSION['accountNumber'];
		$email = $_SESSION['emailsaved'];
		$userStatussaved = $_SESSION['userStatussaved'];
		$firstnamesaved = $_SESSION['firstnamesaved'];
		$lastnamesaved = $_SESSION['lastnamesaved'];
		$lockCheck = $_SESSION["lockCheck"];
	}
//Avoid Testing - end


/////////////////////////////////////////// Account and Card Balance
	if(isset($_GET['conf_pass'])){
		header('location: ../signout.php');
	}





/////////////////////////////////////////// Account Transfer
	if(isset($_POST['btn_accountTransfer']))
	{

		$email=mysqli_real_escape_string($conn, $_POST['accountTransfer_from']);
		$aCurrency = mysqli_real_escape_string($conn, $_SESSION['aCurrency']);
		$toEmail=mysqli_real_escape_string($conn, $_POST['accountTransfer_to']);
		$amountReceived=mysqli_real_escape_string($conn, $_POST['accountTransfer_amount']);
		$amount = preg_replace("/[^0-9\s\.]/", "", $amountReceived);
		$description=mysqli_real_escape_string($conn, $_POST['accountTransfer_description']);
		$descriptionFrom = "Transfered ".$aCurrency." ".$amount." to account ".$toEmail."<br> from account ".$email.". <br>: ".$description;
		$descriptionTo = "Received ".$aCurrency." ".$amount." from account ".$email."<br> to account ".$toEmail.". <br>: ".$description;
		$userStatus="Active";
		
		$result = $conn->query("SELECT accountNumber, accountBalance FROM tblAccount WHERE aUserEmail='$email'");
		if ($result->num_rows > 0) {
			while($row = $result->fetch_assoc()) {
				$accountNumber = $row['accountNumber'];
				$accountBalance = $row['accountBalance'];
			}
		}else{
		}
		if($email!=$toEmail){

			if($accountBalance>=$amount){

				$result = $conn->query("SELECT accountNumber, accountBalance FROM tblAccount WHERE aUserEmail='$toEmail'");
				if ($result->num_rows > 0) {
					while($row = $result->fetch_assoc()) {
						$toAccountNumber = $row['accountNumber'];
						$toAccountBalance = $row['accountBalance'];
					}
				}else{
				}

				if(isset($toAccountNumber)){
	//Increase to account balance					
					$newAccBalto = $amount + $toAccountBalance;
					$update = "UPDATE tblAccount SET accountBalance='$newAccBalto' WHERE aUserEmail='$toEmail'";
					if(mysqli_query($conn,$update)){
						session_start();
						$_SESSION['toAccUpdateSuccess'] = "toAccUpdateSuccess";
	//To account Transaction log insert
						$timeStamp = date("Y-m-d H:i:sa");
						$insert = "INSERT INTO tblTransactions (tType, tDate, tDescription, tAccountType, tAmount, tBalance, tAccountNumber) VALUES ('Receive', '$timeStamp', '$descriptionTo', 'PRA', '$amount', '$newAccBalto', '$toAccountNumber')";
						if(mysqli_query($conn,$insert)){
							$_SESSION['toAccTranSuccess'] = "toAccTranSuccess";
						}else{
							$_SESSION['toAccTranFail'] = "toAccTranFail";
							header('location: ./');
						}
					}else{
						$_SESSION['toAccUpdateFail'] = "toAccUpdateFail";
						header('location: ./');
					}
	//Reduce from account balance
					$newAccBalfrom = $accountBalance - $amount;
					$update = "UPDATE tblAccount SET accountBalance='$newAccBalfrom' WHERE aUserEmail='$email'";
					if(mysqli_query($conn,$update)){
						$_SESSION['fromAccUpdateSuccess'] = "fromAccUpdateSuccess";
	//From account Transaction log insert
						$timeStamp = date("Y-m-d H:i:sa");
						$insert = "INSERT INTO tblTransactions (tType, tDate, tDescription, tAccountType, tAmount, tBalance, tAccountNumber) VALUES ('Send', '$timeStamp', '$descriptionFrom', 'PRA', '$amount', '$newAccBalfrom', '$accountNumber')";
						if(mysqli_query($conn,$insert)){
							$_SESSION['fromAccTranSuccess'] = "fromAccTranSuccess";
							header('location: ./');
						}else{
							$_SESSION['fromAccTranFail'] = "fromAccTranFail";
							header('location: ./');
						}
					}else{
						$_SESSION['fromAccUpdateFail'] = "fromAccUpdateFail";
						header('location: ./');
					}
				}else{
					$_SESSION['noToAccount'] = "noToAccount";
					header('location: ./');
				}
			}else{
				$_SESSION['noBalance'] = "noBalance";
				header('location: ./');
			}
		}else{
			$_SESSION['sameEmail'] = "sameEmail";
			header('location: ./');
		}
	}
/*$_SESSION[''] = "toAccUpdateSuccess";
$_SESSION[''] = "toAccTranSuccess";
$_SESSION[''] = "toAccTranFail";
$_SESSION[''] = "toAccUpdateFail";
$_SESSION[''] = "fromAccUpdateSuccess";
$_SESSION[''] = "fromAccTranSuccess";
$_SESSION[''] = "fromAccTranFail";
$_SESSION[''] = "fromAccUpdateFail";
$_SESSION['noToAccount'] = "noToAccount";
$_SESSION['noBalance'] = "noBalance";*/

//For testing - start
if(isset($_GET['execute'])){
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
}
//For Testing - end

if($_SESSION['toAccUpdateSuccess']=="toAccUpdateSuccess" AND $_SESSION['toAccTranSuccess']=="toAccTranSuccess" AND $_SESSION['fromAccUpdateSuccess']=="fromAccUpdateSuccess" AND $_SESSION['fromAccTranSuccess']=="fromAccTranSuccess" ){
	echo "<script>$(document).ready(function(){
		test('top','right','','success','','','Transaction Successful!');
		});
		</script>";
	//unset($_SESSION['toAccUpdateSuccess']);
	//unset($_SESSION['toAccTranSuccess']);
	//unset($_SESSION['fromAccUpdateSuccess']);
	//unset($_SESSION['fromAccTranSuccess']);
	} 

	if($_SESSION['toAccUpdateFail']=="toAccUpdateFail" AND $_SESSION['toAccTranFail']=="toAccTranFail" AND $_SESSION['fromAccUpdateFail']=="fromAccUpdateFail" AND $_SESSION['fromAccTranFail']=="fromAccTranFail" ){
		echo "<script>$(document).ready(function(){
			test('top','right','','danger','','','Transaction Failed!');
			});
			</script>";
	//unset($_SESSION['toAccUpdateFail']);
	//unset($_SESSION['toAccTranFail']);
	//unset($_SESSION['fromAccUpdateFail']);
	//unset($_SESSION['fromAccTranFail']);
		} 

		if($_SESSION['noToAccount']=="noToAccount"){
			echo "<script>$(document).ready(function(){
				test('top','right','','warning','','','Receiver doesn't exist');
				});
				</script>";
	//unset($_SESSION['noToAccount']);
			} 

			if($_SESSION['noBalance']=="noBalance"){
				echo "<script>$(document).ready(function(){
					test('top','right','','warning','','','Not enough balance!');
					});
					</script>";
	//unset($_SESSION['noBalance']);
				} 

				if($_SESSION['sameEmail']=="sameEmail"){
					echo "<script>$(document).ready(function(){
						test('top','right','','info','','','Can not transfer to same account!');
						});
						</script>";
	//unset($_SESSION['noBalance']);
					} 



/////////////////////////////////////////// Card Transfer
					if(isset($_POST['btn_cardTransfer']))
					{
		//------temp code to check-------
						$fromCard=mysqli_real_escape_string($conn, $_POST['cardTransfer_from']);
						$toCard=mysqli_real_escape_string($conn, $_POST['cardTransfer_to']);
						$aCurrency = mysqli_real_escape_string($conn, $_SESSION['aCurrency']);
						$amountReceived=mysqli_real_escape_string($conn, $_POST['cardTransfer_amount']);
						$amount = preg_replace("/[^0-9\s\.]/", "", $amountReceived);
						$description=mysqli_real_escape_string($conn, $_POST['cardTransfer_description']);
						$descriptionFrom = "Transfered ".$aCurrency." ".$amount." to card ".$toCard."<br> from card ".$fromCard.". <br>: ".$description;
						$descriptionTo = "Received ".$aCurrency." ".$amount." from card ".$fromCard."<br> to card ".$toCard.". <br>: ".$description;
						$userStatus="Active";

						$result = $conn->query("SELECT vCardNumber, vCardBalance, vCardOrder FROM tblVirtualCard WHERE vCardNumber='$fromCard'");
						if ($result->num_rows > 0) {
							while($row = $result->fetch_assoc()) {
								$cardNumber = $row['vCardNumber'];
								$cardBalance = $row['vCardBalance'];
								$cardOrderFrom = $row['vCardOrder'];
							}
						}else{
						}

						if($fromCard!=$toCard){
							if($cardBalance>=$amount){

								$result = $conn->query("SELECT vCardNumber, vCardBalance, vAccountNumber, vCardOrder FROM tblVirtualCard WHERE vCardNumber='$toCard'");
								if ($result->num_rows > 0) {
									while($row = $result->fetch_assoc()) {
										$toCardNumber = $row['vCardNumber'];
										$toCardBalance = $row['vCardBalance'];
										$AccountNumber = $row['vAccountNumber'];
										$vCardOrderTo = $row['vCardOrder'];
									}
								}else{
								}

								if(isset($toCardNumber)){
//Increase to card balance					
									$newCardBalto = $amount + $toCardBalance;
									$update = "UPDATE tblVirtualCard SET vCardBalance='$newCardBalto' WHERE vCardNumber='$toCard'";
									if(mysqli_query($conn,$update)){
										$_SESSION['toCardUpdateSuccess'] = "toCardUpdateSuccess";
//To card Transaction log insert
										$timeStamp = date("Y-m-d H:i:sa");
										$insert = "INSERT INTO tblTransactions (tType, tDate, tDescription, tAccountType, tAmount, tBalance, tAccountNumber) VALUES ('Receive', '$timeStamp', '$descriptionTo', '$vCardOrderTo', '$amount', '$newCardBalto', '$AccountNumber')";
										if(mysqli_query($conn,$insert)){
											$_SESSION['toCardTranSuccess'] = "toCardTranSuccess";
										}else{
											$_SESSION['toCardTranFail'] = "toCardTranFail";
										}
									}else{
										$_SESSION['toCardUpdateFail'] = "toCardUpdateFail";
										header('location: ./');
									}

//Reduce from card balance
									$newCardBalfrom = $cardBalance - $amount;
									$update = "UPDATE tblVirtualCard SET vCardBalance='$newCardBalfrom' WHERE vCardNumber='$fromCard'";
									if(mysqli_query($conn,$update)){
										$_SESSION['fromCardUpdateSuccess'] = "fromCardUpdateSuccess";
//From card Transaction log insert
										$timeStamp = date("Y-m-d H:i:sa");
										$insert = "INSERT INTO tblTransactions (tType, tDate, tDescription, tAccountType, tAmount, tBalance, tAccountNumber) VALUES ('Send', '$timeStamp', '$descriptionFrom', '$cardOrderFrom', '$amount', '$newCardBalfrom', '$AccountNumber')";
										if(mysqli_query($conn,$insert)){
											$_SESSION['fromCardTranSuccess'] = "fromCardTranSuccess";
											header('location: ./');
										}else{
											$_SESSION['fromCardTranFail'] = "fromCardTranFail";
											header('location: ./');
										}
									}else{
										$_SESSION['fromCardUpdateFail'] = "fromCardUpdateFail";
										header('location: ./');
									}
								}else{
									$_SESSION['noToCard'] = "noToCard";
									header('location: ./');
								}
								
							}else{
								$_SESSION['noCardBalance'] = "noCardBalance";
								header('location: ./');
							}
						}else{
							$_SESSION['sameCard'] = "sameCard";
							header('location: ./');
						}
						
					}

//For testing - start
					if(isset($_GET['execute'])){
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
					}
//For Testing - end

					if($_SESSION['toCardUpdateSuccess']=="toCardUpdateSuccess" AND $_SESSION['toCardTranSuccess']=="toCardTranSuccess" AND $_SESSION['fromCardUpdateSuccess']=="fromCardUpdateSuccess" AND $_SESSION['fromCardTranSuccess']=="fromCardTranSuccess" ){
						echo "<script>$(document).ready(function(){
							test('top','right','','success','','','Transaction Successful!');
							});
							</script>";
	//unset($_SESSION['toAccUpdateSuccess']);
	//unset($_SESSION['toAccTranSuccess']);
	//unset($_SESSION['fromAccUpdateSuccess']);
	//unset($_SESSION['fromAccTranSuccess']);
						} 

						if($_SESSION['toCardUpdateFail']=="toCardUpdateFail" AND $_SESSION['toCardTranFail']=="toCardTranFail" AND $_SESSION['fromCardUpdateFail']=="fromCardUpdateFail" AND $_SESSION['fromCardTranFail']=="fromCardTranFail" ){
							echo "<script>$(document).ready(function(){
								test('top','right','','danger','','','Transaction Failed!');
								});
								</script>";
	//unset($_SESSION['toAccUpdateFail']);
	//unset($_SESSION['toAccTranFail']);
	//unset($_SESSION['fromAccUpdateFail']);
	//unset($_SESSION['fromAccTranFail']);
							} 

							if($_SESSION['noToCard']=="noToCard"){
								echo "<script>$(document).ready(function(){
									test('top','right','','warning','','','Receiving Card doesn't exist');
									});
									</script>";
	//unset($_SESSION['noToAccount']);
								} 

								if($_SESSION['noCardBalance']=="noCardBalance"){
									echo "<script>$(document).ready(function(){
										test('top','right','','warning','','','Not enough balance!');
										});
										</script>";
	//unset($_SESSION['noBalance']);
									} 

									if($_SESSION['sameCard']=="sameCard"){
										echo "<script>$(document).ready(function(){
											test('top','right','','info','','','Can not transfer to same card!');
											});
											</script>";
	//unset($_SESSION['noBalance']);
										} 


///////////////////////////////////////////  New Virtual Card
										if(isset($_POST['btn_newVcGenerate'])){
											$accountNumber = $_SESSION['accountNumber'];
											$result = $conn->query("SELECT vCardNumber, vcardOrder FROM tblVirtualCard WHERE vAccountNumber='$accountNumber'");
											if ($result->num_rows < 3) {
												$cardOrderCount = 1;
												while($row = $result->fetch_assoc()) {
													++$cardOrderCount;
												}
												$newCardOrder = "VC".$cardOrderCount;
												$cardNum = "1996";
												for($i = 0; $i < 12; $i++){
													$cardNum .= mt_rand(0, 9);
												}
												$timeStamp = date("Y-m-d");	
												$expDate = date("Y-m-d", strtotime("$timeStamp +1825 day"));
												$csv = "";
												for($i = 0; $i < 3; $i++){
													$csv .= mt_rand(0, 9);
												}
												$cardName=mysqli_real_escape_string($conn, $_POST['card_name']);
												$insert = "INSERT INTO tblVirtualCard(vCardNumber, vExpireDate, vCsv, vCardName, vCardBalance, vCardOrder, vAccountNumber) VALUES ('$cardNum', '$expDate', '$csv', '$cardName', '0', '$newCardOrder', '$accountNumber')";
												if(mysqli_query($conn,$insert)){
													$_SESSION['newVcSucc'] = "newVcSucc";
													header('location: ./vc.php');
												}else{
													$_SESSION['newVcFail'] = "newVcFail";
													header('location: ./vc.php');
												}
											}else{
												$_SESSION['newVc3Exist'] = "newVc3Exist";
												header('location: ./vc.php');
											}	
										}

//For testing - start
										if(isset($_GET['execute'])){
											$_SESSION['newVcSucc'] = "";
											$_SESSION['newVcFail'] = "";
											$_SESSION['newVc3Exist'] = "";
										}
//For Testing - end

										if($_SESSION['newVcSucc']=="newVcSucc"){
											echo "<script>$(document).ready(function(){
												test('top','right','','success','','','New Virtual Card created!');
												});
												</script>";
	//unset($_SESSION['noBalance']);
											} 
											if($_SESSION['newVcFail']=="newVcFail"){
												echo "<script>$(document).ready(function(){
													test('top','right','','danger','','','New Virtual Card creation failed');
													});
													</script>";
	//unset($_SESSION['noBalance']);
												} 
												if($_SESSION['newVc3Exist']=="newVc3Exist"){
													echo "<script>$(document).ready(function(){
														test('top','right','','warning','','','3 Cards already created!');
														});
														</script>";
	//unset($_SESSION['noBalance']);
													} 

///////////////////////////////////////////  Delete Virtual Card
													if(isset($_GET['delVc'])){
														$delCardNum = $_GET['delVc'];
														$result = $conn->query("SELECT vCardNumber, vCardBalance FROM tblVirtualCard WHERE vCardNumber='$delCardNum'");
														if ($result->num_rows > 0) {
		//echo $delCardNum." ";
															while($row = $result->fetch_assoc()) {
																$balanceVc = $row['vCardBalance'];
															}

															$deleteVC = "DELETE FROM tblVirtualCard WHERE vCardNumber='$delCardNum'";
															if(mysqli_query($conn,$deleteVC)){

																$result = $conn->query("SELECT accountBalance FROM tblAccount WHERE accountNumber='$accountNumber'");
																if ($result->num_rows > 0) {
																	while($row = $result->fetch_assoc()) {
																		$balanceAcc = $row['accountBalance'];
																	}
																	$newBalanceAcc = $balanceAcc + $balanceVc;
																	$insertVcBal = "UPDATE tblAccount SET accountBalance='$newBalanceAcc' WHERE accountNumber='$accountNumber'";
																	mysqli_query($conn,$insertVcBal);

																	$_SESSION['delVcSucc'] = "delVcSucc";
																	header('location: ./vc.php');
																}
															}else{
																$_SESSION['DelVcFail'] = "DelVcFail";
																header('location: ./vc.php');
															}
														}else{
															$_SESSION['DelVcNotExt'] = "DelVcNotExt";
															header('location: ./vc.php');
														}	
													}

//For testing - start
													if(isset($_GET['execute'])){
														$_SESSION['delVcSucc'] = "";
														$_SESSION['DelVcFail'] = "";
														$_SESSION['DelVcNotExt'] = "";
													}
//For Testing - end

													if($_SESSION['delVcSucc']=="delVcSucc"){
														echo "<script>$(document).ready(function(){
															test('top','right','','success','','','Virtual Card deletion success!');
															});
															</script>";
															echo "<script>$(document).ready(function(){
																test('top','right','','success','','','Balance Transfered to Primaty Account!');
																});
																</script>";
	//unset($_SESSION['noBalance']);
															} 
															if($_SESSION['DelVcFail']=="DelVcFail"){
																echo "<script>$(document).ready(function(){
																	test('top','right','','danger','','','Virtual Card deletion failed!');
																	});
																	</script>";
	//unset($_SESSION['noBalance']);
																} 
																if($_SESSION['DelVcNotExt']=="DelVcNotExt"){
																	echo "<script>$(document).ready(function(){
																		test('top','right','','warning','','','Virtual Card does not exists!');
																		});
																		</script>";
	//unset($_SESSION['noBalance']);
																	} 


/////////////////////////////////////////// Account to VC transfer
																	if(isset($_POST['btn_accToCardTransfer']))
																	{
		//------temp code to check-------
																		$fromAccount=mysqli_real_escape_string($conn, $_SESSION['accountNumbertran']);
																		$toCard=mysqli_real_escape_string($conn, $_POST['accToCard']);
																		$amountReceived=mysqli_real_escape_string($conn, $_POST['accToCardAmount']);
																		$amount = preg_replace("/[^0-9\s\.]/", "", $amountReceived);
																		$description=mysqli_real_escape_string($conn, $_POST['accToCardDescription']);
																		$aCurrency = mysqli_real_escape_string($conn, $_SESSION['aCurrency']);
																		$descriptionFrom = "Transfered ".$aCurrency." ".$amount." to account ".$toCard."<br> from account ".$fromAccount.". <br>: ".$description;
																		$descriptionTo = "Received ".$aCurrency." ".$amount." from account ".$fromAccount."<br> to account ".$toCard.". <br>: ".$description;
																		$userStatus="Active";
																		$_SESSION['accountNumbertran'] = "";

																		$result = $conn->query("SELECT accountBalance FROM tblAccount WHERE accountNumber='$fromAccount'");
																		if ($result->num_rows > 0) {
																			while($row = $result->fetch_assoc()) {
																				$accountBalance = $row['accountBalance'];
																			}
																		}else{
																		}

																		if($accountBalance>=$amount){

																			$result = $conn->query("SELECT vCardNumber, vCardBalance, vAccountNumber FROM tblVirtualCard WHERE vCardNumber='$toCard'");
																			if ($result->num_rows > 0) {
																				while($row = $result->fetch_assoc()) {
																					$toCardNumber = $row['vCardNumber'];
																					$toCardBalance = $row['vCardBalance'];
																					$AccountNumber = $row['vAccountNumber'];
																				}
																			}else{
																			}

																			if(isset($toCardNumber)){
//Increase to card balance					
																				$newCardBalto = $amount + $toCardBalance;
																				$update = "UPDATE tblVirtualCard SET vCardBalance='$newCardBalto' WHERE vCardNumber='$toCard'";
																				if(mysqli_query($conn,$update)){
																					$_SESSION['toCardUpdateSuccess'] = "toCardUpdateSuccess";
//To card Transaction log insert
																					$timeStamp = date("Y-m-d H:I:sa");
																					$insert = "INSERT INTO tblTransactions (tType, tDate, tDescription, tAccountType, tAmount, tBalance, tAccountNumber) VALUES ('Receive', '$timeStamp', '$descriptionTo', '$cardOrder', '$amount', '$newCardBalto', '$AccountNumber')";
																					if(mysqli_query($conn,$insert)){
																						$_SESSION['toCardTranSuccess'] = "toCardTranSuccess";
																					}else{
																						$_SESSION['toCardTranFail'] = "toCardTranFail";
																						header('location: ./pra.php');
																					}
//Reduce from account balance
																					$newAccountBalancefrom = $accountBalance - $amount;
																					$update = "UPDATE tblAccount SET accountBalance='$newAccountBalancefrom' WHERE accountNumber='$fromAccount'";
																					if(mysqli_query($conn,$update)){
																						$_SESSION['fromAccUpdateSuccess'] = "fromAccUpdateSuccess";
//From account Transaction log insert
																						$timeStamp = date("Y-m-d H:I:sa");
																						$insert = "INSERT INTO tblTransactions (tType, tDate, tDescription, tAccountType, tAmount, tBalance, tAccountNumber) VALUES ('Send', '$timeStamp', '$descriptionFrom', '$cardOrder', '$amount', '$newAccountBalancefrom', '$AccountNumber')";
																						if(mysqli_query($conn,$insert)){
																							$_SESSION['fromAccTranSuccess'] = "fromAccTranSuccess";
																							header('location: ./pra.php');
																						}else{
																							$_SESSION['fromAccTranFail'] = "fromAccTranFail";
																							header('location: ./pra.php');
																						}
																					}else{
																						$_SESSION['fromAccUpdateFail'] = "fromAccUpdateFail";
																						header('location: ./pra.php');
																					}
																				}else{
																					$_SESSION['toCardUpdateFail'] = "toCardUpdateFail";
																					header('location: ./pra.php');
																				}
																				
																			}else{
																				$_SESSION['noToCard'] = "noToCard";
																				header('location: ./pra.php');
																			}
																		}else{
																			$_SESSION['noAccBalance'] = "noAccBalance";
																			header('location: ./pra.php');
																		}
																		
																	}


//For testing - start
																	if(isset($_GET['execute'])){
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
																	}
//For Testing - end

																	if($_SESSION['toCardUpdateSuccess']=="toCardUpdateSuccess" AND $_SESSION['toCardTranSuccess']=="toCardTranSuccess" AND $_SESSION['fromAccUpdateSuccess']=="fromAccUpdateSuccess" AND $_SESSION['fromAccTranSuccess']=="fromAccTranSuccess" ){
																		echo "<script>$(document).ready(function(){
																			test('top','right','','success','','','Transaction Successful!');
																			});
																			</script>";
	//unset($_SESSION['toAccUpdateSuccess']);
	//unset($_SESSION['toAccTranSuccess']);
	//unset($_SESSION['fromAccUpdateSuccess']);
	//unset($_SESSION['fromAccTranSuccess']);
																		} 

																		if($_SESSION['toCardUpdateFail']=="toCardUpdateFail" AND $_SESSION['toCardTranFail']=="toCardTranFail" AND $_SESSION['fromAccUpdateFail']=="fromAccUpdateFail" AND $_SESSION['fromAccTranFail']=="fromAccTranFail" ){
																			echo "<script>$(document).ready(function(){
																				test('top','right','','danger','','','Transaction Failed!');
																				});
																				</script>";
	//unset($_SESSION['toAccUpdateFail']);
	//unset($_SESSION['toAccTranFail']);
	//unset($_SESSION['fromAccUpdateFail']);
	//unset($_SESSION['fromAccTranFail']);
																			} 

																			if($_SESSION['noToCard']=="noToCard"){
																				echo "<script>$(document).ready(function(){
																					test('top','right','','warning','','','Receiving Card doesn't exist');
																					});
																					</script>";
	//unset($_SESSION['noToAccount']);
																				} 

																				if($_SESSION['noAccBalance']=="noAccBalance"){
																					echo "<script>$(document).ready(function(){
																						test('top','right','','warning','','','Not enough balance!');
																						});
																						</script>";
	//unset($_SESSION['noBalance']);
																					} 


/////////////////////////////////////////// Bill Payment
																					if(isset($_POST['btn_paymentPay']) AND $_POST['select_payee']!=""){
																						$_SESSION['billPaid'] = "billPaid";
																						header('location: ./payment.php');
																					}else if(isset($_POST['btn_paymentPay']) AND $_POST['select_payee']==""){
																						$_SESSION['billFailed'] = "billFailed";
																						header('location: ./payment.php');
																					}

//For testing - start
																					if(isset($_GET['execute'])){
																						$_SESSION['billPaid'] = "";
																						$_SESSION['billFailed'] = "";
																					}
//For Testing - end

																					if($_SESSION['billPaid']=="billPaid"){
																						echo "<script>$(document).ready(function(){
																							test('top','right','','success','','','Bill Payment Successful!');
																							});
																							</script>";
	//unset($_SESSION['noBalance']);
																						} 
																						if($_SESSION['billFailed']=="billFailed"){
																							echo "<script>$(document).ready(function(){
																								test('top','right','','danger','','','Bill Payment Failed!');
																								});
																								</script>";
	//unset($_SESSION['noBalance']);
																							} 


/////////////////////////////////////////// Search Account
																							if(isset($_POST['searchAccount'])){
																								$_SESSION['accountNumberCust'] = mysqli_real_escape_string($conn, $_POST['searchAccount']);
																								$accountNumberCust = $_SESSION['accountNumberCust'];
																								$result = $conn->query("SELECT aUserEmail FROM tblAccount WHERE accountNumber='$accountNumberCust'");
																								if ($result->num_rows > 0) {
																									while($row = $result->fetch_assoc()) {
																										$aUserEmail = $row['aUserEmail'];
																									}
																								}else{
																								}
																								$result = $conn->query("SELECT userType FROM tbluserdetails WHERE email='$aUserEmail'");
																								if ($result->num_rows > 0) {
																									while($row = $result->fetch_assoc()) {
																										$userTypesavedCust = $row['userType'];
																									}
																								}else{
																								}
																								$_SESSION["emailsavedCust"] = $aUserEmail;
																								$_SESSION['chatEmail'] = $aUserEmail;
																								$_SESSION["userTypesavedCust"] = $userTypesavedCust;
																								header('location: ./pra.php');
																							}else if(isset($_POST['searchAccount'])){
																								$_SESSION['accountNumberNoCust'] = mysqli_real_escape_string($conn, $_POST['searchAccount']);
																								header('location: ./pra.php');
																							}else if(isset($_GET['searchAccount'])){
																								$_SESSION['accountNumberCust'] = mysqli_real_escape_string($conn, $_GET['searchAccount']);
																								$accountNumberCust = $_SESSION['accountNumberCust'];
																								$result = $conn->query("SELECT aUserEmail FROM tblAccount WHERE accountNumber='$accountNumberCust'");
																								if ($result->num_rows > 0) {
																									while($row = $result->fetch_assoc()) {
																										$aUserEmail = $row['aUserEmail'];
																									}
																								}else{
																								}
																								$result = $conn->query("SELECT userType FROM tbluserdetails WHERE email='$aUserEmail'");
																								if ($result->num_rows > 0) {
																									while($row = $result->fetch_assoc()) {
																										$userTypesavedCust = $row['userType'];
																									}
																								}else{
																								}
																								$_SESSION["emailsavedCust"] = $aUserEmail;
																								$_SESSION['chatEmail'] = $aUserEmail;
																								$_SESSION["userTypesavedCust"] = $userTypesavedCust;
																								header('location: ./chat.php');
																							}

//For testing - start
																							if(isset($_GET['execute'])){
																								$_SESSION['accountNumberCust'] = "";
																								$_SESSION['accountNumberNoCust'] = "";
																								$_SESSION["userTypesavedCust"] = "";
																							}
//For Testing - end

																							if($_SESSION['accountNumberCust']!=""){
																								echo "<script>$(document).ready(function(){
																									test('top','right','','success','','','Account Found!');
																									});
																									</script>";
	//unset($_SESSION['noBalance']);
																								} 
																								if($_SESSION['accountNumberNoCust']!=""){
																									echo "<script>$(document).ready(function(){
																										test('top','right','','danger','','','Account Not Found!');
																										});
																										</script>";
	//unset($_SESSION['noBalance']);
																									} 



/////////////////////////////////////////// Set Account Status
																									if(isset($_POST['accStatus']))
																									{
																										$passedValue = $_POST['statusCheck'];
																										$email = $_SESSION["emailsavedCust"];
																										if($passedValue== "Active"){
																											$update = "UPDATE tbluserdetails SET userStatus='Active' WHERE email='$email'";
																											if(mysqli_query($conn,$update)){
																											}
																											require_once '../db_class/mail/accountunblock.php';
																											$_SESSION['accountStatus'] = "activated";
																											header('location: ./customer.php'); 
																										}else{
																											$update = "UPDATE tbluserdetails SET userStatus='Inactive' WHERE email='$email'";
																											if(mysqli_query($conn,$update)){
																											}
																											require_once '../db_class/mail/accountblock.php';
																											$_SESSION['accountStatus'] = "deactivated";
																											header('location: ./customer.php'); 
																										}
																									}

//For testing - start
																									if(isset($_GET['execute'])){
																										$_SESSION['accountStatus'] = "";
																									}
//For Testing - end

																									if($_SESSION['accountStatus']=="activated"){
																										echo "<script>$(document).ready(function(){
																											test('top','right','','success','','','Account Activated!');
																											});
																											</script>";
																										} 

																										if($_SESSION['accountStatus']=="deactivated"){
																											echo "<script>$(document).ready(function(){
																												test('top','right','','danger','','','Account De-activated!');
																												});
																												</script>";
																											} 


/////////////////////////////////////////// Set Account Limits
																											if(isset($_POST['accLimit']))
																											{
																												$passedValue = $_POST['limitCheck'];
																												$email = $_SESSION["emailsavedCust"];
																												if($passedValue== "Blocked"){
																													$update = "UPDATE tbluserdetails SET userStatus='Blocked' WHERE email='$email'";
																													if(mysqli_query($conn,$update)){
																													}
																													require_once '../db_class/mail/accountblock.php';
																													$_SESSION['accountLimits'] = "blocked";
																													header('location: ./customer.php'); 
																												}else{
																													$update = "UPDATE tbluserdetails SET userStatus='Active' WHERE email='$email'";
																													if(mysqli_query($conn,$update)){
																													}
																													require_once '../db_class/mail/accountunblock.php';
																													$_SESSION['accountLimits'] = "unblocked";
																													header('location: ./customer.php'); 
																												}
																											}


//For testing - start
																											if(isset($_GET['execute'])){
																												$_SESSION['accountLimits'] = "";
																											}
//For Testing - end

																											if($_SESSION['accountLimits']=="blocked"){
																												echo "<script>$(document).ready(function(){
																													test('top','right','','danger','','','Account Blocked!');
																													});
																													</script>";
																												} 

																												if($_SESSION['accountLimits']=="unblocked"){
																													echo "<script>$(document).ready(function(){
																														test('top','right','','success','','','Account Unblocked!');
																														});
																														</script>";
																													} 

/////////////////////////////////////////// Set Account Transaction Limits
																													if(isset($_POST['tranLimit']))
																													{
																														$passedValue = $_POST['transactionLimit'];
																														$email = $_SESSION["emailsavedCust"];
																														if($passedValue != ""){
																															$update = "UPDATE tbluserdetails SET transactionLimit='$passedValue' WHERE email='$email'";
																															if(mysqli_query($conn,$update)){
																															}
																															$_SESSION['tranLimits'] = "updated";
																															header('location: ./customer.php'); 
																														}else{
																															$_SESSION['tranLimits'] = "updatefailed";
																															header('location: ./customer.php'); 
																														}
																													}

//For testing - start
																													if(isset($_GET['execute'])){
																														$_SESSION['tranLimits'] = "";
																													}
//For Testing - end

																													if($_SESSION['tranLimits']=="updated"){
																														echo "<script>$(document).ready(function(){
																															test('top','right','','success','','','Transaction Limit Updated!');
																															});
																															</script>";
																														} 

																														if($_SESSION['tranLimits']=="updatefailed"){
																															echo "<script>$(document).ready(function(){
																																test('top','right','','danger','','','Transaction Limit Update Failed!!');
																																});
																																</script>";
																															} 



/////////////////////////////////////////// Update Customer Details
																															if(isset($_POST['saveCust']))
																															{
																																$email = $_SESSION["emailsavedCust"];
																																$fName = $_POST['fName'];
																																$lName = $_POST["lName"];
																																$stAddress = $_POST['stAddress'];
																																$addLine1 = $_POST["addLine1"];
																																$addLine2 = $_POST['addLine2'];
																																$city = $_POST["city"];
																																$stateProvince = $_POST['stateProvince'];
																																$phoneNumber = $_POST["phoneNumber"];
																																$userMode = $_POST["userMode"];

																																if($userMode == "custAdv"){
																																	$_SESSION["userTypesavedCust"] = "custAdv";
																																}elseif ($userMode == "custMed") {
																																	$_SESSION["userTypesavedCust"] = "custMed";
																																}elseif ($userMode == "custEas") {
																																	$_SESSION["userTypesavedCust"] = "custEas";
																																}elseif ($userMode == "staAdmin") {
																																	$_SESSION["userTypesavedCust"] = "staAdmin";
																																}elseif ($userMode == "staLocal") {
																																	$_SESSION["userTypesavedCust"] = "staLocal";
																																}elseif ($userMode == "staSupp") {
																																	$_SESSION["userTypesavedCust"] = "staSupp";
																																} 

																																$update = "UPDATE tbluserdetails SET fName='$fName', lName='$lName', stAddress='$stAddress', addLine1='$addLine1', addLine2='$addLine2', city='$city', stateProvince='$stateProvince', phoneNumber='$phoneNumber', userType='$userMode' WHERE email='$email'";
																																if(mysqli_query($conn,$update)){
																																	$_SESSION['updateCust'] = "updated";
																																	header('location: ./customer.php'); 
																																}else{
																																	$_SESSION['updateCust'] = "updateFailed";
																																	header('location: ./customer.php');
																																}
																																
																															}

//For testing - start
																															if(isset($_GET['execute'])){
																																$_SESSION['updateCust'] = "";
																															}
//For Testing - end

																															if($_SESSION['updateCust']=="updated"){
																																echo "<script>$(document).ready(function(){
																																	test('top','right','','success','','','Customer Details Updated!');
																																	});
																																	</script>";
																																} 

																																if($_SESSION['updateCust']=="updateFailed"){
																																	echo "<script>$(document).ready(function(){
																																		test('top','right','','danger','','','Customer Details Update Failed!');
																																		});
																																		</script>";
																																	} 




/////////////////////////////////////////// Update User Details
																																	if(isset($_POST['saveUser']))
																																	{
																																		$email = $_SESSION["emailsaved"];
																																		$fName = $_POST['fName'];
																																		$lName = $_POST["lName"];
																																		$stAddress = $_POST['stAddress'];
																																		$addLine1 = $_POST["addLine1"];
																																		$addLine2 = $_POST['addLine2'];
																																		$city = $_POST["city"];
																																		$stateProvince = $_POST['stateProvince'];
																																		$phoneNumber = $_POST["phoneNumber"];
																																		$userMode = $_POST["userMode"];

																																		if($userMode == "custAdv"){
																																			$_SESSION["userTypesaved"] = "custAdv";
																																		}elseif ($userMode == "custMed") {
																																			$_SESSION["userTypesaved"] = "custMed";
																																		}elseif ($userMode == "custEas") {
																																			$_SESSION["userTypesaved"] = "custEas";
																																		}elseif ($userMode == "staAdmin") {
																																			$_SESSION["userTypesaved"] = "staAdmin";
																																		}elseif ($userMode == "staLocal") {
																																			$_SESSION["userTypesaved"] = "staLocal";
																																		}elseif ($userMode == "staSupp") {
																																			$_SESSION["userTypesaved"] = "staSupp";
																																		} 

																																		$update = "UPDATE tbluserdetails SET fName='$fName', lName='$lName', stAddress='$stAddress', addLine1='$addLine1', addLine2='$addLine2', city='$city', stateProvince='$stateProvince', phoneNumber='$phoneNumber', userType='$userMode' WHERE email='$email'";
																																		if(mysqli_query($conn,$update)){
																																			$_SESSION['updateUser'] = "updated";
																																			header('location: ./user.php'); 
																																		}else{
																																			$_SESSION['updateUser'] = "updateFailed";
																																			header('location: ./user.php');
																																		}
																																		
																																	}

//For testing - start
																																	if(isset($_GET['execute'])){
																																		$_SESSION['updateUser'] = "";
																																	}
//For Testing - end

																																	if($_SESSION['updateUser']=="updated"){
																																		echo "<script>$(document).ready(function(){
																																			test('top','right','','success','','','User Details Updated!');
																																			});
																																			</script>";
																																		} 

																																		if($_SESSION['updateUser']=="updateFailed"){
																																			echo "<script>$(document).ready(function(){
																																				test('top','right','','danger','','','User Details Update Failed!');
																																				});
																																				</script>";
																																			} 


/////////////////////////////////////////// Account Deposit
																																			if(isset($_POST['btn_accDepositTransfer']))
																																			{

																																				/*$email=mysqli_real_escape_string($conn, $_POST['accountTransfer_from']);*/
																																				$aCurrency = mysqli_real_escape_string($conn, $_SESSION['aCurrency']);
																																				$toEmail=mysqli_real_escape_string($conn, $_SESSION['accountEmailtran']);
																																				$amountReceived=mysqli_real_escape_string($conn, $_POST['accDepositAmount']);
																																				$amount = preg_replace("/[^0-9\s\.]/", "", $amountReceived);
																																				$description=mysqli_real_escape_string($conn, $_POST['accDepositDescription']);
																																				/*$descriptionFrom = "Transfered ".$aCurrency." ".$amount." to account ".$toEmail."<br> from account ".$email.". <br>: ".$description;*/
																																				$descriptionDep = "Deposit ".$aCurrency." ".$amountReceived." <br> to account ".$toEmail." <br>: ".$description;
																																				$userStatus="Active";
																																				
			/*$result = $conn->query("SELECT accountNumber, accountBalance FROM tblAccount WHERE aUserEmail='$email'");
			if ($result->num_rows > 0) {
				while($row = $result->fetch_assoc()) {
					$accountNumber = $row['accountNumber'];
					$accountBalance = $row['accountBalance'];
				}
			}else{
			}*/
			/*if($email!=$toEmail){*/

				/*if($accountBalance>=$amount){*/

					$result = $conn->query("SELECT accountNumber, accountBalance FROM tblAccount WHERE aUserEmail='$toEmail'");
					if ($result->num_rows > 0) {
						while($row = $result->fetch_assoc()) {
							$toAccountNumber = $row['accountNumber'];
							$toAccountBalance = $row['accountBalance'];
						}
					}else{
					}

					if(isset($toAccountNumber)){
	//Increase to account balance					
						$newAccBalto = $amount + $toAccountBalance;
						$update = "UPDATE tblAccount SET accountBalance='$newAccBalto' WHERE aUserEmail='$toEmail'";
						if(mysqli_query($conn,$update)){
							/*session_start();*/
							$_SESSION['toAccUpdateSuccess'] = "toAccUpdateSuccess";
	//To account Transaction log insert
							$timeStamp = date("Y-m-d H:i:sa");
							$insert = "INSERT INTO tblTransactions (tType, tDate, tDescription, tAccountType, tAmount, tBalance, tAccountNumber) VALUES ('Deposit', '$timeStamp', '$descriptionDep', 'PRA', '$amount', '$newAccBalto', '$toAccountNumber')";
							if(mysqli_query($conn,$insert)){
								$_SESSION['toAccTranSuccess'] = "toAccTranSuccess";
								header('location: ./pra.php');
							}else{
								$_SESSION['toAccTranFail'] = "toAccTranFail";
								header('location: ./pra.php');
							}
						}else{
							$_SESSION['toAccUpdateFail'] = "toAccUpdateFail";
							header('location: ./pra.php');
						}
	//Reduce from account balance
							/*$newAccBalfrom = $accountBalance - $amount;
							$update = "UPDATE tblAccount SET accountBalance='$newAccBalfrom' WHERE aUserEmail='$toEmail'";
							if(mysqli_query($conn,$update)){
								$_SESSION['fromAccUpdateSuccess'] = "fromAccUpdateSuccess";
	//From account Transaction log insert
							$timeStamp = date("Y-m-d H:i:sa");
							$insert = "INSERT INTO tblTransactions (tType, tDate, tDescription, tAccountType, tAmount, tBalance, tAccountNumber) VALUES ('Withdraw', '$timeStamp', '$descriptionDep', 'PRA', '$amount', '$newAccBalto', '$accountNumber')";
							if(mysqli_query($conn,$insert)){
								$_SESSION['fromAccTranSuccess'] = "fromAccTranSuccess";
								header('location: ./');
							}else{
								$_SESSION['fromAccTranFail'] = "fromAccTranFail";
								header('location: ./');
							}
							}else{
								$_SESSION['fromAccUpdateFail'] = "fromAccUpdateFail";
								header('location: ./');
							}*/
						}else{
							$_SESSION['noToAccount'] = "noToAccount";
							header('location: ./pra.php');
						}
				/*}else{
					$_SESSION['noBalance'] = "noBalance";
					header('location: ./');
				}*/
			/*}else{
				$_SESSION['sameEmail'] = "sameEmail";
				header('location: ./');
			}*/
		}
/*$_SESSION[''] = "toAccUpdateSuccess";
$_SESSION[''] = "toAccTranSuccess";
$_SESSION[''] = "toAccTranFail";
$_SESSION[''] = "toAccUpdateFail";
$_SESSION[''] = "fromAccUpdateSuccess";
$_SESSION[''] = "fromAccTranSuccess";
$_SESSION[''] = "fromAccTranFail";
$_SESSION[''] = "fromAccUpdateFail";
$_SESSION['noToAccount'] = "noToAccount";
$_SESSION['noBalance'] = "noBalance";*/

//For testing - start
if(isset($_GET['execute'])){
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
}
//For Testing - end

if($_SESSION['toAccUpdateSuccess']=="toAccUpdateSuccess" AND $_SESSION['toAccTranSuccess']=="toAccTranSuccess"){
	echo "<script>$(document).ready(function(){
		test('top','right','','success','','','Transaction Successful!');
		});
		</script>";
	//unset($_SESSION['toAccUpdateSuccess']);
	//unset($_SESSION['toAccTranSuccess']);
	//unset($_SESSION['fromAccUpdateSuccess']);
	//unset($_SESSION['fromAccTranSuccess']);
	} 

	if($_SESSION['toAccUpdateFail']=="toAccUpdateFail" OR $_SESSION['toAccTranFail']=="toAccTranFail" ){
		echo "<script>$(document).ready(function(){
			test('top','right','','danger','','','Transaction Failed!');
			});
			</script>";
	//unset($_SESSION['toAccUpdateFail']);
	//unset($_SESSION['toAccTranFail']);
	//unset($_SESSION['fromAccUpdateFail']);
	//unset($_SESSION['fromAccTranFail']);
		} 

		if($_SESSION['noToAccount']=="noToAccount"){
			echo "<script>$(document).ready(function(){
				test('top','right','','warning','','','Receiver doesn't exist');
				});
				</script>";
	//unset($_SESSION['noToAccount']);
			} 


/////////////////////////////////////////// Account Withdraw
			if(isset($_POST['btn_accWithdrawTransfer']))
			{

				/*$email=mysqli_real_escape_string($conn, $_POST['accountTransfer_from']);*/
				$aCurrency = mysqli_real_escape_string($conn, $_SESSION['aCurrency']);
				$toEmail=mysqli_real_escape_string($conn, $_SESSION['accountEmailtran']);
				$amountReceived=mysqli_real_escape_string($conn, $_POST['accWithdrawAmount']);
				$amount = preg_replace("/[^0-9\s\.]/", "", $amountReceived);
				$description=mysqli_real_escape_string($conn, $_POST['accWithdrawDescription']);
				/*$descriptionFrom = "Transfered ".$aCurrency." ".$amount." to account ".$toEmail."<br> from account ".$email.". <br>: ".$description;*/
				$descriptionDep = "Withdraw ".$aCurrency." ".$amountReceived." <br> from account ".$toEmail.". <br>: ".$description;
				$userStatus="Active";
				
				$result = $conn->query("SELECT accountNumber, accountBalance FROM tblAccount WHERE aUserEmail='$toEmail'");
				if ($result->num_rows > 0) {
					while($row = $result->fetch_assoc()) {
						$accountNumber = $row['accountNumber'];
						$accountBalance = $row['accountBalance'];
					}
				}else{
				}
			/*if($email!=$toEmail){

				if($accountBalance>=$amount){

					$result = $conn->query("SELECT accountNumber, accountBalance FROM tblAccount WHERE aUserEmail='$toEmail'");
					if ($result->num_rows > 0) {
						while($row = $result->fetch_assoc()) {
							$toAccountNumber = $row['accountNumber'];
							$toAccountBalance = $row['accountBalance'];
						}
					}else{
					}*/

					if(isset($accountNumber)){
	/*//Increase to account balance					
						$newAccBalto = $amount + $toAccountBalance;
						$update = "UPDATE tblAccount SET accountBalance='$newAccBalto' WHERE aUserEmail='$toEmail'";
						if(mysqli_query($conn,$update)){
							session_start();
							$_SESSION['toAccUpdateSuccess'] = "toAccUpdateSuccess";
	//To account Transaction log insert
							$timeStamp = date("Y-m-d H:i:sa");
							$insert = "INSERT INTO tblTransactions (tType, tDate, tDescription, tAccountType, tAmount, tBalance, tAccountNumber) VALUES ('Deposit', '$timeStamp', '$descriptionDep', 'PRA', '$amount', '$newAccBalto', '$toAccountNumber')";
							if(mysqli_query($conn,$insert)){
									$_SESSION['toAccTranSuccess'] = "toAccTranSuccess";
								}else{
									$_SESSION['toAccTranFail'] = "toAccTranFail";
									header('location: ./');
								}
							}else{
								$_SESSION['toAccUpdateFail'] = "toAccUpdateFail";
								header('location: ./');
							}*/
	//Reduce from account balance
							$newAccBalfrom = $accountBalance - $amount;
							$update = "UPDATE tblAccount SET accountBalance='$newAccBalfrom' WHERE aUserEmail='$toEmail'";
							if(mysqli_query($conn,$update)){
								$_SESSION['fromAccUpdateSuccess'] = "fromAccUpdateSuccess";
	//From account Transaction log insert
								$timeStamp = date("Y-m-d H:i:sa");
								$insert = "INSERT INTO tblTransactions (tType, tDate, tDescription, tAccountType, tAmount, tBalance, tAccountNumber) VALUES ('Withdraw', '$timeStamp', '$descriptionDep', 'PRA', '$amount', '$newAccBalfrom', '$accountNumber')";
								if(mysqli_query($conn,$insert)){
									$_SESSION['fromAccTranSuccess'] = "fromAccTranSuccess";
									header('location: ./pra.php');
								}else{
									$_SESSION['fromAccTranFail'] = "fromAccTranFail";
									header('location: ./pra.php');
								}
							}else{
								$_SESSION['fromAccUpdateFail'] = "fromAccUpdateFail";
								header('location: ./pra.php');
							}
						}else{
							$_SESSION['noToAccount'] = "noToAccount";
							header('location: ./pra.php');
						}
			/*	}else{
					$_SESSION['noBalance'] = "noBalance";
					header('location: ./');
				}
			}else{
				$_SESSION['sameEmail'] = "sameEmail";
				header('location: ./');
			}*/
		}
/*$_SESSION[''] = "toAccUpdateSuccess";
$_SESSION[''] = "toAccTranSuccess";
$_SESSION[''] = "toAccTranFail";
$_SESSION[''] = "toAccUpdateFail";
$_SESSION[''] = "fromAccUpdateSuccess";
$_SESSION[''] = "fromAccTranSuccess";
$_SESSION[''] = "fromAccTranFail";
$_SESSION[''] = "fromAccUpdateFail";
$_SESSION['noToAccount'] = "noToAccount";
$_SESSION['noBalance'] = "noBalance";*/

//For testing - start
if(isset($_GET['execute'])){
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
}
//For Testing - end

if($_SESSION['fromAccUpdateSuccess']=="fromAccUpdateSuccess" AND $_SESSION['fromAccTranSuccess']=="fromAccTranSuccess" ){
	echo "<script>$(document).ready(function(){
		test('top','right','','success','','','Transaction Successful!');
		});
		</script>";
	//unset($_SESSION['toAccUpdateSuccess']);
	//unset($_SESSION['toAccTranSuccess']);
	//unset($_SESSION['fromAccUpdateSuccess']);
	//unset($_SESSION['fromAccTranSuccess']);
	} 

	if($_SESSION['fromAccUpdateFail']=="fromAccUpdateFail" OR $_SESSION['fromAccTranFail']=="fromAccTranFail" ){
		echo "<script>$(document).ready(function(){
			test('top','right','','danger','','','Transaction Failed!');
			});
			</script>";
	//unset($_SESSION['toAccUpdateFail']);
	//unset($_SESSION['toAccTranFail']);
	//unset($_SESSION['fromAccUpdateFail']);
	//unset($_SESSION['fromAccTranFail']);
		} 

		if($_SESSION['noToAccount']=="noToAccount"){
			echo "<script>$(document).ready(function(){
				test('top','right','','warning','','','Receiver doesn't exist');
				});
				</script>";
	//unset($_SESSION['noToAccount']);
			} 






























		}catch(Exception $e){

		}


		?>


