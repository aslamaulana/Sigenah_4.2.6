<?= $this->extend('_layout/template'); ?>

<?= $this->section('tombol'); ?>
<div>
	<a href="#" onclick="history.back(-1)">
		<li class="btn btn-block btn-info btn-sm" active><i class="nav-icon fa fa-chevron-left"></i> Kembali</li>
	</a>
</div>
<?= $this->endSection(); ?>

<?= $this->section('content'); ?>
<?php if ($_SESSION['perubahan'] == 'Perubahan') { ?>
	<div class="card-body">
		<form action="<?= base_url('/user/rkpd/opd_kegiatan/simpanExcel') ?>" method="POST" enctype="multipart/form-data">
			<?= csrf_field() ?>
			<table class="table table-bordered">
				<tr>
					<td colspan="3">Tambah Data Kegiatan (import dari Renja murni)</td>
				</tr>
				<tr>
					<td style="width:120px;">Tahap 1 -> </td>
					<td style="width:220px;">Download Format Excel</td>
					<td>
						<div class="input-group">
							<a href="<?= base_url('/user/rkpd/opd_kegiatan/export_perubahan'); ?>">
								<li class="btn btn-block btn-success btn-sm" active><i class="nav-icon fa fa-file-excel"></i> Format</li>
							</a>
						</div>
					</td>
				</tr>
				<tr>
					<td>Tahap 2 -> </td>
					<td>Upload File Excel</td>
					<td>
						<div class="input-group">
							<div class="custom-file">
								<input type="file" name="fileexcel" class="custom-file-input" id="file" required accept=".xls, .xlsx, .Xlsx, .Xls" /></p>
								<label class="custom-file-label">Pilih dokumen [xls, xlsx]</label>
							</div>
						</div>
					</td>
				</tr>
			</table>
			<div class="card-footer">
				<button type="submit" class="btn btn-primary">Upload</button>
			</div>
		</form>
	</div>
<?php } else { ?>
	<div class="card-body">
		<form action="<?= base_url('/user/rkpd/opd_kegiatan/simpanExcel') ?>" method="POST" enctype="multipart/form-data">
			<?= csrf_field() ?>
			<table class="table table-bordered">
				<tr>
					<td colspan="3">Impor Data Kegiatan Dari Renstra</td>
				</tr>
				<tr>
					<td style="width:120px;">Tahap 1 -> </td>
					<td style="width:220px;">Download Format Excel</td>
					<td>
						<div class="input-group">
							<a href="<?= base_url('/user/rkpd/opd_kegiatan/export'); ?>">
								<li class="btn btn-block btn-success btn-sm" active><i class="nav-icon fa fa-file-excel"></i> Format</li>
							</a>
						</div>
					</td>
				</tr>
				<tr>
					<td>Tahap 2 -> </td>
					<td>Upload File Excel</td>
					<td>
						<div class="input-group">
							<div class="custom-file">
								<input type="file" name="fileexcel" class="custom-file-input" id="file" required accept=".xls, .xlsx, .Xlsx, .Xls" /></p>
								<label class="custom-file-label">Pilih dokumen [xls, xlsx]</label>
							</div>
						</div>
					</td>
				</tr>
			</table>
			<div class="card-footer">
				<button type="submit" class="btn btn-primary">Upload</button>
			</div>
		</form>
	</div>
<?php } ?>

<div class="card-body">
	<form action="<?= base_url('/user/rkpd/opd_kegiatan/simpanExcel_edit') ?>" method="POST" enctype="multipart/form-data">
		<?= csrf_field() ?>
		<table class="table table-bordered">
			<tr>
				<td colspan="3">Ubah Data Renja Kegiatan Tahun <?= $_SESSION['tahun']; ?></td>
			</tr>
			<tr>
				<td style="width:120px;">Tahap 1 -> </td>
				<td style="width:220px;">Download Format Excel</td>
				<td>
					<div class="input-group">
						<a href="<?= base_url('/user/rkpd/opd_kegiatan/export_edit'); ?>">
							<li class="btn btn-block btn-success btn-sm" active><i class="nav-icon fa fa-file-excel"></i> Format</li>
						</a>
					</div>
				</td>
			</tr>
			<tr>
				<td>Tahap 2 -> </td>
				<td>Upload File Excel</td>
				<td>
					<div class="input-group">
						<div class="custom-file">
							<input type="file" name="fileexcel" class="custom-file-input file-input" id="file" required accept=".xls, .xlsx, .Xlsx, .Xls" /></p>
							<label class="custom-file-label file-label">Pilih dokumen [xls, xlsx]</label>
						</div>
					</div>
				</td>
			</tr>
		</table>
		<div class="card-footer">
			<button type="submit" class="btn btn-primary">Upload</button>
		</div>
	</form>
</div>

<div class="card-body">
	<table class="table table-bordered">
		<tr>
			<td colspan="3">Hapus Seluruh Data Renja Kegiatan Tahun <?= $_SESSION['tahun']; ?></td>
		</tr>
		<tr>
			<td colspan="3" class="text-center">
				<a class="btn btn-danger btn-circle btn-md" onclick="if(confirm('Apakah anda yakin ingin menghapus data ini ??')){location.href='<?= base_url() . '/user/rkpd/opd_kegiatan/hapusAll'; ?>'}" href="#">
					<i class="nav-icon fas fa-trash-alt"> Hapus</i>
				</a>
			</td>
		</tr>
	</table>
</div>

<?= $this->endSection(); ?>
<?= $this->section('Javascript'); ?>
<script>
	$(".custom-file-input").on("change", function() {
		var fileName = $(this).val().split("\\").pop();
		$(this).siblings(".custom-file-label").addClass("selected").html(fileName);
	});
	$(".file-input").on("change", function() {
		var fileName = $(this).val().split("\\").pop();
		$(this).siblings(".file-label").addClass("selected").html(fileName);
	});
</script>
<?= $this->endSection(); ?>