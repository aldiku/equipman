<?= $this->extend('template/template'); ?>
<?= $this->Section('main'); ?>
<section class="container-fluid" id="main">
    <div class="row">
        <div class="col-md-6">
            <div class="card shadow">
                <div class="card-header">
                    Role
                    <div class="card-tools">
                        <button class="btn btn-sm btn-success" onclick="add()"><i class="fa fa-add"></i> Add</button>
                        <?= $this->include('template/tool-card'); ?>
                    </div>
                </div>
                <div class="card-body">
                    <table id="tableRole" class="table table-no-bordered table-sm" data-show-refresh="true" data-pagination="true" data-side-pagination="server">
                    </table>
                </div>
            </div>
        </div>
		<div class="col-md-6">
            <div class="card shadow">
                <div class="card-header">
                    Permission
                    <div class="card-tools">
                        <button class="btn btn-sm btn-success" onclick="addPermission()"><i class="fa fa-add"></i> Add</button>
                        <?= $this->include('template/tool-card'); ?>
                    </div>
                </div>
                <div class="card-body">
                    <table id="tablePermission" class="table table-no-bordered table-sm" data-show-refresh="true" data-pagination="true" data-side-pagination="server">
                    </table>
                </div>
            </div>
        </div>
		<div class="col-md-12">
            <div class="card shadow">
                <div class="card-header">
                    Role & Permission
                    <div class="card-tools">
                        <?= $this->include('template/tool-card'); ?>
                    </div>
                </div>
                <div class="card-body">
                    <table id="tableRolePermission" class="table table-no-bordered table-sm" data-show-refresh="true" data-pagination="true" data-side-pagination="server">
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>
<div class="modal fade" id="modalAdd" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h3 class="modal-title">Add New</h3>
				<button type="button" class="close" data-bs-dismiss="modal" aria-label="Close"><span
						aria-hidden="true">&times;</span></button>
			</div>
			<div class="modal-body form">
				<form role="form" id="formAdd">
					<div class="form-body">
						<div class="form-group">
							<label for="">Key Name</label>
							<input type="text" class="form-control" value="" id="" name="name" placeholder="Key_name" autofocus required>
						</div>
                        <div class="form-group">
							<label for="">Deskripsi</label>
							<input type="text" class="form-control" value="" id="" name="description" placeholder="Username" required>
						</div>
					</div>

					<button type="submit" class="btnSave btn btn-primary">Simpan</button>
					<button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
			    </form>
		    </div>
		</div>
	</div>
</div>
<div class="modal fade" id="modalEdit" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h3 class="modal-title" id="modelEditTitle"></h3>
				<button type="button" class="close" data-bs-dismiss="modal" aria-label="Close"><span
						aria-hidden="true">&times;</span></button>
			</div>
			<div class="modal-body form">
				<form role="form" id="formEdit">
					<div class="form-body">
                        <input type="hidden" name="id" value="" id="editId">
						<div class="form-group">
							<label for="">Nama</label>
							<input type="text" class="form-control" value="" id="editName" name="name" disabled>
						</div>
                        <div class="form-group">
							<label for="">Description</label>
							<input type="text" class="form-control" value="" id="editDescription" name="description" placeholder="Description">
						</div>
					</div>

					<button type="submit" class="btnSave btn btn-primary">Simpan</button>
					<button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
			    </form>
		    </div>
		</div>
	</div>
</div>
<div class="modal fade" id="modalAddPermission" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h3 class="modal-title">Add New</h3>
				<button type="button" class="close" data-bs-dismiss="modal" aria-label="Close"><span
						aria-hidden="true">&times;</span></button>
			</div>
			<div class="modal-body form">
				<form role="form" id="formAddPermission">
					<div class="form-body">
						<div class="form-group">
							<label for="">Permission Key Name</label>
							<input type="text" class="form-control" value="" id="" name="name" placeholder="permission.edit"  required>

						</div>
                        <div class="form-group">
							<label for="">Deskripsi</label>
							<input type="text" class="form-control" value="" id="" name="description" placeholder="Username" required>
						</div>
					</div>

					<button type="submit" class="btnSave btn btn-primary">Simpan</button>
					<button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
			    </form>
		    </div>
		</div>
	</div>
