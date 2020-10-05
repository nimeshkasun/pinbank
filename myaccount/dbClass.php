<?php
session_start();
if(isset($_GET['execute'])){
	$_SESSION['loggedIn'] = "loggedIn";
}

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


//Avoid Testing - start
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

		$email=mysqli_real_escape_string($conn, $_SESSION['emailsaved']);
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
				
					//////////////////// Transaction Check
				require_once './pageutil/transactionCheck.php';

				if($amount <= $avgTransaction || $amount <= $trasactionLimit){

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
							$insert = "INSERT INTO tblTransactions (tType, tDate, tDescription, tAccountType, tAmount, tBalance, tAccountNumber) VALUES ('Send', '$timeStamp', '$descriptionFrom', 'PRA', '$amount', '$newAccBalto', '$accountNumber')";
							if(mysqli_query($conn,$insert)){
								$_SESSION['fromAccTranSuccess'] = "fromAccTranSuccess";
								$_SESSION['forceTransactionCount'] = "";
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

					}else{ //Block account
						$temp = $_SESSION['forceTransactionCount'];
						$temp = $temp + 1;
						$_SESSION['forceTransactionCount'] = $temp;

						if($temp == 3){
							$update = "UPDATE tbluserdetails SET userStatus='Blocked' WHERE email='$email'";
							if(mysqli_query($conn,$update)){
								$_SESSION['forceTransactionCount'] = "";
								require_once '../db_class/mail/accountblock.php';
								header('location: ../signout.php');
							}
						}else{
							$_SESSION['transactionLimitChecked'] = "transactionLimitChecked";
							header('location: ./'); 
						}
					}



						/////////////
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
	$_SESSION['transactionLimitChecked'] = "";
	$_SESSION['avgTransaction'] = "";
	$_SESSION['trasactionLimit'] = "";
	$_SESSION['forceTransactionCount'] = "";
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

					if($_SESSION['transactionLimitChecked']=="transactionLimitChecked"){
						echo "<script>$(document).ready(function(){
							test('top','right','','warning','','','You can not transfer more that your transaction limits!');
							});
							</script>";
							echo "<script>$(document).ready(function(){
								test('top','right','','info','','','Your current transaction limit: ".$_SESSION['avgTransaction']." and maximum possible transaction amount: ".$_SESSION['trasactionLimit']."');
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
																				$fromAccount=mysqli_real_escape_string($conn, $_SESSION['accountNumber']);
																				$toCard=mysqli_real_escape_string($conn, $_POST['accToCard']);
																				$amountReceived=mysqli_real_escape_string($conn, $_POST['accToCardAmount']);
																				$amount = preg_replace("/[^0-9\s\.]/", "", $amountReceived);
																				$description=mysqli_real_escape_string($conn, $_POST['accToCardDescription']);
																				$aCurrency = mysqli_real_escape_string($conn, $_SESSION['aCurrency']);
																				$descriptionFrom = "Transfered ".$aCurrency." ".$amount." to account ".$toCard."<br> from account ".$fromAccount.". <br>: ".$description;
																				$descriptionTo = "Received ".$aCurrency." ".$amount." from account ".$fromAccount."<br> to account ".$toCard.". <br>: ".$description;
																				$userStatus="Active";

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
																								header('location: ./transfer.php');
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
																									header('location: ./transfer.php');
																								}else{
																									$_SESSION['fromAccTranFail'] = "fromAccTranFail";
																									header('location: ./transfer.php');
																								}
																							}else{
																								$_SESSION['fromAccUpdateFail'] = "fromAccUpdateFail";
																								header('location: ./transfer.php');
																							}
																						}else{
																							$_SESSION['toCardUpdateFail'] = "toCardUpdateFail";
																							header('location: ./transfer.php');
																						}
																						
																					}else{
																						$_SESSION['noToCard'] = "noToCard";
																						header('location: ./transfer.php');
																					}
																				}else{
																					$_SESSION['noAccBalance'] = "noAccBalance";
																					header('location: ./transfer.php');
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


///////////////////////////////////////////  Call Me Request
																											if(isset($_POST['callMe']))
																											{
																												$passedNumber = $_POST['supportNumber'];
																												if($passedNumber != ""){
																													require_once '../db_class/mail/callrequest.php';
																													$_SESSION['callMe'] = "requestsent";
																													header('location: ./support.php'); 
																												}else{
																													$_SESSION['callMe'] = "requestfailed";
																													header('location: ./support.php'); 
																												}
																											}

//For testing - start
																											if(isset($_GET['execute'])){
																												$_SESSION['callMe'] = "";
																											}
//For Testing - end

																											if($_SESSION['callMe']=="requestsent"){
																												echo "<script>$(document).ready(function(){
																													test('top','right','','success','','','Call Request Sent!');
																													});
																													</script>";
																												} 

																												if($_SESSION['callMe']=="requestfailed"){
																													echo "<script>$(document).ready(function(){
																														test('top','right','','danger','','','Call Request Failed!!');
																														});
																														</script>";
																													} 



