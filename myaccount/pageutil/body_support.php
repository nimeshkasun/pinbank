<div class="page-body">
<!-- Body Begin -->
    <?php require_once './dbClass.php'; ?>
   
<!-- Accounts and Cards -->
    <div class="row">
      <div class="col-md-6 col-xl-6" id="load_PraCardBalance1">
        <?php require_once './pageutil/support_chat.php'; ?>
      </div>

      <div class="col-md-6 col-xl-3">
        <div class="card text-center text-white bg-c-blue">
            <div class="card-block">
                <h4 class="m-t-10 m-b-10">Call Me</h4>
                <p class="m-b-0">  
                    <form action="./dbClass.php" method="POST" class="js-default js-dynamic-state js-dynamic-enable js-dynamic-disable js-primary js-info js-warning  js-inverse js-single js-switch">
                        <br>
                        <input type="number" class="js-danger" name="supportNumber" placeholder=" 94123456789" style="width: 80%; height: 30px;">
                        <br><br>   
                        <button type="submit" name="callMe" class="btn btn-primary js-dynamic-enable">CONFIRM</button>                                              
                    </form>
                    <div>
                        <span class="f-left m-t-10 text-muted text-white" style="color: white;">
                            <p style="color: white;"><i class="text-white f-16 feather icon-alert-triangle m-r-10"></i>Enter your mobile number with country code without '+' sign</p>
                        </span>
                    </div>
                </p>
            </div>
        </div>
      </div>
<?php if($_SESSION["userTypesaved"] == "custAdv" || $_SESSION["userTypesaved"] == "custMed"){ ?>
      <div class="col-md-6 col-xl-3">
        <div class="card text-center text-white bg-c-yellow">
            <div class="card-block">
                <h4 class="m-t-10 m-b-10">Email Me</h4>
                <p class="m-b-0">  
                    <form action="./dbClass.php" method="POST" class="js-default js-dynamic-state js-dynamic-enable js-dynamic-disable js-primary js-info js-warning  js-inverse js-single js-switch">
                        <br>
                        <input type="email" class="js-danger" name="supportEmail" value="<?php echo $email; ?>" placeholder=" user@email.com" style="width: 80%; height: 30px;">
                        <br><br>   
                        <button type="submit" name="emailMe" class="btn btn-primary js-dynamic-enable">CONFIRM</button>                                              
                    </form>
                    <div>
                        <span class="f-left m-t-10 text-muted text-white" style="color: white;">
                            <p style="color: white;"><i class="text-white f-16 feather icon-alert-triangle m-r-10"></i>Enter your email address that you check frequently</p>
                        </span>
                    </div>
                </p>
            </div>
        </div>
      </div>
<?php } ?>
<!-- Body End-->
</div>

