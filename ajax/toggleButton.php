<?php
require_once("../includes/dbConfig.php");

if(isset($_POST["videoId"]) && isset($_POST["username"])){
    $query = $con->prepare("SELECT * FROM favourites 
                            WHERE username=:username AND videoId=:videoId");
    $query->bindValue(":username", $_POST["username"]);
    $query->bindValue(":videoId", $_POST["videoId"]);

    $query->execute();

    if($query->rowCount() == 1){

        return true;

    }
}
