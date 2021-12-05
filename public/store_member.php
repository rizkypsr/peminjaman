<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    include_once('../src/database/database.php');

    $name = $_POST["name"];
    $address = $_POST["address"];
    $city = $_POST["city"];
    $telp = $_POST["telp"];

    $sql = "INSERT INTO member (name, address, city, telp) VALUES ('" . $name . "', '" . $address . "', '" . $city . "', '" . $telp . "')  ";

    if ($conn->query($sql)) {
        header("location: member.php");
    } else {
        die("Error: " . $conn->error);
    }
}
