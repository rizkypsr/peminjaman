<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    include_once('../src/database/database.php');

    $title = $_POST["title"];
    $author = $_POST["author"];
    $year = $_POST["year"];

    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["photo"]["name"]);

    if (move_uploaded_file($_FILES["photo"]["tmp_name"], $target_file)) {
        $sql = "INSERT INTO book (title, author, publication_year, photo) VALUES ('" . $title . "', '" . $author . "', '" . $year . "', '" . $_FILES["photo"]["name"] . "')  ";

        if ($conn->query($sql)) {
            header("location: book.php");
        } else {
            die($conn->error);
        }
    } else {
        header("location: book.php?error=Error Saat Upload Gambar. Coba gambar lain");
    }
}
