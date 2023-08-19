<?php
session_start();
if (!isset($_SESSION['email'])) {
    echo header('Location:../../../index.php?ms=access_denied');
}
require '../../../database/Config.php';

$user_email = $_GET['email'];
$select_user_query = "SELECT * FROM users WHERE email='$user_email'";
$select_user_result = mysqli_query($database, $select_user_query);
$user = mysqli_fetch_array($select_user_result);
$id = $user['id'];
$select_query = "SELECT * FROM tasks WHERE user=$id";
$select_task_result = mysqli_query($database, $select_query);
$tasks = [];
while ($task = mysqli_fetch_array($select_task_result)) {
    array_push($tasks, $task);
}
echo json_encode($tasks);
