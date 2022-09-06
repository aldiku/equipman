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
                    <!-- tab -->
                    <?php foreach($tab as $tv){ ?>
                    <div class="tab-pane fade" id="tab<?= $tv['id'] ?>" role="tabpanel"
                        aria-labelledby="tab-<?= $tv['id'] ?>-tab">
                        <div class="row">
                            <form id="<?= str_replace(" ","",($tv['tab'])) ?>">
                                <div class="col-md-12">
                                    <div class="card shadow card-success">
                                        <div class="card-header">
                                            <?= $tv['tab'] ?>
                                        </div>
                                        <div class="card-body" style="height: 500px; overflow: scroll">
                                            <input type="hidden" name="tab_form" value="<?= $tv['tab'] ?>">
                                            <?php foreach($tv['field'] as $f){ ?>
                                            <div class="form-group row">
                                                <div class="col-12 col-sm-3">
                                                    <label for="field<?= $f['id'] ?>"><?= $f['label'] ?></label>
                                                </div>
                                                <div class="col-12 col-sm">
                                                    <?php if($f['type'] == 'text'){ ?>
                                                    <input id="field<?= $f['id'] ?>" type="text"
                                                        name="<?= $f['inCoding']?>" class="form-control form-control-sm"
                                                        placeholder="<?= $f['label']?>" data-type="<?= $f['type']?>">
                                                    <?php }elseif(strtolower($f['type']) == 'num'){ ?>
                                                    <input id="field<?= $f['id'] ?>" type="number"
                                                        name="<?= $f['inCoding']?>" class="form-control form-control-sm"
                                                        step="any" data-type="<?= $f['type']?>">
                                                    <?php }elseif(strtolower($f['type']) == 'date'){ ?>
                                                    <input id="field<?= $f['id'] ?>" name="<?= $f['inCoding']?>"
                                                        type="date" class="form-control form-control-sm"
                                                        data-type="<?= $f['type']?>">
                                                    <?php }elseif(strtolower($f['type']) == 'checked'){ ?>
                                                    <div class="form-check">
                                                        <input type="checkbox" class="form-check-input"
                                                            id="field<?= $f['id'] ?>" name="<?= $f['inCoding']?>"
                                                            data-type="<?= $f['type']?>">
                                                        <label class="form-check-label"
                                                            for="field<?= $f['id'] ?>"><?= $f['label']?></label>
                                                    </div>
                                                    <?php }elseif($f['type'] == 'File Upload'){ ?>
                                                    <div class="input-group">
                                                        <div class="custom-file">
                                                            <input type="file" name="<?= $f['inCoding']?>"
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
                                                    <select name="<?= $f['inCoding']?>"
                                                        class="form-control  form-control-sm form-select"
                                                        data-type="<?= $f['type']?>">
                                                        <?php foreach($f['option'] as $op){ ?>
                                                        <option value="<?= $op['value'] ?>">[<?= $op['value'] ?>]
                                                            <?= $op['comment'] ?></option>
                                                        <?php } ?>
                                                    </select>
                                                    <?php }elseif(strtolower($f['type']) == 'yesno'){ ?>
                                                    <div
                                                        class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success">
                                                        <input type="checkbox" name="<?= $f['inCoding']?>"
                                                            class="custom-control-input" id="field<?= $f['id']?>">
                                                        <label class="custom-control-label" for="field<?= $f['id']?>">No
                                                            / Yes</label>
                                                    </div>
                                                    <?php } ?>
                                                </div>
                                            </div>
                                            <?php } ?>
                                        </div>
                                        <div class="card-footer">
                                            <button class="btn btn-primary btn-sm w-100" id="btnSave">Simpan</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <script>
                        $("form#<?= str_replace(" ","",($tv['tab'])) ?>").submit(function (e) {
                            e.preventDefault();
                            $('#btnSave').text('Menyimpan...');
                            $('#btnSave').attr('disabled', true);
                            var dt<?= str_replace(" ","",($tv['tab'])) ?> = new FormData(this);
                            $.ajax({
                                url: SITE_URL + '/dashboard/save',
                                type: 'POST',
                                data: dt<?= str_replace(" ","",($tv['tab'])) ?>,
                                success: function (res) {
                                    if (res.status) {
                                        toastr.success('Data Sukses Tersimpan');
                                        console.log(res)
                                    } else {
                                        toastr.error('Data Gagal disimpan');
                                    }
                                },
                                cache: false,
                                contentType: false,
                                processData: false
                            });
                            $('#btnSave').text('Simpan');
                            $('#btnSave').attr('disabled', false);
                        });
                    </script>
                    <?php } ?>
                    <!-- tab report -->
                    <div class="tab-pane fade active show" id="report" role="tabpanel" aria-labelledby="report-tab">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="card card-success shadow">
                                    <div class="card-header">
                                        Section : <?= $detail->nama_section ?>
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
