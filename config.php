<?php

$DBNAME = 'helpdesk';
$DBHOST = 'localhost';
$DBUSER = 'helpdesk';
$DBPASS = 'password';


$link = mysqli_connect("$DBHOST", "$DBUSER", "$DBPASS", "$DBNAME");

if (!$link) {
    echo "Error: Unable to connect to MySQL." . PHP_EOL;
    echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
    echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
    exit;
}


$result = mysqli_query($link, "SELECT * FROM `ost_config` WHERE `key` = 'helpdesk_title'");
$row = mysqli_fetch_array($result);
$siteName =  $row['value'];

=======
<?php

$DBNAME = 'helpdesk';
$DBHOST = 'localhost';
$DBUSER = 'helpdesk';
$DBPASS = 'password';


$link = mysqli_connect("$DBHOST", "$DBUSER", "$DBPASS", "$DBNAME");

if (!$link) {
    echo "Error: Unable to connect to MySQL." . PHP_EOL;
    echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
    echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
    exit;
}


$result = mysqli_query($link, "SELECT * FROM `ost_config` WHERE `key` = 'helpdesk_title'");
$row = mysqli_fetch_array($result);
$siteName =  $row['value'];

?>