///////////////////////////////////////////  Email Me Request
																													if(isset($_POST['emailMe']))
																													{
																														$passedEmail = $_POST['supportEmail'];
																														if($passedEmail != ""){
																															require_once '../db_class/mail/emailrequest.php';
																															$_SESSION['emailMe'] = "requestsent";
																															header('location: ./support.php'); 
																														}else{
																															$_SESSION['emailMe'] = "requestfailed";
																															header('location: ./support.php'); 
																														}
																													}

//For testing - start
																													if(isset($_GET['execute'])){
																														$_SESSION['emailMe'] = "";
																													}
//For Testing - end

																													if($_SESSION['emailMe']=="requestsent"){
																														echo "<script>$(document).ready(function(){
																															test('top','right','','success','','','Email Request Sent!');
																															});
																															</script>";
																														} 

																														if($_SESSION['emailMe']=="requestfailed"){
																															echo "<script>$(document).ready(function(){
																																test('top','right','','danger','','','Email Request Failed!!');
																																});
																																</script>";
																															} 

































































																														}catch(Exception $e){

																														}
























/////////////////////////////////////////////////////////////////////////////////////////////////////// Test
																														try{

/////////////////////////////////////////// Account and Card Balance
																															if(isset($_GET['execute'])){
	//session_start();
	//$email = $_SESSION['emailsaved'];
																																$email = "nimesh.ekanayaka7@gmail.com";
																																$result = $conn->query("SELECT accountBalance, aCurrency FROM tblAccount WHERE aUserEmail='$email'");
																																if ($result->num_rows > 0) {
																																	while($row = $result->fetch_assoc()) {
																																		$accountBalance = $row['accountBalance'];
																																		$aCurrency = $row['aCurrency'];
																																	}
																																	echo $success."(2) Account and Card balance retrieve"."<br><br>";
																																}else{
																																	echo $bug."(3) Account and Card balance retrieve: ".mysqli_error($conn)."<br><br>";
																																}
																															}
																															


/////////////////////////////////////////// Account Transfer
																															if(isset($_GET['execute']))
																															{
		//------temp code to check-------
																																$email=mysqli_real_escape_string($conn,"nimesh.ekanayaka7@gmail.com");
																																$toEmail=mysqli_real_escape_string($conn,"lahiruthivankara@gmail.com");
																																$amount=mysqli_real_escape_string($conn,"10");
																																$description=mysqli_real_escape_string($conn,"def");
																																$descriptionFrom = "Transfered ".$aCurrency." ".$amount." to account ".$toEmail."<br> from account ".$email.". <br>: ".$description;
																																$descriptionTo = "Received ".$aCurrency." ".$amount." from account ".$email."<br> to account ".$toEmail.". <br>: ".$description;
																																$userStatus="Active";

																																$result = $conn->query("SELECT accountNumber, accountBalance FROM tblAccount WHERE aUserEmail='$email'");
																																if ($result->num_rows > 0) {
																																	while($row = $result->fetch_assoc()) {
																																		$accountNumber = $row['accountNumber'];
																																		$accountBalance = $row['accountBalance'];
																																	}
																																	echo $success."(4) Account balance check before transfer"."<br><br>";
																																}else{
																																	echo $bug."(5) Account check before transfer: ".mysqli_error($conn)."<br><br>";
																																}

																																if($accountBalance>=$amount){

																																	$result = $conn->query("SELECT accountNumber, accountBalance FROM tblAccount WHERE aUserEmail='$toEmail'");
																																	if ($result->num_rows > 0) {
																																		while($row = $result->fetch_assoc()) {
																																			$toAccountNumber = $row['accountNumber'];
																																			$toAccountBalance = $row['accountBalance'];
																																		}
																																		echo $success."(6) To account data check before transfer"."<br><br>";
																																	}else{
																																		echo $bug."(7) To account data check before transfer: ".mysqli_error($conn)."<br><br>";
																																	}

																																	if(isset($toAccountNumber)){
//Increase to account balance					
																																		$newAccBalto = $amount + $toAccountBalance;
																																		$update = "UPDATE tblAccount SET accountBalance='$newAccBalto' WHERE aUserEmail='$toEmail'";
																																		if(mysqli_query($conn,$update)){
																																			if(isset($_GET['execute'])){
																																				echo $success."(8) tblAccount - To Account balance update"."<br><br>";
																																			}
//To account Transaction log insert
																																			$timeStamp = date("Y-m-d H:I:sa");
																																			$insert = "INSERT INTO tblTransactions (tType, tDate, tDescription, tAccountType, tAmount, tBalance, tAccountNumber) VALUES ('Receive', '$timeStamp', '$descriptionTo', 'PRA', '$amount', '$newAccBalto', '$toAccountNumber')";
																																			if(mysqli_query($conn,$insert)){
																																				if(isset($_GET['execute'])){
																																					echo $success."(9) tblTransactions - To Transction record insert"."<br><br>";
																																				}
//To account temp Transaction log delete
																																				$delete = "DELETE FROM tblTransactions WHERE tDate='$timeStamp'";
																																				if(mysqli_query($conn,$delete)){
																																					if(isset($_GET['execute'])){
																																						echo $success."(10) tblTransactions - To Transction record delete"."<br><br>";
																																					}
																																				}else{
																																					if(isset($_GET['execute'])){
																																						echo $bug."(11) tblTransactions - To Transction record delete: ".mysqli_error($conn)."<br><br>";
																																					}
																																				}
																																			}else{
																																				if(isset($_GET['execute'])){
																																					echo $bug."(12) tblTransactions - To Transction record insert: ".mysqli_error($conn)."<br><br>";
																																				}
																																			}
//Reduce from account balance
																																			$newAccBalfrom = $accountBalance - $amount;
																																			$update = "UPDATE tblAccount SET accountBalance='$newAccBalfrom' WHERE aUserEmail='$email'";
																																			if(mysqli_query($conn,$update)){
																																				if(isset($_GET['execute'])){
																																					echo $success."(13) tblAccount - From Account balance update"."<br><br>";
																																				}
//From account Transaction log insert
																																				$timeStamp = date("Y-m-d H:I:sa");
																																				$insert = "INSERT INTO tblTransactions (tType, tDate, tDescription, tAccountType, tAmount, tBalance, tAccountNumber) VALUES ('Send', '$timeStamp', '$descriptionFrom', 'PRA', '$amount', '$newAccBalto', '$accountNumber')";
																																				if(mysqli_query($conn,$insert)){
																																					if(isset($_GET['execute'])){
																																						echo $success."(14) tblTransactions - From Transction record insert"."<br><br>";
																																					}
//From account temp Transaction log delete
																																					$delete = "DELETE FROM tblTransactions WHERE tDate='$timeStamp'";
																																					if(mysqli_query($conn,$delete)){
																																						if(isset($_GET['execute'])){
																																							echo $success."(15) tblTransactions - From Transction record delete"."<br><br>";
																																						}
																																					}else{
																																						if(isset($_GET['execute'])){
																																							echo $bug."(16) tblTransactions - From Transction record delete: ".mysqli_error($conn)."<br><br>";
																																						}
																																					}
																																				}else{
																																					if(isset($_GET['execute'])){
																																						echo $bug."(17) tblTransactions - From Transction record insert: ".mysqli_error($conn)."<br><br>";
																																					}
																																				}
																																			}else{
																																				if(isset($_GET['execute'])){
																																					echo $bug."(18) tblAccount - From Account balance update: ".mysqli_error($conn)."<br><br>";
																																				}
																																			}
																																		}else{
																																			if(isset($_GET['execute'])){
																																				echo $bug."(19) tblAccount - To Account doesn't exist: ".mysqli_error($conn)."<br><br>";
																																			}
																																		}
																																	}
																																}else{
																																	if(isset($_GET['execute'])){
																																		echo $bug."(20) tblAccount - From Account Not Enough Balance: ".mysqli_error($conn)."<br><br>";
																																	}
																																}
																																
																															}


/////////////////////////////////////////// Card Transfer
																															if(isset($_GET['execute']))
																															{
		//------temp code to check-------
																																$fromCard=mysqli_real_escape_string($conn,"1996481243502433");
																																$toCard=mysqli_real_escape_string($conn,"1996501047080921");
																																$amount=mysqli_real_escape_string($conn,"10");
																																$description=mysqli_real_escape_string($conn,"Card Des");
																																$descriptionFrom = "Transfered ".$aCurrency." ".$amount." to account ".$toCard."<br> from account ".$fromCard.". <br>: ".$description;
																																$descriptionTo = "Received ".$aCurrency." ".$amount." from account ".$fromCard."<br> to account ".$toCard.". <br>: ".$description;
																																$userStatus="Active";

																																$result = $conn->query("SELECT vCardNumber, vCardBalance, vCardOrder FROM tblVirtualCard WHERE vCardNumber='$fromCard'");
																																if ($result->num_rows > 0) {
																																	while($row = $result->fetch_assoc()) {
																																		$cardNumber = $row['vCardNumber'];
																																		$cardBalance = $row['vCardBalance'];
																																		$cardOrder = $row['vCardOrder'];
																																	}
																																	echo $success."(21) Card balance check before transfer"."<br><br>";
																																}else{
																																	echo $bug."(22) Card check before transfer: ".mysqli_error($conn)."<br><br>";
																																}

																																if($cardBalance>=$amount){

																																	$result = $conn->query("SELECT vCardNumber, vCardBalance, vAccountNumber FROM tblVirtualCard WHERE vCardNumber='$toCard'");
																																	if ($result->num_rows > 0) {
																																		while($row = $result->fetch_assoc()) {
																																			$toCardNumber = $row['vCardNumber'];
																																			$toCardBalance = $row['vCardBalance'];
																																			$AccountNumber = $row['vAccountNumber'];
																																		}
																																		echo $success."(23) To card data check before transfer"."<br><br>";
																																	}else{
																																		echo $bug."(24) To card data check before transfer: ".mysqli_error($conn)."<br><br>";
																																	}

																																	if(isset($toCardNumber)){
//Increase to card balance					
																																		$newCardBalto = $amount + $toCardBalance;
																																		$update = "UPDATE tblVirtualCard SET vCardBalance='$newCardBalto' WHERE vCardNumber='$toCard'";
																																		if(mysqli_query($conn,$update)){
																																			if(isset($_GET['execute'])){
																																				echo $success."(25) tblVirtualCard - To Card balance update"."<br><br>";
																																			}
//To card Transaction log insert
																																			$timeStamp = date("Y-m-d H:I:sa");
																																			$insert = "INSERT INTO tblTransactions (tType, tDate, tDescription, tAccountType, tAmount, tBalance, tAccountNumber) VALUES ('Receive', '$timeStamp', '$descriptionTo', '$cardOrder', '$amount', '$newCardBalto', '$AccountNumber')";
																																			if(mysqli_query($conn,$insert)){
																																				if(isset($_GET['execute'])){
																																					echo $success."(26) tblTransactions - To Transction record insert"."<br><br>";
																																				}
//To card temp Transaction log delete
																																				$delete = "DELETE FROM tblTransactions WHERE tDate='$timeStamp'";
																																				if(mysqli_query($conn,$delete)){
																																					if(isset($_GET['execute'])){
																																						echo $success."(27) tblTransactions - To Transction record delete"."<br><br>";
																																					}
																																				}else{
																																					if(isset($_GET['execute'])){
																																						echo $bug."(28) tblTransactions - To Transction record delete: ".mysqli_error($conn)."<br><br>";
																																					}
																																				}
																																			}else{
																																				if(isset($_GET['execute'])){
																																					echo $bug."(29) tblTransactions - To Transction record insert: ".mysqli_error($conn)."<br><br>";
																																				}
																																			}
//Reduce from card balance
																																			$newCardBalfrom = $cardBalance - $amount;
																																			$update = "UPDATE tblVirtualCard SET vCardBalance='$newCardBalfrom' WHERE vCardNumber='$fromCard'";
																																			if(mysqli_query($conn,$update)){
																																				if(isset($_GET['execute'])){
																																					echo $success."(30) tblVirtualCard - From Card balance update"."<br><br>";
																																				}
//From card Transaction log insert
																																				$timeStamp = date("Y-m-d H:I:sa");
																																				$insert = "INSERT INTO tblTransactions (tType, tDate, tDescription, tAccountType, tAmount, tBalance, tAccountNumber) VALUES ('Send', '$timeStamp', '$descriptionFrom', '$cardOrder', '$amount', '$newCardBalfrom', '$AccountNumber')";
																																				if(mysqli_query($conn,$insert)){
																																					if(isset($_GET['execute'])){
																																						echo $success."(31) tblTransactions - From Transction record insert"."<br><br>";
																																					}
	//From card temp Transaction log delete
																																					$delete = "DELETE FROM tblTransactions WHERE tDate='$timeStamp'";
																																					if(mysqli_query($conn,$delete)){
																																						if(isset($_GET['execute'])){
																																							echo $success."(32) tblTransactions - From Transction record delete"."<br><br>";
																																						}
																																					}else{
																																						if(isset($_GET['execute'])){
																																							echo $bug."(33) tblTransactions - From Transction record delete: ".mysqli_error($conn)."<br><br>";
																																						}
																																					}
																																				}else{
																																					if(isset($_GET['execute'])){
																																						echo $bug."(34) tblTransactions - From Transction record insert: ".mysqli_error($conn)."<br><br>";
																																					}
																																				}
																																			}else{
																																				if(isset($_GET['execute'])){
																																					echo $bug."(35) tblVirtualCard - From Card balance update: ".mysqli_error($conn)."<br><br>";
																																				}
																																			}
																																		}else{
																																			if(isset($_GET['execute'])){
																																				echo $bug."(36) tblVirtualCard - From Card balance update:: ".mysqli_error($conn)."<br><br>";
																																			}
																																		}
																																		
																																	}else{
																																		if(isset($_GET['execute'])){
																																			echo $bug."(37) tblVirtualCard - To Card doesn't exist: ".mysqli_error($conn)."<br><br>";
																																		}
																																	}
																																}else{
																																	if(isset($_GET['execute'])){
																																		echo $bug."(38) tblAccount - From Account Not Enough Balance: ".mysqli_error($conn)."<br><br>";
																																	}
																																}
																																
																															}


/////////////////////////////////////////// New Virtual Card
																															if(isset($_GET['execute'])){
	//$accountNumber = $_SESSION['accountNumber'];
																																$accountNumber = "199600000001";
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
																																	$cardName=mysqli_real_escape_string($conn,"Test Card");
																																	$insert = "INSERT INTO tblVirtualCard(vCardNumber, vExpireDate, vCsv, vCardName, vCardBalance, vCardOrder, vAccountNumber) VALUES ('$cardNum', '$expDate', '$csv', '$cardName', '0', '$newCardOrder', '$accountNumber')";
																																	if(mysqli_query($conn,$insert)){
																																		if(isset($_GET['execute'])){
																																			echo $success."(39) tblVirtualCard - Temp record insert"."<br><br>";
																																		}
																																		$delete = "DELETE from tblVirtualCard WHERE vCardNumber = '$cardNum'";
																																		if(mysqli_query($conn,$delete)){
																																			if(isset($_GET['execute'])){
																																				echo $success."(40) tblVirtualCard - Temp record delete"."<br><br>";
																																			}
																																		}else{
																																			echo $bug."(41) tblVirtualCard - Temp record delete: ".mysqli_error($conn)."<br><br>";
																																		}
			//header('location: ../signin.php');
																																	}else{
			//header('location: ../signup.php');
																																		echo $bug."(42) tblVirtualCard - Temp record insert: ".mysqli_error($conn)."<br><br>";
																																	}
																																}else{
																																	echo $bug."(40) 3 Cards already created: ".mysqli_error($conn)."<br><br>";
																																}

																																
																															}


