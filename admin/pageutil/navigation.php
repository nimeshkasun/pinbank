<nav class="pcoded-navbar">
    <div class="pcoded-inner-navbar main-menu">
    <div class="pcoded-navigatio-lavel">Navigation</div>
        <ul class="pcoded-item pcoded-left-item">
            <li class="">
                <a href="./">
                    <span class="pcoded-micon"><i class="feather icon-home"></i></span>
                    <span class="pcoded-mtext">Dashboard</span>
                </a>
            </li>

            <li class="pcoded-hasmenu pcoded-trigger">
                <a href="javascript:void(0)">
                    <span class="pcoded-micon"><i class="ti-files"></i></span>
                    <span class="pcoded-mtext">Customer</span>
                </a>
                <ul class="pcoded-submenu">
                    <li class="">
                        <a href="./pra.php">
                            <span class="pcoded-mtext">Account</span>
                        </a>
                    </li>
                    <li class="">
                        <a href="./customer.php">
                            <span class="pcoded-mtext">Profile</span>
                        </a>
                    </li>
                    <li class="">
                        <a href="./chat.php">
                            <span class="pcoded-mtext">Chat</span>
                        </a>
                    </li>
                </ul>
            </li>
            <!-- <li class="">
                <a href="#">
                    <span class="pcoded-micon"><i class="ti-write"></i></span>
                    <span class="pcoded-mtext">Loans</span>
                </a>
            </li> -->
        </ul>

    <!-- <div class="pcoded-navigatio-lavel">Actions</div>
        <ul class="pcoded-item pcoded-left-item">
            <li class="">
                <a href="./transfer.php">
                    <span class="pcoded-micon"><i class="ti-share"></i></span>
                    <span class="pcoded-mtext">Transfer Money</span>
                </a>
            </li>
            <li class="">
                <a href="./payment.php">
                    <span class="pcoded-micon"><i class="ti-receipt"></i></span>
                    <span class="pcoded-mtext">Make a Payment</span>
                </a>
            </li> -->
            <!-- <li class="">
                <a href="#">
                    <span class="pcoded-micon"><i class="feather icon-home"></i></span>
                    <span class="pcoded-mtext">Obtain a Loan</span>
                </a>
            </li> -->
            <!-- <li class="">
                <a href="#">
                    <span class="pcoded-micon"><i class="ti-infinite"></i></span>
                    <span class="pcoded-mtext">Pin.Me</span>
                </a>
            </li>
        </ul> -->

<?php if($_SESSION["userTypesaved"] == "staAdmin" || $_SESSION["userTypesaved"] == "staSupp"){ ?>
    <div class="pcoded-navigatio-lavel">Support</div>
        <ul class="pcoded-item pcoded-left-item">
            <li class="">
                <a href="./support.php">
                    <span class="pcoded-micon"><i class="ti-email"></i></span>
                    <span class="pcoded-mtext">Support</span>
                </a>
            </li>
        </ul>
<?php } ?>






    </div>
</nav>