<?php
//fetch.php
//session_start();
require_once '../db_class/dbConn.php';
 $fName = "";
 $lName = "";
 $phoneNumber = "";
 $stAddress = "";
 $addLine1 = "";
 $addLine2 = "";
 $city = "";
 $stateProvince = "";
 $postalCode = "";
 $country = "";

$email = $_SESSION["emailsaved"];
	$result = $conn->query("SELECT * FROM tblUserDetails WHERE email='$email'");
	if ($result->num_rows > 0) {
		while($row = $result->fetch_assoc()) {
			 $fName = $row['fName'];
			 $lName = $row['lName'];
			 $phoneNumber = $row['phoneNumber'];
			 $stAddress = $row['stAddress'];
			 $addLine1 = $row['addLine1'];
			 $addLine2 = $row['addLine2'];
			 $city = $row['city'];
			 $stateProvince = $row['stateProvince'];
			 $postalCode = $row['postalCode'];
			 $country = $row['country'];
		}
	}
?>

                <div class="card">
                    <div class="card-header">
                        <h5 class="card-header-text">Customer Details</h5>
                        <button id="edit-btn" type="button" class="btn btn-sm btn-primary waves-effect waves-light f-right">
    <i class="icofont icofont-edit"></i>
</button>
                    </div>
                    <div class="card-block">
                        <div class="view-info">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="general-info">
                                        <div class="row">
                                            <div class="col-lg-12 col-xl-6">
                                                <div class="table-responsive">
                                                    <table class="table m-0">
                                                        <tbody>
                                                            <tr>
                                                                <th scope="row">First Name</th>
                                                                <td><?php echo $fName; ?></td>
                                                            </tr>
                                                            <tr>
                                                                <th scope="row">Last Name</th>
                                                                <td><?php echo $lName; ?></td>
                                                            </tr>
                                                            <tr>
                                                                <th scope="row">Streat Name</th>
                                                                <td><?php echo $stAddress; ?></td>
                                                            </tr>
                                                            <tr>
                                                                <th scope="row">Address Line 1</th>
                                                                <td><?php echo $addLine1; ?></td>
                                                            </tr>
                                                            <tr>
                                                                <th scope="row">Address Line 2</th>
                                                                <td><?php echo $addLine2; ?></td>
                                                            </tr>
                                                            <tr>
                                                                <th scope="row">City</th>
                                                                <td><?php echo $city; ?></td>
                                                            </tr>
                                                            <tr>
                                                                <th scope="row">State/ Province</th>
                                                                <td><?php echo $stateProvince; ?></td>
                                                            </tr>
                                                            <tr>
                                                                <th scope="row">Country</th>
                                                                <td><?php echo $country; ?></td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                            <!-- end of table col-lg-6 -->
                                            <div class="col-lg-12 col-xl-6">
                                                <div class="table-responsive">
                                                    <table class="table">
                                                        <tbody>
                                                            <tr>
                                                                <th scope="row">Email</th>
                                                                <td><?php echo $_SESSION['emailsaved']; ?></td>
                                                            </tr>
                                                            <tr>
                                                                <th scope="row">Mobile Number</th>
                                                                <td><?php echo $phoneNumber; ?></td>
                                                            </tr>
                                                            <tr>
                                                                <th scope="row">User Mode</th>
                                                                <td><?php 
                                                                    if($userTypesaved == "custAdv"){
                                                                        echo "Advanced Mode";
                                                                    }elseif ($userTypesaved == "custMed") {
                                                                        echo "Medium Mode";
                                                                    }elseif ($userTypesaved == "custEas") {
                                                                        echo "Easy Mode";
                                                                    }elseif ($userTypesaved == "staAdmin") {
                                                                        echo "Admin Mode";
                                                                    }elseif ($userTypesaved == "staLocal") {
                                                                        echo "Staff Mode";
                                                                    }elseif ($userTypesaved == "staSupp") {
                                                                        echo "Support Mode";
                                                                    }  
                                                                ?></td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                            <!-- end of table col-lg-6 -->
                                        </div>
                                        <!-- end of row -->
                                    </div>
                                    <!-- end of general info -->
                                </div>
                                <!-- end of col-lg-12 -->
                            </div>
                            <!-- end of row -->
                        </div>
                        <!-- end of view-info -->
                        <div class="edit-info">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="general-info">
                                    	<form action="./dbClass.php" method="POST">
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <table class="table">
                                                    <tbody>
                                                        <tr>
                                                            <td>
                                                                <div class="input-group">
                                                                    <span class="input-group-addon"><i class="icofont icofont-user"></i></span>
                                                                    <input type="text" class="form-control" placeholder="First Name" name="fName" value="<?php echo $fName; ?>">
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <div class="input-group">
                                                                    <span class="input-group-addon"><i class="icofont icofont-user"></i></span>
                                                                    <input type="text" class="form-control" placeholder="Last Name" name="lName" value="<?php echo $lName; ?>">
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <div class="input-group">
                                                                    <span class="input-group-addon"><i class="icofont icofont-location-pin"></i></span>
                                                                    <input type="text" class="form-control" placeholder="Streat Name" name="stAddress" value="<?php echo $stAddress; ?>">
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <div class="input-group">
                                                                    <span class="input-group-addon"><i class="icofont icofont-location-pin"></i></span>
                                                                    <input type="text" class="form-control" placeholder="Address Line 1" name="addLine1" value="<?php echo $addLine1; ?>">
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <div class="input-group">
                                                                    <span class="input-group-addon"><i class="icofont icofont-location-pin"></i></span>
                                                                    <input type="text" class="form-control" placeholder="Address Line 2" name="addLine2" value="<?php echo $addLine2; ?>">
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <div class="input-group">
                                                                    <span class="input-group-addon"><i class="icofont icofont-location-pin"></i></span>
                                                                    <input type="text" class="form-control" placeholder="City" name="city" value="<?php echo $city; ?>">
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <div class="input-group">
                                                                    <span class="input-group-addon"><i class="icofont icofont-location-pin"></i></span>
                                                                    <input type="text" class="form-control" placeholder="State/ Province" name="stateProvince" value="<?php echo $stateProvince; ?>">
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                            <!-- end of table col-lg-6 -->
                                            <div class="col-lg-6">
                                                <table class="table">
                                                    <tbody>
                                                        <tr>
                                                            <td>
                                                                <div class="input-group">
                                                                    <span class="input-group-addon"><i class="icofont icofont-mobile-phone"></i></span>
                                                                    <input type="text" class="form-control" placeholder="Mobile Number" name="phoneNumber" value="<?php echo $phoneNumber; ?>">
                                                                </div>
                                                                <div class="input-group">
                                                                    <span class="input-group-addon"><i class="icofont icofont-user"></i></span>
                                                                    <select type="select" name="userMode"  style="width: 100%;" required>
                                                                        <option value="staAdmin">Admin Mode</option>
                                                                        <option value="staLocal">Staff Mode</option>
                                                                        <option value="staSupp">Support Mode</option>
                                                                    </select>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                            <!-- end of table col-lg-6 -->
                                        </div>
                                        <!-- end of row -->
                                        <div class="text-center">
                                        	<button type="submit" name="saveUser" class="btn btn-primary waves-effect waves-light m-r-20">Save</button>
                                            <a href="#!" id="edit-cancel" class="btn btn-default waves-effect">Cancel</a>
                                        </div>
                                    </form>
                                    </div>
                                    <!-- end of edit info -->
                                </div>
                                <!-- end of col-lg-12 -->
                            </div>
                            <!-- end of row -->
                        </div>
                        <!-- end of edit-info -->
                    </div>
                    <!-- end of card-block -->
                </div>