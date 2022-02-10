<?php
require_once("includes/header.php");

$preview = new PreviewProvider($con, $loggedIn);
echo $preview->createPreviewVideo(null);

$containers = new CategoryContainers($con, $loggedIn);
echo $containers->showAllCategories();




