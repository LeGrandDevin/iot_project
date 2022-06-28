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
    <link rel="stylesheet" href="tables.css" />
    <title>Tables</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
</head>

<body>

<div class="tables">
    <?php
    $conn = mysqli_connect("185.224.138.133", "u928306449_groupe_quatre","KeyceGroupe4","u928306449_groupe_quatre" );
    $sql = mysqli_query($conn, "SELECT * FROM captorData" );
    echo '<table class="table-content">';
    echo '<tr class="table-header">'.'<td class="header-item">idcaptorData</td>'.'<td class="header-item">humidity</td>'.'<td class="header-item">temperature</td>'.'<td class="header-item">date</td>';
    while($data = mysqli_fetch_array($sql))
    {
        echo '<tr>'.'<td>'.$data['idcaptorData'].'</td>'.'<td>'.$data['humidity'].'</td>'.'<td>'.$data['temperature'].'</td>'.'<td>'.$data['date'].'</td>'.'</tr>'/*."<br/>"*/ ;
    }
    echo '</table>';
    ?>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
<script src="js/scripts.js"></script>

</body>
</html>
