<script src="web/js/load_charts_home.js"></script>
<?php include "includes/layout/header.php"; ?> 
<?php include "includes/database/database_get_currencies.php" ?>
<?php include "includes/database/database_update.php"; ?> 
<div class="jumbotron">
    <h1>Exchange converter</h1>
    <p class="lead">Just get the conversion in all the currencies.</p>
    <p class="lead">Last update <?php echo $last_update ?> </p>
</div>

<!--currency converter form-->

<div class="row" id="form1">    
    
    <form name="formconversion" role="form" onsubmit="return false;">
        <fieldset>
            <legend>Enter your value and select the currencies </legend>
            <div class="col-md-3 form-group-lg">
                <label for="value">Value:</label>
                <input  class="span2" type="text" class="form-control"  name="valueconversion" id="value" value="0.00" >
                </input>
            </div>
            <div class="col-md-3 form-group-lg">
                <label for="current1">From:</label>
                <select  class="span3" class="form-control" onchange="AmCharts.currencychart(this.value, 'currency1')" name="current1" id="current1" >
                    <?php foreach ($currencies as $current) { ?>
                        <option value="<?php echo $current->getCurrencyName(); ?>,<?php echo $current->getRate() ?>"  ><?php echo $current; ?></option>
                    <?php } ?>
                </select>
            </div>       

            <div class="col-md-3 form-group-lg">           
                <label for="current2">To:</label>
                <select  class="span3" class="form-control" onchange="AmCharts.currencychart(this.value, 'currency2')" name="current2" id="current2" >
                    <?php foreach ($currencies as $current) { ?>
                        <option value="<?php echo $current->getCurrencyName(); ?>,<?php echo $current->getRate() ?>" ><?php echo $current ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="form-actions">
                <input type="button" onclick="convertit(this.form)" class="btn btn-primary" value="Convert" />

            </div>

        </fieldset>
    </form>
    
<!--result currency converter form-->
    <fieldset>
        <legend>Result</legend>
        <div class="row">  
            <div class="col-md-1"></div>
            <div id ="conversionresult" class="col-md-9"></div>
        </div>
    </fieldset>

</div>

<!--charts currencies converter form-->

<div class="row">
    <div id="currency1header" class="col-md-3 padding-large-horizontal"></div>
    <div id="currency1chart" class="col-md-9 chart"></div>
</div>


<div class="row">
    <div id="currency2header" class="col-md-3 padding-large-horizontal"></div>
    <div id="currency2chart" class="col-md-9 chart"></div>
</div>

<?php include "includes/layout/footer.php"; ?>

