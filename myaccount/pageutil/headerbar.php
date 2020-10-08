<nav class="navbar header-navbar pcoded-header">
    <div class="navbar-wrapper">

        <div class="navbar-logo">
            <a class="mobile-menu" id="mobile-collapse" href="#!">
                <div align="left"><i class="feather icon-menu"></i></div>
            </a>
            <a href="./">
                <img class="img-fluid" src="./files/assets/images/logo.png" alt="Theme-Logo">
            </a>
            <a class="mobile-options">
                <i class="feather icon-more-horizontal"></i>
            </a>
        </div>

        <div class="navbar-container container-fluid">
            <ul class="nav-left">
                <!-- <li class="header-search">
                    <div class="main-search morphsearch-search">
                        <div class="input-group">
                            <span class="input-group-addon search-close"><i class="feather icon-x"></i></span>
                            <input type="text" class="form-control">
                            <span class="input-group-addon search-btn"><i class="feather icon-search"></i></span>
                        </div>
                    </div>
                </li> -->
                <li>
                    <a href="#!" onclick="javascript:toggleFullScreen()">
                        <i class="feather icon-maximize full-screen"></i>
                    </a>
                </li>
            </ul>
            <ul class="nav-right">
                <li class="header-notification">
                    <div class="dropdown-primary dropdown">
                        <div class="dropdown-togglee" data-toggle="dropdown">
                            <i class="feather icon-bell"></i>
                            <span class="badge bg-c-pink count">0</span>
                        </div>
                        <ul class="show-notification notification-view dropdown-menu menunot" data-dropdown-in="fadeIn" data-dropdown-out="fadeOut">
                            <li>
                                <label class="label label-danger">Notifications</label>
                            </li>
                        </ul>
                        <script>
                            $(document).ready(function(){
                             
                             function load_unseen_notification(view = '')
                             {
                              $.ajax({
                               url:"pageutil/headbar_noti_fetch.php",
                               method:"POST",
                               data:{view:view},
                               dataType:"json",
                               success:function(data)
                               {
                                $('.menunot').html(data.notification);
                                if(data.unseen_notification > 0)
                                {
                                 $('.count').html(data.unseen_notification);
                                 var a = new Audio()
                                 a.src =   "pageutil/headbar_noti_fetch.wav"
                                 a.play()
                                }
                               }
                              });
                             }
                             
                             load_unseen_notification();
                             
                             $(document).on('click', '.dropdown-togglee', function(){
                              $('.count').html('0');
                              load_unseen_notification('yes');
                             });
                             
                             setInterval(function(){ 
                              load_unseen_notification();; 
                             }, 5000);
                             
                            });
                        </script>
                    </div>
                </li>
                <!-- <li class="header-notification">
                    <div class="dropdown-primary dropdown">
                        <div class="displayChatbox dropdown-toggle" data-toggle="dropdown">
                            <i class="feather icon-message-square"></i>
                            <span class="badge bg-c-green">3</span>
                        </div>
                    </div>
                </li> -->
                <li class="user-profile header-notification">
                    <div class="dropdown-primary dropdown">
                        <div class="dropdown-toggle" data-toggle="dropdown">
                            <img src="./files/assets/images/avatar-4.jpg" class="img-radius" alt="User-Profile-Image">
                            <span><?php echo $firstnamesaved." ".$lastnamesaved; ?></span>
                            <i class="feather icon-chevron-down"></i>
                        </div>
                        <ul class="show-notification profile-notification dropdown-menu" data-dropdown-in="fadeIn" data-dropdown-out="fadeOut">
                            <!-- <li>
                                <a href="#!">
                                    <i class="feather icon-settings"></i> Settings
                                </a>
                            </li> -->
                            <li>
                                <a href="./user.php">
                                    <i class="feather icon-user"></i> Profile
                                </a>
                            </li>
                            <li>
                                <a href="./support.php">
                                    <i class="feather icon-mail"></i> My Messages
                                </a>
                            </li>
                            <?php if($_SESSION["userTypesaved"] == "custAdv"){ ?>
                            <li>
                                <a href="" id="btn_lock" data-toggle="modal">
                                    <i class="feather icon-lock"></i> Lock Screen
                                </a> 
                            </li>
                            <?php } ?>
                            <li>
                                <a href="../signout.php">
                                    <i class="feather icon-log-out"></i> Sign Out
                                </a>
                            </li>
                        </ul>

                    </div>
                </li>
            </ul>
        </div>
    </div>
    

</nav>

<!-- Lock screen start -->
<div class="fullscreen-container">
    <div class="modal-dialog">
        <div class="login-card card-block login-card-modal">
            <form class="md-float-material" method="" action="./dbClass.php">
                <div class="text-center">
                    <img src="./files/assets/images/logo.png" alt="logo.png">
                </div>
                <div class="card m-t-15">
                    <div class="auth-box card-block">
                        <div class="row">
                            <div class="col-md-12">
                                <h3 class="text-center"><i class="icofont icofont-lock text-primary f-80"></i></h3>
                            </div>
                        </div>
                        <p class="text-inverse b-b-default text-right">Back to <a href="../signout.php">Sign In</a></p>
                        <div class="input-group">
                            <input type="Password" class="form-control" id="conf_pass" name="conf_pass" placeholder="Confirm Your Password">
                            <span class="md-line"></span>
                            <input type="hidden" name="hpss" id="hpss" value="<?php echo $lockCheck; ?>">
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <button type="button" id="btn_unlock" class="btn btn-primary btn-md btn-block waves-effect text-center"><i class="icofont icofont-lock"></i> Unlock Screen </button>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-10">
                                <p class="text-inverse text-left m-b-0">Thank you being alert!</p>
                                <p class="text-inverse text-left"><b>Pin Online Banking System</b></p>
                            </div>
                            <div class="col-md-2">
                                <img src="../img/logo.png" alt="small-logo.png">
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Lock screen end -->
