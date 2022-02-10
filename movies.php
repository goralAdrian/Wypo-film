<?php
require_once("includes/header.php");

$preview = new PreviewProvider($con, $loggedIn);
echo $preview->createMoviesPreviewVideo();

$containers = new CategoryContainers($con, $loggedIn);
echo $containers->showMovieCategories();
?>