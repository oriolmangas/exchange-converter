  
<?php include "lib/model/Currency.class.php"; ?>
<?php include_once "config.php"; ?>
<?php include "includes/database/database_get_currencies.php"; ?>

<?php $url = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'];
     $keys = parse_url($url); // parse the url
     $path = explode("/", $keys['path']); // splitting the path
     $last = end($path); // get the value of the last element 
?>


<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Exchange converter</title>
        <link rel="stylesheet" href="web/css/main.css"  type='text/css'/>
        <link rel="stylesheet" href="web/css/style.css" type="text/css">
        <!-- Bootstrap -->
        <link href="web/css/bootstrap.min.css" rel="stylesheet" media="screen">
        <link rel="stylesheet" href="web/css/justified-nav.css" type="text/css">
    </head>
    <body>
        <div class="container">  
            <div class="masthead">
                <h3 class="text-muted">Exchange converter</h3>
                <ul class="nav nav-justified">
                    <li <?php if ( $last == 'index.php' ) { echo 'class="active"'; } ?>><a href="index.php">Conversor</a></li>
                    <li <?php if ( $last == 'currencies-evolution.php' ) { echo 'class="active"'; } ?>><a href="currencies-evolution.php">Currencies Evolution</a></li>
                    <li <?php if ( $last == 'download-contact.php' ) { echo 'class="active"'; } ?>><a href="download-contact.php">Download this Code or Contact</a></li>
                    <li><a href="https://bitbucket.org/oriolmangas/exchange-converter">Bitbucket</a></li>
                </ul><!-- /.navbar -->
            </div>



