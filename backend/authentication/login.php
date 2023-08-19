<?php
require('../../database/Config.php');
require('../algorithms/Encyption.php');

class Login
{
    private $email;
    private $password;
    private $database;
    private $redirectUrl;

    public function __construct($email, $password, $database, $redirectUrl)
    {
        $this->email = $email;
        $this->password = $password;
        $this->database = $database;
        $this->redirectUrl = $redirectUrl;
        $this->authenticate();
    }

    private function authenticate()
    {
        $hashing = new Scrypt();
        $search_query = "SELECT * FROM users WHERE email='$this->email'";
        $search_result = mysqli_query($this->database, $search_query);
        $count = mysqli_num_rows($search_result);
        if ($count == 1) {
            $user = mysqli_fetch_array($search_result);
            $password = $user['password'];
            $dec_password = $hashing->decrypt("$password");
            if ($this->password === $dec_password) {
                $this->setSession();
                echo header("Location:$this->redirectUrl");
            } else {
                $results =  [
                    'error' => 'Credentials don\'t matched'
                ];

                echo header('Location:../../index.php?error=' . $results['error']);
            }
        } else {
            $results =  [
                'error' => 'Credentials don\'t matched'
            ];

            echo header('Location:../../index.php?error=' . $results['error']);
        }
    }

    private function setSession()
    {
        session_start(
            array('cookie_lifetime' => 86400)
        );
        $_SESSION['email'] = $this->email;
    }
}


if (isset($_POST['submit']) && isset($_POST['email']) && isset($_POST['password'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    if ($email != "" && $password != "") {
        $login = new Login("$email", "$password", $database, "../../dashboard.php");
    } else {
        echo header('Location:../../index.php?error=All fields are required');
    }
} else {
    echo header('Location:../../index.php');
}