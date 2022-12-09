<?= $this->extend('_layout/template'); ?>

<?= $this->section('tombol'); ?>
<div>
	<a href="#" onclick="history.back(-1)">
		<li class="btn btn-block btn-info btn-sm" active><i class="nav-icon fa fa-chevron-left"></i> Kembali</li>
	</a>
</div>
<?= $this->endSection(); ?>

<?= $this->section('content'); ?>
<div class="card-body">
	<table class="table table-bordered">
		<tr>
			<td class="col-md-2 font-weight-bold">Sasaran:</td>
			<td class="col-md-10"><?= $program['sasaran_n']; ?></td>
		</tr>
		<tr>
			<td class="col-md-2 font-weight-bold">Program:</td>
			<td class="col-md-10"><?= $program['program_90']; ?></td>
		</tr>
	</table><br><br>
	<form action="<?= base_url('/admin/rpjmd/program/program_indik_update') ?>" method="POST">
		<?= csrf_field() ?>
		<input type="hidden" name="id_program" value="<?= $program['id_program']; ?>">
		<div class="row">
			<div class="col-md-6">
				<div class="form-group">
					<label>Indikator Program <medium class="text-danger">*</medium></label>
					<textarea name="indikator_program" class="form-control" placeholder="indikator sasaran" maxlength="300" rows="4" required><?= $program['indikator_program']; ?></textarea>
				</div>
				<div class="form-group">
					<label>Satuan <medium class="text-danger">*</medium></label>
					<select name="satuan" class="form-control select2bs4 <?= ($validation->hasError('satuan')) ? 'is-invalid' : ''; ?>" required>
						<option value="<?= $program['satuan']; ?>"><?= $program['satuan']; ?></option>
						<?php foreach ($satuan as $row) : ?>
							<option value="<?= $row['satuan']; ?>"><?= $row['satuan']; ?></option>
						<?php endforeach; ?>
					</select>
					<span class="text-danger"><?= $validation->getError('satuan'); ?></span>
				</div>
			</div>
			<div class="col-md-3">
				<div class="form-group">
					<label>Target 2021</label>
					<input type="text" value="<?= $program['t_2021']; ?>" class="form-control" name="t_2021" maxlength="20" required>
				</div>
				<div class="form-group">
					<label>Target 2022</label>
					<input type="text" value="<?= $program['t_2022']; ?>" class="form-control" name="t_2022" maxlength="20" required>
				</div>
				<div class="form-group">
					<label>Target 2023</label>
					<input type="text" value="<?= $program['t_2023']; ?>" class="form-control" name="t_2023" maxlength="20" required>
				</div>
				<div class="form-group">
					<label>Target 2024</label>
					<input type="text" value="<?= $program['t_2024']; ?>" class="form-control" name="t_2024" maxlength="20" required>
				</div>
				<div class="form-group">
					<label>Target 2025</label>
					<input type="text" value="<?= $program['t_2025']; ?>" class="form-control" name="t_2025" maxlength="20" required>
				</div>
				<div class="form-group">
					<label>Target 2026</label>
					<input type="text" value="<?= $program['t_2026']; ?>" class="form-control" name="t_2026" maxlength="20" required>
				</div>
			</div>
			<div class="col-md-3">
				<div class="form-group">
					<label>Target RP 2021</label>
					<input type="number" value="<?= $program['rp_2021']; ?>" class="form-control" name="rp_2021" maxlength="20" required>
				</div>
				<div class="form-group">
					<label>Target RP 2022</label>
					<input type="number" value="<?= $program['rp_2022']; ?>" class="form-control" name="rp_2022" maxlength="20" required>
				</div>
				<div class="form-group">
					<label>Target RP 2023</label>
					<input type="number" value="<?= $program['rp_2023']; ?>" class="form-control" name="rp_2023" maxlength="20" required>
				</div>
				<div class="form-group">
					<label>Target RP 2024</label>
					<input type="number" value="<?= $program['rp_2024']; ?>" class="form-control" name="rp_2024" maxlength="20" required>
				</div>
				<div class="form-group">
					<label>Target RP 2025</label>
					<input type="number" value="<?= $program['rp_2025']; ?>" class="form-control" name="rp_2025" maxlength="20" required>
				</div>
				<div class="form-group">
					<label>Target RP 2026</label>
					<input type="number" value="<?= $program['rp_2026']; ?>" class="form-control" name="rp_2026" maxlength="20" required>
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
<?= $this->section('Javascript'); ?>
<script src="<?= base_url('/toping/plugins/inputmask/jquery.mask.min.js') ?>"></script>
<script>
	$(document).ready(function() {
		$('#birth-date').mask('00/00/0000');
		$('#phone-number').mask('0000-0000');
		<?php foreach ($tahunA as $rop) : ?>
			$('#money-<?= $rop['tahun']; ?>').mask('000.000.000.000.000,00', {
				reverse: true
			});
		<?php endforeach; ?>
	});
</script>
<?= $this->endSection(); ?>