<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    include_once('../src/database/database.php');

    session_start();

    $sql = "SELECT username FROM users WHERE id=" . $_POST["id"];
    $user = mysqli_fetch_object($conn->query($sql));

    $sql = "DELETE FROM users WHERE id=" . $_POST["id"];

    if ($conn->query($sql)) {
        if ($_SESSION['auth'] == $user->username) {
            unset($_SESSION['auth']);
            header("location: login.php");
        } else {
            header("location: user.php");
        }
    }
}
