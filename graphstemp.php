<div>
    <canvas id="tempChart"></canvas>
</div>

<script>
    const templabels = [
        'January',
        'February',
        'March',
        'April',
        'May',
        'June',
    ];

    const tempdata = {
        labels: templabels,
        datasets: [{
            label: 'Graphique Température',
            backgroundColor: 'rgb(255, 20, 50)',
            borderColor: 'rgb(255, 20, 50)',
            data: [35, 100, 40, 40, 40, 40, 45],
        }]
    };

    const tempconfig = {
        type: 'line',
        data: tempdata,
        options: {}
    };

    const tempChart = new Chart(
        document.getElementById('tempChart'),
        tempconfig
    );
</script>