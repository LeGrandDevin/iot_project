<?php
require_once 'toolBox.php';
$dbValues = getCaptorHumValue(date("y-m-d h:i:s",0), date("y-m-d h:i:s",time() + 14 * 60 * 60 ));  
$values = formatHumValuetoChart($dbValues);
?>

<div>
    <canvas id="humChart"></canvas>
</div>

<script>
const humdata = {
    datasets: [{
        label: 'Graphique Humidité',
        backgroundColor: 'rgb(50, 20, 255)',
        borderColor: 'rgb(50, 20, 255)',
        data: [<?= $values ?>],
    }]
};

const humconfig = {
    type: 'line',
    data: humdata,
    options: {
        scales: {
            x: {
                min: new Date('2022-06-27 00:00:00'),
            },
        },
    }
};

const humChart = new Chart(
    document.getElementById('humChart'),
    humconfig
);
</script>
