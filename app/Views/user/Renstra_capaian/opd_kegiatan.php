<?= $this->extend('_layout/template'); ?>

<?= $this->section('stylesheet'); ?>
<link rel="stylesheet" href="<?= base_url('/toping/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') ?>">
<link rel="stylesheet" href="<?= base_url('/toping/plugins/datatables-rowgroup/css/rowGroup.bootstrap4.min.js') ?>">
<?= $this->endSection(); ?>

<?= $this->section('tombol'); ?>
<div>
	<a href="<?= base_url('/user/renstra_capaian/opd_capaian_kegiatan/import'); ?>">
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
					<div style="width: 120px;">Kode</div>
				</th>
				<th rowspan="2" class="align-middle">
					<div style="width: 700px;">Program / Kegiatan / Kegiatan Indikator</div>
				</th>
				<th rowspan="2"></th>
				<th rowspan="2"></th>
				<th rowspan="2"></th>
				<th rowspan="2"></th>
				<th rowspan="2"></th>
				<th rowspan="2" class="align-middle">
					<div style="width: 350px;">Sasaran Kegiatan</div>
				</th>
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
			<?php $no = 1;
			foreach ($opd_kegiatan as $rom) : ?>
				<?php $triwulan1 = $db->table('vw_renstra_capaian_kegiatan_keuangan')
					->selectsum('b1')
					->selectsum('b2')
					->selectsum('b3')
					->getWhere([
						'opd_program_n' => $rom['opd_program_n'],
						'opd_kegiatan_n' => $rom['opd_kegiatan_n'],
						// 'opd_indikator_kegiatan' => $rom['opd_indikator_kegiatan'],
						'opd_id' => user()->opd_id,
						'tahun' => $_SESSION['tahun'],
						'perubahan' => $_SESSION['perubahan'],
					])->getRowArray();
				?>
				<?php $triwulan2 = $db->table('vw_renstra_capaian_kegiatan_keuangan')
					->selectsum('b4')
					->selectsum('b5')
					->selectsum('b6')
					->getWhere([
						'opd_program_n' => $rom['opd_program_n'],
						'opd_kegiatan_n' => $rom['opd_kegiatan_n'],
						// 'opd_indikator_kegiatan' => $rom['opd_indikator_kegiatan'],
						'opd_id' => user()->opd_id,
						'tahun' => $_SESSION['tahun'],
						'perubahan' => $_SESSION['perubahan'],
					])->getRowArray();
				?>
				<?php $triwulan3 = $db->table('vw_renstra_capaian_kegiatan_keuangan')
					->selectsum('b7')
					->selectsum('b8')
					->selectsum('b9')
					->getWhere([
						'opd_program_n' => $rom['opd_program_n'],
						'opd_kegiatan_n' => $rom['opd_kegiatan_n'],
						// 'opd_indikator_kegiatan' => $rom['opd_indikator_kegiatan'],
						'opd_id' => user()->opd_id,
						'tahun' => $_SESSION['tahun'],
						'perubahan' => $_SESSION['perubahan'],
					])->getRowArray();
				?>
				<?php $triwulan4 = $db->table('vw_renstra_capaian_kegiatan_keuangan')
					->selectsum('b10')
					->selectsum('b11')
					->selectsum('b12')
					->getWhere([
						'opd_program_n' => $rom['opd_program_n'],
						'opd_kegiatan_n' => $rom['opd_kegiatan_n'],
						// 'opd_indikator_kegiatan' => $rom['opd_indikator_kegiatan'],
						'opd_id' => user()->opd_id,
						'tahun' => $_SESSION['tahun'],
						'perubahan' => $_SESSION['perubahan'],
					])->getRowArray();
				?>

				<tr>
					<td></td>
					<td class="text-wrap">
						<div style="padding-left: 40px;"><?= $rom['opd_indikator_kegiatan']; ?></div>
					</td>
					<td>[<?= $rom['id_program']; ?>]</td>
					<td>[PROGRAM] <?= $rom['opd_program_n']; ?></td>
					<td>[<?= $rom['id_kegiatan']; ?>]</td>
					<td><?= $rom['opd_kegiatan_n']; ?> </td>
					<td><?= $rom['opd_kegiatan_sasaran_n']; ?></td>
					<td></td>
					<td class="align-top text-center"><?= $rom['satuan']; ?></td>
					<td class="align-top text-center"><?= $rom['t_tahun']; ?></td>
					<td class="align-top text-center"><?= $rom['triwulan_1']; ?></td>
					<td></td>
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
					<td class="text-center align-top">
						<a class="btn btn-info btn-circle btn-xs" href="<?= base_url() . '/user/renstra_capaian/opd_capaian_kegiatan/opd_kegiatan_edit/' . $rom['id_opd_kegiatan']; ?>">
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
		bsCustomFileInput.init();
	});
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
				targets: [2, 3, 4, 5, 6, 12, 15, 18, 21]
			}],
			order: [
				[2, 'asc'],
				[4, 'asc']
			],
			rowGroup: {
				startRender: function(rows, group) {

					if (rows.data().pluck(2)[0] == group) {
						return $('<tr class="font-weight-bold" style="background-color: blanchedalmond;" />')
							.append('<td class="align-top">' + group + '</td>')
							.append('<td class="align-top text-wrap">' + rows.data().pluck(3)[0] + ' </td>')
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
					} else if (rows.data().pluck(4)[0] == group) {
						return $('<tr style="background: azure;" />')
							.append('<td class="align-top">' + group + '</td>')
							.append('<td class="text-wrap align-top">' + rows.data().pluck(5)[0] + '</td>')
							.append('<td class="text-wrap">' + rows.data().pluck(6)[0] + '</td>')
							.append('<td></td>')
							.append('<td></td>')
							.append('<td></td>')
							.append('<td class="align-top text-center">' + rows.data().pluck(12)[0] + '</td>')
							.append('<td></td>')
							.append('<td class="align-top text-center">' + rows.data().pluck(15)[0] + '</td>')
							.append('<td></td>')
							.append('<td class="align-top text-center">' + rows.data().pluck(18)[0] + '</td>')
							.append('<td></td>')
							.append('<td class="align-top text-center">' + rows.data().pluck(21)[0] + '</td>')
							.append('<td></td>');
					}
				},
				dataSrc: [2, 4]
			}
		});

	});
</script>
<?= $this->endSection(); ?>