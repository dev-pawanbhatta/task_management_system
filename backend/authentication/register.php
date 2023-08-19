<?php
require('../../database/Config.php');
require('../algorithms/Encyption.php');

class Register
{
    private $name;
    private $email;
    private $password;
    private $database;

    public function __construct($name, $email, $password, $database)
    {
        $this->name = $name;
        $this->email = $email;
        $this->password = $password;
        $this->database = $database;
        $this->register();
    }

    private function register()
    {
        $hashing = new Scrypt();
        $search_query = "SELECT * FROM users WHERE email='$this->email'";
        $search_result = mysqli_query($this->database, $search_query);
        $count = mysqli_num_rows($search_result);
        if ($count == 0) {
            $this->password = $hashing->encrypt($this->password);
            $insert_query = "INSERT INTO users(name,email,password) VALUES('$this->name','$this->email','$this->password')";
            $insert_result = mysqli_query($this->database, $insert_query);
            if ($insert_result) {
                echo header('Location:../../index.php');
            } else {
                echo header('Location:../../register.php?error=Account not created');
            }
        } else {
            $results =  [
                'error' => 'Email already exists'
            ];

            echo header('Location:../../register.php?error=' . $results['error']);
        }
    }
}


if (isset($_POST['submit']) && isset($_POST['name']) && isset($_POST['email']) && isset($_POST['password'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    if ($name != "" && $email != "" && $password != "") {
        $login = new Register("$name", "$email", "$password", $database);
    } else {
        echo header('Location:../../register.php?error=All fields are required');
    }
} else {
    echo header('Location:../../register.php?error=Error 400! Invalid Resource');
}
