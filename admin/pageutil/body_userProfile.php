<div class="page-body">
    <?php 
      require_once './dbClass.php'; 
      //require_once './pageutil/fetch_accountType.php'; 
      $userTypesaved = $_SESSION["userTypesaved"];
    ?>
    <div class="row ">
        <?php
           
        ?>
      <div class="col-md-6 col-xl-3">
        <div class="card text-center text-white bg-c-blue">
            <div class="card-block">
                <h4 class="m-t-10 m-b-10">Account Type</h4>
                <p class="m-b-0">
                        <?php if($userTypesaved == "staAdmin") { ?>
                            <h6 class="m-t-10 m-b-10">Administrator</h6>
                        <?php } elseif ($userTypesaved == "staLocal") { ?>
                            <h6 class="m-t-10 m-b-10">Bank Staff</h6>
                        <?php } elseif ($userTypesaved == "staSupp") { ?>
                            <h6 class="m-t-10 m-b-10">Bank Support</h6>
                        <?php } elseif ($userTypesaved == "custAdv" || $userTypesaved == "custMed" || $userTypesaved == "custEas") { ?>
                            <h6 class="m-t-10 m-b-10">Bank Customer</h6>
                        <?php } ?>
                </p>
            </div>
        </div>
      </div>

      <div class="col-md-6 col-xl-3">
        <div class="card text-center text-white bg-c-blue">
            <div class="card-block">
                <h4 class="m-t-10 m-b-10">Employee Account Number</h4>
                <p class="m-b-0">
                        
                            <h6 class="m-t-10 m-b-10"><?php echo $accountNumber = $_SESSION["accountNumber"]; ?></h6>
                </p>
            </div>
        </div>
      </div>

    </div>

        <div class="row">
        <div class="col-sm-12">
            <?php require_once './pageutil/fetch_userDetails.php'; ?>
        </div>
    </div>
</div>
