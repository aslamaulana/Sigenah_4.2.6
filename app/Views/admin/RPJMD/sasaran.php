<?= $this->extend('_layout/template'); ?>

<?= $this->section('stylesheet'); ?>
<link rel="stylesheet" href="<?= base_url('/toping/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') ?>">
<link rel="stylesheet" href="<?= base_url('/toping/plugins/datatables-rowgroup/css/rowGroup.bootstrap4.min.js') ?>">
<?= $this->endSection(); ?>

<?= $this->section('tombol'); ?>
<div style="width:90px;position: absolute;right: 0px;">
	<a href="<?= base_url('/admin/rpjmd/sasaran/sasaran_add'); ?>">
		<li class="btn btn-block btn-warning btn-sm" active><i class="nav-icon fa fa-plus"></i> Add</li>
	</a>
</div>
<?= $this->endSection(); ?>

<?= $this->section('content'); ?>
<div class="card-body">
	<table id="example1" class="table table-bordered display nowrap" cellspacing="0">
		<thead>
			<tr>
				<th class="text-center" width="40px">Kode</th>
				<th>
					<div style="width: 750px;">Tujuan / Sasaran / Sasaran Indikator</div>
				</th>
				<th></th>
				<th></th>
				<th></th>
				<th></th>
				<?php foreach ($tahunA as $row) : ?>
					<th class="text-center" width="60px"><?= $row['tahun']; ?></th>
				<?php endforeach; ?>
				<th class="text-center" width="60px">Aksi</th>
			</tr>
		</thead>
		<tbody>
			<?php $querz = $db->table('tb_rpjmd_sasaran')
				->distinct('tb_rpjmd_tujuan.kode_tujuan, tb_rpjmd_sasaran.*')
				->select('tb_rpjmd_tujuan.kode_tujuan, tb_rpjmd_sasaran.*')
				->join('tb_rpjmd_tujuan', 'tb_rpjmd_sasaran.tujuan_n = tb_rpjmd_tujuan.tujuan', 'Left')->get()->getResultArray();
			foreach ($querz as $rom) : ?>
				<tr>
					<td></td>
					<td class="align-top" style=" padding-left: 40px;"><?= $rom['indikator_sasaran']; ?></td>
					<!-- --------------------------------------------------------- -->
					<td class="align-top"><?= $rom['kode_sasaran']; ?></td>
					<td class="align-top" style="padding-left: 20px;">[SASARAN] <?= '<a href="/admin/rpjmd/sasaran/sasaran_indik_add?p=' . $rom['sasaran'] . '&k=' . $rom['kode_sasaran'] . '&m=' . $rom['tujuan_n'] . '" title="Add Indikator Sasaran">' . $rom['sasaran'] . '</a>'; ?></td>
					<!-- --------------------------------------------------------- -->
					<td class="font-weight-bold"><?= $rom['kode_tujuan']; ?></td>
					<td class="text-justify font-weight-bold">[TUJUAN] <?= $rom['tujuan_n']; ?></td>
					<!-- --------------------------------------------------------- -->
					<td class="align-top text-center"><?= $rom['t_2021'] . ' ' . $rom['satuan']; ?></td>
					<td class="align-top text-center"><?= $rom['t_2022'] . ' ' . $rom['satuan']; ?></td>
					<td class="align-top text-center"><?= $rom['t_2023'] . ' ' . $rom['satuan']; ?></td>
					<td class="align-top text-center"><?= $rom['t_2024'] . ' ' . $rom['satuan']; ?></td>
					<td class="align-top text-center"><?= $rom['t_2025'] . ' ' . $rom['satuan']; ?></td>
					<td class="align-top text-center"><?= $rom['t_2026'] . ' ' . $rom['satuan']; ?></td>
					<td class="text-center align-top">
						<a class="btn btn-info btn-circle btn-xs" href="<?= base_url() . '/admin/rpjmd/sasaran/sasaran_indik_edit/' . $rom['id_sasaran']; ?>">
							<i class="nav-icon fas fa-pen-alt"></i>
						</a>
						<a class="btn btn-danger btn-circle btn-xs" onclick="if(confirm('Apakah anda yakin ingin menghapus data ini ??')){location.href='<?= base_url() . '/admin/rpjmd/sasaran/sasaran_hapus/' . $rom['id_sasaran']; ?>'}" href="#">
							<i class="nav-icon fas fa-trash-alt"></i>
						</a>
					</td>
					<!-- --------------------------------------------------------- -->
					<td class="text-center align-top">
						<a class="btn btn-info btn-circle btn-xs" href="<?= base_url() . '/admin/rpjmd/sasaran/sasaran_edit?p=' . $rom['sasaran'] . '&k=' . $rom['kode_sasaran'] . '&m=' . $rom['tujuan_n']; ?>">
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
				targets: [2, 3, 4, 5, 13]
			}],
			order: [
				[2, 'asc'],
				[4, 'asc']
			],
			rowGroup: {
				startRender: function(rows, group) {

					if (rows.data().pluck(4)[0] == group) {
						return $('<tr class="font-weight-bold" style="background-color: blanchedalmond;" />')
							.append('<td class="align-top">' + group + '</td>')
							.append('<td class="align-top text-wrap">' + rows.data().pluck(5)[0] + '</td>')
							.append('<td></td>')
							.append('<td></td>')
							.append('<td></td>')
							.append('<td></td>')
							.append('<td></td>')
							.append('<td></td>')
							.append('<td></td>');
					} else if (rows.data().pluck(2)[0] == group) {

						return $('<tr style="background: azure;" />')
							.append('<td class="align-top">' + group + '</td>')
							.append('<td class="align-top text-wrap">' + rows.data().pluck(3)[0] + '</td>')
							.append('<td></td>')
							.append('<td></td>')
							.append('<td></td>')
							.append('<td></td>')
							.append('<td></td>')
							.append('<td></td>')
							.append('<td class="align-top text-center">' + rows.data().pluck(13)[0] + '</td>');
					}
				},
				dataSrc: [4, 2]
			},
		});
	});
</script>
<?= $this->endSection(); ?>