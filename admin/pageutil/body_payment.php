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
        

    <div class="col-sm-12">
      <div class="card">
        <div class="card-header">
            <h5>Make Payments</h5>
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
                <div class="j-wrapper j-wrapper-640">
                  <form action="./dbClass.php" method="post" class="j-pro j-multistep" id="j-pro" >
                      <!-- end /.header-->
                      <div class="j-content">
                          <fieldset>
                              <div class="j-divider-text j-gap-top-20 j-gap-bottom-45">
                                  <span>Step 1/2 - Payee info</span>
                              </div>
                              <div class="j-unit">
                                  <label class="j-label">Category</label>
                                  <div class="j-input">
                                      <select class="" name="select_paycategory" id="select_paycategory" >
                                        <option disabled selected>Select Category</option>
                                        <option value="AIR">Airlines</option>
                                        <option value="AMO">Automobile</option>
                                        <option value="CTV">Cable TV</option>
                                        <option value="SOC">Clubs and Societies</option>
                                        <option value="EDU">Education</option>
                                        <option value="ELE">Electricity</option>
                                        <option value="TEL">Telephone</option>
                                      </select>
                                  </div>
                              </div>
                                  <div class="j-unit">
                                      <label class="j-label">Payee</label>
                                      <div class="j-input">
                                          <select name="select_payee" id="select_payee" >
                                            <!-- Appended by JavaScript -->
                                          </select>
                                      </div>
                                  </div>
                          </fieldset>
                          <fieldset id="billingAccDetails">
                              
                          </fieldset>
                          <!-- start response from server -->
                          <div class="j-response"></div>
                          <!-- end response from server -->
                      </div>
                      <!-- end /.content -->
                      <div class="j-footer">
                          <button type="submit" class="btn btn-primary j-multi-submit-btn" name="btn_paymentPay">Pay Now</button>
                          <button type="button" class="btn btn-primary j-multi-next-btn">Next</button>
                          <button type="button" class="btn btn-default m-r-20 j-multi-prev-btn">Back</button>
                      </div>
                      <!-- end /.footer -->
                  </form>
                </div>
              </div>
            </div>
        </div>
      </div>
    </div>












</div>
<!-- Row End-->

</div>
<!-- Body End-->
