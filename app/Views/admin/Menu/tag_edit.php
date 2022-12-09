<?= $this->extend('_layout/template'); ?>
<?= $this->section('content'); ?>
<div class="card-body">
	<form action="<?= base_url('/admin/menu/tag/tag_update') ?>" method="POST">
		<?= csrf_field() ?>
		<input type="hidden" name="id" value="<?= $tag['id_tag']; ?>">
		<div class="row">
			<div class="col-md-2">
				<div class="form-group">
					<label>Tag</label>
				</div>
			</div>
			<div class="col-md-10">
				<div class="form-group">
					<input type="text" name="tag" value="<?= $tag['tag']; ?>" class="form-control" maxlength="20" require>
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
					<input type="text" name="keterangan" value="<?= $tag['keterangan']; ?>" class="form-control" maxlength="255" require>
				</div>
			</div>
		</div>
		<div class="card-footer">
			<button type="submit" class="btn btn-primary">Simpan</button>
		</div>
	</form>
</div>
<?= $this->endSection(); ?>