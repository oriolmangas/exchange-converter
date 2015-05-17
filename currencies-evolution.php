<?php include "includes/layout/header.php"; ?> 

<div class="jumbotron">
    <h1>Currencies Evolution</h1>
    <p class="lead">Last update <?php echo $last_update ?></p>
</div>

<!--List all currencies charts -->
<?php foreach ($currencies as $current) { ?>

    <?php if ($current->getCurrencyName() != 'EUR') { ?>

        <div class="row">

            <div id="currency<?php echo $current->getCurrencyName(); ?>header" class="col-md-3 padding-large-horizontal"> 

            </div>

            <div  id="currency<?php echo $current->getCurrencyName(); ?>chart" class="col-md-9 chart">

            </div>

        </div>

    <?php } ?>

<?php } ?>

<!--javascript that controls this page charts-->
<script src="web/js/load_charts_currencies_evolution.js"></script>

<?php include "includes/layout/footer.php"; ?>

