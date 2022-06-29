<?php
require_once 'toolBox.php';
$dbValues = getCaptorTempValue(date("y-m-d h:i:s",0), date("y-m-d h:i:s",time() + 14 * 60 * 60 ));  
$values = formatTempValuetoChart($dbValues);
?>

<div>
    <canvas id="tempChart"></canvas>
</div>

<script>
const tempdata = {
    datasets: [{
        label: 'Graphique Température',
        backgroundColor: 'rgb(255, 20, 50)',
        borderColor: 'rgb(255, 20, 50)',
        data: [<?= $values ?>]
    }]
};

const tempconfig = {
    type: 'line',
    data: tempdata,
    options: {
        scales: {
            x: {
                min: new Date('2022-06-27 00:00:00'),
            },
        },
    }
};

const tempChart = new Chart(
    document.getElementById('tempChart'),
    tempconfig
);
</script>
