<?= $this->extend('template/template'); ?>
<?= $this->Section('main'); ?>
<section class="container-fluid" id="main">
    <div class="row">
        <div class="col-12">
            <div class="card shadow">
                <div class="card-header">
                    <?= $title ?>
                    <div class="card-tools">
                        <button class="btn btn-sm btn-success" onclick="add()"><i class="fa fa-add"></i> Add</button>
                        <?= $this->include('template/tool-card'); ?>
                    </div>
                </div>
                <div class="card-body">
                    <table id="tableUser" class="table table-no-bordered table-sm" data-show-refresh="true" data-pagination="true" data-side-pagination="server">
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
							<label for="">Nama</label>
							<input type="text" class="form-control" value="" id="" name="name" placeholder="Nama Lengkap" autofocus required>
						</div>
                        <div class="form-group">
							<label for="">Username</label>
							<input type="text" class="form-control" value="" id="" name="username" placeholder="Username" required>
						</div>
                        <div class="form-group">
							<label for="">Email</label>
							<input type="email" class="form-control" value="" id="" name="email" placeholder="Email" required>
						</div>
                        <div class="form-group">
							<label for="">Password</label>
							<input type="password" class="form-control" value="" id="" name="password" required>
						</div>
						
					</div>

					<button type="submit" id="btnSave" class="btn btn-primary">Simpan</button>
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
							<input type="text" class="form-control" value="" id="editName" name="name" placeholder="Nama Lengkap" autofocus required>
						</div>
                        <div class="form-group">
							<label for="">Username</label>
							<input type="text" class="form-control" value="" id="editUsername" name="username" placeholder="Username" disabled>
						</div>
                        <div class="form-group">
							<label for="">Email</label>
							<input type="email" class="form-control" value="" id="editEmail" name="email" placeholder="Email" disabled>
						</div>
                        <div class="form-group">
							<label for="">Update Password</label>
							<input type="password" class="form-control" value="" id="editPassword" name="password">
                            <span class="text-muted">Isi ini jika ingin ganti password</span>
						</div>
                        <div class="form-group">
							<label for="">Aktif</label>
                            <select name="active" id="editActive" name="active" class="form-control">
                                <option value="0">Tidak Aktif</option>
                                <option value="1">Aktif</option>
                            </select>
						</div>
                        <div class="form-group">
							<label for="">User Group</label>
                            <select name="group" id="editGroup" name="group" class="form-control">
                               <?php foreach($groups as $g){ ?>
                                <option value="<?= $g['id']?>"><?= $g['name']?></option>
                               <?php } ?>
                            </select>
						</div>
						
					</div>

					<button type="submit" id="btnSave" class="btn btn-primary">Simpan</button>
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
        $('#tableUser').bootstrapTable({
			search: true,
			url: SITE_URL + '/users/get_all',
			pageSize: 10,
			pageList: "[10, 20, 50, 100]",
			columns: [{
				field: 'id',
				title: 'User ID',
				halign: 'center',
				sortable: true

			},{
				field: 'name',
				title: 'Nama',
				halign: 'center',
				sortable: true

			}, {
				field: 'email',
				title: 'Email',
				halign: 'center',
				sortable: true,
			}, {
				field: 'username',
				title: 'Username',
				halign: 'center',
				sortable: true
			},{
				field: 'groupname',
				title: 'User Group',
				halign: 'center',
				sortable: false
			}, {
				field: 'active',
				title: 'Aktif',
				halign: 'center',
				sortable: true,
                formatter: function (value, row, index) {
                    var aktif = '<span class="text-success">Aktif</span>';
                    var noaktif = '<span class="text-danger">Tidak Aktif</span>';
					return (row.active == 0) ? noaktif : aktif;
				}
			}, {
				title: 'Action',
				halign: 'center',
				formatter: function (value, row, index) {
					return '<button class=\'btn btn-success btn-xs\' onclick=\'show("' +row.id +'")\'><i class="fa fa-pencil"></i> View</button><button class=\'ml-3 btn btn-danger btn-xs\' onclick=\'hapus("' +row.id +'")\'><i class="fa fa-trash"></i></button>';
				}
			}],
		});
    });

    function add(){
        $('#modalAdd').modal('show');
        $('#formAdd').trigger('reset');
    }

    function show(id){
        $.ajax({
            url: SITE_URL + '/users/user/' + id,
            type: 'get',
            success: function (res) {
                if (res.status) {
                    $('#modalEdit').modal('show');
                    var u = res.data;
                    $('#editId').val(u.id);
                    $('#editName').val(u.name);
                    $('#editUsername').val(u.username);
                    $('#editEmail').val(u.email);
                    $('#editActive').val(u.active);
                    $('#editGroup').val(u.group_id);
                } else {
                    toastr.error('Anda tidak berhak')
                }
            }
        });
    }

    function hapus(id){
        if (confirm("Yakin akan menghapus data?, ") == true) {
            $.ajax({
                url: SITE_URL + '/users/user/'+id,
                type: "DELETE",
                dataType: "JSON",
                success: function (data) {
                    if (data.status) {
                        toastr.success('Data Sukses Terhapus');
                        $('#tableUser').bootstrapTable('refresh');
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
		$('#btnSave').text('saving...');
		$('#btnSave').attr('disabled', true);
		$.ajax({
			url: SITE_URL + '/users/user',
			type: "POST",
			data: $('#formAdd').serialize(),
			dataType: "JSON",
			success: function (data) {
				if (data.status) {
					toastr.success('Data Sukses Tersimpan');
					$('#modalAdd').modal('hide');
					$('#tableUser').bootstrapTable('refresh');
				} else {
                    var message = '';
                    if(data.messages.email){
                        message += data.messages.email +', '
                    }
                    if(data.messages.username){
                        message += data.messages.username +', '
                    }
					toastr.error(message)
					$('#modalAdd').modal('hide');
				}
				$('#btnSave').text('Simpan');
				$('#btnSave').attr('disabled', false);
			},
			error: function (jqXHR, textStatus, errorThrown) {
				alert(textStatus);
				$('#btnSave').text('save');
				$('#btnSave').attr('disabled', false);
			}
		});
	});
    $('#formEdit').submit(function (e) {
		e.preventDefault();
		$('#btnSave').text('saving...');
		$('#btnSave').attr('disabled', true);
        var id = $('#editId').val();
		$.ajax({
			url: SITE_URL + '/users/user/'+id,
			type: "PUT",
			data: $('#formEdit').serialize(),
			dataType: "JSON",
			success: function (data) {
				if (data.status) {
					toastr.success('Data Sukses Tersimpan');
					$('#modalEdit').modal('hide');
					$('#tableUser').bootstrapTable('refresh');
				} else {
					toastr.error(data.message)
					$('#modalEdit').modal('hide');
				}
				$('#btnSave').text('Simpan');
				$('#btnSave').attr('disabled', false);
			},
			error: function (jqXHR, textStatus, errorThrown) {
				alert(textStatus);
				$('#btnSave').text('save');
				$('#btnSave').attr('disabled', false);
			}
		});
	});
</script>
<?= $this->endSection(); ?>