<?php

include_once('../src/database/database.php');

session_start();

if (!isset($_SESSION['auth'])) {
    header("location: login.php");
}

$sql = "SELECT * FROM borrow";
$result = $conn->query($sql);
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <link rel="apple-touch-icon" sizes="76x76" href="./assets/img/apple-icon.png">
    <link rel="icon" type="image/png" href="./assets/img/favicon.png">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>
        Tambah Peminjaman
    </title>
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
    <!--     Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
    <!-- CSS Files -->
    <link href="./css/bootstrap.min.css" rel="stylesheet" />
    <link href="./css/paper-dashboard.css?v=2.0.1" rel="stylesheet" />
    <link rel="stylesheet" href="./css/style.css">
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
                    <li>
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
                    <li class="active">
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
                        <a class="navbar-brand" href="index.php">Tambah Peminjaman</a>
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
                        <a href="create_borrow.php" class="btn btn-outline-primary btn-round">
                            <i class="fa fa-plus"></i> Tambah Peminjaman
                        </a>
                        <button class="btn btn-primary btn-fab btn-icon btn-round" onclick="window.print()">
                            <i class="fa fa-print"></i>
                        </button>
                        <div class="input-group no-border">
                            <input id="search" type="search" class="form-control" placeholder="Search...">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <i class="nc-icon nc-zoom-split"></i>
                                </div>
                            </div>
                        </div>
                        <?php if (isset($_GET['error'])) { ?>
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <?php echo $_GET['error'] ?>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        <?php } ?>
                        <div class="card" id="section-to-print">
                            <div class="card-body ">
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead class=" text-primary">
                                            <tr>
                                                <th> ID Member </th>
                                                <th> ID Buku </th>
                                                <th> Tgl Pinjam </th>
                                                <th> Tgl Kembali </th>
                                                <th> Aksi </th>
                                            </tr>
                                        </thead>
                                        <tbody id="data">
                                            <?php while ($row = $result->fetch_object()) { ?>
                                                <tr>
                                                    <td> <?php echo $row->member_id ?> </td>
                                                    <td> <?php echo $row->book_id ?> </td>
                                                    <td> <?php echo $row->start_date ?> </td>
                                                    <td> <?php echo $row->end_date ?> </td>
                                                    <td>
                                                        <form class="d-inline" action="delete_borrow.php" method="POST">
                                                            <input type="hidden" name="id" value="<?php echo $row->id ?>">
                                                            <button type="submit" class="btn btn-danger btn-fab btn-icon btn-round">
                                                                <i class="fa fa-trash"></i>
                                                            </button>
                                                        </form>
                                                        <a href="edit_borrow.php?id=<?php echo $row->id ?>" class="btn btn-primary btn-fab btn-icon btn-round">
                                                            <i class="fa fa-edit"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                            <?php } ?>
                                    </table>
                                </div>
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
    <script>
        $(document).ready(function() {
            $('#search').on('keyup', function() {
                $.ajax({
                    type: 'POST',
                    url: 'search_borrow.php',
                    data: {
                        search: $(this).val()
                    },
                    cache: false,
                    success: function(data) {
                        $('#data').html(data);
                    }
                });
            });
        });
    </script>
</body>

</html>