<?php
/* 
 * Initian load of all currencies and their last values in database
 */

$connection = mysql_connect(DB_HOST, DB_USER, DB_PASSWORD);

if (!$connection) {
    echo('ERROR LOCALHOST' . mysql_error());
    die();
}

mysql_select_db(DB_NAME, $connection);
$query = '
    SELECT max(date)
    FROM currency';
$result = mysql_query($query);

while ($row = mysql_fetch_assoc($result)) {
    $last_update = $row['max(date)']; // we save the last update
}

$need_update = 0;
//last update in European Central Banc
$XML = simplexml_load_file("http://www.ecb.europa.eu/stats/eurofxref/eurofxref-daily.xml");
if ($XML) {
    foreach ($XML->Cube->Cube as $rate2) {
        $time_currency_last_value = $rate2["time"];
    }
}
if (strtotime($last_update) < strtotime($time_currency_last_value)) {
    $need_update = 1; //need update
}

$currencies = array();
$query = ('SELECT currency.id, currency.currency_name, currency.rate, currency.date, currency_translation.currency_description  FROM currency INNER JOIN currency_translation WHERE currency.date LIKE "' . $last_update . '" AND currency.currency_name = currency_translation.currency_name ORDER BY currency_name ASC');
$result = mysql_query($query, $connection);
echo(mysql_error());
$currencies['EUR'] = new currency('0', 'EUR', '1', $last_update,'Euro');
while ($curr = mysql_fetch_array($result)) {
    $currencies[$curr[1]] = new currency($curr[0], $curr[1], $curr[2], $curr[3], $curr[4]);
}

// Close the connection
mysql_close($connection);

?>
