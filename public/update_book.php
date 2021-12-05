<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    include_once('../src/database/database.php');

    $id = $_POST["id"];
    $title = $_POST["title"];
    $author = $_POST["author"];
    $year = $_POST["year"];


    if (!is_uploaded_file($_FILES['photo']['tmp_name'])) {
        $sql = "UPDATE book SET title='" . $title . "', author='" . $author . "', publication_year='" . $year . "' WHERE id=" . $id;
    } else {
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($_FILES["photo"]["name"]);

        if (move_uploaded_file($_FILES["photo"]["tmp_name"], $target_file)) {
            $sql = "UPDATE book SET title='" . $title . "', author='" . $author . "', publication_year='" . $year . "', photo='" . $_FILES["photo"]["name"] . "' WHERE id=" . $id;
        } else {
            header("location: book.php?error=Error Saat Upload Gambar. Coba gambar lain");
        }
    }

    if ($conn->query($sql)) {
        header("location: book.php");
    } else {
        die("Error" . $conn->error);
    }
}
