<?php
$db = new PDO ("mysql:host=185.224.138.133;dbname=u928306449_groupe_quatre;charset=utf8","u928306449_groupe_quatre","KeyceGroupe4");
$req = $db->prepare('SELECT * FROM captorData');
$req->execute();

$data = $req->fetchAll();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="dashboard.css" />
    <title>Dashboard</title>
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.js"></script>
    <script src="tables.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
</head>

<body class="sb-nav-fixed">

<nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
    <!-- Navbar Brand-->
    <a class="navbar-brand ps-3" href="dashboard.php">IOT Project</a>
    <!-- Navbar-->
    <ul class="navbar-nav ms-auto me-lg-4">
        <li class="dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                <li><a class="dropdown-item" href="#!">Déconnexion</a></li>
            </ul>
        </li>
    </ul>
</nav>
<div id="layoutSidenav">
    <div id="layoutSidenav_nav">
        <nav class="sb-sidenav sb-sidenav-dark" id="sidenavAccordion">
            <div class="sb-sidenav-menu">
                <div class="nav">
                    <div class="sb-sidenav-menu-heading">Accueil</div>
                    <a class="nav-link" href="dashboard.php">
                        <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                        Dashboard
                    </a>
                    <div class="sb-sidenav-menu-heading">Fonctionnalités</div>
                    <a class="nav-link" href="graphs.php">
                        <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                        Graphiques
                    </a>
                    <a class="nav-link" href="tables.php">
                        <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                        Tables
                    </a>
                </div>
            </div>
        </nav>
    </div>
</div>

<div class="tables" id="tables">
    <?php
    $conn = mysqli_connect("185.224.138.133", "u928306449_groupe_quatre","KeyceGroupe4","u928306449_groupe_quatre" );
    $sql = mysqli_query($conn, "SELECT * FROM captorData" );
    echo '<table class="table-content" id="table-content">';
    echo '<thead><tr class="table-header">'.'<td class="header-item">idcaptorData</td>'.'<td class="header-item">humidity</td>'.'<td class="header-item">temperature</td>'.'<td class="header-item">date</td></thead>';
    echo '<tbody>';
    while($data = mysqli_fetch_array($sql))
    {
        echo '<tr class="table-row">'.'<td class="table-data">'.$data['idcaptorData'].'</td>'.'<td class="table-data">'.$data['humidity'].'</td>'.'<td class="table-data">'.$data['temperature'].'</td>'.'<td class="table-data">'.$data['date'].'</td>'.'</tr>'/*."<br/>"*/ ;
    }
    echo '</tbody></table>';
    ?>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
<script src="js/scripts.js"></script>

</body>
</html>
