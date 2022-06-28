<div>
    <canvas id="humChart"></canvas>
</div>

<script>
    const humlabels = [
        'January',
        'February',
        'March',
        'April',
        'May',
        'June',
    ];

    const humdata = {
        labels: humlabels,
        datasets: [{
            label: 'Graphique Humidité',
            backgroundColor: 'rgb(50, 20, 255)',
            borderColor: 'rgb(50, 20, 255)',
            data: [0, 10, 5, 2, 20, 30, 45],
        }]
    };

    const humconfig = {
        type: 'line',
        data: humdata,
        options: {}
    };

    const humChart = new Chart(
        document.getElementById('humChart'),
        humconfig
    );
</script>
