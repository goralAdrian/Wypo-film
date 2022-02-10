<?php
ob_start();
session_start();

$timezone = date_default_timezone_set("Europe/Warsaw");
$con = mysqli_connect("localhost", "root", "", "wypozyczalnia");

try{
    $con = new PDO("mysql:dbname=wypozyczalnia;host=localhost", "root", "");
    $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
}catch (PDOException $e){
    exit("Connection failed: " . $e->getMessage());
}