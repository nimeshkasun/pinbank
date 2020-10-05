<?php require_once './pageutil/exchangeRatesAPI.php'; ?>
<div class="card-block text-center">
    <div class="risk-rate">
        <span><b><i class="icofont icofont-cur-dollar">1</i></b></span>
    </div>
    <h6 class="m-b-10 m-t-10">All rates are based on US Dollar and updated hourly.</h6>
    <br>
    <div class="row justify-content-center m-t-10 b-t-default m-l-0 m-r-0">
        <div class="col m-t-15 b-r-default">
            <h6 class="text-muted"><strong>Rs</strong></h6>
            <h6><?php echo convertCurrency('1','USD','LKR'); ?></h6>
        </div>
        <div class="col m-t-15 b-r-default">
            <h6 class="text-muted"><i class="icofont icofont-cur-euro"></i></h6>
            <h6><?php echo convertCurrency('1','USD','EUR'); ?></h6>
        </div>
        <div class="col m-t-15">
            <h6 class="text-muted"><i class="icofont icofont-cur-pound"></i></h6>
            <h6><?php echo convertCurrency('1','USD','GBP'); ?></h6>
        </div>
        
    </div>
    <div class="row justify-content-center m-t-10 b-t-default m-l-0 m-r-0">
        <div class="col m-t-15 b-r-default">
            <h6 class="text-muted"><i class="icofont icofont-cur-rupee"></i></h6>
            <h6><?php echo convertCurrency('1','USD','INR'); ?></h6>
        </div>
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
        <div class="col m-t-15 b-r-default">
            <h6 class="text-muted"><i class="icofont icofont-cur-riyal"></i></h6>
            <h6><?php echo convertCurrency('1','USD','QAR'); ?></h6>
        </div>
        <div class="col m-t-15">
            <h6 class="text-muted"><i class="icofont icofont-cur-dong"></i></h6>
            <h6><?php echo convertCurrency('1','USD','VND'); ?></h6>
        </div>
    </div>
    <div class="row justify-content-center m-t-10 b-t-default m-l-0 m-r-0">
        <div class="col m-t-15 b-r-default">
            <h6 class="text-muted"><i class="icofont icofont-cur-frank"></i></h6>
            <h6><?php echo convertCurrency('1','USD','CHF'); ?></h6>
        </div>
        <div class="col m-t-15 b-r-default">
            <h6 class="text-muted"><i class="icofont icofont-cur-hryvnia"></i></h6>
            <h6><?php echo convertCurrency('1','USD','UAH'); ?></h6>
        </div>
        <div class="col m-t-15">
            <h6 class="text-muted"><i class="icofont icofont-cur-afghani"></i></h6>
            <h6><?php echo convertCurrency('1','USD','AFN'); ?></h6>
        </div>
    </div>
    <div class="row justify-content-center m-t-10 b-t-default m-l-0 m-r-0">
        <div class="col m-t-15 b-r-default">
            <h6 class="text-muted"><i class="icofont icofont-cur-peso"></i></h6>
            <h6><?php echo convertCurrency('1','USD','ARS'); ?></h6>
        </div>
        <div class="col m-t-15 b-r-default">
            <h6 class="text-muted"><i class="icofont icofont-cur-taka"></i></h6>
            <h6><?php echo convertCurrency('1','USD','BDT'); ?></h6>
        </div>
        <div class="col m-t-15">
            <h6 class="text-muted"><i class="icofont icofont-cur-turkish-lira"></i></h6>
            <h6><?php echo convertCurrency('1','USD','TRY'); ?></h6>
        </div>
    </div>

</div>