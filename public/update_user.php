<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    include_once('../src/database/database.php');

    $id = $_POST["id"];
    $username = $_POST["username"];

    if (!empty($_POST['password'])) {
        $password = password_hash($_POST["password"], PASSWORD_DEFAULT);
        $sql = "UPDATE users SET username='" . $username . "', password='" . $password . "' WHERE id=" . $id;
    } else {
        $sql = "UPDATE users SET username='" . $username . "' WHERE id=" . $id;
    }

    if ($conn->query($sql)) {
        header("location: user.php");
    } else {
        die("Error: " . $conn->error);
    }
}
