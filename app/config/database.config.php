<?php
// Initializes the configuration array
$CONFIG = array();

// Connection block database 1
$index = 1;
$CONFIG["DBNAME"][$index] = "bd_biblio";
$CONFIG["USERNAME"][$index] = "user_java";
$CONFIG["PASSWORD"][$index] = "123456";
$CONFIG["PORT"][$index] = "5432";
$CONFIG["HOST"][$index] = "localhost";
$CONFIG["DRIVER"][$index] = "pgsql";
$CONFIG["DRIVER_OPTIONS"][$index] = array();
$CONFIG["DB_DEBUG"][$index] = TRUE;


// Connection block database 2
$index = 2;
$CONFIG["DBNAME"][$index] = "bd_softparking_mysql";
$CONFIG["USERNAME"][$index] = "user_mysql";
$CONFIG["PASSWORD"][$index] = "123456";
$CONFIG["PORT"][$index] = "3452";
$CONFIG["HOST"][$index] = "localhost";
$CONFIG["DRIVER"][$index] = "mysql";
$CONFIG["DRIVER_OPTIONS"][$index] = array();
$CONFIG["DB_DEBUG"][$index] = false;


// Reset index
unset($index);
?>