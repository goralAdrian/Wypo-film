<?php

class Constants {
    //region PASSWORD
    public static $passwordsDoNoMatch = "Hasła nie pasują";
    public static $passwordNotAlphanumeric = "Hasło może zawierac jedynie liczby i litery";
    public static $passwordCharacters = "Hasło powinno zawierać od 5 do 32 znaków";
    //endregion

    //region EMAIL
    public static $emailInvalid = "Email nieprawidłowy";
    public static $checkEmailQuery = "Podany e-mail jest już w użyciu";
    //endregion

    //region NAMES
    public static $lastNameCharacters = "Twoje nazwisko powinno zawierać od 2 do 30 znaków";
    public static $firstNameCharacters = "Twoje imię powinno zawierać od 2 do 30 znaków";
    public static $usernameCharacters = "Twój login powinien zawierać o 5 do 25 znaków";
    public static $checkUsernameQuery = "Podany login jest już w użyciu";
//endregion

    public static $incorrectCredits = "Login lub hasło są nieprawidłowe";

    public static $usernameTaken = "Username already in use";
    public static $emailsDontMatch = "Your emails don't match";
    public static $emailTaken = "Email already in use";
    public static $passwordsDontMatch = "Passwords don't match";
    public static $passwordLength = "Your password must be between 5 and 25 characters";
    public static $loginFailed = "Your username or password was incorrect";
    public static $passwordIncorrect = "Your old password is incorrect";

}