</div>
<div class="modal fade" id="modalEditPermission" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h3 class="modal-title" id="modelEditPermissionTitle"></h3>
				<button type="button" class="close" data-bs-dismiss="modal" aria-label="Close"><span
						aria-hidden="true">&times;</span></button>
			</div>
			<div class="modal-body form">
				<form role="form" id="formEditPermission">
					<div class="form-body">
                        <input type="hidden" name="id" value="" id="editIdPermission">
						<div class="form-group">
							<label for="">Nama</label>
							<input type="text" class="form-control" value="" id="editNamePermission" name="name" disabled>
						</div>
                        <div class="form-group">
							<label for="">Description</label>
							<input type="text" class="form-control" value="" id="editDescriptionPermission" name="description" placeholder="Description">
						</div>
					</div>

					<button type="submit" class="btnSave btn btn-primary">Simpan</button>
					<button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
			    </form>
		    </div>
		</div>
	</div>
</div>
<div class="modal fade" id="modalAddRolePermission" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h3 class="modal-title">Add New Role Permission</h3>
				<button type="button" class="close" data-bs-dismiss="modal" aria-label="Close"><span
						aria-hidden="true">&times;</span></button>
			</div>
			<div class="modal-body form">
				<form role="form" id="formAddRolePermission">
					<div class="form-body">
						<input type="hidden" name="permission_id" id="permissionId">
						<div class="form-group">
							<label for="">User Group</label>
                            <select id="addGroup" name="group_id" class="form-control">
                               <?php foreach($groups as $g){ ?>
                                <option value="<?= $g['id']?>"><?= $g['name']?></option>
                               <?php } ?>
                            </select>
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
<script>
    $(document).ready(function () {
        $('#tableRole').bootstrapTable({
			search: true,
			url: SITE_URL + '/roles/get_all',
			pageSize: 10,
			pageList: "[10, 20, 50, 100]",
			columns: [{
				field: 'id',
				title: 'Group ID',
				halign: 'center',
				sortable: true

			},{
				field: 'name',
				title: 'Key Name',
				halign: 'center',
				sortable: true

			}, {
				field: 'description',
				title: 'Description',
				halign: 'center',
				sortable: true,
			},{
				title: 'Action',
				halign: 'center',
				formatter: function (value, row, index) {
					return '<button class=\'btn btn-success btn-xs\' onclick=\'show("' +row.id +'")\'><i class="fa fa-pencil"></i> View</button>';
				}
			}],
		});
		$('#tablePermission').bootstrapTable({
			search: true,
			url: SITE_URL + '/roles/get_all_permissions',
			pageSize: 10,
			pageList: "[10, 20, 50, 100]",
			columns: [{
				field: 'id',
				title: 'ID Perm',
				halign: 'center',
				sortable: true

			},{
				field: 'name',
				title: 'Key Name',
				halign: 'center',
				sortable: false

			}, {
				field: 'description',
				title: 'Permission Description',
				halign: 'center',
				sortable: true,
			},{
				title: 'Action',
				halign: 'center',
				formatter: function (value, row, index) {
					return '<button class=\'btn btn-success btn-xs\' onclick=\'showPermission("' +row.id +'")\'><i class="fa fa-pencil"></i> View</button><button class=\'btn ml-2 btn-primary btn-xs\' onclick=\'addToGroup("' +row.id +'")\'><i class="fa fa-add"></i> Add To Group</button>';
				}
			}],
		});
		$('#tableRolePermission').bootstrapTable({
			search: true,
			url: SITE_URL + '/roles/get_all_rolepermissions',
			pageSize: 10,
			pageList: "[10, 20, 50, 100]",
			columns: [{
				field: 'permission_id',
				title: 'ID Perm',
				halign: 'center',
				sortable: true

			},{
				field: 'group_name',
				title: 'Key Name',
				halign: 'center',
				sortable: false

			}, {
				field: 'permission',
				title: 'Permission Key',
				halign: 'center',
				sortable: true,
			},{
				field: 'description',
				title: 'Permission Description',
				halign: 'center',
				sortable: true,
			},{
				title: 'Action',
				halign: 'center',
				formatter: function (value, row, index) {
					var g = row.group_id;
					var p = row.permission_id;
					return `<button class="btn btn-danger btn-xs" onclick="delRolePermission('${g}','${p}')"><i class="fa fa-trash"></i> Delete</button>`;
				}
			}],
		});
    });

    function add(){
        $('#modalAdd').modal('show');
        $('#formAdd').trigger('reset');
    }
	function addPermission(){
        $('#modalAddPermission').modal('show');
        $('#formAddPermission').trigger('reset');
    }
	function addToGroup(id){
        $('#modalAddRolePermission').modal('show');
        $('#formAddRolePermission').trigger('reset');
		$('#permissionId').val(id);
    }

    function show(id){
        $.ajax({
            url: SITE_URL + '/roles/role/' + id,
            type: 'get',
            success: function (res) {
                if (res.status) {
                    $('#modalEdit').modal('show');
                    var u = res.data;
                    $('#editId').val(u.id);
                    $('#editName').val(u.name);
                    $('#editDescription').val(u.description);
                } else {
                    toastr.error('Anda tidak berhak')
                }
            }
        });
    }

	function showPermission(id){
        $.ajax({
            url: SITE_URL + '/roles/permission/' + id,
            type: 'get',
            success: function (res) {
                if (res.status) {
                    $('#modalEditPermission').modal('show');
                    var u = res.data;
                    $('#editIdPermission').val(u.id);
                    $('#editNamePermission').val(u.name);
                    $('#editDescriptionPermission').val(u.description);
                } else {
                    toastr.error('Anda tidak berhak')
                }
            }
        });
    }
	function delRolePermission(gid,pid){
        if (confirm("Yakin akan menghapus data?, ") == true) {
            $.ajax({
                url: SITE_URL + '/roles/rolepermission/'+gid+'/'+pid,
                type: "DELETE",
                dataType: "JSON",
                success: function (data) {
                    if (data.status) {
                        toastr.success('Data Sukses Terhapus');
                        $('#tableRolePermission').bootstrapTable('refresh');
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

    $('#formAdd').submit(function (e) {
		e.preventDefault();
		$('.btnSave').text('saving...');
		$('.btnSave').attr('disabled', true);
		$.ajax({
			url: SITE_URL + '/roles/role',
			type: "POST",
			data: $('#formAdd').serialize(),
			dataType: "JSON",
			success: function (data) {
				if (data.status) {
					toastr.success('Data Sukses Tersimpan');
					$('#modalAdd').modal('hide');
					$('#tableRole').bootstrapTable('refresh');
				} else {
					toastr.error(data.messages)
					$('#modalAdd').modal('hide');
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
    $('#formEdit').submit(function (e) {
		e.preventDefault();
		$('.btnSave').text('saving...');
		$('.btnSave').attr('disabled', true);
        var id = $('#editId').val();
		$.ajax({
			url: SITE_URL + '/roles/role/'+id,
			type: "PUT",
			data: $('#formEdit').serialize(),
			dataType: "JSON",
			success: function (data) {
				if (data.status) {
					toastr.success('Data Sukses Tersimpan');
					$('#modalEdit').modal('hide');
					$('#tableRole').bootstrapTable('refresh');
				} else {
					toastr.error(data.message)
					$('#modalEdit').modal('hide');
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
	$('#formAddPermission').submit(function (e) {
		e.preventDefault();
		$('.btnSave').text('saving...');
		$('.btnSave').attr('disabled', true);
		$.ajax({
			url: SITE_URL + '/roles/permission',
			type: "POST",
			data: $('#formAddPermission').serialize(),
			dataType: "JSON",
			success: function (data) {
				if (data.status) {
					toastr.success('Data Sukses Tersimpan');
					$('#modalAddPermission').modal('hide');
					$('#tablePermission').bootstrapTable('refresh');
				} else {
					toastr.error(data.messages)
					$('#modalAddPermission').modal('hide');
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
	$('#formEditPermission').submit(function (e) {
		e.preventDefault();
		$('.btnSave').text('saving...');
		$('.btnSave').attr('disabled', true);
        var id = $('#editIdPermission').val();
		$.ajax({
			url: SITE_URL + '/roles/permission/'+id,
			type: "PUT",
			data: $('#formEditPermission').serialize(),
			dataType: "JSON",
			success: function (data) {
				if (data.status) {
					toastr.success('Data Sukses Tersimpan');
					$('#modalEditPermission').modal('hide');
					$('#tablePermission').bootstrapTable('refresh');
				} else {
					toastr.error(data.message)
					$('#modalEditPermission').modal('hide');
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
	$('#formAddRolePermission').submit(function (e) {
		e.preventDefault();
		$('.btnSave').text('saving...');
		$('.btnSave').attr('disabled', true);
		$.ajax({
			url: SITE_URL + '/roles/rolepermission',
			type: "POST",
			data: $('#formAddRolePermission').serialize(),
			dataType: "JSON",
			success: function (data) {
				if (data.status) {
					toastr.success('Data Sukses Tersimpan');
					$('#modalAddRolePermission').modal('hide');
					$('#tableRolePermission').bootstrapTable('refresh');
				} else {
					toastr.error(data.messages)
					$('#modalAddRolePermission').modal('hide');
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
</script>
<?= $this->endSection(); ?>