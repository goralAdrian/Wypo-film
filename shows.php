<?php
require_once("includes/header.php");

$preview = new PreviewProvider($con, $loggedIn);
echo $preview->createTVShowPreviewVideo();

$containers = new CategoryContainers($con, $loggedIn);
echo $containers->showTVShowCategories();
?>