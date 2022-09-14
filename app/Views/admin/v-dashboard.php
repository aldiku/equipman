<?= $this->extend('template/template'); ?>
<?= $this->Section('main'); ?>

<!-- Main content -->
<section class="content" id="main">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6">
                <div class="card p-2">
                    <canvas id="myChart" width="400px" height="300px"></canvas>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card p-2">
                    <div class="log"></div>
                </div>
            </div>
        </div>
    </div>
</section>

<?= $this->endSection(); ?>
<?= $this->Section('pageScript'); ?>
<script src="https://cdn.jsdelivr.net/npm/chart.js@3.9.1/dist/chart.min.js"></script>
<script>
const ctx = document.getElementById('myChart').getContext('2d');
var area = ["Jakarta","Cirebon","Bandung"];
var db = [
            {
                label: "Low",
                data: [2,3,2],
                backgroundColor: ['#28a745'],
            },
            {
                label: 'Medium',
                data: [3,3,3],
                backgroundColor: ['yellow'],
            },
            {
                label: 'Significant',
                data: [1,3,4],
                backgroundColor: ['orange'],
            },
            {
                label: 'High',
                data: [1,1,1],
                backgroundColor: ['red'],
            },
            ];
const myChart = new Chart(ctx, {
    type: 'bar',
    data: {
    labels: area,
        datasets: db
        },
    options: {
        events: ['mousemove', 'mouseout', 'click', 'touchstart', 'touchmove'],  
        onClick: function(event, El){
            if(El){
                var label = db[El[0].datasetIndex].label;
                var lokasi = area[El[0].index];
                var value = db[El[0].datasetIndex].data[El[0].index];
                show(label,lokasi,value)
            }
        },
        plugins: {
            title: {
                display: true,
                text: 'Pipeline Level 1',
                color: '#000',
                font: {
                    size: 24,
                    weight: 'bold',
                    lineHeight: 1.2,
                }
            },
            legend :{
                position : 'bottom'
            }
        },
        scales: {
            x: {
                stacked: true,
                grid: {
                    borderWidth: '4',
                    borderColor: 'black'
                }
            },
            y: {
                beginAtZero: true,
                stacked: true
            }
        }
    }
});

function show(label,lokasi,value){
    data = `Clicked Lokasi : ${lokasi} dengan Risk : ${label}, dengan Nilai : ${value}`
    $('.log').html(data)
    //ajax
    
}
</script>
<?= $this->endSection(); ?>