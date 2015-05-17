<?php /*
 * JSON file for the charts
 */

include "../../config.php";


if (isset($_GET['currency'])) {
    $currency = $_GET['currency'];
} else {
    $currency = NULL;
}


// Connect to MySQL
$link = mysql_connect(DB_HOST, DB_USER, DB_PASSWORD);
if (!$link) {
    die('Could not connect: ' . mysql_error());
}

// Select the data base
$db = mysql_select_db(DB_NAME, $link);
if (!$db) {
    die('Error selecting database \'test\' : ' . mysql_error());
}

// Fetch the data
$query = '
  SELECT *
  FROM currency
  WHERE currency_name LIKE "' . $currency . '"
  ORDER BY date ASC';
$result = mysql_query($query);

// All good?
if (!$result) {
    // Nope
    $message = 'Invalid query: ' . mysql_error() . "\n";
    $message .= 'Whole query: ' . $query;
    die($message);
}



// Print out rows
$prefix = '';
echo "[\n";
while ($row = mysql_fetch_assoc($result)) {
    echo $prefix . " {\n";
    echo '  "category": "' . $row['date'] . '",' . "\n";
    echo '  "value1": ' . $row['rate'] . ',' . "\n";
    echo " }";
    $prefix = ",\n";
}
echo "\n]";

// Close the connection
mysql_close($link);

die();


?>