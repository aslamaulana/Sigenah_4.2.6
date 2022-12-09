<?= $this->extend('_layout/template'); ?>

<?= $this->section('stylesheet'); ?>
<link rel="stylesheet" href="<?= base_url('/toping/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') ?>">
<link rel="stylesheet" href="<?= base_url('/toping/plugins/datatables-rowgroup/css/rowGroup.bootstrap4.min.js') ?>">
<?= $this->endSection(); ?>

<?= $this->section('tombol'); ?>
<div style="width:90px;position: absolute;right: 0px;">
	<a href="<?= base_url('/admin/rpjmd/visi/visi_add'); ?>">
		<li class="btn btn-block btn-warning btn-sm" active><i class="nav-icon fa fa-plus"></i> Add</li>
	</a>
</div>
<?= $this->endSection(); ?>

<?= $this->section('content'); ?>
<div class="card-body">
	<table id="example1" class="table table-bordered">
		<thead>
			<tr>
				<th class="text-center" width="60px">Kode</th>
				<th>Visi / Misi</th>
				<th></th>
				<th></th>
				<th class="text-center" width="80px">Aksi</th>
			</tr>
		</thead>
		<tfoot>
			<tr>
				<th class="text-center">Kode</th>
				<th>Visi / Misi</th>
				<th></th>
				<th></th>
				<th class="text-center">Aksi</th>
			</tr>
		</tfoot>
		<tbody>
			<?php $nomor = 1;
			foreach ($visi as $row) : ?>
				<tr>
					<td><?= $row['kode_misi']; ?></td>
					<td style="padding-left: 40px;"><b>[MISI]</b> <?= $row['misi']; ?></td>
					<!-- --------------------------------------------------------- -->
					<td><?= $row['kode_visi']; ?></td>
					<td><b>[VISI]</b> <a href="<?= base_url() . '/admin/rpjmd/visi/misi_add/' . $row['id_visi']; ?>" title="add misi"><?= $row['visi']; ?></a></td>
					<!-- --------------------------------------------------------- -->
					<td class="text-center align-top">
						<a class="btn btn-info btn-circle btn-xs" href="<?= base_url() . '/admin/rpjmd/visi/misi_edit/' . $row['id_misi'] . '/' . $row['id_visi']; ?>">
							<i class="nav-icon fas fa-pen-alt"></i>
						</a>
						<a class="btn btn-danger btn-circle btn-xs" onclick="if(confirm('Apakah anda yakin ingin menghapus data ini ??')){location.href='<?= base_url() . '/admin/rpjmd/visi/misi_hapus/' . $row['id_misi']; ?>'}" href="#">
							<i class="nav-icon fas fa-trash-alt"></i>
						</a>
					</td>
					<td class="text-center">
						<a class="btn btn-info btn-circle btn-xs" href="<?= base_url() . '/admin/rpjmd/visi/visi_edit/' . $row['id_visi']; ?>">
							<i class="nav-icon fas fa-pen-alt"></i>
						</a>
						<a class="btn btn-danger btn-circle btn-xs" onclick="if(confirm('Apakah anda yakin ingin menghapus data ini ??')){location.href='<?= base_url() . '/admin/rpjmd/visi/visi_hapus/' . $row['id_visi']; ?>'}" href="#">
							<i class="nav-icon fas fa-trash-alt"></i>
						</a>
					</td>
				</tr>
			<?php endforeach; ?>
		</tbody>
	</table>
</div>
<?= $this->endSection(); ?>

<?= $this->section('Javascript'); ?>
<!-- DataTables  & Plugins -->
<script src="<?= base_url('/toping/plugins/datatables/jquery.dataTables.min.js') ?>"></script>
<script src="<?= base_url('/toping/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') ?>"></script>
<script src="<?= base_url('/toping/plugins/datatables-rowgroup/js/dataTables.rowGroup.min.js') ?>"></script>
<script>
	$(function() {
		bsCustomFileInput.init();
	});
	$(function() {
		$("#example1").DataTable({
			"scrollX": true,
			"scrollY": '65vh',
			"scrollCollapse": true,
			"paging": true,
			"responsive": true,
			"autoWidth": false,
			"ordering": false,
			"lengthMenu": [
				[20, 40, 60, 100, -1],
				[20, 40, 60, 100, 'All']
			],
			columnDefs: [{
				visible: false,
				targets: [2, 3, 5]
			}],
			order: [
				[2, 'asc']
			],
			rowGroup: {
				startRender: function(rows, group) {
					if (rows.data().pluck(2)[0] == group) {
						return $('<tr class="font-weight-bold" style="background-color: blanchedalmond;" />')
							.append('<td class="align-top text-wrap font-weight-bold">' + group + '</td>')
							.append('<td>' + rows.data().pluck(3)[0] + '</td>')
							.append('<td class="text-center align-top">' + rows.data().pluck(5)[0] + '</td>');
					}
				},
				dataSrc: [2]
			}
		});
	});
</script>
<?= $this->endSection(); ?>