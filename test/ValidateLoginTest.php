<?php

class ValidateLoginTest extends \PHPUnit\Framework\TestCase{

    public function validateLogin($login){
        $number = 0;

        if(strlen($login) > 25 || strlen($login) < 5){
            //array_push($this->errorArray, Constants::$usernameCharacters);
            $number += 1;
        }

//        $checkUsernameQuery = $this->con->prepare("SELECT Username FROM users WHERE Username='$login'");
//        $checkUsernameQuery->execute();
//        if ($checkUsernameQuery->rowCount() != 0) {
//            array_push($this->errorArray, Constants::$checkUsernameQuery);
//            return;
//        }
        if($number != 0)
            return false;
        else
            return true;
    }

    public function testValidateLoginFalse(){

        $actual = $this->validateLogin("1234");
        echo $actual;
        $this->assertEquals(false, $actual);
    }

    public function testValidateLoginTrue(){

        $actual = $this->validateLogin("123456");
        echo $actual;
        $this->assertEquals(true, $actual);
    }

}
