<?php

require_once("../includes/dbConfig.php");

if(isset($_POST["videoId"]) && isset($_POST["username"])){
    $query = $con->prepare("SELECT * FROM favourites 
                            WHERE username=:username AND videoId=:videoId");
    $query->bindValue(":username", $_POST["username"]);
    $query->bindValue(":videoId", $_POST["videoId"]);

    $query->execute();

    if($query->rowCount() == 0){

        $query = $con->prepare("INSERT INTO favourites (username, videoId)
                                VALUES(:username, :videoId)");
        $query->bindValue(":username", $_POST["username"]);
        $query->bindValue(":videoId", $_POST["videoId"]);

        $query->execute();

        return false;

    } elseif($query->rowCount() == 1){
        $query = $con->prepare("DELETE FROM favourites WHERE username=:username AND videoId=:videoId");
        $query->bindValue(":username", $_POST["username"]);
        $query->bindValue(":videoId", $_POST["videoId"]);

        $query->execute();

        return true;
    }
} else{
    echo "already added";

}

