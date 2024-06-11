<?php

include_once("global/dbcon.php");
include("global/fun.php");
include("global/dbWebFun.php");
include("chkLenience.php");
$db = Database::connectDB();
$fun = new Funcation();
$dbf = new dbFuncation();
$webUrlfun = $fun->baseUrl();

$chklin= new chkLenienceWeb();
// Define a constant for the base URL
define('BASE_URL', 'C:\xampp\htdocs\ibmspro\ibm');
$chklkey=$chklin->apiKeyProject();

// Define a global variable for the web URL
global $webUrl;

// global site settig
$fun->printGlobalVar();

// Get the current web URL
$protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https' : 'http';
$currentUrl = $protocol . '://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];

// Remove the filename from the URL
$webUrl = dirname($currentUrl);

$webUrl2 = $_SERVER['DOCUMENT_ROOT'] . "/portfolio/ibm";

// Make $db accessible in the chkLenienceWeb class
global $db;

// Now, $webUrl contains the complete web URL

// Example usage

// Now you can use BASE_URL anywhere in your script
// echo BASE_URL . '/path/to/resource';


?>