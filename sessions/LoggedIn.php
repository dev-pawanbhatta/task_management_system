<?php
session_start();
if (!isset($_SESSION['email'])) {
    echo header('Location:index.php');
}
