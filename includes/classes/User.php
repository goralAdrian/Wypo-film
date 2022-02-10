<?php
class User {
    /**
     * @var PDO
     */
    private $con, $sqlData;

    public function __construct($con, $username) {
        $this->con = $con;

        $query = $con->prepare("SELECT * FROM users WHERE username=:username");
        $query->bindValue(":username", $username);
        $query->execute();

        $this->sqlData = $query->fetch(PDO::FETCH_ASSOC);
    }

    public function getFirstName() {
        return $this->sqlData["Name"];
    }

    public function getLastName() {
        return $this->sqlData["Surname"];
    }

    public function getEmail() {
        return $this->sqlData["Email"];
    }


    public function getUsername() {
        return $this->sqlData["Username"];
    }

}
?>