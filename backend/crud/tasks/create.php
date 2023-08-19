<?php
session_start();
if (!isset($_SESSION['email'])) {
    echo header('Location:../../../index.php?ms=access_denied');
}
require '../../../database/Config.php';

class Task
{
    private string $title;
    private string $description;
    private string $time;
    private mysqli $database;

    public function __construct($title, $description, $time, $database)
    {
        $this->title = $title;
        $this->description = $description;
        $this->time = $time;
        $this->database = $database;

        $this->validate();
    }

    private function store()
    {
        $user_email = $_SESSION['email'];
        $select_user_query = "SELECT * FROM users WHERE email='$user_email'";
        $select_user_result = mysqli_query($this->database, $select_user_query);
        $user = mysqli_fetch_array($select_user_result);
        $id = $user['id'];
        $insert_query = "INSERT INTO tasks(title,description,time,user) VALUES('$this->title','$this->description','$this->time','$id')";
        $insert_result = mysqli_query($this->database, $insert_query);
        if ($insert_result) {
            echo header('Location:../../../tasks/?msg=added_successfully');
        } else {
            echo header('Location:../../../tasks/?err=error_occured');
        }
    }

    private function validate()
    {
        if ($this->title == "" && $this->description == "" && $this->time == "") {
            echo header('Location:../../../tasks/?err=All fields are required');
            return;
        }
        $this->store();
    }
}


if (isset($_POST['submit']) && isset($_POST['title']) && isset($_POST['description']) && isset($_POST['time'])) {
    $task = new Task($_POST['title'], $_POST['description'], $_POST['time'], $database);
} else {
    echo header('Location:../../../tasks/?err=invalid_resources');
}
