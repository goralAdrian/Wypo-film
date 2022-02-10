<?php

namespace Test;
class Account{
    public function validatePassword($password, $password2) {
        $number = 0;
        if ($password != $password2) {
            //array_push($this->errorArray, Constants::$passwordsDoNoMatch);
            $number += 1;
        }
        if (preg_match('/[^A-Za-z0-9]/', $password)) {
            //array_push($this->errorArray, Constants::$passwordNotAlphanumeric);
            $number +=1;
        }
        if (strlen($password) > 32 || strlen($password) < 5) {
            //array_push($this->errorArray, Constants::$passwordCharacters);
            $number +=1;
        }
        return $number;
    }
}


class ValidatePasswordTest extends \PHPUnit\Framework\TestCase{

    public function testSanitizeFormPassword(){
        $result = new Account();
        $actual = $result->validatePassword("123456", "123456");
        $this->assertEquals(0, $actual);
        //0 Błedów hasła są takie same i mają poprawne formy
    }

    public function testSanitizeFormPassword1(){
        $result = new Account();
        $actual = $result->validatePassword("12345", "123456");
        $this->assertEquals(1, $actual);
        //1 błąd przy sprawdzaniu haseł
    }

    public function testSanitizeFormPassword2(){
        $result = new Account();
        $actual = $result->validatePassword("1234", "12");
        $this->assertEquals(2, $actual);
        //2 Błędy przy sprawdzaniu haseł
    }

    public function testSanitizeFormEPassword3(){
        $result = new Account();
        $actual = $result->validatePassword("///", "//");
        $this->assertEquals(3, $actual);
        // 3 Błędy przy sprawdzaniu poprawności haseł
    }


}
