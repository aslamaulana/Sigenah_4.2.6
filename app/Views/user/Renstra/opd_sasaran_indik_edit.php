<?= $this->extend('_layout/template'); ?>

<?= $this->section('stylesheet'); ?>
<link rel="stylesheet" href="<?= base_url('/toping/plugins/select2/css/select2.min.css') ?>">
<link rel="stylesheet" href="<?= base_url('/toping/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') ?>">
<?= $this->endSection(); ?>

<?= $this->section('content'); ?>
<div class="card-body">
	<table class="table table-bordered">
		<tr>
			<td class="col-md-2">Sasaran:</td>
			<td class="col-md-10"><?= $indikator['opd_sasaran']; ?></td>
		</tr>
		<tr>
			<td class="col-md-2">Kode Sasaran:</td>
			<td class="col-md-10"><?= $indikator['opd_kode_sasaran']; ?></td>
		</tr>
	</table><br>
	<form action="<?= base_url('/user/renstra/opd_sasaran/opd_sasaran_indik_update') ?>" method="POST">
		<?= csrf_field() ?>
		<input type="hidden" name="id_sasaran" value="<?= $indikator['id_opd_sasaran']; ?>">
		<div class="row">
			<div class="col-md-6">
				<div class="form-group">
					<label>Indikator Sasaran <medium class="text-danger">*</medium></label>
					<textarea name="indikator_sasaran" class="form-control" placeholder="indikator sasaran" maxlength="300" rows="4" required><?= (old('indikator_sasaran')) ? old('indikator_sasaran') : $indikator['opd_indikator_sasaran']; ?></textarea>
					<span class="text-danger"><?= $validation->getError('indikator_sasaran'); ?></span>
				</div>
				<div class="form-group">
					<label>Satuan <medium class="text-danger">*</medium></label>
					<select name="satuan" class="form-control select2bs4 <?= ($validation->hasError('satuan')) ? 'is-invalid' : ''; ?>" required>
						<option value="<?= $indikator['satuan']; ?>"><?= $indikator['satuan']; ?></option>
						<?php foreach ($satuan as $row) : ?>
							<option value="<?= $row['satuan']; ?>"><?= $row['satuan']; ?></option>
						<?php endforeach; ?>
					</select>
					<span class="text-danger"><?= $validation->getError('satuan'); ?></span>
				</div>
			</div>
			<div class="col-md-6">
				<div class="form-group">
					<label>Target 2021</label>
					<input type="text" value="<?= (old('t_2021')) ? old('t_2021') : $indikator['t_2021']; ?>" class="form-control" name="t_2021" maxlength="50" required>
				</div>
				<div class="form-group">
					<label>Target 2022</label>
					<input type="text" value="<?= (old('t_2022')) ? old('t_2022') : $indikator['t_2022']; ?>" class="form-control" name="t_2022" maxlength="50" required>
				</div>
				<div class="form-group">
					<label>Target 2023</label>
					<input type="text" value="<?= (old('t_2023')) ? old('t_2023') : $indikator['t_2023']; ?>" class="form-control" name="t_2023" maxlength="50" required>
				</div>
				<div class="form-group">
					<label>Target 2024</label>
					<input type="text" value="<?= (old('t_2024')) ? old('t_2024') : $indikator['t_2024']; ?>" class="form-control" name="t_2024" maxlength="50" required>
				</div>
				<div class="form-group">
					<label>Target 2025</label>
					<input type="text" value="<?= (old('t_2024')) ? old('t_2024') : $indikator['t_2025']; ?>" class="form-control" name="t_2025" maxlength="50" required>
				</div>
				<div class="form-group">
					<label>Target 2026</label>
					<input type="text" value="<?= (old('t_2026')) ? old('t_2026') : $indikator['t_2026']; ?>" class="form-control" name="t_2026" maxlength="50" required>
				</div>
			</div>
			<div class="col-md-12">
				<medium class="text-success">*/ Jika target kosong isikan dengan tanda strip [-]</medium>
			</div>
		</div>

		<div class="card-footer">
			<button type="submit" class="btn btn-primary">Simpan</button>
		</div>
	</form>
</div>
<?= $this->endSection(); ?>