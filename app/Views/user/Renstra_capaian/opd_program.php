<?= $this->extend('_layout/template'); ?>

<?= $this->section('stylesheet'); ?>
<link rel="stylesheet" href="<?= base_url('/toping/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') ?>">
<link rel="stylesheet" href="<?= base_url('/toping/plugins/datatables-rowgroup/css/rowGroup.bootstrap4.min.js') ?>">
<?= $this->endSection(); ?>

<?= $this->section('tombol'); ?>
<div>
	<a href="<?= base_url('/user/renstra_capaian/opd_capaian_program/import'); ?>">
		<li class="btn btn-block btn-success btn-sm" active><i class="nav-icon fa fa-file-excel"></i> Import</li>
	</a>
</div>
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
				<th rowspan="2" class="text-center align-middle">
					<div style="width: 120px; margin:auto;">Target</div>
				</th>
				<th colspan="2" class="text-center">
					<div style="width: 120px; margin:auto;">Triwulan 1</div>
				</th>
				<th rowspan="2"></th>
				<th colspan="2" class="text-center">
					<div style="width: 120px; margin:auto;">Triwulan 2</div>
				</th>
				<th rowspan="2"></th>
				<th colspan="2" class="text-center">
					<div style="width: 120px; margin:auto;">Triwulan 3</div>
				</th>
				<th rowspan="2"></th>
				<th colspan="2" class="text-center">
					<div style="width: 120px; margin:auto;">Triwulan 4</div>
				</th>
				<th rowspan="2"></th>
				<th rowspan="2" class="text-center align-middle" width="60px">Aksi</th>
			</tr>
			<tr>
				<th class="text-center">
					<div style="width: 80px; margin:auto;">K</div>
				</th>
				<th class="text-center">
					<div style="width: 120px; margin:auto;">Rp.</div>
				</th>
				<th class="text-center">
					<div style="width: 80px; margin:auto;">K</div>
				</th>
				<th class="text-center">
					<div style="width: 120px; margin:auto;">Rp.</div>
				</th>
				<th class="text-center">
					<div style="width: 80px; margin:auto;">K</div>
				</th>
				<th class="text-center">
					<div style="width: 120px; margin:auto;">Rp.</div>
				</th>
				<th class="text-center">
					<div style="width: 80px; margin:auto;">K</div>
				</th>
				<th class="text-center">
					<div style="width: 120px; margin:auto;">Rp.</div>
				</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($opd_program as $rom) : ?>
				<?php $triwulan1 = $db->table('vw_renstra_capaian_program_keuangan')
					->selectsum('b1')
					->selectsum('b2')
					->selectsum('b3')
					->getWhere([
						'opd_sasaran_n' => $rom['opd_sasaran_n'],
						'opd_program_n' => $rom['opd_program_n'],
						// 'opd_indikator_program' => $rom['opd_indikator_program'],
						'opd_id' => user()->opd_id,
						'tahun' => $_SESSION['tahun'],
						'perubahan' => $_SESSION['perubahan'],
					])->getRowArray();
				?>
				<?php $triwulan2 = $db->table('vw_renstra_capaian_program_keuangan')
					->selectsum('b4')
					->selectsum('b5')
					->selectsum('b6')
					->getWhere([
						'opd_sasaran_n' => $rom['opd_sasaran_n'],
						'opd_program_n' => $rom['opd_program_n'],
						// 'opd_indikator_program' => $rom['opd_indikator_program'],
						'opd_id' => user()->opd_id,
						'tahun' => $_SESSION['tahun'],
						'perubahan' => $_SESSION['perubahan'],
					])->getRowArray();
				?>
				<?php $triwulan3 = $db->table('vw_renstra_capaian_program_keuangan')
					->selectsum('b7')
					->selectsum('b8')
					->selectsum('b9')
					->getWhere([
						'opd_sasaran_n' => $rom['opd_sasaran_n'],
						'opd_program_n' => $rom['opd_program_n'],
						// 'opd_indikator_program' => $rom['opd_indikator_program'],
						'opd_id' => user()->opd_id,
						'tahun' => $_SESSION['tahun'],
						'perubahan' => $_SESSION['perubahan'],
					])->getRowArray();
				?>
				<?php $triwulan4 = $db->table('vw_renstra_capaian_program_keuangan')
					->selectsum('b10')
					->selectsum('b11')
					->selectsum('b12')
					->getWhere([
						'opd_sasaran_n' => $rom['opd_sasaran_n'],
						'opd_program_n' => $rom['opd_program_n'],
						// 'opd_indikator_program' => $rom['opd_indikator_program'],
						'opd_id' => user()->opd_id,
						'tahun' => $_SESSION['tahun'],
						'perubahan' => $_SESSION['perubahan'],
					])->getRowArray();
				?>
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
					<td></td>
					<!-- 9 -->
					<td><?= number_format($triwulan1['b1'] + $triwulan1['b2'] + $triwulan1['b3'], 0, ',', '.'); ?></td>
					<td class="align-top text-center"><?= $rom['triwulan_2']; ?></td>
					<td></td>
					<td><?= number_format($triwulan2['b4'] + $triwulan2['b5'] + $triwulan2['b6'], 0, ',', '.'); ?></td>
					<td class="align-top text-center"><?= $rom['triwulan_3']; ?></td>
					<td></td>
					<td><?= number_format($triwulan3['b7'] + $triwulan3['b8'] + $triwulan3['b9'], 0, ',', '.'); ?></td>
					<td class="align-top text-center"><?= $rom['triwulan_4']; ?></td>
					<td></td>
					<td><?= number_format($triwulan4['b10'] + $triwulan4['b11'] + $triwulan4['b12'], 0, ',', '.'); ?></td>
					<td style="text-align: center;">
						<a class="btn btn-info btn-circle btn-xs" href="<?= base_url() . '/user/renstra_capaian/opd_capaian_program/opd_program_edit/' . $rom['id_opd_program']; ?>">
							<i class="nav-icon fas fa-pen-alt"></i>
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
				targets: [1, 2, 4, 9, 12, 15, 18]
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
							.append('<td class="align-top text-center">' + rows.data().pluck(9)[0] + '</td>')
							.append('<td></td>')
							.append('<td class="align-top text-center">' + rows.data().pluck(12)[0] + '</td>')
							.append('<td></td>')
							.append('<td class="align-top text-center">' + rows.data().pluck(15)[0] + '</td>')
							.append('<td></td>')
							.append('<td class="align-top text-center">' + rows.data().pluck(18)[0] + '</td>')
							.append('<td></td>');
					}
				},
				dataSrc: [1, 2]
			}
		});
	});
</script>
<?= $this->endSection(); ?>