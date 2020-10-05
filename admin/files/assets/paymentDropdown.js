$('#select_paycategory').on('change', function(){
   console.log($('#select_paycategory').val());
    $('#select_payee').html('');
    if($('#select_paycategory').val()=="AIR"){
        $('#select_payee').append('<option disabled selected>Select a Payee</option>');
        $('#select_payee').append('<option value="AIRASIA">AIR ASIA</option>');
        $('#select_payee').append('<option value="SLAIR">SRI LANKAN AIRLINES</option>');
    }else if($('#select_paycategory').val()=="TEL"){
        $('#select_payee').append('<option disabled selected>Select a Payee</option>');
        $('#select_payee').append('<option value="AIRTEL">BHARTI AIRTEL LANKA (PVT) LTD</option>');
        $('#select_payee').append('<option value="DCDMAPRE">DIALOG - CDMA & FIXED BROADBAND [POSTPAID]</option>');
        $('#select_payee').append('<option value="DCDMAPOST">DIALOG - CDMA & FIXED BROADBAND [POSTPAID]</option>');
    }
});

$('#select_payee').on('change', function(){
   console.log($('#select_paycategory').val());
   console.log($('#select_payee').val());
    $('#billingAccDetails').html('');
    $('#billingAccDetails').append('\
                              <div class="j-divider-text j-gap-top-20 j-gap-bottom-45">\
                                  <span>Step 2/2 - Billing Account Details</span>\
                              </div>\
                              ');
    
    if($('#select_paycategory').val()=="AIR" && $('#select_payee').val()=="AIRASIA"){
        $('#billingAccDetails').append('\
                              <div class="j-span6 j-unit">\
                                  <label class="j-label">Booking Number</label>\
                                  <div class="j-input">\
                                      <input type="text" name="AIRASIAbnum" REQUIRED>\
                                  </div>\
                              </div>\
                              <div class="j-span6 j-unit">\
                                  <label class="j-label">Amount</label>\
                                  <div class="j-input">\
                                      <input type="number" name="AIRASIAamount" REQUIRED>\
                                  </div>\
                              </div>\
                              ');
    }





});