<?php

session_start();

if (!isset($_SESSION['auth'])) {
    header("location: login.php");
}

if ($_SERVER["REQUEST_METHOD"] == "GET") {

    include_once('../src/database/database.php');

    $id = $_GET["id"];

    $sql = "SELECT * FROM member where id=" . $id;
    $result = $conn->query($sql);
    $row = mysqli_fetch_object($result);
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
        Ubah Member
    </title>
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
    <!--     Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
    <!-- CSS Files -->
    <link href="./css/bootstrap.min.css" rel="stylesheet" />
    <link href="./css/paper-dashboard.css?v=2.0.1" rel="stylesheet" />
</head>

<body class="">
    <div class="wrapper ">
        <div class="sidebar" data-color="white" data-active-color="danger">
            <div class="logo">
                <a href="index.php" class="simple-text logo-normal">
                    Perpustakaan Semua
                </a>
            </div>
            <div class="sidebar-wrapper">
                <ul class="nav">
                    <li>
                        <a href="index.php">
                            <i class="nc-icon nc-chart-bar-32"></i>
                            <p>Dashboard</p>
                        </a>
                    </li>
                    <li>
                        <a href="user.php">
                            <i class="nc-icon nc-single-02"></i>
                            <p>Users</p>
                        </a>
                    </li>
                    <li class="active">
                        <a href="member.php">
                            <i class="nc-icon nc-circle-10"></i>
                            <p>Member</p>
                        </a>
                    </li>
                    <li>
                        <a href="book.php">
                            <i class="nc-icon nc-bookmark-2"></i>
                            <p>Buku</p>
                        </a>
                    </li>
                    <li>
                        <a href="borrow.php">
                            <i class="nc-icon nc-paper"></i>
                            <p>Peminjaman</p>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="main-panel" style="height: 100vh;">
            <!-- Navbar -->
            <nav class="navbar navbar-expand-lg navbar-absolute fixed-top navbar-transparent">
                <div class="container-fluid">
                    <div class="navbar-wrapper">
                        <div class="navbar-toggle">
                            <button type="button" class="navbar-toggler">
                                <span class="navbar-toggler-bar bar1"></span>
                                <span class="navbar-toggler-bar bar2"></span>
                                <span class="navbar-toggler-bar bar3"></span>
                            </button>
                        </div>
                        <a class="navbar-brand" href="index.php">Ubah Member</a>
                    </div>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navigation" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-bar navbar-kebab"></span>
                        <span class="navbar-toggler-bar navbar-kebab"></span>
                        <span class="navbar-toggler-bar navbar-kebab"></span>
                    </button>
                    <div class="collapse navbar-collapse justify-content-end" id="navigation">
                        <ul class="navbar-nav">
                            <li class="nav-item btn-rotate dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="nc-icon nc-single-02"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                                    <form action="logout.php" method="POST">
                                        <button type="submit" class="dropdown-item" href="logout.php">Keluar</button>
                                    </form>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
            <!-- End Navbar -->
            <div class="content">
                <div class="row">
                    <div class="col">
                        <div class="card">
                            <div class="card-body ">
                                <form action="update_member.php" method="POST">
                                    <input type="hidden" name="id" value="<?php echo $row->id ?>">
                                    <div class="form-group">
                                        <label for="name">Nama</label>
                                        <input type="text" class="form-control" id="name" name="name" placeholder="Masukkan nama" value="<?php echo $row->name ?>" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="address">Alamat</label>
                                        <textarea class="form-control" id="address" name="address" rows="3" placeholder="Masukkan alamat" required><?php echo $row->address ?></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="city">Kota</label>
                                        <input type="text" class="form-control" id="city" name="city" placeholder="Masukkan kota" value="<?php echo $row->city ?>" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="telp">Nomor Telp</label>
                                        <input type="telp" class="form-control" id="telp" maxlength="13" name="telp" placeholder="Masukkan nomor telp" value="<?php echo $row->telp ?>" required>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <footer class="footer" style="position: absolute; bottom: 0; width: -webkit-fill-available;">
                <div class="container-fluid">
                    <div class="row">
                        <div class="credits ml-auto">
                            <span class="copyright">
                                © 2021, made with <i class="fa fa-heart heart"></i> by Creative Tim
                            </span>
                        </div>
                    </div>
                </div>
            </footer>
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