<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="dashboard.css" />
    <title>Projet IOT - Acceuil</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
    
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.js"></script>
    <script src="tables.js"></script>
</head>
<?php
include_once 'header.php';
?>

    <div class="datapres">
        <div class="graphs">
            <div class="tempgraph">
                <?php
                require_once "graphstemp.php";
                ?>
            </div>

            <div class="humgraph">
                <?php
                require_once "graphshumidity.php";
                ?>
            </div>
        </div>

        <div class="tablesclass1">
            <div class="tablesclass2">
                <?php
                require_once "tableBack.php";
                ?>
            </div>
        </div>
    </div>
</body>
</html>
