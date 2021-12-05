<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    include_once('../src/database/database.php');

    $sql = "DELETE FROM borrow WHERE id=" . $_POST["id"];

    if ($conn->query($sql)) {
        header("location: borrow.php");
    }
}
