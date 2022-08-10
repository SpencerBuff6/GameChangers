<?php
session_start();

if(!defined('DB_SERVER') &&
   !defined('DB_USERNAME') &&
   !defined('DB_PASSWORD') &&
   !defined('DB_NAME'))
{
    define('DB_SERVER', '169.254.198.217');
    define('DB_USERNAME', 'phpa');
    define('DB_PASSWORD', 'some_strong_password');
    define('DB_NAME', 'Game Collection');
}

$_SESSION["link"] = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

if($_SESSION["link"] == false)
{
    die("ERROR: Could not connect. " . mysqli_connect_error());
}

?>