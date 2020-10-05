$(function() {
  $("#btn_lock").click(function() {
    $(".fullscreen-container").fadeTo(200, 1);
  });
  $("#btn_unlock").click(function() {
  	var conf_pass = document.getElementById("conf_pass").value;
	  var pass = document.getElementById("hpss").value;

  	if(conf_pass==pass){
  		$(".fullscreen-container").fadeOut(200);
  		$conf_pass = "";
  		$pass = "";
  		document.getElementById("conf_pass").value = "";
  		$(document).ready(function(){
	    	test('top','right','','success','','','Screen Unlocked!');
		});
  	}else if(conf_pass==""){
  		$conf_pass = "";
  		$pass = "";
  		document.getElementById("conf_pass").value = "";
  		$(document).ready(function(){
	    	test('top','right','','warning','','','Please Enter the Password!');
		});
  	}else{
  		$conf_pass = "";
  		$pass = "";
  		document.getElementById("conf_pass").value = "";
  		$(document).ready(function(){
	    	test('top','right','','danger','','','Password Verification Failed!');
		});
  	} 
  }); 
});

$(function() {
  $("#btn_newVC").click(function() {
    $(".fullscreen-container2").fadeTo(200, 1);
  });
  $("#btn_newVcCancel").click(function() {
      $(".fullscreen-container2").fadeOut(200);
  });
});

$(function() {
  $("#btn_accToCard").click(function() {
    $(".fullscreen-container2").fadeTo(200, 1);
  });
  $("#btn_accToCardCancel").click(function() {
      $(".fullscreen-container2").fadeOut(200);
  });
});


$(function() {
  $("#btn_accDeposit").click(function() {
    $(".fullscreen-container3").fadeTo(200, 1);
  });
  $("#btn_accDepositCancel").click(function() {
      $(".fullscreen-container3").fadeOut(200);
  });
});

$(function() {
  $("#btn_accWithdraw").click(function() {
    $(".fullscreen-container4").fadeTo(200, 1);
  });
  $("#btn_accWithdrawCancel").click(function() {
      $(".fullscreen-container4").fadeOut(200);
  });
});