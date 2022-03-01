<?php 

// Configuration of database connection
$_DB = array(
    "hostname" => "192.168.65.137",
    "username" => "root",
    "password" => "root",
    "db_name" => "camera"
);

// Create connexion to database
try {
    $_SQL = new PDO("mysql:host=".$_DB["hostname"].";dbname=".$_DB["db_name"].";charset=utf8;", $_DB["username"], $_DB["password"]);
} catch(Exception $e) {
    echo "Erreur de connexion à la base de données";
} 