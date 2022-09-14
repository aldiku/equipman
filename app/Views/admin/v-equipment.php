<?= $this->extend('template/template'); ?>
<?= $this->Section('main'); ?>
<style>
	.icon-equip {
		font-size: 4em;
		width: 90px;
	}
	.line {
		border-left: 2px solid #a29797;
		margin-left: 5px;
	}
</style>
<section class="container-fluid" id="main">
    <div class="row">
        <div class="col-12">
            <div class="card shadow">
                <div class="card-header">
                    <?= $title ?>
                    <div class="card-tools">
                        <button class="btn btn-sm btn-success" onclick="add()"><i class="fa fa-add"></i> Add Main</button>
                        <?= $this->include('template/tool-card'); ?>
                    </div>
                </div>
                <div class="card-body" style="background: #f1f2f4;">
				<div id="toolbar" class="card p-2 shadow">
					<form class="form-inline row px-2" id="formfilter">
						<div class="form-group">
							<label class="" for="">Plant</label>
							<select name="plant" class="mx-2 form-control form-select" id="filter_plant">
								<option value="all">All</option>
								<option value="1">OnShore</option>
								<option value="2">OffShore</option>
							</select>
						</div>
						<div class="form-group">
							<label class="" for="">Location</label>
							<select name="id_area" class="mx-2 form-control form-select" id="filter_area">
								<option value="all">All</option>
								<?php foreach($area as $ae){ ?>
								<option value="<?= $ae['id'] ?>"><?= $ae['area'] ?></option>
								<?php } ?>
							</select>
						</div>
						<div class="form-group">
							<label class="" for="">Equipment</label>
							<select name="id_equipment" class="mx-2 form-control form-select" id="filter_equipment">
								<option value="all">All</option>
								<?php foreach($equipment as $ee){ ?>
								<option value="<?= $ee['id'] ?>"><?= $ee['nama'] ?></option>
								<?php } ?>
							</select>
						</div>
						<div class="form-group mb-0">
								<label class="" for="">Search</label>
								<input type="text" class="mx-2 form-control" id="filter_search" name="search">
						</div>
						<button id="ok" type="submit" class="btn btn-primary">OK</button>
					</form>
				</div>
                    <table id="tableSection" class="table table-no-bordered table-sm" data-toolbar="#toolbar" data-show-refresh="true" data-pagination="true" data-side-pagination="server" data-show-custom-view="true" data-custom-view="customViewFormatter" data-show-custom-view-button="true" data-custom-view-default-view="true" 
            		data-query-params="filterparam" data-query-params-type="">
                    </table>
					<template id="templateCard">
						<div class="col-md-4 mt-3">
							<div class="card shadow-sm">
								<div class="card-body p-2">
									<div class="row">
										<div class="col-auto h1 d-flex justify-content-center align-items-center text-center icon-equip">
											%equipment%	
										</div>
										<div class="col">
											<a href="./dashboard/section/%id%">
												<h4 class="mb-2">%kode% <span>[%area%]</span></h4>
											</a>
											<div class="px-2 py-1 w-100 mb-0 bg-primary d-flex justify-content-between rounded">
												<div>Main</div>
												<div>
													<a class="btn btn-xs btn-default" href="./dashboard/section/%id%">View</a>
													<button class="btn btn-xs btn-warning" onclick="show('%id%')"><i class="fa fa-pencil"></i> Edit</button>
													<button class="btn btn-xs btn-danger" onclick="hapusSection('%id%')"><i class="fa fa-trash"></i></button>
												</div>
											</div>
											%section%
											<div class="d-flex mb-0">
												<div class="line">---</div>
												<div class="btn btn-xs bg-purple mt-1" onclick="addSection('%id%')"><i class="fas fa-add"></i> Add Section</div>
											</div>
											
											
										</div>
									</div>
									<div class="align-items-center mt-2">
										<div>
											<span class="badge badge-primary">%plant%</span>
											<span class="badge badge-info">%type%</span>
										</div>
									</div>
								</div>
							</div>
						</div>
					</template>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card shadow">
                <div class="card-header">
                    Manajemen Location Field
                    <div class="card-tools">
                        <button class="btn btn-sm btn-success" onclick="addArea()"><i class="fa fa-add"></i> Add</button>
                        <?= $this->include('template/tool-card'); ?>
                    </div>
                </div>
                <div class="card-body">
                    <table id="tableArea" class="table table-no-bordered table-sm" data-show-refresh="true" data-pagination="true" data-search="true" >
                        <thead>
                            <tr>
                            <th>ID</th>
                            <th>Location Field</th>
                            <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($area as $ar){ ?>
                            <tr>
                                <td><?= $ar['id'] ?></td>
                                <td><?= $ar['area'] ?></td>
                                <td><button class='btn btn-success btn-xs' onclick="showArea('<?= $ar['id'] ?>')"><i class="fa fa-pencil"></i> View</button><button class='ml-3 btn btn-danger btn-xs' onclick="hapusArea('<?= $ar['id'] ?>')"><i class="fa fa-trash"></i></button></td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card shadow">
                <div class="card-header">
                    Manajemen Equipment
                    <div class="card-tools">
                        <button class="btn btn-sm btn-success" onclick="addEquipment()"><i class="fa fa-add"></i> Add</button>
                        <?= $this->include('template/tool-card'); ?>
                    </div>
                </div>
                <div class="card-body">
                    <table id="tableEquipment" class="table table-no-bordered table-sm" data-show-refresh="true" data-pagination="true" data-search="true" >
                        <thead>
                            <tr>
                            <th>ID</th>
                            <th>Location Field</th>
                            <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($equipment as $eq){ ?>
                            <tr>
                                <td><?= $eq['id'] ?></td>
                                <td><?= $eq['nama'] ?></td>
                                <td><button class='btn btn-success btn-xs' onclick="showEquipment('<?= $eq['id'] ?>')"><i class="fa fa-pencil"></i> View</button><button class='ml-3 btn btn-danger btn-xs' onclick="hapusEquipment('<?= $eq['id'] ?>')"><i class="fa fa-trash"></i></button></td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</section>
<div class="modal fade" id="modalAddSection" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="overlay">
				<i class="fas fa-2x fa-sync fa-spin"></i>
			</div>
			<div class="modal-header">
				<h3 class="modal-title">Add New <span id="section_type"></span></h3>
				<button type="button" class="close" data-bs-dismiss="modal" aria-label="Close"><span
						aria-hidden="true">&times;</span></button>
			</div>
			<div class="modal-body form">
				<form role="form" id="formAddSection">
					<input type="hidden" name="parent" id="parent_id" val=''>
					<div class="form-body">
						<div class="form-group">
							<label for="">Plant</label>
							<select name="plant" id="AddPlant" class="form-control">
								<option value="1">Darat / OnShore</option>
                                <option value="2">Laut / OffShore</option>
                            </select>
						</div>
						<div class="form-group">
							<label for="">Location Field</label>
							<select name="id_area" id="AddIdArea" class="form-control">
								<option value="">--pilih--</option>
								<?php foreach($area as $a){ ?>
								<option value="<?= $a['id'] ?>"><?= $a['area'] ?></option>
								<?php } ?>
							</select>
						</div>
						<div class="form-group">
							<label for="">Asset Type</label>
							<select name="id_equipment" id="AddIdEquipment" class="form-control">
								<option value="">--pilih--</option>
								<?php foreach($equipment as $e){ ?>
								<option value="<?= $e['id'] ?>"><?= $e['nama'] ?></option>
								<?php } ?>
							</select>
						</div>
						<div class="form-group">
							<label for="">Section Name</label>
							<input type="text" class="form-control" value="" id="AddNamaSection" name="nama_section" placeholder="" required>
						</div>
						<div class="form-group">
							<label for="">Name</label>
							<input type="text" class="form-control" value="" id="AddKode" name="kode" placeholder="Kode" autofocus required>
						</div>
                        <div class="form-group">
							<label for="">Description</label>
							<input type="text" class="form-control" value="" id="AddDescription" name="description" placeholder="Deskripsi">
						</div>
					</div>
					<button type="submit" class="btnSave btn btn-primary">Simpan</button>
					<button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
			    </form>
		    </div>
		</div>
	</div>
</div>
<div class="modal fade" id="modalEditSection" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h3 class="modal-title">Edit</h3>
				<button type="button" class="close" data-bs-dismiss="modal" aria-label="Close"><span
						aria-hidden="true">&times;</span></button>
			</div>
			<div class="modal-body form">
				<form role="form" id="formEditSection">
                    <input type="hidden" name="id" value="" id="editId">
					<div class="form-body">
						<div class="form-group">
							<label for="">Name</label>
							<input type="text" class="form-control" value="" id="editKode" name="kode" placeholder="Kode" autofocus required>
						</div>
                        <div class="form-group">
							<label for="">Section</label>
							<input type="text" class="form-control" value="" id="editNamaSection" name="nama_section" placeholder="Main" required>
						</div>
                        <div class="form-group">
							<label for="">Plant</label>
							<select name="plant" id="editPlant" class="form-control">
                                <option value="1">Darat / OnShore</option>
                                <option value="2">Laut / OffShore</option>
                            </select>
						</div>
                        <div class="form-group">
							<label for="">Location Field</label>
							<select name="id_area" id="editIdArea" class="form-control">
                                <option value="">--pilih--</option>
                                <?php foreach($area as $a){ ?>
                                <option value="<?= $a['id'] ?>"><?= $a['area'] ?></option>
                                <?php } ?>
                            </select>
						</div>
                        <div class="form-group">
							<label for="">Type Equipment</label>
							<select name="id_equipment" id="editIdEquipment" class="form-control">
                                <option value="">--pilih--</option>
                                <?php foreach($equipment as $e){ ?>
                                <option value="<?= $e['id'] ?>"><?= $e['nama'] ?></option>
                                <?php } ?>
                            </select>
						</div>
                        <div class="form-group">
							<label for="">Description</label>
							<input type="text" class="form-control" value="" id="editDescription" name="description" placeholder="Deskripsi">
						</div>
                        
					</div>
					<button type="submit" class="btnSave btn btn-primary">Simpan</button>
					<button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
			    </form>
		    </div>
		</div>
	</div>
</div>

<div class="modal fade" id="modalAddArea" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h3 class="modal-title">Add New</h3>
				<button type="button" class="close" data-bs-dismiss="modal" aria-label="Close"><span
						aria-hidden="true">&times;</span></button>
			</div>
			<div class="modal-body form">
				<form role="form" id="formAddArea">
					<div class="form-body">
						<div class="form-group">
							<label for="">Nama Location Field</label>
							<input type="text" class="form-control" value="" id="" name="area" placeholder="Area" autofocus required>
						</div>
					</div>
					<button type="submit" class="btnSave btn btn-primary">Simpan</button>
					<button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
			    </form>
		    </div>
		</div>
	</div>
</div>
<div class="modal fade" id="modalEditLocation Field" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h3 class="modal-title">Edit Location Field</h3>
				<button type="button" class="close" data-bs-dismiss="modal" aria-label="Close"><span
						aria-hidden="true">&times;</span></button>
			</div>
			<div class="modal-body form">
				<form role="form" id="formEditArea">
                    <input type="hidden" name="id" value="" id="AreaeditId">
					<div class="form-body">
						<div class="form-group">
							<label for="">Nama Location Field</label>
							<input type="text" class="form-control" value="" id="AreaeditArea" name="area" placeholder="Location Field" autofocus required>
						</div>
					</div>
					<button type="submit" class="btnSave btn btn-primary">Simpan</button>
					<button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
			    </form>
		    </div>
		</div>
	</div>
</div>
<div class="modal fade" id="modalAddEquipment" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h3 class="modal-title">Add New</h3>
				<button type="button" class="close" data-bs-dismiss="modal" aria-label="Close"><span
						aria-hidden="true">&times;</span></button>
			</div>
			<div class="modal-body form">
				<form role="form" id="formAddEquipment">
					<div class="form-body">
						<div class="form-group">
							<label for="">Nama Equipment</label>
							<input type="text" class="form-control" value="" id="" name="nama" placeholder="Nama Equipment" autofocus required>
						</div>
					</div>
					<button type="submit" class="btnSave btn btn-primary">Simpan</button>
					<button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
			    </form>
		    </div>
		</div>
	</div>
</div>
<div class="modal fade" id="modalEditEquipment" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h3 class="modal-title">Edit Equipment</h3>
				<button type="button" class="close" data-bs-dismiss="modal" aria-label="Close"><span
						aria-hidden="true">&times;</span></button>
			</div>
			<div class="modal-body form">
				<form role="form" id="formEditEquipment">
                    <input type="hidden" name="id" value="" id="EquipmenteditId">
					<div class="form-body">
						<div class="form-group">
							<label for="">Nama Equipment</label>
							<input type="text" class="form-control" value="" id="EquipmenteditNama" name="nama" placeholder="Equipment" autofocus required>
						</div>
					</div>
					<button type="submit" class="btnSave btn btn-primary">Simpan</button>
					<button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
			    </form>
		    </div>
		</div>
	</div>
</div>
<?= $this->endSection(); ?>
<?= $this->Section('pageScript'); ?>
<script src="https://unpkg.com/bootstrap-table@1.21.0/dist/bootstrap-table.min.js"></script>
<script src="https://unpkg.com/bootstrap-table@1.21.0/dist/extensions/custom-view/bootstrap-table-custom-view.js"></script>

<script>
    $(document).ready(function () {
		$('form#formfilter').submit(function (e) {
            e.preventDefault();
            $('#tableSection').bootstrapTable('refresh');
        });
        $('#tableSection').bootstrapTable({
			search: false,
			url: SITE_URL + '/equipment/get_all_section',
			pageSize: 9,
			pageList: "[10, 20, 50, 100]",
			columns: [{
				field: 'id',
				title: 'No',
				halign: 'center',
				sortable: true
			}, {
				field: 'plant',
				title: 'Plant',
				halign: 'center',
				sortable: true,
                formatter: function (value, row, index) {
					return (row.plant == '1') ? 'OnShore' : 'OffShore';
				}
			}, {
				field: 'area',
				title: 'Location Field',
				halign: 'center',
				sortable: false
			},{
				field: 'equipment',
				title: 'Equipment',
				halign: 'center',
				sortable: false
			},{
				field: 'nama_section',
				title: 'Section',
				halign: 'center',
				sortable: true

			}, {
				title: 'Action',
				halign: 'center',
				formatter: function (value, row, index) {
					return '<button class=\'btn btn-success btn-xs\' onclick=\'show("' +row.id +'")\'><i class="fa fa-pencil"></i> View</button><button class=\'ml-3 btn btn-danger btn-xs\' onclick=\'hapusSection("' +row.id +'")\'><i class="fa fa-trash"></i></button>';
				}
			}],
		});
        $('#tableArea').bootstrapTable();
        $('#tableEquipment').bootstrapTable();
    });

	function filterparam(params) {
        return {
            page: params.pageNumber,
            limit: params.pageSize,
            search: $('#filter_search').val(),
            plant: $('#filter_plant').val(),
            area: $('#filter_area').val(),
            equipment: $('#filter_equipment').val(),
            sort: params.sortName,
            order: params.sortOrder
        }
    }

    function customViewFormatter(data) {
        var template = $('#templateCard').html()
        var view = ''
        $.each(data, function (i, row) {
			var section = build_section(row.child);
			var logo = '<i class="fab fa-pied-piper-pp"></i>';
			if(row.equipment == 'Pipeline'){
				logo = '<i class="fab fa-pied-piper-pp"></i>';
			}
			if(row.equipment == 'Vessel'){
				logo = '<i class="fab fa-vaadin"></i>';
			}
			if(row.equipment == 'Tank'){
				logo = '<i class="fas fa-dolly-flatbed"></i>';
			}
			if(row.equipment == 'Piping'){
				logo = '<i class="fas fa-wave-square"></i>';
			}
            view += template.replace('%kode%', row.kode)
				.replaceAll('%id%', row.id)
                .replace('%area%', row.area)
                .replace('%plant%', (row.plant == '1')? "OnShore" : "OffShore")
                .replace('%lokasi%', row.lokasi)
                .replace('%type%', row.equipment)
                .replace('%equipment%', logo)
                .replace('%section%', section)
        })

        return `<div class="row">${view}</div>`
    }

	function build_section(data){
		var view = '';
		if(data.length >= 1){
			$.each(data, function(i,row){
				view += `<div class="d-flex mb-0">
							<div class="line">---</div>
							<div class="px-2 mt-1 py-1 w-100 mb-0 bg-indigo d-flex justify-content-between rounded">
								<div>${row.nama_section}</div>
								<div>
								<a class="btn btn-xs btn-default" href="./dashboard/section/${row.id}">View</a>
								<button class="btn btn-xs btn-warning" onclick="show('${row.id}')"><i class="fa fa-pencil"></i> Edit</button>
								<button class="btn btn-xs btn-danger" onclick="hapusSection('${row.id}')"><i class="fa fa-trash"></i></button>
								</div>	
							</div>
						</div>`
			});
		}
		return view;
	}

    function add(){
        $('#formAddSection').trigger('reset');
		$('#section_type').html('Main');
		$('#AddNamaSection').val('Main');
		$('#parent_id').val('0');
        $('#modalAddSection').modal('show');
		$('.overlay').addClass('d-none');

    }
	function addSection(id){
        $('#formAddSection').trigger('reset');
		$('.overlay').removeClass('d-none');
		$.ajax({
            url: SITE_URL + '/equipment/section/' + id,
            type: 'get',
            success: function (res) {
                if (res.status) {
                    var u = res.data;
                    $('#AddKode').val(u.kode);
                    $('#AddNamaSection').val('');
                    $('#AddIdArea').val(u.id_area);
                    $('#AddPlant').val(u.plant);
                    $('#AddIdEquipment').val(u.id_equipment);
                    $('#AddDescription').val(u.description);
					$('.overlay').addClass('d-none');
                } else {
					toastr.error('Anda tidak berhak')
                }
            }
        });
		$('#parent_id').val(id);
		$('#section_type').html('Section');
		$('#modalAddSection').modal('show');
    }
    function addArea(){
        $('#modalAddArea').modal('show');
        $('#formAddArea').trigger('reset');
    }
    function addEquipment(){
        $('#modalEquipment').modal('show');
        $('#formAddEquipment').trigger('reset');
    }

    function show(id){
        $.ajax({
            url: SITE_URL + '/equipment/section/' + id,
            type: 'get',
            success: function (res) {
                if (res.status) {
                    $('#modalEditSection').modal('show');
                    var u = res.data;
                    $('#editId').val(u.id);
                    $('#editKode').val(u.kode);
                    $('#editNamaSection').val(u.nama_section);
                    $('#editPlant').val(u.plant);
                    $('#editIdArea').val(u.id_area);
                    $('#editIdEquipment').val(u.id_equipment);
                    $('#editDescription').val(u.description);
                } else {
                    toastr.error('Anda tidak berhak')
                }
            }
        });
    }
    function showArea(id){
        $.ajax({
            url: SITE_URL + '/equipment/area/' + id,
            type: 'get',
            success: function (res) {
                if (res.status) {
                    $('#modalEditArea').modal('show');
                    var u = res.data;
                    $('#AreaeditId').val(u.id);
                    $('#AreaeditArea').val(u.area);
                } else {
                    toastr.error('Anda tidak berhak')
                }
            }
        });
    }
    function showEquipment(id){
        $.ajax({
            url: SITE_URL + '/equipment/equipment/' + id,
            type: 'get',
            success: function (res) {
                if (res.status) {
                    $('#modalEditEquipment').modal('show');
                    var u = res.data;
                    $('#EquipmenteditId').val(u.id);
                    $('#EquipmenteditNama').val(u.nama);
                } else {
                    toastr.error('Anda tidak berhak')
                }
            }
        });
    }

    function hapusSection(id){
        if (confirm("Yakin akan menghapus data?, ") == true) {
            $.ajax({
                url: SITE_URL + '/equipment/section/'+id,
                type: "DELETE",
                dataType: "JSON",
                success: function (data) {
                    if (data.status) {
                        toastr.success('Data Sukses Terhapus');
                        $('#tableSection').bootstrapTable('refresh');
                    } else {
                        toastr.error('Data Gagal Dihapus')
                    }
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    alert(textStatus);
                }
            });
        } 
    }
    function hapusArea(id){
        if (confirm("Yakin akan menghapus data?, ") == true) {
            $.ajax({
                url: SITE_URL + '/equipment/area/'+id,
                type: "DELETE",
                dataType: "JSON",
                success: function (data) {
                    if (data.status) {
                        toastr.success('Data Sukses Terhapus');
                        $('#tableArea').bootstrapTable('refresh');
                        location.reload();
                    } else {
                        toastr.error('Data Gagal Dihapus')
                    }
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    alert(textStatus);
                }
            });
        } 
    }
    function hapusEquipment(id){
        if (confirm("Yakin akan menghapus data?, ") == true) {
            $.ajax({
                url: SITE_URL + '/equipment/equipment/'+id,
                type: "DELETE",
                dataType: "JSON",
                success: function (data) {
                    if (data.status) {
                        toastr.success('Data Sukses Terhapus');
                        $('#tableEquipment').bootstrapTable('refresh');
                        location.reload();
                    } else {
                        toastr.error('Data Gagal Dihapus')
                    }
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    alert(textStatus);
                }
            });
        } 
    }

    $('#formAddSection').submit(function (e) {
		e.preventDefault();
		$('.btnSave').text('saving...');
		$('.btnSave').attr('disabled', true);
		$.ajax({
			url: SITE_URL + '/equipment/section',
			type: "POST",
			data: $('#formAddSection').serialize(),
			dataType: "JSON",
			success: function (data) {
				if (data.status) {
					toastr.success('Data Sukses Tersimpan');
					$('#modalAddSection').modal('hide');
					$('#tableSection').bootstrapTable('refresh');
				} else {
					toastr.error(data.message)
					$('#modalAddSection').modal('hide');
				}
				$('.btnSave').text('Simpan');
				$('.btnSave').attr('disabled', false);
			},
			error: function (jqXHR, textStatus, errorThrown) {
				alert(textStatus);
				$('.btnSave').text('save');
				$('.btnSave').attr('disabled', false);
			}
		});
	});
    $('#formEditSection').submit(function (e) {
		e.preventDefault();
		$('.btnSave').text('saving...');
		$('.btnSave').attr('disabled', true);
        var id = $('#editId').val();
		$.ajax({
			url: SITE_URL + '/equipment/section/'+id,
			type: "PUT",
			data: $('#formEditSection').serialize(),
			dataType: "JSON",
			success: function (data) {
				if (data.status) {
					toastr.success('Data Sukses Tersimpan');
					$('#modalEditSection').modal('hide');
					$('#tableSection').bootstrapTable('refresh');
				} else {
					toastr.error(data.message)
					$('#modalEditSection').modal('hide');
				}
				$('.btnSave').text('Simpan');
				$('.btnSave').attr('disabled', false);
			},
			error: function (jqXHR, textStatus, errorThrown) {
				alert(textStatus);
				$('.btnSave').text('save');
				$('.btnSave').attr('disabled', false);
			}
		});
	});
    $('#formAddArea').submit(function (e) {
		e.preventDefault();
		$('.btnSave').text('saving...');
		$('.btnSave').attr('disabled', true);
		$.ajax({
			url: SITE_URL + '/equipment/area',
			type: "POST",
			data: $('#formAddArea').serialize(),
			dataType: "JSON",
			success: function (data) {
				if (data.status) {
					toastr.success('Data Sukses Tersimpan');
					$('#modalAddArea').modal('hide');
					$('#tableArea').bootstrapTable('refresh');
				} else {
					toastr.error(message)
					$('#modalAddArea').modal('hide');
				}
				$('.btnSave').text('Simpan');
				$('.btnSave').attr('disabled', false);
                location.reload();
			},
			error: function (jqXHR, textStatus, errorThrown) {
				alert(textStatus);
				$('.btnSave').text('save');
				$('.btnSave').attr('disabled', false);
			}
		});
	});
    $('#formEditArea').submit(function (e) {
		e.preventDefault();
		$('.btnSave').text('saving...');
		$('.btnSave').attr('disabled', true);
        var id = $('#AreaeditId').val();
		$.ajax({
			url: SITE_URL + '/equipment/area/'+id,
			type: "PUT",
			data: $('#formEditArea').serialize(),
			dataType: "JSON",
			success: function (data) {
				if (data.status) {
					toastr.success('Data Sukses Tersimpan');
					$('#modalEditArea').modal('hide');
					$('#tableArea').bootstrapTable('refresh');
				} else {
					toastr.error(data.message)
					$('#modalEditArea').modal('hide');
				}
				$('.btnSave').text('Simpan');
				$('.btnSave').attr('disabled', false);
                location.reload();
			},
			error: function (jqXHR, textStatus, errorThrown) {
				alert(textStatus);
				$('.btnSave').text('save');
				$('.btnSave').attr('disabled', false);
			}
		});
	});
    $('#formAddEquipment').submit(function (e) {
		e.preventDefault();
		$('.btnSave').text('saving...');
		$('.btnSave').attr('disabled', true);
		$.ajax({
			url: SITE_URL + '/equipment/equipment',
			type: "POST",
			data: $('#formAddEquipment').serialize(),
			dataType: "JSON",
			success: function (data) {
				if (data.status) {
					toastr.success('Data Sukses Tersimpan');
					$('#modalAddEquipment').modal('hide');
					$('#tableEquipment').bootstrapTable('refresh');
				} else {
                    toastr.error(message)
					$('#modalAddEquipment').modal('hide');
				}
				$('.btnSave').text('Simpan');
				$('.btnSave').attr('disabled', false);
                location.reload();
			},
			error: function (jqXHR, textStatus, errorThrown) {
                alert(textStatus);
				$('.btnSave').text('save');
				$('.btnSave').attr('disabled', false);
			}
		});
	});
    $('#formEditEquipment').submit(function (e) {
		e.preventDefault();
		$('.btnSave').text('saving...');
		$('.btnSave').attr('disabled', true);
        var id = $('#EquipmenteditId').val();
		$.ajax({
			url: SITE_URL + '/equipment/equipment/'+id,
			type: "PUT",
			data: $('#formEditEquipment').serialize(),
			dataType: "JSON",
			success: function (data) {
				if (data.status) {
					toastr.success('Data Sukses Tersimpan');
					$('#modalEditEquipment').modal('hide');
					$('#tableEquipment').bootstrapTable('refresh');
				} else {
					toastr.error(data.message)
					$('#modalEditEquipment').modal('hide');
				}
				$('.btnSave').text('Simpan');
				$('.btnSave').attr('disabled', false);
                location.reload();
			},
			error: function (jqXHR, textStatus, errorThrown) {
				alert(textStatus);
				$('.btnSave').text('save');
				$('.btnSave').attr('disabled', false);
			}
		});
	});
</script>
<?= $this->endSection(); ?>