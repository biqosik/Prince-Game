<?php
$host = "localhost";
$username = "root";
$passwrod  = '';
$db_name = "game_db";
$db = new mysqli($host,$username,$passwrod,$db_name);

if(!isset($_SESSION['variable'])) session_start();