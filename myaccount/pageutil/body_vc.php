<div class="page-body">
<!-- Body Begin -->
    <?php require_once './dbClass.php'; ?>
   
<!-- Accounts and Cards -->
    <div class="row">
      <div class="col-md-6 col-xl-3" id="load_PraCardBalance1">
        <?php require_once './pageutil/fetch_pageVcCardBalance1.php'; ?>
      </div>
      <div class="col-md-6 col-xl-3" id="load_PraCardBalance2">
        <?php require_once './pageutil/fetch_pageVcCardBalance2.php'; ?>
      </div>
      <div class="col-md-6 col-xl-3" id="load_PraCardBalance3">
        <?php require_once './pageutil/fetch_pageVcCardBalance3.php'; ?>
      </div>
        <div class="col-md-6 col-xl-3">
            <div class="card widget-card-1">
                <div class="card-block-small">
                    <a href="#" id="btn_newVC" data-toggle="modal"><i class="feather feather icon-plus bg-c-blue card1-icon"></i></a>
                    <h4>New Virtual Card</h4>
                    <div>
                        <span class="f-left m-t-10 text-muted">
                            <i class="text-c-blue f-16 feather icon-alert-triangle m-r-10"></i>You can add upto 3 virtual cards
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>

        <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h5>Virtual Cards</h5>
                </div>
                <div class="card-block">
                    <div class="dt-responsive table-responsive">
                        <table id="order-table" class="table table-striped table-bordered nowrap">
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
                            <tbody id="load_pratransactons">
                              <?php require_once './pageutil/fetch_pageVcTransactions.php'; ?>
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
    </div>
<!-- Body End-->
</div>

<div class="fullscreen-container2">
    <div class="modal-dialog">
        <div class="login-card card-block login-card-modal">
            <form class="md-float-material" method="POST" action="./dbClass.php">
                <div class="text-center">
                    <img src="./files/assets/images/logo.png" alt="logo.png">
                </div>
                <div class="card m-t-15">
                    <div class="auth-box card-block">
                        <div class="row">
                            <div class="col-md-12">
                                <h3 class="text-center"><i class="ti-credit-card text-primary f-80"></i></h3>
                            </div>
                        </div>
                        <div class="input-group">
                            <input type="text" class="form-control" id="card_name" name="card_name" placeholder="Name for new card" required>
                            <span class="md-line"></span>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <button type="submit" name="btn_newVcGenerate" id="btn_newVcGenerate" class="btn btn-primary btn-md btn-block waves-effect text-center"></i> Generate New Card </button>
                            </div>
                        </div>
            </form>
                        <div class="row">
                            <div class="col-xl-3"><br>
                                <button type="button" id="btn_newVcCancel" class="btn btn-md btn-block waves-effect text-center"> Cancel </button>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-10">
                                <p class="text-inverse text-left"><b>Pin Online Banking System</b></p>
                            </div>
                            <div class="col-md-2">
                                <img src="../img/logo.png" alt="small-logo.png">
                            </div>
                        </div>
                    </div>
                </div>
            
        </div>
    </div>
</div>
<!-- New VC end -->
