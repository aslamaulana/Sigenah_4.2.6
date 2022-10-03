<?= $this->extend('_layout/template'); ?>

<?= $this->section('stylesheet'); ?>
<link rel="stylesheet" href="<?= base_url('/toping/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') ?>">
<link rel="stylesheet" href="<?= base_url('/toping/plugins/datatables-rowgroup/css/rowGroup.bootstrap4.min.js') ?>">
<?= $this->endSection(); ?>

<?= $this->section('tombol'); ?>
<?php if (menu('renstra')->kunci == 'tidak') { ?>
	<div style="width:90px;">
		<a href="<?= base_url('/user/renstra/opd_tujuan/opd_tujuan_add'); ?>">
			<li class="btn btn-block btn-warning btn-sm" active><i class="nav-icon fa fa-plus"></i> Add</li>
		</a>
	</div>
	<?php if ($_SESSION['perubahan'] == 'Perubahan') { ?>
		<div>
			<a onclick="if(confirm('Import langsung dari RENSTRA murni??')){location.href='<?= base_url() . '/user/renstra/opd_tujuan/import_tujuan'; ?>'}" href="#">
				<li class="btn btn-block btn-success btn-sm" active><i class="nav-icon fa fa-file-excel"></i> Import</li>
			</a>
		</div>
	<?php } ?>
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
	<table id="example1" class="table table-bordered display nowrap">
		<thead>
			<tr>
				<th class="text-center" width="40px">Kode</th>
				<th>
					<div style="width: 560px;">Tujuan / Tujuan Indikator</div>
				</th>
				<th></th>
				<th></th>
				<?php foreach ($tahunA as $row) : ?>
					<th class="text-center">
						<div style="width: 120px; margin:auto;"><?= $row['tahun']; ?></div>
					</th>
				<?php endforeach; ?>
				<th class="text-center" width="60px">Aksi</th>
			</tr>
		</thead>
		<tbody>
			<?php $nomor = 1;
			$querz = $db->table('tb_renstra_tujuan')->getWhere(['opd_id' => user()->opd_id, 'perubahan' => $_SESSION['perubahan']])->getResultArray();
			foreach ($querz as $rom) : ?>
				<tr>
					<td></td>
					<td class="align-top" style=" padding-left: 40px;"><?= $rom['opd_indikator_tujuan']; ?></td>
					<td><?= $rom['opd_kode_tujuan']; ?></td>
					<td>[TUJUAN] <?= '<a href="/user/renstra/opd_tujuan/opd_tujuan_indik_add?p=' . $rom['opd_tujuan'] . '&k=' . $rom['opd_kode_tujuan'] . '" title="Add Indikator Tujuan">' . $rom['opd_tujuan'] . '</a>'; ?></td>
					<td class="align-top text-center"><?= $rom['t_2021'] . ' ' . $rom['satuan']; ?></td>
					<td class="align-top text-center"><?= $rom['t_2022'] . ' ' . $rom['satuan']; ?></td>
					<td class="align-top text-center"><?= $rom['t_2023'] . ' ' . $rom['satuan']; ?></td>
					<td class="align-top text-center"><?= $rom['t_2024'] . ' ' . $rom['satuan']; ?></td>
					<td class="align-top text-center"><?= $rom['t_2025'] . ' ' . $rom['satuan']; ?></td>
					<td class="align-top text-center"><?= $rom['t_2026'] . ' ' . $rom['satuan']; ?></td>
					<td class="text-center align-top">
						<?php if (menu('renstra')->kunci == 'tidak') { ?>
							<a class="btn btn-info btn-circle btn-xs" href="<?= base_url() . '/user/renstra/opd_tujuan/opd_tujuan_indik_edit/' . $rom['id_opd_tujuan']; ?>">
								<i class="nav-icon fas fa-pen-alt"></i>
							</a>
							<a class="btn btn-danger btn-circle btn-xs" onclick="if(confirm('Apakah anda yakin ingin menghapus data ini ??')){location.href='<?= base_url() . '/user/renstra/opd_tujuan/opd_tujuan_hapus/' . $rom['id_opd_tujuan']; ?>'}" href="#">
								<i class="nav-icon fas fa-trash-alt"></i>
							</a>
						<?php } else { ?>
							<a class="btn btn-danger btn-circle btn-xs">
								<i class="nav-icon fas fa-lock"></i>
							</a>
						<?php } ?>
					</td>
					<td class="text-center align-top">
						<?php if (menu('renstra')->kunci == 'tidak') { ?>
							<a class="btn btn-info btn-circle btn-xs" href="<?= base_url() . '/user/renstra/opd_tujuan/opd_tujuan_edit?p=' . $rom['opd_tujuan'] . '&k=' . $rom['opd_kode_tujuan']; ?>">
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
				<?php if ($_SESSION['perubahan'] != 'Perubahan') {
					echo "targets: [2, 3, 11]";
				} else {
					echo "targets: [2, 3, 4, 11]";
				} ?>,
			}],
			order: [
				[2, 'asc'],
				[3, 'asc']
			],
			rowGroup: {

				startRender: function(rows, group) {

					if (rows.data().pluck(2)[0] == group) {
						return $('<tr class="font-weight-bold" style="background-color: blanchedalmond;" />')
							.append('<td>' + group + '</td>')
							.append('<td class="align-top text-wrap">' + rows.data().pluck(3)[0] + '</td>')
						<?php if ($_SESSION['perubahan'] != 'Perubahan') {
							echo ".append('<td></td>')";
						} ?>
							.append('<td></td>')
							.append('<td></td>')
							.append('<td></td>')
							.append('<td></td>')
							.append('<td></td>')
							.append('<td class="align-top text-center">' + rows.data().pluck(11)[0] + '</td>');

					}
				},
				dataSrc: [2, 3]
			}
		});
	});
</script>
<?= $this->endSection(); ?>