$('#select_paycategory').on('change', function(){
   console.log($('#select_paycategory').val());
    $('#select_payee').html('');
    if($('#select_paycategory').val()=="AIR"){
        $('#select_payee').append('<option disabled selected>Select a Payee</option>');
        $('#select_payee').append('<option value="AIRASIA">AIR ASIA</option>');
        $('#select_payee').append('<option value="SLAIR">SRI LANKAN AIRLINES</option>');
    }else if($('#select_paycategory').val()=="AMO"){
        $('#select_payee').append('<option disabled selected>Select a Payee</option>');
        $('#select_payee').append('<option value="TOYOTA">TOYOTA LANKA (PVT) LTD</option>');
        $('#select_payee').append('<option value="HONDA">HONDA (PVT) LTD</option>');
    }else if($('#select_paycategory').val()=="CTV"){
        $('#select_payee').append('<option disabled selected>Select a Payee</option>');
        $('#select_payee').append('<option value="SLTPEO">SLT PEO TV</option>');
        $('#select_payee').append('<option value="IMGSAT">IMAGESAT TV</option>');
    }else if($('#select_paycategory').val()=="SOC"){
        $('#select_payee').append('<option disabled selected>Select a Payee</option>');
        $('#select_payee').append('<option value="EDVICON">EDVICON INTERNATIONAL</option>');
        $('#select_payee').append('<option value="IEEEKDU">IEEE - KDU BRANCH</option>');
    }else if($('#select_paycategory').val()=="EDU"){
        $('#select_payee').append('<option disabled selected>Select a Payee</option>');
        $('#select_payee').append('<option value="KDU">KOTELAWALA DEFENCE UNIVERSITY</option>');
        $('#select_payee').append('<option value="SLIIT">SRI LANKA INSTITUTE OF INFORMATION TECHNOLOGY</option>');
        $('#select_payee').append('<option value="NSBM">NATIONAL SCHOOL OF BUSINESS MANAGEMENT</option>');
    }else if($('#select_paycategory').val()=="ELE"){
        $('#select_payee').append('<option disabled selected>Select a Payee</option>');
        $('#select_payee').append('<option value="CEB">CEYLON ELECTRICITY BOARD</option>');
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
    
    if($('#select_paycategory').val()=="AIR" && ('#select_payee').val()=="AIRASIA"){
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

    if($('#select_paycategory').val()=="AIR" && ('#select_payee').val()=="SLAIR"){
        $('#billingAccDetails').append('\
                              <div class="j-span6 j-unit">\
                                  <label class="j-label">Booking Number</label>\
                                  <div class="j-input">\
                                      <input type="text" name="SLAIRbnum" REQUIRED>\
                                  </div>\
                              </div>\
                              <div class="j-span6 j-unit">\
                                  <label class="j-label">Amount</label>\
                                  <div class="j-input">\
                                      <input type="number" name="SLAIRamount" REQUIRED>\
                                  </div>\
                              </div>\
                              ');
    }

    if($('#select_paycategory').val()=="AMO"){
        $('#billingAccDetails').append('\
                              <div class="j-span6 j-unit">\
                                  <label class="j-label">Registration Number</label>\
                                  <div class="j-input">\
                                      <input type="text" name="regnum" REQUIRED>\
                                  </div>\
                              </div>\
                              <div class="j-span6 j-unit">\
                                  <label class="j-label">Amount</label>\
                                  <div class="j-input">\
                                      <input type="number" name="amount" REQUIRED>\
                                  </div>\
                              </div>\
                              ');
    }

    if($('#select_paycategory').val()=="CTV"){
        $('#billingAccDetails').append('\
                              <div class="j-span6 j-unit">\
                                  <label class="j-label">Connection Number</label>\
                                  <div class="j-input">\
                                      <input type="text" name="connum" REQUIRED>\
                                  </div>\
                              </div>\
                              <div class="j-span6 j-unit">\
                                  <label class="j-label">Amount</label>\
                                  <div class="j-input">\
                                      <input type="number" name="amount" REQUIRED>\
                                  </div>\
                              </div>\
                              ');
    }

    if($('#select_paycategory').val()=="SOC"){
        $('#billingAccDetails').append('\
                              <div class="j-span6 j-unit">\
                                  <label class="j-label">NIC Number</label>\
                                  <div class="j-input">\
                                      <input type="text" name="nicnum" REQUIRED>\
                                  </div>\
                              </div>\
                              <div class="j-span6 j-unit">\
                                  <label class="j-label">Amount</label>\
                                  <div class="j-input">\
                                      <input type="number" name="amount" REQUIRED>\
                                  </div>\
                              </div>\
                              ');
    }

    if($('#select_paycategory').val()=="EDU"){
        $('#billingAccDetails').append('\
                              <div class="j-span6 j-unit">\
                                  <label class="j-label">NIC Number</label>\
                                  <div class="j-input">\
                                      <input type="text" name="nicnum" REQUIRED>\
                                  </div>\
                              </div>\
                              <div class="j-span6 j-unit">\
                                  <label class="j-label">Amount</label>\
                                  <div class="j-input">\
                                      <input type="number" name="amount" REQUIRED>\
                                  </div>\
                              </div>\
                              ');
    }

    if($('#select_paycategory').val()=="ELE"){
        $('#billingAccDetails').append('\
                              <div class="j-span6 j-unit">\
                                  <label class="j-label">Bill Number</label>\
                                  <div class="j-input">\
                                      <input type="text" name="billnum" REQUIRED>\
                                  </div>\
                              </div>\
                              <div class="j-span6 j-unit">\
                                  <label class="j-label">Amount</label>\
                                  <div class="j-input">\
                                      <input type="number" name="amount" REQUIRED>\
                                  </div>\
                              </div>\
                              ');
    }

    if($('#select_paycategory').val()=="TEL"){
        $('#billingAccDetails').append('\
                              <div class="j-span6 j-unit">\
                                  <label class="j-label">Mobile Number</label>\
                                  <div class="j-input">\
                                      <input type="text" name="bnum" REQUIRED>\
                                  </div>\
                              </div>\
                              <div class="j-span6 j-unit">\
                                  <label class="j-label">Amount</label>\
                                  <div class="j-input">\
                                      <input type="number" name="amount" REQUIRED>\
                                  </div>\
                              </div>\
                              ');
    }



});