<?php

class Account {
    /**
 * @var PDO
 */
    private $con;
    private $errorArray;

    public function __construct($con) {
        $this->errorArray = array();
        $this->con = $con;
    }

    /**
     * Jest to funkcja do aktualizacji danych użytkownika
     * @param $fn
     * @param $ln
     * @param $em
     * @param $un
     * @return bool
     */
    public function updateDetails($fn, $ln, $em, $un) {
        $this->validateName($fn);
        $this->validateSurname($ln);
        $this->validateNewEmail($em, $un);

        if(empty($this->errorArray)) {
            $query = $this->con->prepare("UPDATE users SET firstName=:fn, lastName=:ln, email=:em
                                            WHERE username=:un");
            $query->bindValue(":fn", $fn);
            $query->bindValue(":ln", $ln);
            $query->bindValue(":em", $em);
            $query->bindValue(":un", $un);

            return $query->execute();
        }

        return false;
    }

    /**
     * Jest to funkcja do zalogowania użytkownika
     * @param $login
     * @param $password
     * @return bool
     */
    public function login($login, $password) {
        $password = md5($password);
        $query = $this->con->prepare("SELECT * FROM users WHERE Username='$login' AND Password='$password'");
        $query->execute();

        if ($query->rowCount() == 1)
            return true;
        else {
            array_push($this->errorArray, Constants::$incorrectCredits);
            return false;
        }
    }

    /**
     * Jest to funkcja do zarejestrowania użytkownika
     * @param $login
     * @param $password
     * @param $password2
     * @param $email
     * @param $name
     * @param $surname
     * @return bool
     */
    public function register($login, $password, $password2, $email, $name, $surname) {
        $this->validateLogin($login);
        $this->validatePassword($password, $password2);
        $this->validateEmail($email);
        $this->validateName($name);
        $this->validateSurname($surname);

        if (empty($this->errorArray)) {
            return $this->insertData($login, $password, $email, $name, $surname);
        } else {
            return false;
        }
    }

    /**
     * Jest to funkcja, która dodaje dane użytkownika do bazy danych
     * @param $login
     * @param $password
     * @param $email
     * @param $name
     * @param $surname
     * @return bool
     */
    public function insertData($login, $password, $email, $name, $surname) {
        $encryptedPw = md5($password);

        $profiePic = "assets/images/ProfilePic.jpg";
        $date = date("Y-m-d");

        $result = $this->con->prepare("INSERT INTO users VALUES 
        ('', '$login', '$encryptedPw', '$name', '$surname', '$email', '$date', '$profiePic')");


        return $result->execute();
    }

    /**
     * Jest to funkcja, która wyświetla na stronie error przy wprowadzaniu błędnych danych zalogowania/rejestracji
     * @param $error
     * @return string
     */
    public function getError($error) {
        if (!in_array($error, $this->errorArray)) {
            $error = "";
        }
        return "<span class='errorMessage'>$error</span>";
    }

    public function getFirstError() {
        if(!empty($this->errorArray)) {
            return $this->errorArray[0];
        }
    }
    //region VALIDATE

    /**
     * Jest to funkcja która waliduje poprawność loginu
     * @param $login
     */
    public function validateLogin($login) {
        if (strlen($login) > 25 || strlen($login) < 5) {
            array_push($this->errorArray, Constants::$usernameCharacters);
            return;
        }

        $checkUsernameQuery = $this->con->prepare("SELECT Username FROM users WHERE Username='$login'");
        $checkUsernameQuery->execute();
        if ($checkUsernameQuery->rowCount() != 0) {
            array_push($this->errorArray, Constants::$checkUsernameQuery);
            return;
        }
    }

    private function validatePassword($password, $password2) {
        if ($password != $password2) {
            array_push($this->errorArray, Constants::$passwordsDoNoMatch);
        }
        if (preg_match('/[^A-Za-z0-9]/', $password)) {
            array_push($this->errorArray, Constants::$passwordNotAlphanumeric);
        }
        if (strlen($password) > 32 || strlen($password) < 5) {
            array_push($this->errorArray, Constants::$passwordCharacters);
        }
    }

    private function validateEmail($email) {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            array_push($this->errorArray, Constants::$emailInvalid);
            return;
        }
        $checkEmailQuery = $this->con->prepare("SELECT Email FROM users WHERE Email='$email'");
        if ($checkEmailQuery->rowCount() != 0) {
            array_push($this->errorArray, Constants::$checkEmailQuery);
            return;
        }

    }

    private function validateName($name) {
        if (strlen($name) > 30 || strlen($name) < 2) {
            array_push($this->errorArray, Constants::$firstNameCharacters);
            return;
        }
    }

    private function validateSurname($surname) {
        if (strlen($surname) > 30 || strlen($surname) < 2) {
            array_push($this->errorArray, Constants::$lastNameCharacters);
            return;

        }
    }

    private function validateNewEmail($em, $un) {

        if(!filter_var($em, FILTER_VALIDATE_EMAIL)) {
            array_push($this->errorArray, Constants::$emailInvalid);
            return;
        }

        $query = $this->con->prepare("SELECT * FROM users WHERE email=:em AND username != :un");
        $query->bindValue(":em", $em);
        $query->bindValue(":un", $un);

        $query->execute();

        if($query->rowCount() != 0) {
            array_push($this->errorArray, Constants::$emailTaken);
        }
    }

    /**
     * Jest to funkcja która aktualizacje hasło
     * @param $oldPw
     * @param $pw
     * @param $pw2
     * @param $un
     * @return bool
     */
    public function updatePassword($oldPw, $pw, $pw2, $un) {
        $this->validateOldPassword($oldPw, $un);
        $this->validatePassword($pw, $pw2);

        if(empty($this->errorArray)) {
            $query = $this->con->prepare("UPDATE users SET password=:pw WHERE username=:un");
            $pw = hash("sha512", $pw);
            $query->bindValue(":pw", $pw);
            $query->bindValue(":un", $un);

            return $query->execute();
        }

        return false;
    }

    public function validateOldPassword($oldPw, $un) {
        $pw = hash("sha512", $oldPw);

        $query = $this->con->prepare("SELECT * FROM users WHERE username=:un AND password=:pw");
        $query->bindValue(":un", $un);
        $query->bindValue(":pw", $pw);

        $query->execute();

        if($query->rowCount() == 0) {
            array_push($this->errorArray, Constants::$passwordIncorrect);
        }
    }
//endregion
}