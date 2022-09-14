<?= $this->extend('template/template'); ?>
<?= $this->Section('main'); ?>
<style>
    .overflow-x {
        overflow-x: scroll;
        display: -webkit-inline-box;
    }

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
<div class="row">
    <div class="col-12">
        <div class="card card-primary card-outline card-outline-tabs">
            <div class="card-header p-0 pt-1 border-bottom-0">
                <ul class="nav nav-tabs d-flex justify-content-between" id="custom-tabs-three-tab" role="tablist">
                    <div class="overflow-x col pb-2">
                        <?php foreach($tab as $t){ ?>
                        <li class="nav-item" onclick="set_active('tab-<?= $t['id'] ?>-tab','tab<?= $t['id'] ?>')">
                            <a class="nav-link" id="tab-<?= $t['id'] ?>-tab" data-toggle="pill"
                                 role="tab" aria-controls="tab<?= $t['id'] ?>"
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
                    <!-- tab -->
                    <?php foreach($tab as $tv){ ?>
                    <div class="tab-pane fade" id="tab<?= $tv['id'] ?>" role="tabpanel"
                        aria-labelledby="tab-<?= $tv['id'] ?>-tab">
                        <div class="row">
                            <form id="<?= str_replace(" ","",($tv['tab'])) ?>" class="col-12">
                                <input type="hidden" name="section_id" value="<?= $detail->id ?>">
                                <?php foreach($tv['field'] as $kfield => $vfield){ ?>
                                <div class="card shadow card-success">
                                    <div class="card-header text-center p-2">
                                        <?= $kfield ?>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <?php foreach($vfield as $f){ ?>
                                                <div class="col-md-6">
                                                    <div class="form-group row">
                                                        <div class="col-12 col-sm-4">
                                                            <label for="field<?= $f['id'] ?>"><?= $f['label'] ?>
                                                                <?= (strtolower($f['type']) == 'num' && !empty($f['satuan']))? '('.$f['satuan'].')' :'' ?>
                                                            </label>
                                                        </div>
                                                        <div class="col-12 col-sm">
                                                            <?php if($f['type'] == 'text'){ ?>
                                                            <input id="field<?= $f['id'] ?>" type="text"
                                                                value="<?= $f['value']['val'] ?>" name="<?= $f['id'] ?>"
                                                                class="form-control form-control-sm" placeholder="<?= $f['label']?>"
                                                                data-type="<?= $f['type']?>">
            
                                                            <?php }elseif(strtolower($f['type']) == 'num'){ ?>
                                                            <input id="field<?= $f['id'] ?>" type="number"
                                                                value="<?= $f['value']['val'] ?>" name="<?= $f['id'] ?>"
                                                                class="form-control form-control-sm" step="any"
                                                                data-type="<?= $f['type']?>">
            
                                                            <?php }elseif(strtolower($f['type']) == 'date'){ ?>
                                                            <input id="field<?= $f['id'] ?>" name="<?= $f['id'] ?>" type="date"
                                                                class="form-control form-control-sm"
                                                                value="<?= $f['value']['val'] ?>" data-type="<?= $f['type']?>">
            
                                                            <?php }elseif($f['type'] == 'File Upload'){ ?>
                                                            <div class="input-group">
                                                                <div class="custom-file">
                                                                    <input type="file" name="<?= $f['id'] ?>"
                                                                        class="custom-file-input" id="field<?= $f['id'] ?>"
                                                                        data-type="<?= $f['type']?>">
                                                                    <label class="custom-file-label"
                                                                        for="field<?= $f['id'] ?>">Choose file</label>
                                                                </div>
                                                                <div class="input-group-append">
                                                                    <span class="input-group-text">Upload</span>
                                                                </div>
                                                            </div>
            
                                                            <?php }elseif($f['type'] == 'text_lookup'){ ?>
                                                            <select name="<?= $f['id'] ?>"
                                                                class="form-control  form-control-sm form-select"
                                                                data-type="<?= $f['type']?>">
                                                                <option value="">--pilih--</option>
                                                                <?php foreach($f['option'] as $op){ ?>
                                                                <option value="<?= $op['value'] ?>"
                                                                    <?= ($op['value'] == $f['value']['val']) ? "selected='selected'" : '' ?>>
                                                                    [<?= $op['value'] ?>] <?= $op['comment'] ?></option>
                                                                <?php } ?>
                                                            </select>
                                                            <?php }elseif(strtolower($f['type']) == 'yesno' || strtolower($f['type']) == 'checked'){ ?>
                                                            <div
                                                                class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success">
                                                                <input type="checkbox" name="<?= $f['id'] ?>"
                                                                    <?= ($f['value']['val'] =='on') ?'checked' :'' ?>
                                                                    class="custom-control-input" id="field<?= $f['id']?>">
                                                                <label class="custom-control-label" for="field<?= $f['id']?>">No
                                                                    / Yes</label>
                                                            </div>
                                                            <?php } ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>
                                <?php } ?>
                                <div class="card">
                                    <button class="btn btn-primary btn-sm w-100 btnSave">Simpan</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <script>
                        document.addEventListener("DOMContentLoaded", function () {
                            $("form#<?= str_replace("","",($tv['tab'])) ?>").submit(function (e) {
                                e.preventDefault();
                                $('.btnSave').text('Menyimpan...');
                                $('.btnSave').attr('disabled', true);
                                var dt<?= str_replace(" ", "", ($tv['tab'])) ?> = new FormData(this);
                                $.ajax({
                                    url: SITE_URL + '/dashboard/save_val',
                                    type: 'POST',
                                    data: dt<?= str_replace(" ", "", ($tv['tab'])) ?> ,
                                    success: function (res) {
                                        if (res.status) {
                                            toastr.success('Data Sukses Tersimpan');
                                        } else {
                                            toastr.error('Data Gagal disimpan');
                                        }
                                        $('.btnSave').text('Simpan');
                                        $('.btnSave').attr('disabled', false);
                                    },
                                    cache: false,
                                    contentType: false,
                                    processData: false
                                });
                            });
                        });
                    </script>
                    <?php } ?>
                    <div class="tab-pane fade active show" id="report" role="tabpanel" aria-labelledby="report-tab">
                        <div class="card shadow">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="card-body table-responsive">
                                        <table class="table table-sm table-bordered table-hover">
                                            <tbody>
                                                <tr>
                                                    <td width="60%"><b>Plant</b></td>
                                                    <td><?= $detail->plant == '1' ? "OnShore" : "OffShore" ?></td>
                                                </tr>
                                                <tr>
                                                    <td><b>Location Field</b></td>
                                                    <td><?= $detail->area ?></td>
                                                </tr>
                                                <tr>
                                                    <td><b>Asset Type</b></td>
                                                    <td><?= $detail->equipment ?></td>
                                                </tr>
                                                <tr>
                                                    <td><b>Section</b></td>
                                                    <td><?= $detail->nama_section ?></td>
                                                </tr>
                                                <tr>
                                                    <td><b>Pipeline Name</b></td>
                                                    <td><?= $detail->kode ?></td>
                                                </tr>
                                                <tr>
                                                    <td><b>Description</b></td>
                                                    <td><?= $detail->description ?></td>
                                                </tr>
                                                <tr>
                                                    <td><b>Risk</b></td>
                                                    <td><?= $report['Risk']['category'] ?></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="card shadow card-primary">
                                        <div class="card-body">
                                            <table class="tg w-100">
                                                <thead>
                                                    <tr>
                                                        <th class="tg-0lax">5</th>
                                                        <th class="tg-nltl"><?= ($x == 'a5')? 'X':'' ?></th>
                                                        <th class="tg-nltl"><?= ($x == 'b5')? 'X':'' ?></th>
                                                        <th class="tg-nltl"><?= ($x == 'c5')? 'X':'' ?></th>
                                                        <th class="tg-mnhx"><?= ($x == 'd5')? 'X':'' ?></th>
                                                        <th class="tg-mnhx"><?= ($x == 'e5')? 'X':'' ?></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td class="tg-0lax">4</td>
                                                        <td class="tg-s7ni"><?= ($x == 'a4')? 'X':'' ?></td>
                                                        <td class="tg-s7ni"><?= ($x == 'b4')? 'X':'' ?></td>
                                                        <td class="tg-nltl"><?= ($x == 'c4')? 'X':'' ?></td>
                                                        <td class="tg-nltl"><?= ($x == 'd4')? 'X':'' ?></td>
                                                        <td class="tg-mnhx"><?= ($x == 'e4')? 'X':'' ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td class="tg-0lax">3</td>
                                                        <td class="tg-kd4e"><?= ($x == 'a3')? 'X':'' ?></td>
                                                        <td class="tg-kd4e"><?= ($x == 'b3')? 'X':'' ?></td>
                                                        <td class="tg-s7ni"><?= ($x == 'c3')? 'X':'' ?></td>
                                                        <td class="tg-nltl"><?= ($x == 'd3')? 'X':'' ?></td>
                                                        <td class="tg-mnhx"><?= ($x == 'e3')? 'X':'' ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td class="tg-0lax">2</td>
                                                        <td class="tg-kd4e"><?= ($x == 'a2')? 'X':'' ?></td>
                                                        <td class="tg-kd4e"><?= ($x == 'b2')? 'X':'' ?></td>
                                                        <td class="tg-s7ni"><?= ($x == 'c2')? 'X':'' ?></td>
                                                        <td class="tg-s7ni"><?= ($x == 'd2')? 'X':'' ?></td>
                                                        <td class="tg-nltl"><?= ($x == 'e2')? 'X':'' ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td class="tg-0lax">1</td>
                                                        <td class="tg-kd4e"><?= ($x == 'a1')? 'X':'' ?></td>
                                                        <td class="tg-kd4e"><?= ($x == 'b1')? 'X':'' ?></td>
                                                        <td class="tg-s7ni"><?= ($x == 'c1')? 'X':'' ?></td>
                                                        <td class="tg-s7ni"><?= ($x == 'd1')? 'X':'' ?></td>
                                                        <td class="tg-nltl"><?= ($x == 'e1')? 'X':'' ?></td>
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
                                <div class="col-md-6">
                                    <div class="card-body">
                                        <table class="table table-sm table-bordered table-hover">
                                            <tbody>
                                                <tr>
                                                    <td width="60%"><b>Inspection period </b></td>
                                                    <td><?= $report['InternalInspectionNum'] ?></td>
                                                </tr>
                                                <tr>
                                                    <td><b>Internal inspections</b></td>
                                                    <td><?= $report['L1_Inspection_Internal_value'] ?></td>
                                                </tr>
                                                <tr>
                                                    <td><b>Intelligent Pigging (IP) Inspection</b></td>
                                                    <td></td>
                                                </tr>
                                                <tr>
                                                    <td><b>Last Inspection Date</b></td>
                                                    <td><?= $report['LastInspectionDateforinternal'] ?></td>
                                                </tr>
                                                <tr>
                                                    <td><b>Next Inspection Date</b></td>
                                                    <td><?= $report['NextInspectioDateForInternal'] ?></td>
                                                </tr>
                                                <tr>
                                                    <td><b>Internal Inspection History</b></td>
                                                    <td><?= $report['InternalInspectionNum'] ?></td>
                                                </tr>
                                                <tr>
                                                    <td><b>Piggable</b></td>
                                                    <td><?= $report['Piggable'] =='on' ? 'Yes' : 'No' ?></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="card-body">
                                    <table class="table table-sm table-bordered table-hover">
                                            <tbody>
                                                <tr>
                                                    <td width="60%"><b>External inspections</b></td>
                                                    <td><?= $report['L1_Inspection_External_value'] ?></td>
                                                </tr>
                                                <tr>
                                                    <td><b>CIPS Inspection</b></td>
                                                    <td></td>
                                                </tr>
                                                <tr>
                                                    <td><b>Next Inspection Date</b></td>
                                                    <td><?= $report['LastInspectionDateforexternal'] ?></td>
                                                </tr>
                                                <tr>
                                                    <td><b>Last Inspection Date</b></td>
                                                    <td><?= $report['NextInspectioDateForExternal'] ?></td>
                                                </tr>
                                                <tr>
                                                    <td><b>External Inspection History</b></td>
                                                    <td><?= $report['InternalInspectionNumForExternal'] ?></td>
                                                </tr>
                                                <tr>
                                                    <td><b>Pipeline Type</b></td>
                                                    <td><?= $report['PipelineType'] ?></td>
                                                </tr>
                                                <tr>
                                                    <td><b>CP System</b></td>
                                                    <td><?= $report['CPSystem'] ?></td>
                                                </tr>
                                            </tbody>
                                        </table>
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
<?= $this->endSection(); ?>
<?= $this->Section('pageScript'); ?>
<script>
    console.log('ok');
</script>
<?= $this->endSection(); ?>