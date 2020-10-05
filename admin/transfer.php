<!DOCTYPE html>
<html lang="en">
    <head>
        <?php require_once './pageutil/head.php'; ?>
    </head>
    <body>
        <?php require_once './pageutil/preloader.php'; ?>
        <div id="pcoded" class="pcoded">
            <div class="pcoded-overlay-box"></div>
            <div class="pcoded-container navbar-wrapper">
                <?php require_once './pageutil/headerbar.php'; ?>
                <div class="pcoded-main-container">
                    <div class="pcoded-wrapper">
                        <?php require_once './pageutil/navigation.php'; ?>
                        <div class="pcoded-content">
                            <div class="pcoded-inner-content">
                                <div class="main-body">
                                    <div class="page-wrapper">
                                        <?php require_once './pageutil/body_transfer.php'; ?>
                                        <!-- New VC end -->

                                    </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php require_once './pageutil/footer.php'; ?>


    </body>
</html>
