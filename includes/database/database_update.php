<?php include_once "config.php"; ?>

<?php

set_time_limit(3600);
// using SimpleXML and PHP 5
// allow_url_fopen=On (default)

$connection = mysql_connect(DB_HOST, DB_USER, DB_PASSWORD);

if (!$connection) {
    die('Connection not posible ' . mysql_error());
}

$result_select_db = mysql_select_db(DB_NAME, $connection);

if (!$result_select_db) {
    die('database error, DB_NAME DATABASE DO NOT EXIST' . '<br/>');
}

$need_update = 0;
$last_update = '0000-00-00';

$query = '
  SELECT max(date)
  FROM currency';

$result = mysql_query($query);

if (!$result) {
    // Nope
    $message = 'Invalid query: ' . mysql_error() . "\n";
    $message .= 'Whole query: ' . $query;
    die($message);
}

$today = date('Y-m-d');

while ($row = mysql_fetch_assoc($result)) {
    $last_update = $row['max(date)']; // we save the last update in our database
}


if (strtotime($last_update) == strtotime($today)) {

    // don't do nothing, is up to date
    
} else {

//look for last update in European central Banc
    $XML = simplexml_load_file("http://www.ecb.europa.eu/stats/eurofxref/eurofxref-daily.xml");

    if ($XML) {
        foreach ($XML->Cube->Cube as $rate2) {
            $time_currency_last_value = $rate2["time"];
        }
    } else {
        echo('No internet conection to http://www.ecb.europa.eu');
    }

// check if we need to update de database

    if (strtotime($last_update) < strtotime($time_currency_last_value)) {
        $need_update = 1; //need update
        $datetime1 = new DateTime($last_update);
        $datetime2 = new DateTime($time_currency_last_value);
        $interval = $datetime1->diff($datetime2);
        $interval->d;
        $days_unuptaded = $interval->d;  // days unupdated
    }


    if ($need_update == 1 AND $days_unuptaded == 1) {
        
// daily update from "http://www.ecb.europa.eu/stats/eurofxref/eurofxref-daily.xml"
// XML is the same valor as de daily xml loaded before 
        
    } elseif ($need_update == 1 AND $days_unuptaded > 1) {
        
// long period update from the last 90 days http://www.ecb.europa.eu/stats/eurofxref/eurofxref-hist-90d.xml, web update maximum tha last 90 days.
        
        $XML = simplexml_load_file("http://www.ecb.europa.eu/stats/eurofxref/eurofxref-hist-90d.xml");
        if (!$XML)
            echo('No internet conection to http://www.ecb.europa.eu');
    }
    
    $updated = 0;
    
    if ($XML) {

        $num_elements = count($XML->Cube->Cube->Cube) * count($XML->Cube->Cube);

        foreach ($XML->Cube->Cube as $rate2) {

            $time_currency = $rate2["time"];

            foreach ($rate2->Cube as $rate) {

                if (strtotime($time_currency) > strtotime($last_update)) {

                    $query = 'INSERT INTO currency (currency_name,rate,date) VALUES ("' . $rate['currency'] . '", ' . $rate['rate'] . ', "' . $time_currency . '")';

                    $result = mysql_query($query, $connection);

                    if (!$result) {
                        echo(mysql_error() . '<br/>');
                        $updated = 0;
                    } else {
                        $updated = 1;
                    }
                }
            }
        }
    }


    if ($need_update == 0) {
        // up to date no action required
    }

    if ($need_update == 1 AND $days_unuptaded == 1 AND $updated = 1) {

        echo('database updated from daily eurofxref-daily.xml, now is up to date');
        
    } elseif ($need_update == 1 AND $days_unuptaded > 1 AND $updated = 1) {

        echo('database updated from last 90 day eurofxref-hist-90d.xml, because the database was unupdated more than one day, now is up to date');
   
    } elseif ($need_update == 1 AND $days_unuptaded > 0 AND $updated = 0) {

        echo('database no updated, some error happened, check internet connection');
    }
}

mysql_close($connection);
