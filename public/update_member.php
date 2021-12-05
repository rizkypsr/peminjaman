<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    include_once('../src/database/database.php');

    $id = $_POST["id"];
    $name = $_POST["name"];
    $city = $_POST["city"];
    $telp = $_POST["telp"];
    $address = $_POST["address"];

    $sql = "UPDATE member SET name='" . $name . "', address='" . $address . "', city='" . $city . "', telp='" . $telp . "' WHERE id=" . $id;

    if ($conn->query($sql)) {
        header("location: member.php");
    } else {
        die("Error: " . $conn->error);
    }
}
