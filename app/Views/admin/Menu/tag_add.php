<?= $this->extend('_layout/template'); ?>
<?= $this->section('content'); ?>
<div class="card-body">
	<form action="<?= base_url('/admin/menu/tag/tag_create') ?>" method="POST">
		<?= csrf_field() ?>
		<div class="row">
			<div class="col-md-2">
				<div class="form-group">
					<label>Tag</label>
				</div>
			</div>
			<div class="col-md-10">
				<div class="form-group">
					<input type="text" name="tag" class="form-control" maxlength="20" require>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-2">
				<div class="form-group">
					<label>Keterangan</label>
				</div>
			</div>
			<div class="col-md-10">
				<div class="form-group">
					<input type="text" name="keterangan" class="form-control" maxlength="255" require>
				</div>
			</div>
		</div>
		<div class="card-footer">
			<button type="submit" class="btn btn-primary">Simpan</button>
		</div>
	</form>
</div>
<?= $this->endSection(); ?>