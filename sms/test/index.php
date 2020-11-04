<?php
include("../newsletterslk.class.php");// Include sms system
if(isset($_REQUEST['submit'])){
    if($_REQUEST['submit']=="direct"){
        $json=FALSE; // Set Json Off 
    }elseif($_REQUEST['submit']=="ajax"){
        $json=TRUE; //Set JSON On Via AJAX
    }
    $sender_id=$_REQUEST['sender_id'];
    $api_key=$_REQUEST['api_key'];
    $api_token=$_REQUEST['api_token'];
    $msgType=$_REQUEST['msgType'];
    @$file=$_REQUEST['file'];
    @$language=$_REQUEST['language'];
    @$duration=$_REQUEST['duration'];
    @$scheduledate=$_REQUEST['scheduledate'];
    $Mobile=$_REQUEST['mobile'];
    $TEXT=$_REQUEST['text'];
    if($Mobile !="" && strlen($Mobile) > 9){
        if($api_key !=""){
            if($api_token !=""){
                /**
                 * 
                 */
                    $newsletters=new Newsletterslk;
                    $newsletters->setUser($api_key,$api_token);// Initializing User Api Key and Api Token
                    $newsletters->setSenderID($sender_id);// Initializing Sender ID
                    $newsletters->msgType=$msgType;// Initializing Message Type

                    if($file !=""){
                        $newsletters->file=$file;// Initializing file url if not empty
                    }
                    
                    if($language !=""){
                        $newsletters->language=$language;// Initializing language if not empty
                    }

                    if($scheduledate !=""){
                        $newsletters->scheduledate=$scheduledate;// Initializing schedule date if not empty
                    }

                    if($duration !=""){
                        $newsletters->duration=$duration;// Initializing duration id not empty
                    }

                    $send=$newsletters->SendMessage($Mobile,$TEXT,$json); // Send Message to Target
                /**
                 * 
                 */
                
                if($json==true && $send != false){
                    echo $send;
                    exit;
                }elseif($json==false && $send != false){
                    $success="Message sent!";
                }elseif($send ==false){
                    $error[]="Message send falied due invalid config";
                }

            }else{
                $error[]="Invalid API TOKEN, Please check documentation for how to get API TOKEN";
            }
        }else{
            $error[]="Invalid API KEY, Please check documentation for how to get API KEY";
        }
    }else{
        $error[]="Invalid Mobile Number";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Newsletters.lk - SMS API</title>
       <!-- Bootstrap core CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
    <!-- Material Design Bootstrap -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.8.10/css/mdb.min.css" rel="stylesheet">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js" ></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.8.10/js/mdb.min.js"></script>
<style>
body,html{
    background:#eee;
}
.headerback {
    background:#006ab9;
    color:#fff;
    text-align: center;
}
</style>
</head>
<body>
    <div class="container">
        <div class="row mt-2">
            <div class="col-12 col-md-8 offset-md-2">
                <div class="alert alert-info">
                    To register and get info, https://app.newsletters.lk/apis
                </div>
                <form method="post"> <!-- FORM START YOU CAN USE POST OR GET -->
                    <div class="card">
                        <?php
                            if(isset($success)){
                                echo'<div class="alert alert-success">'.$success.'</div>';
                            }
                            if(isset($error)){
                                foreach ($error as $key => $value) {
                                    echo'<div class="alert alert-danger">'.$value.'</div>';
                                }
                            }
                        ?>
                        <div class="card-header headerback">API DETAILS</div>
                        <div class="card-body">
                            <div class="md-form">
                                <input type="text" name="sender_id" id="sender_id" aria-expanded="true" value="WebSMS" focus class="form-control"/>
                                <label for="sender_id">Sender ID</label>
                            </div>
                            <div class="md-form">
                                
                                <input type="text" name="api_key" id="api_key"  class="form-control"/>
                                <label for="api_key">API KEY</label>
                            </div>
                            <div class="md-form">
                                
                                <input type="text" name="api_token" id="api_token" class="form-control"/>
                                <label for="api_token">API TOKEN</label>
                            </div>
                        </div>
                    </div>
                    <div class="card mt-2">
                        <div class="card-header headerback">MESSAGE</div>
                        <div class="card-body">
                            <div class="md-form">
                                <select name="msgType" id="msgType" class="form-control">
                                    <option value="sms">SMS</option>
                                    <option value="voice">Voice</option>
                                    <option value="mms">MMS</option>
                                    <option value="flash">Flash</option>
                                    <option value="unicode">Unicode</option>
                                    <option value="whatsapp">Whats APP</option>
                                </select>
                            </div>
                            <div class="md-form" id="file_sel" style="display:none;">
                                <input type="text" class="form-control" name="file" id="file" />
                                <label for="file">File URL For Voice,MMS,Whatsapp</label>
                            </div>
                            <div class="md-form">
                                <input type="text" class="form-control" name="language" id="language" />
                                <label for="language">Laguage - Default empty</label>
                            </div>
                            <div class="md-form" id="voice_duration" style="display:none;">
                                <input type="text" class="form-control" name="duration" id="duration" />
                                <label for="duration">Duration of voice msg</label>
                            </div>
                            <div class="md-form">
                                <input type="datetime" class="form-control" name="scheduledate" id="scheduledate"/>
                                <label for="scheduledate">Schedule date Default instant</label>
                            </div>
                            <hr />
                            <div class="md-form">
                                <input type="text" class="form-control" name="mobile" id="mobile" />
                                <label for="mobile">Mobile Number</label>
                                <small>For Sri Lanka 07XXXXXXXX For Other Countries Enter With Country Code</small>
                            </div>
                            <div class="md-form">
                                <textarea name="text" id="text" cols="30" rows="10" class="form-control" ></textarea><br />
                                <label for="text">Message</label>
                                <small>For Type Sinhala Or Tamil Select Unicode To Message Type</small>
                            </div>
                            <hr />
                            <div class="md-form">
                                <div class="row">
                                    <div class="col">
                                        <button type="submit" name="submit" value="direct" class="btn btn-primary btn-lg btn-block">Send - Direct Submit </button>
                                    </div>
                                    <div class="col">
                                        <button type="button"  id="btn_json" class="btn btn-secondary btn-lg btn-block">Send - Ajax + JSON </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form> <!-- FORM END -->
            </div>
        </div>
    </div>
</body>
<script>

    $(document).on("click touch","#btn_json",function(){
        var new_form= new FormData;
        if($("#mobile").val() !=""){
            if($("#api_key").val() !=""){
                if($("#api_token").val() !=""){
                    /**
                     */
                        new_form.append("mobile",$("#mobile").val());
                        new_form.append("text",$("#text").val());
                        new_form.append("sender_id",$("#sender_id").val());
                        new_form.append("api_key",$("#api_key").val());
                        new_form.append("api_token",$("#api_token").val());
                        new_form.append("msgType",$("#msgType").val());
                        new_form.append("file",$("#file").val());
                        new_form.append("language",$("#language").val());
                        new_form.append("duration",$("#duration").val());
                        new_form.append("submit","ajax");// Visible json 

                        $.ajax({
                            type: "POST",
                            data: new_form,
                            processData: false,
                            contentType: false,
                            dataType: "json",//json 
                            success: function (res) {
                                console.log(res); // Render to consol log
                            },error:function(err){
                                alert(err);
                            }
                        });

                     /**
                      */
                }else{
                    alert("Invalid API Token");
                }
            }else{
                alert("Invalid API key");
            }
        }else{
            alert("Invalid mobile number");
        }
        
    });

    $(document).on("change","#msgType",function(){
        if($(this).val() !="sms" && $(this).val() !="unicode"){
            $("#file_sel").show();
            $("#voice_duration").hide();
        }else{
            if($(this).val()=="voice"){
                $("#voice_duration").show();
            }else{
                $("#voice_duration").hide();
            }
            $("#file_sel").hide();
        }
    });
</script>
</html>
<?php

?>