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
            <div class="col-md-6 ">
                <div class="card p-2">
                    <div id="contChart1">
                        <canvas id="Chart1" width="400px" height="300px"></canvas>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card p-2">
                    <div id="contChart2">
                        <canvas id="Chart2" width="400px" height="300px"></canvas>
                    </div>
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
            var el = document.getElementById('filter_equipment');
            var text = el.options[el.selectedIndex].innerHTML;
            equipment = this.value;
            equipmentType = text;
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

    $('#formfilter').submit(function (e) {
		e.preventDefault();
		$('#btnFilter').text('Generating...');
		$('#btnFilter').attr('disabled', true);
		buildGraf();
	});

    function buildGrafMain() {
        $("canvas#Chart1").remove();
        $("#contChart1").append('<canvas id="Chart1" ></canvas>');
        const ctx = document.getElementById('Chart1').getContext('2d');
        var areaMain = [];
        var areaSection = [];
        var resultMain = {};

        $.ajax({
            url: SITE_URL + '/dashboard/chart?withReport=true&section=main&area=' + area + '&plant=' + plant +
                '&equipment=' + equipment + '&search=' + search,
            type: 'get',
            success: function (res) {
                if (res) {
                    resultMain
                    var objArea = {
                        name:'',
                        low:0,
                        med:0,
                        sig:0,
                        high:0
                    };
                    var datalow= [],datamed= [],datasig= [],datahigh= [],db = [], areaName=[];
                    $.each(res, function(i, val) {
                        $.each(val, function(areaName, val) {
                            objArea.name = areaName;
                            $.each(val, function(i,val2) {
                                $.each(val2, function(i,val3) {
                                    $.each(val3, function(i,val4) {
                                        if(val4.report.Risk.category == 'Low'){
                                            objArea.low += 1
                                        }
                                        if(val4.report.Risk.category == 'Medium'){
                                            objArea.med += 1
                                        }
                                        if(val4.report.Risk.category == 'High'){
                                            objArea.high += 1
                                        }
                                        if(val4.report.Risk.category == 'Significant'){
                                            objArea.sig += 1
                                        }
                                    });
                                });
                            });
                            areaMain.push(objArea)
                            objArea = {
                                name:'',
                                low:0,
                                med:0,
                                sig:0,
                                high:0
                            }
                        });
                    });
                    $.each(areaMain, function(i,item) {
                        areaName.push(item.name);
                        datalow.push(item.low);
                        datamed.push(item.med);
                        datasig.push(item.sig);
                        datahigh.push(item.high);
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
                            labels: areaName,
                            datasets: dataset
                        },
                        options: {
                            events: ['mousemove', 'mouseout', 'click', 'touchstart', 'touchmove'],
                            onClick: function (e, activeEls) {
                                if (activeEls) {
                                    let datasetIndex = activeEls[0].datasetIndex;
                                    let dataIndex = activeEls[0].index;
                                    let datasetLabel = e.chart.data.datasets[datasetIndex].label;
                                    let value = e.chart.data.datasets[datasetIndex].data[dataIndex];
                                    let label = e.chart.data.labels[dataIndex];
                                    console.log("In Main", datasetLabel, label, value);
                                    show("main", datasetLabel, label, value);
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
                $('#btnFilter').text('Filter');
		        $('#btnFilter').attr('disabled', false);
                if (res) {
                    var objArea = {
                        name:'',
                        low:0,
                        med:0,
                        sig:0,
                        high:0
                    };
                    var datalow= [],datamed= [],datasig= [],datahigh= [],db = [], areaName=[];
                    $.each(res, function(i, val) {
                        $.each(val, function(areaName, val) {
                            objArea.name = areaName;
                            $.each(val, function(i,val2) {
                                $.each(val2, function(i,val3) {
                                    $.each(val3, function(i,val4) {
                                        if(val4.report.Risk.category == 'Low'){
                                            objArea.low += 1
                                        }
                                        if(val4.report.Risk.category == 'Medium'){
                                            objArea.med += 1
                                        }
                                        if(val4.report.Risk.category == 'High'){
                                            objArea.high += 1
                                        }
                                        if(val4.report.Risk.category == 'Significant'){
                                            objArea.sig += 1
                                        }
                                    });
                                });
                            });
                            areaSection.push(objArea)
                            objArea = {
                                name:'',
                                low:0,
                                med:0,
                                sig:0,
                                high:0
                            }
                        });
                    });
                    $.each(areaSection, function(i,item) {
                        areaName.push(item.name);
                        datalow.push(item.low);
                        datamed.push(item.med);
                        datasig.push(item.sig);
                        datahigh.push(item.high);
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
                            labels: areaName,
                            datasets: dataset
                        },
                        options: {
                            events: ['mousemove', 'mouseout', 'click', 'touchstart', 'touchmove'],
                            onClick: function (e, activeEls) {
                                if (activeEls) {
                                    let datasetIndex = activeEls[0].datasetIndex;
                                    let dataIndex = activeEls[0].index;
                                    let datasetLabel = e.chart.data.datasets[datasetIndex].label;
                                    let value = e.chart.data.datasets[datasetIndex].data[dataIndex];
                                    let label = e.chart.data.labels[dataIndex];
                                    console.log("In Section", datasetLabel, label, value);
                                    show("section", datasetLabel, label, value);
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

    function show(section,datasetLabel, label, value) {
        console.log("show modal", datasetLabel, label, value);
    }
</script>
<?= $this->endSection(); ?>