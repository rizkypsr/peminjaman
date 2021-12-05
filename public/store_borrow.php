<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    include_once('../src/database/database.php');

    $member = $_POST["member"];
    $book = $_POST["book"];
    $start = $_POST["start_date"];

    $startDate =  date('Y-m-d', strtotime($start));
    $endDate =  date('Y-m-d', strtotime($start . ' + 1 week'));

    $sql = "INSERT INTO borrow (member_id, book_id, start_date, end_date) VALUES ('" . $member . "', '" . $book . "', '" . $startDate . "', '" . $endDate . "')  ";

    if ($conn->query($sql)) {
        header("location: borrow.php");
    } else {
        die("Error: " . $conn->error);
    }
}
