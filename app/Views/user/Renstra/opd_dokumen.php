<?= $this->extend('_layout/template'); ?>

<?= $this->section('content'); ?>
<div class="card-body">

	<form action="<?= base_url('/user/renstra/opd_dokumen/dokumen_create'); ?>" method="POST" enctype="multipart/form-data">
		<?= csrf_field() ?>
		<div class="row">
			<div class="col-12">
				<label>Keterangan</label>
				<div class="form-group">
					<input type="text" name="keterangan" class="form-control" maxlength="255" required>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-5">
				<label>Nama Dokumen</label>
				<div class="form-group">
					<input type="text" name="nama" class="form-control" maxlength="100" required>
				</div>
			</div>
			<div class="col-5">
				<label>Dokumen</label>
				<div class="form-group" style="overflow: hidden;">
					<div class="input-group">
						<div class="custom-file">
							<input type="file" name="file" class="custom-file-input" id="file" required accept=".Pdf, .pdf, .doc, .docx, .Doc, .Docx, .xls, .xlsx, .Xlsx, .Xls" /></p>
							<label class="custom-file-label">Pilih dokumen [xls, xlsx]</label>
						</div>
					</div>
				</div>
			</div>
			<div class="col-2">
				<label>&nbsp;</label>
				<div class="form-group">
					<button type="submit" class="btn btn-primary" style="width: 100%;">Upload Dokumen</button>
				</div>
			</div>
		</div>
	</form>
	<p>&nbsp;</p>
	<div class="row">
		<table id="example1" class="table table-bordered">
			<thead>
				<tr>
					<th>Keteranga Dokumen</th>
					<th style="width:600px;">Dokumen</th>
					<th class="text-center" width="60px">Aksi</th>
				</tr>
			</thead>
			<tbody>
				<?php $querz = $db->table('tb_renstra_dokumen')
					->getWhere([
						'opd_id' => user()->opd_id,
						'tahun' => $_SESSION['tahun'],
					])->getResultArray();
				foreach ($querz as $rom) : ?>
					<tr>
						<td><?= $rom['keterangan']; ?></td>
						<td class="align-top">
							<a href="<?= base_url('/user/renstra/opd_dokumen/download/' . $rom['id_renstra_dokumen']); ?>"> <?= substr($rom['dokumen'], 0, 50); ?> </a><?= '... (' . formatBytes2($rom['size']) . 'b)'; ?>
						</td>
						<td class="text-center align-top">
							<a class="btn btn-danger btn-circle btn-xs" onclick="if(confirm('Apakah anda yakin ingin menghapus data ini ??')){location.href='<?= base_url() . '/user/renstra/opd_dokumen/dokumen_hapus/' . $rom['id_renstra_dokumen']; ?>'}" href="#">
								<i class="nav-icon fas fa-trash-alt"></i>
							</a>
						</td>
					</tr>
				<?php endforeach; ?>
			</tbody>
		</table>
	</div>
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