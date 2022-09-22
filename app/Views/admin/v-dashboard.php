<?= $this->extend('template/template'); ?>
<?= $this->Section('main'); ?>

<!-- Main content -->
<section class="content" id="main">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div id="toolbar" class="card p-2 shadow">
                    <form class="form-horisontal row px-2" id="formfilter">
                        <div class="col">
                            <div class="form-group mb-0">
                                <label class="" for="">Plant</label>
                                <select name="plant" class="form-control form-control-sm form-select" id="filter_plant">
                                    <option value="all">All</option>
                                    <option value="1">OnShore</option>
                                    <option value="2">OffShore</option>
                                </select>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group mb-0">
                                <label class="" for="">Location</label>
                                <select name="id_area" class="form-control form-control-sm form-select"
                                    id="filter_area">
                                    <option value="all">All</option>
                                    <?php foreach($area as $ae){ ?>
                                    <option value="<?= $ae['id'] ?>"><?= $ae['area'] ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group mb-0">
                                <label class="" for="">Equipment</label>
                                <select name="id_equipment" class="form-control form-control-sm form-select"
                                    id="filter_equipment">
                                    <option value="all">All</option>
                                    <?php foreach($equipment as $ee){ ?>
                                    <option value="<?= $ee['id'] ?>"><?= $ee['nama'] ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group mb-0">
                                <label class="" for="">Equipment Name</label>
                                <input type="text" class="form-control form-control-sm" id="filter_search"
                                    name="search">
                            </div>
                        </div>
                        <div class="col-auto d-flex align-items-end">
                            <button id="btnFilter" type="submit" class="btn btn-primary">Filter</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-md-6 card p-2">
                <div id="contChart1">
                    <canvas id="Chart1" width="400px" height="300px"></canvas>
                </div>
            </div>
            <div class="col-md-6 card p-2">
                <div id="contChart2">
                    <canvas id="Chart2" width="400px" height="300px"></canvas>
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
    var equipment = '2';
    var equipmentType = 'Pipeline';
    var area = 'all';
    var plant = 'all';
    var search = '';
    $(function () {
        $('#filter_equipment').val(equipment);
        $('#filter_equipment').on('change', function () {
            equipment = this.value;
            equipmentType = this.name;
            $('#id_equipment').val(equipment);
        });
        buildGraf();
    });

    function buildGraf() {
        equipment = $('#filter_equipment').val();
        plant = $('#filter_plant').val();
        area = $('#filter_area').val();
        search = $('#filter_search').val();
        buildGrafMain();
        buildGrafSection();
    }

    function buildGrafMain() {
        $("canvas#Chart1").remove();
        $("#contChart1").append('<canvas id="Chart1" ></canvas>');
        const ctx = document.getElementById('Chart1').getContext('2d');
        $.ajax({
            url: SITE_URL + '/dashboard/chart?withReport=true&section=main&area=' + area + '&plant=' + plant +
                '&equipment=' + equipment + '&search=' + search,
            type: 'get',
            success: function (res) {
                if (res) {
                    var area = [];
                    var datalow= [],datamed= [],datasig= [],datahigh= [],db = [];
                    $.each(res, function(i, val) {
                        $.each(val, function(areaName, val) {
                            area.push(areaName)
                            $.each(val, function(i,val2) {
                                $.each(val2, function(i,val3) {
                                    $.each(val3, function(i,val4) {
                                        if(val4.report.Risk.category == 'Low'){
                                            datalow.push(val4.report.Risk.num)
                                        }
                                        if(val4.report.Risk.category == 'Medium'){
                                            datamed.push(val4.report.Risk.num)
                                        }
                                        if(val4.report.Risk.category == 'High'){
                                            datahigh.push(val4.report.Risk.num)
                                        }
                                        if(val4.report.Risk.category == 'Significant'){
                                            datasig.push(val4.report.Risk.num)
                                        }
                                    });
                                });
                            });
                        });
                    });
                    dataset = [{
                            label: "Low",
                            data: datalow,
                            backgroundColor: ['#28a745'],
                        },
                        {
                            label: 'Medium',
                            data: datamed,
                            backgroundColor: ['yellow'],
                        },
                        {
                            label: 'Significant',
                            data: datasig,
                            backgroundColor: ['orange'],
                        },
                        {
                            label: 'High',
                            data: datahigh,
                            backgroundColor: ['red'],
                        },
                    ];
                    const myChart = new Chart(ctx, {
                        type: 'bar',
                        data: {
                            labels: area,
                            datasets: dataset
                        },
                        options: {
                            events: ['mousemove', 'mouseout', 'click', 'touchstart', 'touchmove'],
                            onClick: function (event, El) {
                                if (El) {
                                    console.log(El)
                                }
                            },
                            plugins: {
                                title: {
                                    display: true,
                                    text: equipmentType + ' Level 1',
                                    color: '#000',
                                    font: {
                                        size: 24,
                                        weight: 'bold',
                                        lineHeight: 1.2,
                                    }
                                },
                                legend: {
                                    position: 'bottom'
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
                } else {
                    toastr.error('Gagal Meload Data')
                }
            }
        });

    }
    function buildGrafSection() {
        $("canvas#Chart2").remove();
        $("#contChart2").append('<canvas id="Chart2" ></canvas>');
        const ctx = document.getElementById('Chart2').getContext('2d');
        $.ajax({
            url: SITE_URL + '/dashboard/chart?withReport=true&section=section&area=' + area + '&plant=' + plant +
                '&equipment=' + equipment + '&search=' + search,
            type: 'get',
            success: function (res) {
                if (res) {
                    var area = [];
                    var datalow= [],datamed= [],datasig= [],datahigh= [],db = [];
                    $.each(res, function(i, val) {
                        $.each(val, function(areaName, val) {
                            area.push(areaName)
                            $.each(val, function(i,val2) {
                                $.each(val2, function(i,val3) {
                                    $.each(val3, function(i,val4) {
                                        if(val4.report.Risk.category == 'Low'){
                                            datalow.push(val4.report.Risk.num)
                                        }
                                        if(val4.report.Risk.category == 'Medium'){
                                            datamed.push(val4.report.Risk.num)
                                        }
                                        if(val4.report.Risk.category == 'High'){
                                            datahigh.push(val4.report.Risk.num)
                                        }
                                        if(val4.report.Risk.category == 'Significant'){
                                            datasig.push(val4.report.Risk.num)
                                        }
                                    });
                                });
                            });
                        });
                    });
                    dataset = [{
                            label: "Low",
                            data: datalow,
                            backgroundColor: ['#28a745'],
                        },
                        {
                            label: 'Medium',
                            data: datamed,
                            backgroundColor: ['yellow'],
                        },
                        {
                            label: 'Significant',
                            data: datasig,
                            backgroundColor: ['orange'],
                        },
                        {
                            label: 'High',
                            data: datahigh,
                            backgroundColor: ['red'],
                        },
                    ];
                    const myChart = new Chart(ctx, {
                        type: 'bar',
                        data: {
                            labels: area,
                            datasets: dataset
                        },
                        options: {
                            events: ['mousemove', 'mouseout', 'click', 'touchstart', 'touchmove'],
                            onClick: function (event, El) {
                                if (El) {
                                    console.log(El)
                                }
                            },
                            plugins: {
                                title: {
                                    display: true,
                                    text: equipmentType + ' Level 2',
                                    color: '#000',
                                    font: {
                                        size: 24,
                                        weight: 'bold',
                                        lineHeight: 1.2,
                                    }
                                },
                                legend: {
                                    position: 'bottom'
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
                } else {
                    toastr.error('Gagal Meload Data')
                }
            }
        });

    }

    function show(label, lokasi, value) {
        data = `Clicked Lokasi : ${lokasi} dengan Risk : ${label}, dengan Nilai : ${value}`
        $('.log').html(data)
        //ajax

    }
</script>
<?= $this->endSection(); ?>