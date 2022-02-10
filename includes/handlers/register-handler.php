<?php

function sanitizeMail($mail) {
    $mail = strip_tags($mail);
    $mail = str_replace(" ", "", $mail);
    return $mail;
}

function sanitizeName($name) {
    $name = strip_tags($name);
    $name = str_replace(" ", "", $name);
    $name = ucfirst(strtolower($name));

    return $name;
}

function sanitizePassword($password) {
    $password = strip_tags($password);

    return $password;
}

if (isset($_POST['registerButton'])) {

    $login = sanitizeMail($_POST['loginBox']);
    $email = sanitizeMail($_POST['emailBox']);
    $pswrd = sanitizePassword($_POST['pswrdBox']);
    $pswrd2 = sanitizePassword($_POST['pswrd2Box']);
    $name = sanitizeName($_POST['nameBox']);
    $surname = sanitizeName($_POST['surnameBox']);


    $wasSuccessful = $account->register($login, $pswrd, $pswrd2, $email, $name, $surname);
    if ($wasSuccessful) {
        $_SESSION['LoggedIn'] = $login;
        header("Location: mainPage.php");
    }

}
