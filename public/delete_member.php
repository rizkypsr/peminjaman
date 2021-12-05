<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    include_once('../src/database/database.php');

    $sql = "SELECT * FROM borrow WHERE member_id=" . $_POST["id"];
    $memberInBorrowTable = $conn->query($sql);

    if ($memberInBorrowTable->num_rows > 0) {
        header("location: member.php?error=Data member tidak dapat dihapus. Data digunakan di tabel lain");
    } else {
        $sql = "DELETE FROM member WHERE id=" . $_POST["id"];

        if ($conn->query($sql)) {
            header("location: member.php");
        }
    }
}
