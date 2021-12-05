<?php

include_once('../src/database/database.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $username = $_POST["username"];
    $name = $_POST["name"];
    $password = password_hash($_POST["password"], PASSWORD_DEFAULT);


    $sql = "SELECT * FROM users WHERE username='" . $username . "'";
    $result = $conn->query($sql);
    $user = mysqli_fetch_object($result);

    if ($result->num_rows > 0) {
        header("location: register.php?error=Username sudah terdaftar");
    } else {
        $sql = "INSERT INTO users (username, password) VALUES ('" . $username . "', '" . $password . "')";

        if ($conn->query($sql)) {
            header("location: register.php?success=Berhasil mendaftarkan akun.");
        } else {
            die("Error: " . $conn->error);
        }
    }
}

?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <link rel="apple-touch-icon" sizes="76x76" href="./assets/img/apple-icon.png">
    <link rel="icon" type="image/png" href="./assets/img/favicon.png">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>
        Daftar
    </title>
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
    <!--     Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
    <!-- CSS Files -->
    <link href="./css/bootstrap.min.css" rel="stylesheet" />
    <link href="./css/paper-dashboard.css?v=2.0.1" rel="stylesheet" />
    <style>
        html,
        body {
            height: 100%;
        }
    </style>
</head>

<body>
    <div class="container d-flex flex-column align-items-center justify-content-center h-100">
        <?php if (isset($_GET['error'])) { ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <?php echo $_GET['error'] ?>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        <?php } else if (isset($_GET['success'])) { ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <?php echo $_GET['success'] ?>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        <?php } ?>
        <div class="card" style="width: 40%;">
            <div class="card-body">
                <h4 class="card-title">Daftar</h4>
                <form action="" method="POST">
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" class="form-control" id="username" name="username" placeholder="Masukkan username">
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="Masukkan password">
                    </div>
                    <button type="submit" class="btn btn-primary">Daftar</button>
                    <a href="login.php" class="btn btn-primary btn-link">Masuk</a>
                </form>
            </div>
        </div>
    </div>
    <!--   Core JS Files   -->
    <script src="./js/core/jquery.min.js"></script>
    <script src="./js/core/popper.min.js"></script>
    <script src="./js/core/bootstrap.min.js"></script>
    <script src="./js/plugins/perfect-scrollbar.jquery.min.js"></script>
    <script src="./js/paper-dashboard.min.js?v=2.0.1" type="text/javascript"></script>
</body>

</html>