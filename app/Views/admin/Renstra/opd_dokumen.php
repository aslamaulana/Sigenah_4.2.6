<?= $this->extend('_layout/template'); ?>

<?= $this->section('content'); ?>
<div class="card-body">
	<div class="row">
		<div class="col-md">
			<select class="form-control" onchange="location = this.value;">
				<?php foreach ($opd as $row) : ?>
					<option <?= $_SESSION['opd_set'] == $row['id'] ? 'selected' : ''; ?> value="<?= base_url('/admin/renstra/opd_dokumen/opd/' . $row['id']); ?>"><?= $row['description']; ?></option>
				<?php endforeach; ?>
			</select>
		</div>
	</div><br>

	<p>&nbsp;</p>
	<div class="row">
		<table id="example1" class="table table-bordered">
			<thead>
				<tr>
					<th>Keteranga Dokumen</th>
					<th style="width:600px;">Dokumen</th>
				</tr>
			</thead>
			<tbody>
				<?php $querz = $db->table('tb_renstra_dokumen')
					->getWhere([
						'opd_id' => $_SESSION['opd_set'],
						'tahun' => $_SESSION['tahun'],
					])->getResultArray();
				foreach ($querz as $rom) : ?>
					<tr>
						<td><?= $rom['keterangan']; ?></td>
						<td class="align-top">
							<a href="<?= base_url('/admin/renstra/opd_dokumen/download/' . $rom['id_renstra_dokumen']); ?>"> <?= substr($rom['dokumen'], 0, 50); ?> </a><?= '... (' . formatBytes2($rom['size']) . 'b)'; ?>
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