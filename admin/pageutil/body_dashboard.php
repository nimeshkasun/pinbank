<div class="page-body">
<!-- Body Begin -->
    <?php require_once './dbClass.php'; ?>
   
<!-- Accounts and Cards -->
    <div class="row">
        <div class="col-md-6 col-xl-3" id="load_accBalance">
            <script>
                $(document).ready(function(){
                 setInterval(function(){//setInterval() method execute on every interval until called clearInterval()
                  $('#load_accBalance').load("./pageutil/fetch_countVaultBalance.php").fadeIn("slow");
                  //load() method fetch data from fetch.php page
                 }, 1000);
                });     
            </script>
        </div>
        <div class="col-md-6 col-xl-3" id="load_cardBalance1">
            <script>
                $(document).ready(function(){
                 setInterval(function(){//setInterval() method execute on every interval until called clearInterval()
                  $('#load_cardBalance1').load("./pageutil/fetch_countAccount.php").fadeIn("slow");
                  //load() method fetch data from fetch.php page
                 }, 1000);
                });     
            </script>
        </div>
        <div class="col-md-6 col-xl-3" id="load_cardBalance2">
            <script>
                $(document).ready(function(){
                 setInterval(function(){//setInterval() method execute on every interval until called clearInterval()
                  $('#load_cardBalance2').load("./pageutil/fetch_countCards.php").fadeIn("slow");
                  //load() method fetch data from fetch.php page
                 }, 1000);
                });     
            </script>
        </div>
        <div class="col-md-6 col-xl-3" id="load_cardBalance3">
            <script>
                $(document).ready(function(){
                 setInterval(function(){//setInterval() method execute on every interval until called clearInterval()
                  $('#load_cardBalance3').load("./pageutil/fetch_countTransactions.php").fadeIn("slow");
                  //load() method fetch data from fetch.php page
                 }, 1000);
                });     
            </script>
    </div>
    <div class="col-xl-9 col-md-12">
        <div class="card">
            <div class="card-header">
                <h5>All Transactions</h5>
                <div class="card-header-right">
                  <ul class="list-unstyled card-option">
                      <li><i class="feather icon-maximize full-card"></i></li>
                      <li><i class="feather icon-minus minimize-card"></i></li>
                      <li><i class="feather icon-trash-2 close-card"></i></li>
                  </ul>
                </div>
            </div>
            <div class="card-block">
                <div class="dt-responsive table-responsive">
                    <table id="" class="table table-striped table-bordered nowrap">
                        <thead>
                        <tr>
                            <th>Transaction Type</th>
                            <th>Date</th>
                            <th>Description</th>
                            <th>Account</th>
                            <th>Amount</th>
                            <th>Balance</th>
                        </tr>
                        </thead>
                        <tbody id="load_transactons">
                            <script>
                                $(document).ready(function(){
                                 setInterval(function(){//setInterval() method execute on every interval until called clearInterval()
                                  $('#load_transactons').load("./pageutil/fetch_Transactions.php").fadeIn("slow");
                                  //load() method fetch data from fetch.php page
                                 }, 1000);
                                });     
                            </script>
                        </tbody>
                        <tfoot>
                        <tr>
                            <th>Transaction Type</th>
                            <th>Date</th>
                            <th>Description</th>
                            <th>Account</th>
                            <th>Amount</th>
                            <th>Balance</th>
                        </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-6 col-xl-3">
      <div class="card">
        <div class="card-header">
            <h5>Transfer Money</h5>
            <div class="card-header-right">
              <ul class="list-unstyled card-option">
                  <!--<li><i class="feather icon-maximize full-card"></i></li>-->
                  <li><i class="feather icon-minus minimize-card"></i></li>
                  <li><i class="feather icon-trash-2 close-card"></i></li>
              </ul>
            </div>
        </div>
        <div class="card-block">
                <div class="j-tabs-container">
                    <input id="tab1" type="radio" name="tabs" checked="">
                    <label class="j-tabs-label" for="tab1" title="Login">
                        <i class="icofont icofont-login "></i>
                        <span>Account Transfer</span>
                    </label>
                    <input id="tab2" type="radio" name="tabs">
                    <label class="j-tabs-label" for="tab2" title="Registration">
                        <i class="feather icon-credit-card"></i>
                        <span>Card Transfer</span>
                    </label>
                    <div id="tabs-section-1" class="j-tabs-section">
                      <div class="card">
                        <div class="card-block">
                              <form action="./dbClass.php" method="post" class="j-forms" id="j-forms">
                                <div class="content">
                                  <div class="j-row">
                                    <div class="unit">
                                      <div class="j-input">
                                        <input type="email" class="email" name="accountTransfer_from" data-a-sign=" " placeholder="From Email/ Phone Number" required>
                                      </div>
                                    </div>
                                  </div>
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
                    <div id="tabs-section-2" class="j-tabs-section">
                        <div class="card">
                          <div class="card-block">
                            <form action="./dbClass.php" method="post" class="j-forms" id="j-forms" novalidate="">
                              <div class="content">
                                  <div class="j-row">
                                    <div class="unit">
                                      <div class="j-input">
                                        <input type="email" class="email" name="cardTransfer_from" data-a-sign=" " placeholder="From Card" required>
                                      </div>
                                    </div>
                                  </div>
                                  <div class="j-row">
                                    <div class="unit">
                                      <div class="j-input">
                                        <input type="email" class="email" name="cardTransfer_to" data-a-sign=" " placeholder="To Card" required>
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
    </div>

    <div class="col-xl-9 col-md-12">
        <div class="card">
            <div class="card-header">
                <h5>Transaction Analysis</h5>
                <div class="card-header-right">
                  <ul class="list-unstyled card-option">
                      <li><i class="feather icon-maximize full-card"></i></li>
                      <li><i class="feather icon-minus minimize-card"></i></li>
                      <li><i class="feather icon-trash-2 close-card"></i></li>
                  </ul>
                </div>
            </div>
            <div class="card-block">
                <div id="chartdiv"></div>

            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-12">
      <div class="card user-card2">
          <div class="card-header">
            <h5>Exchange Rates</h5>
          </div>
          <?php require_once './pageutil/exchangeRatesAPI.php'; ?>
          <div class="card-block text-center">
              <div class="risk-rate">
                  <span><b><i class="icofont icofont-cur-dollar"></i></b></span>
              </div>
              <h6 class="m-b-10 m-t-10">Balanced</h6>
              <div class="row justify-content-center m-t-10 b-t-default m-l-0 m-r-0">
                  <div class="col m-t-15 b-r-default">
                      <h6 class="text-muted"><strong>Rs</strong></h6>
                      <h6><?php echo convertCurrency('1','USD','LKR'); ?></h6>
                  </div>
                  <div class="col m-t-15">
                      <h6 class="text-muted"><i class="icofont icofont-cur-euro"></i></h6>
                      <h6><?php echo convertCurrency('1','USD','EUR'); ?></h6>
                  </div>
              </div>
              <div class="row justify-content-center m-t-10 b-t-default m-l-0 m-r-0">
                  <div class="col m-t-15 b-r-default">
                      <h6 class="text-muted"><i class="icofont icofont-cur-pound"></i></h6>
                      <h6><?php echo convertCurrency('1','USD','GBP'); ?></h6>
                  </div>
                  <div class="col m-t-15">
                      <h6 class="text-muted"><i class="icofont icofont-cur-rupee"></i></h6>
                      <h6><?php echo convertCurrency('1','USD','INR'); ?></h6>
                  </div>
              </div>
              <div class="row justify-content-center m-t-10 b-t-default m-l-0 m-r-0">
                  <div class="col m-t-15 b-r-default">
                      <h6 class="text-muted"><i class="icofont icofont-cur-yen"></i></h6>
                      <h6><?php echo convertCurrency('1','USD','JPY'); ?></h6>
                  </div>
                  <div class="col m-t-15">
                      <h6 class="text-muted"><i class="icofont icofont-cur-won"></i></h6>
                      <h6><?php echo convertCurrency('1','USD','KRW'); ?></h6>
                  </div>
              </div>
              <div class="row justify-content-center m-t-10 b-t-default m-l-0 m-r-0">
                  <div class="col m-t-15 b-r-default">
                      <h6 class="text-muted"><i class="icofont icofont-cur-rouble"></i></h6>
                      <h6><?php echo convertCurrency('1','USD','RUB'); ?></h6>
                  </div>
                  <div class="col m-t-15">
                      <h6 class="text-muted"><i class="icofont icofont-cur-riyal"></i></h6>
                      <h6><?php echo convertCurrency('1','USD','QAR'); ?></h6>
                  </div>
              </div>
          </div>
          <a href="./exchangerates.php"><button class="btn btn-warning btn-block p-t-15 p-b-15">All Exchange Rates</button></a>
      </div>
    </div>




















</div>
<!-- Row End-->

</div>
<!-- Body End-->
