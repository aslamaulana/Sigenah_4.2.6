<?= $this->extend('_layout/template'); ?>

<?= $this->section('stylesheet'); ?>
<link rel="stylesheet" href="<?= base_url('/toping/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') ?>">
<link rel="stylesheet" href="<?= base_url('/toping/plugins/datatables-rowgroup/css/rowGroup.bootstrap4.min.js') ?>">
<?= $this->endSection(); ?>

<?= $this->section('tombol'); ?>
<?php if (menu('renstra')->kunci == 'tidak') { ?>
	<div>
		<a href="<?= base_url('/user/renstra_capaian/opd_capaian_program/import'); ?>">
			<li class="btn btn-block btn-success btn-sm" active><i class="nav-icon fa fa-file-excel"></i> Import</li>
		</a>
	</div>
<?php } else { ?>
	<div style="width:90px;">
		<a href="#">
			<li class="btn btn-block btn-danger btn-sm" active><i class="nav-icon fa fa-lock"></i></li>
		</a>
	</div>
<?php } ?>
<?= $this->endSection(); ?>

<?= $this->section('content'); ?>
<div class="card-body">
	<table id="example1" class="table table-bordered display nowrap table-sm" cellspacing="0">

		<thead>
			<tr>
				<th rowspan="2" class="align-middle">
					<div style="width: 700px;">Sasaran / Program / Program Indikator</div>
				</th>
				<!-- ------------------------------------------------------------------------ -->
				<th rowspan="2"></th>
				<th rowspan="2"></th>
				<!-- ------------------------------------------------------------------------ -->
				<th rowspan="2" class="text-center align-middle">
					<div style="width: 350px; margin:auto;">Sasaran Program</div>
				</th>
				<th rowspan="2"></th>
				<th rowspan="2" class="text-center align-middle">
					<div style="width: 110px; margin:auto;">Satuan</div>
				</th>
				<th colspan="5" class="text-center align-middle"><?= $_SESSION['tahun']; ?></th>
				<th rowspan="2" class="text-center align-middle" width="60px">Aksi</th>
			</tr>
			<tr>
				<th class="text-center">
					<div style="width: 120px; margin:auto;">Target</div>
				</th>
				<th class="text-center">
					<div style="width: 120px; margin:auto;">Triwulan 1</div>
				</th>
				<th class="text-center">
					<div style="width: 120px; margin:auto;">Triwulan 2</div>
				</th>
				<th class="text-center">
					<div style="width: 120px; margin:auto;">Triwulan 3</div>
				</th>
				<th class="text-center">
					<div style="width: 120px; margin:auto;">Triwulan 4</div>
				</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($opd_program as $rom) : ?>
				<tr>
					<td class="text-wrap">
						<div style="padding-left: 40px;"><?= $rom['opd_indikator_program']; ?></div>
					</td>
					<td>[SASARAN] <?= $rom['opd_sasaran_n']; ?></td>
					<td>
						<div style="padding-left: 20px;">[<?= $rom['id_program']; ?>] <?= $rom['opd_program_n']; ?></div>
					</td>
					<td></td>
					<td><?= $rom['opd_program_sasaran_n']; ?></td>
					<td class="align-top text-center"><?= $rom['satuan']; ?></td>
					<td class="align-top text-center"><?= $rom['t_tahun']; ?></td>
					<td class="align-top text-center"><?= $rom['triwulan_1']; ?></td>
					<td class="align-top text-center"><?= $rom['triwulan_2']; ?></td>
					<td class="align-top text-center"><?= $rom['triwulan_3']; ?></td>
					<td class="align-top text-center"><?= $rom['triwulan_4']; ?></td>
					<td style="text-align: center;">
						<?php if (menu('renstra')->kunci == 'tidak') { ?>
							<a class="btn btn-info btn-circle btn-xs" href="<?= base_url() . '/user/renstra_capaian/opd_capaian_program/opd_program_edit/' . $rom['id_opd_program']; ?>">
								<i class="nav-icon fas fa-pen-alt"></i>
							</a>
						<?php } else { ?>
							<a class="btn btn-danger btn-circle btn-xs">
								<i class="nav-icon fas fa-lock"></i>
							</a>
						<?php } ?>
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
				targets: [1, 2, 4]
			}],
			order: [
				[1, 'asc'],
				[2, 'asc']
			],
			rowGroup: {
				startRender: function(rows, group) {

					if (rows.data().pluck(1)[0] == group) {
						return $('<tr class="font-weight-bold" style="background-color: blanchedalmond;" />')
							.append('<td class="align-top text-wrap font-weight-bold">' + group + '</td>')
							.append('<td></td>')
							.append('<td></td>')
							.append('<td></td>')
							.append('<td></td>')
							.append('<td></td>')
							.append('<td></td>')
							.append('<td></td>')
							.append('<td></td>');
					} else if (rows.data().pluck(2)[0] == group) {

						return $('<tr style="background: azure;" />')
							.append('<td class="align-top text-wrap">' + group + '</td>')
							.append('<td class="text-wrap align-top">' + rows.data().pluck(4)[0] + '</td>')
							.append('<td></td>')
							.append('<td></td>')
							.append('<td></td>')
							.append('<td></td>')
							.append('<td></td>')
							.append('<td></td>')
							.append('<td></td>');
					}
				},
				dataSrc: [1, 2]
			}
		});
	});
</script>
<?= $this->endSection(); ?>