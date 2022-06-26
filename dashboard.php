<?php
$db = new PDO ("mysql:host=185.224.138.133;dbname=u928306449_groupe_quatre;charset=utf8","u928306449_groupe_quatre","KeyceGroupe4");
$req = $db->prepare('SELECT * FROM captorData');
$req->execute();

$data = $req->fetchAll();
var_dump($data);
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DashBoard</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    
<?php
    session_start();
    echo(session_id());
?>
    <div>
        <canvas id="myChart"></canvas>
    </div>
</body>
</html>

<script>
  const labels = [
    'January',
    'February',
    'March',
    'April',
    'May',
    'June',
  ];

  const data = {
    labels: labels,
    datasets: [{
      label: 'My First dataset',
      backgroundColor: 'rgb(255, 99, 132)',
      borderColor: 'rgb(255, 99, 132)',
      data: [0, 10, 5, 2, 20, 30, 45],
    }]
  };

  const config = {
    type: 'line',
    data: data,
    options: {}
  };

const myChart = new Chart(
document.getElementById('myChart'),
config
);
</script>
 