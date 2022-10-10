<?= $this->extend('_layout/template'); ?>

<?= $this->section('stylesheet'); ?>
<link rel="stylesheet" href="<?= base_url('/toping/plugins/select2/css/select2.min.css') ?>">
<link rel="stylesheet" href="<?= base_url('/toping/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') ?>">
<?= $this->endSection(); ?>

<?= $this->section('content'); ?>
<div class="card-body">
	<table class="table table-bordered">
		<tr>
			<td class="col-md-2">Sasaran RPJMD:</td>
			<td class="col-md-10"><?= $sasaran['rpjmd_sasaran_n']; ?></td>
		</tr>
		<tr>
			<td class="col-md-2">Kode Sasaran:</td>
			<td class="col-md-10"><?= $sasaran['opd_kode_sasaran']; ?></td>
		</tr>
		<tr>
			<td class="col-md-2">Sasaran:</td>
			<td class="col-md-10"><?= $sasaran['opd_sasaran']; ?></td>
		</tr>
		<tr>
			<td class="col-md-2">Indikator Sasaran:</td>
			<td class="col-md-10"><?= $sasaran['opd_indikator_sasaran']; ?></td>
		</tr>
		<tr>
			<td class="col-md-2">Target <?= $sasaran['tahun']; ?>:</td>
			<td class="col-md-10"><?= $sasaran['t_tahun'] . ' ' . $sasaran['satuan']; ?></td>
		</tr>
	</table><br>
	<form action="<?= base_url('/user/renstra_capaian/opd_capaian_sasaran/opd_sasaran_update') ?>" method="POST">
		<?= csrf_field() ?>
		<input type="hidden" name="id_sasaran" value="<?= $sasaran['id_opd_sasaran']; ?>">
		<div class="row">
			<div class="col-md">
				<div class="form-group">
					<label>Triwulan 1 </label>
					<div class="input-group mb-3">
						<input type="text" value="<?= $sasaran['triwulan_1']; ?>" class="form-control" name="triwulan_1" maxlength="20">
						<div class="input-group-append">
							<span class="input-group-text"><?= $sasaran['satuan']; ?></span>
						</div>
					</div>
				</div>
				<div class="form-group">
					<label>Triwulan 2 </label>
					<div class="input-group mb-3">
						<input type="text" value="<?= $sasaran['triwulan_2']; ?>" class="form-control" name="triwulan_2" maxlength="20">
						<div class="input-group-append">
							<span class="input-group-text"><?= $sasaran['satuan']; ?></span>
						</div>
					</div>
				</div>
				<div class="form-group">
					<label>Triwulan 3 </label>
					<div class="input-group mb-3">
						<input type="text" value="<?= $sasaran['triwulan_3']; ?>" class="form-control" name="triwulan_3" maxlength="20">
						<div class="input-group-append">
							<span class="input-group-text"><?= $sasaran['satuan']; ?></span>
						</div>
					</div>
				</div>
				<div class="form-group">
					<label>Triwulan 4 </label>
					<div class="input-group mb-3">
						<input type="text" value="<?= $sasaran['triwulan_4']; ?>" class="form-control" name="triwulan_4" maxlength="20">
						<div class="input-group-append">
							<span class="input-group-text"><?= $sasaran['satuan']; ?></span>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="card-footer">
			<button type="submit" class="btn btn-primary">Simpan</button>
		</div>
	</form>
</div>
<?= $this->endSection(); ?>