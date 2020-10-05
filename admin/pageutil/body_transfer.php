<div class="page-body">
<!-- Body Begin -->
    <?php require_once './dbClass.php'; ?>
   
<!-- Accounts and Cards -->
    <div class="row">
        <div class="col-md-6 col-xl-3" id="load_accBalance">
            <script>
                $(document).ready(function(){
                 setInterval(function(){//setInterval() method execute on every interval until called clearInterval()
                  $('#load_accBalance').load("./pageutil/fetch_AccBalance.php").fadeIn("slow");
                  //load() method fetch data from fetch.php page
                 }, 1000);
                });     
            </script>
        </div>
        <div class="col-md-6 col-xl-3" id="load_cardBalance1">
            <script>
                $(document).ready(function(){
                 setInterval(function(){//setInterval() method execute on every interval until called clearInterval()
                  $('#load_cardBalance1').load("./pageutil/fetch_CardBalance1.php").fadeIn("slow");
                  //load() method fetch data from fetch.php page
                 }, 1000);
                });     
            </script>
        </div>
        <div class="col-md-6 col-xl-3" id="load_cardBalance2">
            <script>
                $(document).ready(function(){
                 setInterval(function(){//setInterval() method execute on every interval until called clearInterval()
                  $('#load_cardBalance2').load("./pageutil/fetch_CardBalance2.php").fadeIn("slow");
                  //load() method fetch data from fetch.php page
                 }, 1000);
                });     
            </script>
        </div>
        <div class="col-md-6 col-xl-3" id="load_cardBalance3">
            <script>
                $(document).ready(function(){
                 setInterval(function(){//setInterval() method execute on every interval until called clearInterval()
                  $('#load_cardBalance3').load("./pageutil/fetch_CardBalance3.php").fadeIn("slow");
                  //load() method fetch data from fetch.php page
                 }, 1000);
                });     
            </script>
    </div>

    <div class="col-md-6 col-xl-3">
      <div class="card">
        <div class="card-header">
            <h5>Account Transfer</h5>
            <div class="card-header-right">
              <ul class="list-unstyled card-option">
                  <!--<li><i class="feather icon-maximize full-card"></i></li>-->
                  <li><i class="feather icon-minus minimize-card"></i></li>
                  <li><i class="feather icon-trash-2 close-card"></i></li>
              </ul>
            </div>
        </div>
        <div class="card-block">      
            <div class="card">
              <div class="card-block">
                <form action="./dbClass.php" method="post" class="j-forms" id="j-forms" novalidate="">
                  <div class="content">
                    <div class="j-row">
                      <div class="unit">
                        <div class="j-input">
                          <input type="email" class="email" name="accountTransfer_to" data-a-sign=" " placeholder="To Email/ Phone Number" required>
                        </div>
                      </div>
                    </div>
                    <div class="j-row">
                      <div class="unit">
                        <div class="j-input">
                          <?php $accountCurrency = $_SESSION['accountCurrency']; ?> 
                          <input type="text" name="accountTransfer_amount" class="currency" data-a-sign="<?php echo $accountCurrency; ?> " placeholder="Amount" required>
                        </div>
                      </div>
                    </div>
                    <div class="j-row">
                      <div class="unit">
                        <div class="j-input">
                          <input type="text" name="accountTransfer_description" class="text" data-a-sign=" " placeholder="Description" required>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="footer">
                    <button type="submit" name="btn_accountTransfer" class="btn btn-primary">Transfer</button>
                  </div>  
                </form>
              </div>
            </div>
        </div>
      </div>
    </div>

    <div class="col-md-6 col-xl-3">
      <div class="card">
        <div class="card-header">
            <h5>Account to Card Transfer</h5>
            <div class="card-header-right">
              <ul class="list-unstyled card-option">
                  <!--<li><i class="feather icon-maximize full-card"></i></li>-->
                  <li><i class="feather icon-minus minimize-card"></i></li>
                  <li><i class="feather icon-trash-2 close-card"></i></li>
              </ul>
            </div>
        </div>
        <div class="card-block">                    
          <div class="card">
            <div class="card-block">
              <form action="./dbClass.php" method="post" class="j-forms" id="j-forms" novalidate="">
                <div class="content">
                    <div class="j-row">
                      <div class="unit">
                        <div class="j-input">
                          <input type="text" name="" class="form-control" placeholder="Transfering from: <?php echo $accountNumber; ?>" required disabled>
                      </div>
                      </div>
                    </div>
                    <div class="j-row">
                      <div class="unit">
                        <div class="j-input">
                          <select  name="accToCard" class=" form-control-default">
                              <option value="" disabled selected hidden>Transfer to</option>
                              <?php require_once './pageutil/fetch_vcToDropdown2.php'; ?>
                            </select>
                      </div>
                      </div>
                    </div>
                    <div class="j-row">
                      <div class="unit">
                        <div class="j-input">
                          <?php $accountCurrency = $_SESSION['accountCurrency']; ?> 
                            <input type="text" name="accToCardAmount" class="currency form-control" data-a-sign="<?php echo $accountCurrency; ?>" placeholder="Amount" required>
                        </div>
                      </div>
                    </div>
                    <div class="j-row">
                      <div class="unit">
                        <div class="j-input">
                          <input type="text" class="form-control" name="accToCardDescription" data-a-sign="" placeholder="Description" required>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="footer">
                    <button type="submit" name="btn_accToCardTransfer" id="btn_accToCardTransfer" class="btn btn-primary"> Transfer </button>
                  </div> 
                </form>
              </div>
            </div>
          </div>
      </div>
    </div>





    <div class="col-md-6 col-xl-3">
      <div class="card">
        <div class="card-header">
            <h5>Card Transfer</h5>
            <div class="card-header-right">
              <ul class="list-unstyled card-option">
                  <!--<li><i class="feather icon-maximize full-card"></i></li>-->
                  <li><i class="feather icon-minus minimize-card"></i></li>
                  <li><i class="feather icon-trash-2 close-card"></i></li>
              </ul>
            </div>
        </div>
        <div class="card-block">                    
          <div class="card">
            <div class="card-block">
              <form action="./dbClass.php" method="post" class="j-forms" id="j-forms" novalidate="">
                <div class="content">
                    <div class="j-row">
                      <div class="unit">
                        <div class="j-input">
                        <select n name="cardTransfer_from" class=" form-control-default">
                            <option value="" disabled selected hidden>Transfer from</option>
                            <?php require_once './pageutil/fetch_vcFromDropdown.php'; ?>
                        </select>
                      </div>
                      </div>
                    </div>
                    <div class="j-row">
                      <div class="unit">
                        <div class="j-input">
                        <select  name="cardTransfer_to" class="form-control-default">
                            <option value="" disabled selected hidden>Transfer to</option>
                            <?php require_once './pageutil/fetch_vcToDropdown.php'; ?>
                        </select>
                      </div>
                      </div>
                    </div>
                    <div class="j-row">
                      <div class="unit">
                        <div class="j-input">
                          <?php $accountCurrency = $_SESSION['accountCurrency']; ?> 
                          <input type="text" name="cardTransfer_amount" class="currency" data-a-sign="<?php echo $accountCurrency; ?> " placeholder="Amount" required>
                        </div>
                      </div>
                    </div>
                    <div class="j-row">
                      <div class="unit">
                        <div class="j-input">
                          <input type="text" class="text" name="cardTransfer_description" data-a-sign=" " placeholder="Description" required>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="footer">
                    <button type="submit" class="btn btn-primary" name="btn_cardTransfer">Transfer</button>
                  </div> 
                </form>
              </div>
            </div>
          </div>
      </div>
    </div>












</div>
<!-- Row End-->

</div>
<!-- Body End-->
