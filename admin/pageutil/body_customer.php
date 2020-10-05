<div class="page-body">
    <?php 
      require_once './dbClass.php'; 
      require_once './pageutil/fetch_accountStatus.php'; 
      require_once './pageutil/fetch_accountTransacLimits.php';
    ?>
   <?php $userTypesavedCust = $_SESSION["userTypesavedCust"]; if($_SESSION["emailsavedCust"] == "") {echo("<script>location.href = './pra.php';</script>");} ?>
    <div class="row ">

        <div class="col-md-6 col-xl-3">
        <div class="card text-center text-white bg-c-blue">
            <div class="card-block">
                <h4 class="m-t-10 m-b-10">Account Type</h4>
                <p class="m-b-0">
                        <?php if($userTypesavedCust == "staAdmin") { ?>
                            <h6 class="m-t-10 m-b-10">Administrator</h6>
                        <?php } elseif ($userTypesavedCust == "staLocal") { ?>
                            <h6 class="m-t-10 m-b-10">Bank Staff</h6>
                        <?php } elseif ($userTypesavedCust == "staSupp") { ?>
                            <h6 class="m-t-10 m-b-10">Bank Support</h6>
                        <?php } elseif ($userTypesavedCust == "custAdv" || $userTypesavedCust == "custMed" || $userTypesavedCust == "custEas") { ?>
                            <h6 class="m-t-10 m-b-10">Bank Customer</h6>
                        <?php } ?>
                </p>
            </div>
        </div>
      </div>

      <div class="col-md-6 col-xl-3">
        <div class="card text-center text-white bg-c-blue">
            <div class="card-block">
                <h4 class="m-t-10 m-b-10">Account Status</h4>
                <p class="m-b-0">
                    <!-- <form action="" method="" class="js-default js-dynamic-state js-dynamic-enable js-dynamic-disable js-primary js-success js-info js-warning js-danger js-inverse js-single js-switch"> -->   
                    <form action="./dbClass.php" method="POST" class="js-default js-dynamic-state js-dynamic-enable js-dynamic-disable js-primary js-info js-warning js-inverse js-single js-switch">
                        <?php if($accStatus=="Active") { ?>
                            <input type="checkbox" class="js-success" checked="" name="statusCheck" value="Active">
                        <?php } elseif ($accStatus=="Blocked") { ?>
                            <input type="checkbox" class="js-success" checked="" name="statusCheck" value="Active">
                        <?php } elseif ($accStatus=="Inactive") { ?>
                            <input type="checkbox" class="js-success" name="statusCheck" value="Active">
                        <?php } ?>
                        <br><br>   
                        <button type="submit" name="accStatus" class="btn btn-primary js-dynamic-enable">CONFIRM</button>                                              
                    </form>
                </p>
            </div>
        </div>
      </div>

      <div class="col-md-6 col-xl-3">
        <div class="card text-center text-white bg-c-blue">
            <div class="card-block">
                <h4 class="m-t-10 m-b-10">Account Limits</h4>
                <p class="m-b-0">  
                    <form action="./dbClass.php" method="POST" class="js-default js-dynamic-state js-dynamic-enable js-dynamic-disable js-primary js-info js-warning  js-inverse js-single js-switch">
                        <?php if($accStatus=="Active") { ?>
                            <input type="checkbox" class="js-danger" name="limitCheck" value="Blocked">
                        <?php } elseif ($accStatus=="Blocked") { ?>
                            <input type="checkbox" class="js-danger" checked="" name="limitCheck" value="Blocked">
                        <?php } elseif ($accStatus=="Inactive") { ?>
                            <input type="checkbox" class="js-danger" name="limitCheck" value="Blocked">
                        <?php } ?>
                        <br><br>   
                        <button type="submit" name="accLimit" class="btn btn-primary js-dynamic-enable">CONFIRM</button>                                              
                    </form>
                </p>
            </div>
        </div>
      </div>

      <div class="col-md-6 col-xl-3">
        <div class="card text-center text-white bg-c-blue">
            <div class="card-block">
                <h4 class="m-t-10 m-b-10">Transaction Limits</h4>
                <p class="m-b-0">  
                    <form action="./dbClass.php" method="POST" class="js-default js-dynamic-state js-dynamic-enable js-dynamic-disable js-primary js-info js-warning  js-inverse js-single js-switch">
                        <?php if($transacLimit != "") { ?>
                            <input type="text" class="js-danger" name="transactionLimit" value="<?php echo $transacLimit; ?>">
                        <?php } ?>
                        <br><br>   
                        <button type="submit" name="tranLimit" class="btn btn-primary js-dynamic-enable">CONFIRM</button>                                              
                    </form>
                </p>
            </div>
        </div>
      </div>
        
    </div>

        <div class="row">
        <div class="col-sm-12">
            <?php require_once './pageutil/fetch_custDetails.php'; ?>
        </div>
    </div>
</div>
