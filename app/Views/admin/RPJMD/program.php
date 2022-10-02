<?= $this->extend('_layout/template'); ?>

<?= $this->section('stylesheet'); ?>
<link rel="stylesheet" href="<?= base_url('/toping/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') ?>">
<link rel="stylesheet" href="<?= base_url('/toping/plugins/datatables-rowgroup/css/rowGroup.bootstrap4.min.js') ?>">
<?= $this->endSection(); ?>

<?= $this->section('tombol'); ?>
<div style="width:90px;">
	<a href="<?= base_url('/admin/rpjmd/program/program_add'); ?>" title="Tambah Program">
		<li class="btn btn-block btn-warning btn-sm" active><i class="nav-icon fa fa-plus"></i> Add</li>
	</a>
</div>
<div>
	<a href="<?= base_url('/admin/rpjmd/program/import'); ?>">
		<li class="btn btn-block btn-success btn-sm" active><i class="nav-icon fa fa-file-excel"></i> Import</li>
	</a>
</div>
<?= $this->endSection(); ?>

<?= $this->section('content'); ?>
<div class="card-body">
	<table id="example1" class="table table-bordered display nowrap" cellspacing="0">
		<thead>
			<tr>
				<th rowspan="2" class="text-center align-middle">
					<div style="width: 80px;">Kode</div>
				</th>
				<th rowspan="2" class="align-middle">
					<div style="width: 750px;">Sasaran / Program / Program Indikator</div>
				</th>
				<th rowspan="2" class="text-center align-middle">
					<div style="width: 240px;">Penanggung Jawab</div>
				</th>
				<th rowspan="2"></th>
				<th rowspan="2"></th>
				<th rowspan="2"></th>
				<th rowspan="2"></th>
				<th rowspan="2"></th>
				<?php foreach ($tahunA as $row) : ?>
					<th colspan="2" class="text-center align-middle"><?= $row['tahun']; ?></th>
				<?php endforeach; ?>
				<th rowspan="2" class="text-center align-middle">Aksi</th>
			</tr>
			<tr>
				<?php foreach ($tahunA as $row) : ?>
					<th class="text-center align-middle">Target</th>
					<th class="text-center align-middle">Pagu</th>
				<?php endforeach; ?>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($program as $rom) : ?>
				<tr>
					<td></td>
					<td class="text-wrap">
						<div style="padding-left: 40px;"> <?= $rom['indikator_program']; ?></div>
					</td>
					<td class=""></td>
					<!-- --------------------------------------------------------- -->
					<td><?= $rom['kode_program']; ?></td>
					<td>[PROGRAM] <?= '<a href="/admin/rpjmd/program/program_indik_add?u=' . $rom['urusan_90'] . '&b=' . $rom['bidang_90'] . '&p=' . $rom['program_90'] . '&s=' . $rom['sasaran_n'] . '&k=' . $rom['kode_program'] . '&o=' . $rom['opd_id'] . '" title="Add Indikator program">' . $rom['program_90'] . '</a>'; ?></td>
					<td><?= $rom['name']; ?></td>
					<!-- --------------------------------------------------------- -->
					<td><?= $rom['kode_sasaran']; ?></td>
					<td>[SASARAN] <?= $rom['sasaran_n']; ?></td>
					<!-- --------------------------------------------------------- -->
					<td class="align-top text-center"><?= $rom['t_2021'] . ' ' . $rom['satuan']; ?></td>
					<td class="align-top text-right"><?= number_format($rom['rp_2021'], 2, ',', '.'); ?></td>
					<td class="align-top text-center"><?= $rom['t_2022'] . ' ' . $rom['satuan']; ?></td>
					<td class="align-top text-right"><?= number_format($rom['rp_2022'], 2, ',', '.'); ?></td>
					<td class="align-top text-center"><?= $rom['t_2023'] . ' ' . $rom['satuan']; ?></td>
					<td class="align-top text-right"><?= number_format($rom['rp_2023'], 2, ',', '.'); ?></td>
					<td class="align-top text-center"><?= $rom['t_2024'] . ' ' . $rom['satuan']; ?></td>
					<td class="align-top text-right"><?= number_format($rom['rp_2024'], 2, ',', '.'); ?></td>
					<td class="align-top text-center"><?= $rom['t_2025'] . ' ' . $rom['satuan']; ?></td>
					<td class="align-top text-right"><?= number_format($rom['rp_2025'], 2, ',', '.'); ?></td>
					<td class="align-top text-center"><?= $rom['t_2026'] . ' ' . $rom['satuan']; ?></td>
					<td class="align-top text-right"><?= number_format($rom['rp_2026'], 2, ',', '.'); ?></td>
					<td class="align-top text-center">
						<a class="btn btn-info btn-circle btn-xs" href="<?= base_url() . '/admin/rpjmd/program/program_indik_edit/' . $rom['id_program']; ?>">
							<i class="nav-icon fas fa-pen-alt"></i>
						</a>
						<a class="btn btn-danger btn-circle btn-xs" onclick="if(confirm('Apakah anda yakin ingin menghapus data ini ??')){location.href='<?= base_url() . '/admin/rpjmd/program/program_indik_hapus/' . $rom['id_program']; ?>'}" href="#">
							<i class="nav-icon fas fa-trash-alt"></i>
						</a>
					</td>
					<!-- --------------------------------------------------------- -->
					<td>
						<a class="btn btn-info btn-circle btn-xs" href="<?= base_url() . '/admin/rpjmd/program/program_edit?u=' . $rom['urusan_90'] . '&b=' . $rom['bidang_90'] . '&p=' . $rom['program_90'] . '&s=' . $rom['sasaran_n'] . '&k=' . $rom['kode_program'] . '&o=' . $rom['opd_id']; ?>">
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
				// targets: [1, 2, 3, 27]
				targets: [3, 4, 5, 6, 7, 21]
			}],
			order: [
				[6, 'asc'],
				[3, 'asc']
			],
			rowGroup: {
				startRender: function(rows, group) {

					if (rows.data().pluck(6)[0] == group) {
						return $('<tr class="font-weight-bold" style="background-color: blanchedalmond;" />')
							.append('<td class="align-top">' + group + '</td>')
							.append('<td class="align-top text-wrap">' + rows.data().pluck(7)[0] + '</td>')
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
							.append('<td></td>')
							.append('<td></td>')
							.append('<td></td>');
					} else if (rows.data().pluck(3)[0] == group) {

						return $('<tr style="background: azure;" />')
							.append('<td class="align-top">' + group + '</td>')
							.append('<td class="align-top text-wrap">' + rows.data().pluck(4)[0] + '</td>')
							.append('<td class="align-top text-center">' + rows.data().pluck(5)[0] + '</td>')
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
							.append('<td></td>')
							.append('<td class="align-top text-center">' + rows.data().pluck(21)[0] + '</td>');
					}
				},
				dataSrc: [6, 3]
			},
		});
	});
</script>
<?= $this->endSection(); ?>