<?php
if(isset($_POST['loginButton'])){
    $username = $_POST['usernameBox'];
    $password = $_POST['passwordBox'];

    $result = $account->login($username, $password);
    if ($result){
        $_SESSION['LoggedIn'] = $username;
        header("Location: mainPage.php");
    }
}