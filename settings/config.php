<?php   
session_start();


define("SQL_HOST", "localhost");
define("SQL_USER", "root");
define("SQL_PASS", "123456");
define("SQL_DBNAME", "cars");

try{
    $db = new PDO("mysql:dbname=".SQL_DBNAME.";charset=utf8;host=".SQL_HOST, SQL_USER,SQL_PASS);

} catch(Exception $e){
    die('Erreur : '. $e ->getMessage());
}

// functions
require('functions.php');

// chargement des traitements
// post
require('core.php');
require('carcore.php');
// update
require('updatecore.php');
require('carupdatecore.php');
// delete
require('deletecore.php');
require('cardeletecore.php');
