<?= $this->extend('_layout/template'); ?>

<?= $this->section('stylesheet'); ?>
<link rel="stylesheet" href="<?= base_url('/toping/plugins/select2/css/select2.min.css') ?>">
<link rel="stylesheet" href="<?= base_url('/toping/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') ?>">
<?= $this->endSection(); ?>

<?= $this->section('content'); ?>
<div class="card-body">
	<table class="table table-bordered table-sm">
		<tr>
			<td class="col-md-2">Program:</td>
			<td class="col-md-10"><?= $kegiatan['opd_program_n']; ?></td>
		</tr>
		<tr>
			<td class="col-md-2">Kegiatan:</td>
			<td class="col-md-10"><?= $kegiatan['opd_kegiatan_n']; ?></td>
		</tr>
		<tr>
			<td class="col-md-2">Sasaran Kegiatan:</td>
			<td class="col-md-10"><?= $kegiatan['opd_kegiatan_sasaran_n']; ?></td>
		</tr>
		<tr>
			<td class="col-md-2">Indikator Kegiatan:</td>
			<td class="col-md-10"><?= $kegiatan['opd_indikator_kegiatan']; ?></td>
		</tr>
		<tr>
			<td class="col-md-2">Target <?= $kegiatan['tahun']; ?>:</td>
			<td class="col-md-10"><?= $kegiatan['t_tahun'] . ' ' . $kegiatan['satuan']; ?></td>
		</tr>
	</table><br>
	<form action="<?= base_url('/user/renstra_capaian/opd_capaian_kegiatan/opd_kegiatan_update') ?>" method="POST">
		<?= csrf_field() ?>
		<input type="hidden" name="id_kegiatan" value="<?= $kegiatan['id_opd_kegiatan']; ?>">
		<div class="row">
			<div class="col-md">
				<div class="form-group">
					<label>Triwulan 1 </label>
					<div class="row" style="padding-left: 30px;">
						<div class="col-2">
							Target:
						</div>
						<div class="col-10">
							<div class="input-group mb-3">
								<input type="text" value="<?= $kegiatan['triwulan_1']; ?>" class="form-control" name="triwulan_1" maxlength="20">
								<div class="input-group-append">
									<span class="input-group-text"><?= $kegiatan['satuan']; ?></span>
								</div>
							</div>
						</div>
					</div>
					<div class="row" style="padding-left: 30px;">
						<div class="col-2">
							Faktor Penghambat:
						</div>
						<div class="col-10">
							<div class="input-group mb-3">
								<input type="text" value="<?= $kegiatan['penghambat_1']; ?>" class="form-control" name="penghambat_1" maxlength="300">
							</div>
						</div>
					</div>
					<div class="row" style="padding-left: 30px;">
						<div class="col-2">
							Faktor Pendukung:
						</div>
						<div class="col-10">
							<div class="input-group mb-3">
								<input type="text" value="<?= $kegiatan['pendukung_1']; ?>" class="form-control" name="pendukung_1" maxlength="300">
							</div>
						</div>
					</div>
					<div class="row" style="padding-left: 30px;">
						<div class="col-2">
							Rencana Tindak Lanjut:
						</div>
						<div class="col-10">
							<div class="input-group mb-3">
								<input type="text" value="<?= $kegiatan['tindak_lanjut_1']; ?>" class="form-control" name="tindak_lanjut_1" maxlength="300">
							</div>
						</div>
					</div>
				</div>
				<div class="form-group">
					<label>Triwulan 2 </label>
					<div class="row" style="padding-left: 30px;">
						<div class="col-2">
							Target:
						</div>
						<div class="col-10">
							<div class="input-group mb-3">
								<input type="text" value="<?= $kegiatan['triwulan_2']; ?>" class="form-control" name="triwulan_2" maxlength="20">
								<div class="input-group-append">
									<span class="input-group-text"><?= $kegiatan['satuan']; ?></span>
								</div>
							</div>
						</div>
					</div>
					<div class="row" style="padding-left: 30px;">
						<div class="col-2">
							Faktor Penghambat:
						</div>
						<div class="col-10">
							<div class="input-group mb-3">
								<input type="text" value="<?= $kegiatan['penghambat_2']; ?>" class="form-control" name="penghambat_2" maxlength="300">
							</div>
						</div>
					</div>
					<div class="row" style="padding-left: 30px;">
						<div class="col-2">
							Faktor Pendukung:
						</div>
						<div class="col-10">
							<div class="input-group mb-3">
								<input type="text" value="<?= $kegiatan['pendukung_2']; ?>" class="form-control" name="pendukung_2" maxlength="300">
							</div>
						</div>
					</div>
					<div class="row" style="padding-left: 30px;">
						<div class="col-2">
							Rencana Tindak Lanjut:
						</div>
						<div class="col-10">
							<div class="input-group mb-3">
								<input type="text" value="<?= $kegiatan['tindak_lanjut_2']; ?>" class="form-control" name="tindak_lanjut_2" maxlength="300">
							</div>
						</div>
					</div>
				</div>
				<div class="form-group">
					<label>Triwulan 3 </label>
					<div class="row" style="padding-left: 30px;">
						<div class="col-2">
							Target:
						</div>
						<div class="col-10">
							<div class="input-group mb-3">
								<input type="text" value="<?= $kegiatan['triwulan_3']; ?>" class="form-control" name="triwulan_3" maxlength="20">
								<div class="input-group-append">
									<span class="input-group-text"><?= $kegiatan['satuan']; ?></span>
								</div>
							</div>
						</div>
					</div>
					<div class="row" style="padding-left: 30px;">
						<div class="col-2">
							Faktor Penghambat:
						</div>
						<div class="col-10">
							<div class="input-group mb-3">
								<input type="text" value="<?= $kegiatan['penghambat_3']; ?>" class="form-control" name="penghambat_3" maxlength="300">
							</div>
						</div>
					</div>
					<div class="row" style="padding-left: 30px;">
						<div class="col-2">
							Faktor Pendukung:
						</div>
						<div class="col-10">
							<div class="input-group mb-3">
								<input type="text" value="<?= $kegiatan['pendukung_3']; ?>" class="form-control" name="pendukung_3" maxlength="300">
							</div>
						</div>
					</div>
					<div class="row" style="padding-left: 30px;">
						<div class="col-2">
							Rencana Tindak Lanjut:
						</div>
						<div class="col-10">
							<div class="input-group mb-3">
								<input type="text" value="<?= $kegiatan['tindak_lanjut_3']; ?>" class="form-control" name="tindak_lanjut_3" maxlength="300">
							</div>
						</div>
					</div>
				</div>
				<div class="form-group">
					<label>Triwulan 4 </label>
					<div class="row" style="padding-left: 30px;">
						<div class="col-2">
							Target:
						</div>
						<div class="col-10">
							<div class="input-group mb-3">
								<input type="text" value="<?= $kegiatan['triwulan_4']; ?>" class="form-control" name="triwulan_4" maxlength="20">
								<div class="input-group-append">
									<span class="input-group-text"><?= $kegiatan['satuan']; ?></span>
								</div>
							</div>
						</div>
					</div>
					<div class="row" style="padding-left: 30px;">
						<div class="col-2">
							Faktor Penghambat:
						</div>
						<div class="col-10">
							<div class="input-group mb-3">
								<input type="text" value="<?= $kegiatan['penghambat_4']; ?>" class="form-control" name="penghambat_4" maxlength="300">
							</div>
						</div>
					</div>
					<div class="row" style="padding-left: 30px;">
						<div class="col-2">
							Faktor Pendukung:
						</div>
						<div class="col-10">
							<div class="input-group mb-3">
								<input type="text" value="<?= $kegiatan['pendukung_4']; ?>" class="form-control" name="pendukung_4" maxlength="300">
							</div>
						</div>
					</div>
					<div class="row" style="padding-left: 30px;">
						<div class="col-2">
							Rencana Tindak Lanjut:
						</div>
						<div class="col-10">
							<div class="input-group mb-3">
								<input type="text" value="<?= $kegiatan['tindak_lanjut_4']; ?>" class="form-control" name="tindak_lanjut_4" maxlength="300">
							</div>
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