/////////////////////////////////////////// Account to VC transfer
																															if(isset($_GET['execute']))
																															{
		//------temp code to check-------
																																$fromAccount=mysqli_real_escape_string($conn,"199600000000");
																																$toCard=mysqli_real_escape_string($conn,"1996501047080921");
																																$amount=mysqli_real_escape_string($conn,"10");
																																$description=mysqli_real_escape_string($conn,"Card Des");
																																$descriptionFrom = "Transfered ".$aCurrency." ".$amount." to account ".$toCard."<br> from account ".$fromAccount.". <br>: ".$description;
																																$descriptionTo = "Received ".$aCurrency." ".$amount." from account ".$fromAccount."<br> to account ".$toCard.". <br>: ".$description;
																																$userStatus="Active";

																																$result = $conn->query("SELECT accountBalance FROM tblAccount WHERE accountNumber='$fromAccount'");
																																if ($result->num_rows > 0) {
																																	while($row = $result->fetch_assoc()) {
																																		$accountBalance = $row['accountBalance'];
																																	}
																																	echo $success."(41) Account balance check before transfer"."<br><br>";
																																}else{
																																	echo $bug."(42) Account check before transfer: ".mysqli_error($conn)."<br><br>";
																																}

																																if($accountBalance>=$amount){

																																	$result = $conn->query("SELECT vCardNumber, vCardBalance, vAccountNumber FROM tblVirtualCard WHERE vCardNumber='$toCard'");
																																	if ($result->num_rows > 0) {
																																		while($row = $result->fetch_assoc()) {
																																			$toCardNumber = $row['vCardNumber'];
																																			$toCardBalance = $row['vCardBalance'];
																																			$AccountNumber = $row['vAccountNumber'];
																																		}
																																		echo $success."(43) To card data check before transfer"."<br><br>";
																																	}else{
																																		echo $bug."(44) To card data check before transfer: ".mysqli_error($conn)."<br><br>";
																																	}

																																	if(isset($toCardNumber)){
//Increase to card balance					
																																		$newCardBalto = $amount + $toCardBalance;
																																		$update = "UPDATE tblVirtualCard SET vCardBalance='$newCardBalto' WHERE vCardNumber='$toCard'";
																																		if(mysqli_query($conn,$update)){
																																			if(isset($_GET['execute'])){
																																				echo $success."(45) tblVirtualCard - To Card balance update"."<br><br>";
																																			}
//To card Transaction log insert
																																			$timeStamp = date("Y-m-d H:I:sa");
																																			$insert = "INSERT INTO tblTransactions (tType, tDate, tDescription, tAccountType, tAmount, tBalance, tAccountNumber) VALUES ('Receive', '$timeStamp', '$descriptionTo', '$cardOrder', '$amount', '$newCardBalto', '$AccountNumber')";
																																			if(mysqli_query($conn,$insert)){
																																				if(isset($_GET['execute'])){
																																					echo $success."(46) tblTransactions - To Transction record insert"."<br><br>";
																																				}
//To card temp Transaction log delete
																																				$delete = "DELETE FROM tblTransactions WHERE tDate='$timeStamp'";
																																				if(mysqli_query($conn,$delete)){
																																					if(isset($_GET['execute'])){
																																						echo $success."(47) tblTransactions - To Transction record delete"."<br><br>";
																																					}
																																				}else{
																																					if(isset($_GET['execute'])){
																																						echo $bug."(48) tblTransactions - To Transction record delete: ".mysqli_error($conn)."<br><br>";
																																					}
																																				}
																																			}else{
																																				if(isset($_GET['execute'])){
																																					echo $bug."(49) tblTransactions - To Transction record insert: ".mysqli_error($conn)."<br><br>";
																																				}
																																			}
//Reduce from account balance
																																			$newAccountBalancefrom = $accountBalance - $amount;
																																			$update = "UPDATE tblAccount SET accountBalance='$newAccountBalancefrom' WHERE accountNumber='$fromAccount'";
																																			if(mysqli_query($conn,$update)){
																																				if(isset($_GET['execute'])){
																																					echo $success."(50) tblVirtualCard - From Card balance update"."<br><br>";
																																				}
//From account Transaction log insert
																																				$timeStamp = date("Y-m-d H:I:sa");
																																				$insert = "INSERT INTO tblTransactions (tType, tDate, tDescription, tAccountType, tAmount, tBalance, tAccountNumber) VALUES ('Send', '$timeStamp', '$descriptionFrom', '$cardOrder', '$amount', '$newAccountBalancefrom', '$AccountNumber')";
																																				if(mysqli_query($conn,$insert)){
																																					if(isset($_GET['execute'])){
																																						echo $success."(51) tblTransactions - From Transction record insert"."<br><br>";
																																					}
	//From account temp Transaction log delete
																																					$delete = "DELETE FROM tblTransactions WHERE tDate='$timeStamp'";
																																					if(mysqli_query($conn,$delete)){
																																						if(isset($_GET['execute'])){
																																							echo $success."(52) tblTransactions - From Transction record delete"."<br><br>";
																																						}
																																					}else{
																																						if(isset($_GET['execute'])){
																																							echo $bug."(53) tblTransactions - From Transction record delete: ".mysqli_error($conn)."<br><br>";
																																						}
																																					}
																																				}else{
																																					if(isset($_GET['execute'])){
																																						echo $bug."(54) tblTransactions - From Transction record insert: ".mysqli_error($conn)."<br><br>";
																																					}
																																				}
																																			}else{
																																				if(isset($_GET['execute'])){
																																					echo $bug."(55) tblVirtualCard - From Card balance update: ".mysqli_error($conn)."<br><br>";
																																				}
																																			}
																																		}else{
																																			if(isset($_GET['execute'])){
																																				echo $bug."(56) tblVirtualCard - From Card balance update:: ".mysqli_error($conn)."<br><br>";
																																			}
																																		}
																																		
																																	}else{
																																		if(isset($_GET['execute'])){
																																			echo $bug."(57) tblVirtualCard - To Card doesn't exist: ".mysqli_error($conn)."<br><br>";
																																		}
																																	}
																																}else{
																																	if(isset($_GET['execute'])){
																																		echo $bug."(58) tblAccount - From Account Not Enough Balance: ".mysqli_error($conn)."<br><br>";
																																	}
																																}
																																
																															}








if(isset($_GET['execute'])){
	$_SESSION['loggedIn'] = "";
}










																														}catch(Exception $e){
																															if(isset($_GET['execute'])){
																																echo $bug."(2) tblUserDetails: ".$e."<br><br>";
																															}
																														}
																														?>



