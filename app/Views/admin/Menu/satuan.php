<?= $this->extend('_layout/template'); ?>

<?= $this->section('tombol'); ?>
<div style="width:90px;position: absolute;right: 0px;">
	<a href="<?= base_url('/admin/menu/satuan/satuan_add'); ?>">
		<li class="btn btn-block btn-warning btn-sm" active><i class="nav-icon fa fa-plus"></i> Add</li>
	</a>
</div>
<?= $this->endSection(); ?>

<?= $this->section('content'); ?>
<div class="card-body">
	<table id="example1" class="table table-bordered">
		<thead>
			<tr>
				<th style="width:30px;">No</th>
				<th>Satuan</th>
				<th style="width:80px;text-align: center;"> </th>
			</tr>
		</thead>
		<tbody>
			<?php $no = 1;
			foreach ($satuan as $row) : ?>
				<tr>
					<td><?= $no++; ?></td>
					<td><?= $row['satuan']; ?></td>
					<td>
						<a class="btn btn-info btn-circle btn-xs" href="<?= base_url('/admin/menu/satuan/satuan_edit/' . $row['id_satuan']); ?>">
							<i class="nav-icon fas fa-pen-alt"></i>
						</a>
						<a class="btn btn-danger btn-circle btn-xs" onclick="if(confirm('Apakah anda yakin ingin menghapus data ini ??')){location.href='<?= base_url('/admin/menu/satuan/hapus/' . $row['id_satuan']); ?>'}" href="#">
							<i class="nav-icon fas fa-trash-alt"></i>
						</a>
					</td>
				</tr>

			<?php endforeach; ?>
		</tbody>
	</table>
</div>
<?= $this->endSection(); ?>