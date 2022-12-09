<?= $this->extend('_layout/template'); ?>

<?= $this->section('stylesheet'); ?>
<link rel="stylesheet" href="<?= base_url('/toping/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') ?>">
<link rel="stylesheet" href="<?= base_url('/toping/plugins/datatables-rowgroup/css/rowGroup.bootstrap4.min.js') ?>">
<?= $this->endSection(); ?>

<?= $this->section('tombol'); ?>
<?php if (menu('renstra')->kunci == 'tidak') { ?>
	<div>
		<a href="<?= base_url('/user/renstra_capaian/opd_capaian_sasaran/import'); ?>">
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
	<table id="example1" class="table table-bordered display nowrap table-sm">
		<thead>
			<tr>
				<th rowspan="2" class="text-center align-middle">
					<div style="width: 80px;">Kode</div>
				</th>
				<th rowspan="2" class="align-middle">
					<div style="width: 600px;">Sasaran Pemda / Sasaran / Sasaran Indikator</div>
				</th>
				<!-- ------------------------------------------------------------------------ -->
				<th rowspan="2"></th>
				<th rowspan="2"></th>
				<!-- ------------------------------------------------------------------------ -->
				<th rowspan="2"></th>
				<th rowspan="2"></th>
				<th rowspan="2"></th>
				<!-- ------------------------------------------------------------------------ -->
				<th rowspan="2" class="text-center align-middle">
					<div style="width: 350px; margin:auto;">Tujuan OPD</div>
				</th>
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
			<?php foreach ($sasaran as $rom) : ?>
				<tr>
					<td></td>
					<td>
						<div style="padding-left: 40px;"><?= $rom['opd_indikator_sasaran']; ?></div>
					</td>
					<td><?= $rom['kode_sasaran']; ?></td>
					<td>[SASARAN RPJMD] <?= $rom['rpjmd_sasaran_n']; ?></td>
					<td><?= $rom['opd_kode_sasaran']; ?></td>
					<td>
						<div style="padding-left: 20px;">[SASARAN] <?= $rom['opd_sasaran']; ?></div>
					</td>
					<td class="align-top  text-wrap"><?= '[' . $rom['opd_kode_tujuan'] . '] ' . $rom['opd_tujuan_n']; ?> </td>
					<td></td>
					<td class="align-top text-center"><?= $rom['satuan']; ?></td>
					<td class="align-top text-center"><?= $rom['t_tahun']; ?></td>
					<td class="align-top text-center"><?= $rom['triwulan_1']; ?></td>
					<td class="align-top text-center"><?= $rom['triwulan_2']; ?></td>
					<td class="align-top text-center"><?= $rom['triwulan_3']; ?></td>
					<td class="align-top text-center"><?= $rom['triwulan_4']; ?></td>
					<td class="text-center align-top">
						<?php if (menu('renstra')->kunci == 'tidak') { ?>
							<a class="btn btn-info btn-circle btn-xs" href="<?= base_url() . '/user/renstra_capaian/opd_capaian_sasaran/opd_sasaran_edit/' . $rom['id_opd_sasaran']; ?>">
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
				targets: [2, 3, 4, 5, 6]
			}],
			order: [
				[3, 'asc'],
				[5, 'asc']
			],
			rowGroup: {

				startRender: function(rows, group) {

					if (rows.data().pluck(3)[0] == group) {
						return $('<tr class="font-weight-bold" style="background-color: blanchedalmond;" />')
							.append('<td>' + rows.data().pluck(2)[0] + '</td>')
							.append('<td class="align-top text-wrap font-weight-bold">' + group + '</td>')
							.append('<td></td>')
							.append('<td></td>')
							.append('<td></td>')
							.append('<td></td>')
							.append('<td></td>')
							.append('<td></td>')
							.append('<td></td>')
							.append('<td></td>');
					} else if (rows.data().pluck(5)[0] == group) {

						return $('<tr style="background: azure;" />')
							.append('<td class="align-top">' + rows.data().pluck(4)[0] + '</td>')
							.append('<td class="align-top text-wrap">' + group + '</td>')
							.append('<td class="align-top text-wrap">' + rows.data().pluck(6)[0] + '</td>')
							.append('<td></td>')
							.append('<td></td>')
							.append('<td></td>')
							.append('<td></td>')
							.append('<td></td>')
							.append('<td></td>')
							.append('<td></td>');
					}
				},
				dataSrc: [3, 5]
			}
		});
	});
</script>
<?= $this->endSection(); ?>