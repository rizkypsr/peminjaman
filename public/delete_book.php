<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    include_once('../src/database/database.php');

    $sql = "SELECT * FROM borrow WHERE book_id=" . $_POST["id"];
    $bookInBorrowTable = $conn->query($sql);

    if ($bookInBorrowTable->num_rows > 0) {
        header("location: book.php?error=Data buku tidak dapat dihapus. Data digunakan di tabel lain");
    } else {
        $sql = "DELETE FROM book WHERE id=" . $_POST["id"];

        if ($conn->query($sql)) {
            header("location: book.php");
        }
    }
}
