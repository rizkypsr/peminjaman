<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    include_once('../src/database/database.php');

    $id = $_POST["id"];
    $member = (int) $_POST["member"];
    $book = (int) $_POST["book"];
    $start = $_POST["start_date"];

    $startDate =  date('Y-m-d', strtotime($start));
    $endDate =  date('Y-m-d', strtotime($start . ' + 1 week'));

    $sql = "UPDATE borrow SET member_id='" . $member . "', book_id='" . $book . "', start_date='" . $startDate . "', end_date='" . $endDate . "' WHERE id=" . $id;

    if ($conn->query($sql)) {
        header("location: borrow.php");
    } else {
        die("Error: " . $conn->error);
    }
}
