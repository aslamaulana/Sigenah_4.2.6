<?= $this->extend('_layout/template'); ?>

<?= $this->section('stylesheet'); ?>
<link rel="stylesheet" href="<?= base_url('/toping/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') ?>">
<link rel="stylesheet" href="<?= base_url('/toping/plugins/datatables-rowgroup/css/rowGroup.bootstrap4.min.js') ?>">
<?= $this->endSection(); ?>

<?= $this->section('tombol'); ?>
<div style="width:90px;position: absolute;right: 0px;">
	<a href="<?= base_url('/admin/rpjmd/strategi/strategi_add'); ?>">
		<li class="btn btn-block btn-warning btn-sm" active><i class="nav-icon fa fa-plus"></i> Add</li>
	</a>
</div>
<?= $this->endSection(); ?>

<?= $this->section('content'); ?>
<div class="card-body">
	<table id="example1" class="table table-bordered display nowrap" cellspacing="0">
		<thead>
			<tr>
				<th class="text-center">
					<div style="width: 80px;">Kode</div>
				</th>
				<th>Sasaran / strategi</th>
				<th></th>
				<th></th>
				<th class="text-center" width="60px">Aksi</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($strategi as $rol) : ?>
				<tr>
					<td></td>
					<td>
						<div style="padding-left: 40px;"><?= $rol['strategi']; ?></div>
					</td>
					<!-- --------------------------------------------------------- -->
					<td class="align-top font-weight-bold"><?= $rol['kode_sasaran']; ?></td>
					<td class="align-top font-weight-bold">[SASARAN] <?= $rol['sasaran_n']; ?></td>
					<!-- --------------------------------------------------------- -->
					<td class="text-center">
						<a class="btn btn-info btn-circle btn-xs" href="<?= base_url() . '/admin/rpjmd/strategi/strategi_edit/' . $rol['id_strategi']; ?>">
							<i class="nav-icon fas fa-pen-alt"></i>
						</a>
						<a class="btn btn-danger btn-circle btn-xs" onclick="if(confirm('Apakah anda yakin ingin menghapus data ini ??')){location.href='<?= base_url() . '/admin/rpjmd/strategi/strategi_hapus/' . $rol['id_strategi']; ?>'}" href="#">
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
		$("#example1").DataTable({
			"scrollX": true,
			"scrollY": '65vh',
			"scrollCollapse": true,
			"paging": true,
			"responsive": false,
			"autoWidth": false,
			"ordering": false,
			"lengthMenu": [
				[20, 40, 60, 100, -1],
				[20, 40, 60, 100, 'All']
			],
			columnDefs: [{
				visible: false,
				targets: [2, 3]
			}],
			order: [
				[2, 'asc']
			],
			rowGroup: {
				startRender: function(rows, group) {

					if (rows.data().pluck(2)[0] == group) {
						return $('<tr class="font-weight-bold" style="background-color: blanchedalmond;" />')
							.append('<td class="align-top">' + group + '</td>')
							.append('<td class="align-top text-wrap">' + rows.data().pluck(3)[0] + '</td>')
							.append('<td></td>');
					}
				},
				dataSrc: [2]
			},
		});
	});
</script>
<?= $this->endSection(); ?>