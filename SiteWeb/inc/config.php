<?php 
session_start();

// Include DB CONFIG 
require_once "db.php";

// TABLE OF CONFIG
$_CONFIG = array();

// Init class
require "user.class.php";
$_USER = new User($_SQL);

require "cam.class.php";
$_CAM = new Cam($_SQL);