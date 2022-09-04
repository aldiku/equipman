<style>
    .overflow-x {
        overflow-x: scroll;
        display: -webkit-inline-box;
    }
</style>
<div class="row">
    <div class="col-12">
        <div class="card card-primary card-outline card-outline-tabs">
            <div class="card-header p-0 pt-1 border-bottom-0">
                <ul class="nav nav-tabs d-flex justify-content-between" id="custom-tabs-three-tab" role="tablist">
                    <div class="overflow-x col pb-2">
                        <?php foreach($tab as $t){ ?>
                        <li class="nav-item" onclick="set_active('tab-<?= $t['id'] ?>-tab','tab<?= $t['id'] ?>')">
                            <a class="nav-link" id="tab-<?= $t['id'] ?>-tab" data-toggle="pill"
                                href="#tab<?= $t['id'] ?>" role="tab" aria-controls="tab<?= $t['id'] ?>"
                                aria-selected="false"><?= $t['tab'] ?></a>
                        </li>
                        <?php } ?>
                    </div>
                    <li class="nav-item ml-auto active border-left" onclick="set_active('report-tab','report')">
                        <a class="nav-link active" id="report-tab" data-toggle="pill" href="#report" role="tab"
                            aria-controls="report" aria-selected="true">Report</a>
                    </li>
                </ul>
            </div>
            <div class="card-body">
                <div class="tab-content" id="custom-tabs-three-tabContent">
                    <?php foreach($tab as $tv){ ?>
                    <div class="tab-pane fade" id="tab<?= $tv['id'] ?>" role="tabpanel"
                        aria-labelledby="tab-<?= $tv['id'] ?>-tab">
                        <?php if(!empty($tv['look_up'])){ foreach($tv['look_up'] as $k=>$l){?>
                            <div class="form-group row">
                                <div class="col-3">
                                    <label for=""><?= $k ?></label>
                                </div>
                                <div class="col">
                                    <select name="<?= $k ?>" class="form-control  form-control-sm form-select">
                                        <?php foreach($l as $op){ ?>
                                        <option value="<?= $op['value'] ?>">[<?= $op['value'] ?>] <?= $op['comment'] ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                        <?php } }?>
                    </div>
                    <?php } ?>
                    <div class="tab-pane fade active show" id="report" role="tabpanel" aria-labelledby="report-tab">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="card card-success shadow">
                                    <div class="card-header">
                                        Section : <?= $detail->nama_section ?>
                                    </div>
                                    <div class="card-body" style="max-height: 300px; overflow: scroll">
                                        <form action="">
                                            <div class="form-group row">
                                                <div class="col-3">
                                                    <label for="">Field</label>
                                                </div>
                                                <div class="col">
                                                    <input type="text" class="form-control form-control-sm"
                                                        placeholder="value">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-3">
                                                    <label for="">Field </label>
                                                </div>
                                                <div class="col">
                                                    <select name="" class="form-control form-control-sm form-select">
                                                        <option value="">-Pilih-</option>
                                                        <option value="1">Satu</option>
                                                        <option value="2">Dua</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-3">
                                                    <label for="">Field </label>
                                                </div>
                                                <div class="col">
                                                    <select name="" class="form-control  form-control-sm form-select">
                                                        <option value="">-Pilih-</option>
                                                        <option value="1">Satu</option>
                                                        <option value="2">Dua</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-3">
                                                    <label for="">Field </label>
                                                </div>
                                                <div class="col">
                                                    <select name="" class="form-control  form-control-sm form-select">
                                                        <option value="">-Pilih-</option>
                                                        <option value="1">Satu</option>
                                                        <option value="2">Dua</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-3">
                                                    <label for="">Field </label>
                                                </div>
                                                <div class="col">
                                                    <select name="" class="form-control  form-control-sm form-select">
                                                        <option value="">-Pilih-</option>
                                                        <option value="1">Satu</option>
                                                        <option value="2">Dua</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-3">
                                                    <label for="">Field </label>
                                                </div>
                                                <div class="col">
                                                    <select name="" class="form-control  form-control-sm form-select">
                                                        <option value="">-Pilih-</option>
                                                        <option value="1">Satu</option>
                                                        <option value="2">Dua</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-3">
                                                    <label for="">Field </label>
                                                </div>
                                                <div class="col">
                                                    <select name="" class="form-control  form-control-sm form-select">
                                                        <option value="">-Pilih-</option>
                                                        <option value="1">Satu</option>
                                                        <option value="2">Dua</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-3">
                                                    <label for="">Field </label>
                                                </div>
                                                <div class="col">
                                                    <select name="" class="form-control  form-control-sm form-select">
                                                        <option value="">-Pilih-</option>
                                                        <option value="1">Satu</option>
                                                        <option value="2">Dua</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-3">
                                                    <label for="">Field </label>
                                                </div>
                                                <div class="col">
                                                    <select name="" class="form-control  form-control-sm form-select">
                                                        <option value="">-Pilih-</option>
                                                        <option value="1">Satu</option>
                                                        <option value="2">Dua</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-3">
                                                    <label for="">Field </label>
                                                </div>
                                                <div class="col">
                                                    <select name="" class="form-control  form-control-sm form-select">
                                                        <option value="">-Pilih-</option>
                                                        <option value="1">Satu</option>
                                                        <option value="2">Dua</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-3">
                                                    <label for="">Field </label>
                                                </div>
                                                <div class="col">
                                                    <select name="" class="form-control  form-control-sm form-select">
                                                        <option value="">-Pilih-</option>
                                                        <option value="1">Satu</option>
                                                        <option value="2">Dua</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="card-footer text-center">
                                        Kalkulasi
                                        <br>
                                        <h3 class="fw-bold">1234567890</h3>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card shadow card-primary">
                                    <div class="card-header">
                                        Grafik
                                    </div>
                                    <div class="card-body">
                                        <style type="text/css">
                                            .tg {
                                                border-collapse: collapse;
                                                border-spacing: 0;
                                                text-align: center;
    
                                            }
    
                                            .tg td {
                                                border-color: black;
                                                border-style: solid;
                                                border-width: 1px;
                                                font-family: Arial, sans-serif;
                                                font-size: 14px;
                                                overflow: hidden;
                                                padding: 10px 5px;
                                                word-break: normal;
                                            }
    
                                            .tg th {
                                                border-color: black;
                                                border-style: solid;
                                                border-width: 1px;
                                                font-family: Arial, sans-serif;
                                                font-size: 14px;
                                                font-weight: normal;
                                                overflow: hidden;
                                                padding: 10px 5px;
                                                word-break: normal;
                                            }
    
                                            .tg .tg-nltl {
                                                background-color: #f56b00;
                                                vertical-align: top
                                            }
    
                                            .tg .tg-mnhx {
                                                background-color: #fe0000;
                                                vertical-align: top
                                            }
    
                                            .tg .tg-0lax {
                                                vertical-align: top;
                                                border: 0px;
                                            }
    
                                            .tg .tg-s7ni {
                                                background-color: #f8ff00;
                                                vertical-align: top
                                            }
    
                                            .tg .tg-kd4e {
                                                background-color: #34ff34;
                                                vertical-align: top
                                            }
                                        </style>
                                        <table class="tg w-100">
                                            <thead>
                                                <tr>
                                                    <th class="tg-0lax">5</th>
                                                    <th class="tg-nltl"></th>
                                                    <th class="tg-nltl"></th>
                                                    <th class="tg-nltl"></th>
                                                    <th class="tg-mnhx"></th>
                                                    <th class="tg-mnhx"></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td class="tg-0lax">4</td>
                                                    <td class="tg-s7ni"></td>
                                                    <td class="tg-s7ni"></td>
                                                    <td class="tg-nltl"></td>
                                                    <td class="tg-nltl"></td>
                                                    <td class="tg-mnhx"></td>
                                                </tr>
                                                <tr>
                                                    <td class="tg-0lax">3</td>
                                                    <td class="tg-kd4e"></td>
                                                    <td class="tg-kd4e"></td>
                                                    <td class="tg-s7ni">X</td>
                                                    <td class="tg-nltl"></td>
                                                    <td class="tg-mnhx"></td>
                                                </tr>
                                                <tr>
                                                    <td class="tg-0lax">2</td>
                                                    <td class="tg-kd4e"></td>
                                                    <td class="tg-kd4e"></td>
                                                    <td class="tg-s7ni"></td>
                                                    <td class="tg-s7ni"></td>
                                                    <td class="tg-nltl"></td>
                                                </tr>
                                                <tr>
                                                    <td class="tg-0lax">1</td>
                                                    <td class="tg-kd4e"></td>
                                                    <td class="tg-kd4e"></td>
                                                    <td class="tg-s7ni"></td>
                                                    <td class="tg-s7ni"></td>
                                                    <td class="tg-nltl"></td>
                                                </tr>
                                                <tr>
                                                    <td class="tg-0lax"></td>
                                                    <td class="tg-0lax">A</td>
                                                    <td class="tg-0lax">B</td>
                                                    <td class="tg-0lax">C</td>
                                                    <td class="tg-0lax">D</td>
                                                    <td class="tg-0lax">E</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="card-footer">
                                        <button class="btn btn-sm btn-primary">Download</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>