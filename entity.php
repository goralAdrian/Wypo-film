<?php
require_once("includes/header.php");

if(!isset($_GET['id'])){
    ErrorMessage::show("Nie znaleziono filmu");
}

$entityId = $_GET["id"];
$entity = new Entity($con, $entityId);

$preview = new PreviewProvider($con, $loggedIn);
echo $preview->createPreviewVideo($entity);

$seasonProvider = new SeasonProvider($con, $loggedIn);
echo $seasonProvider->create($entity);

$categoryContainers = new CategoryContainers($con, $loggedIn);
echo $categoryContainers->showCategory($entity->getCategoryId(), "You might also like");
