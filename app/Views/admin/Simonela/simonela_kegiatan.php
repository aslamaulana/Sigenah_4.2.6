<?= $this->extend('_layout/template'); ?>

<?= $this->section('stylesheet'); ?>
<link rel="stylesheet" href="<?= base_url('/toping/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') ?>">
<?= $this->endSection(); ?>

<?= $this->section('content'); ?>
<div class="card-body">
	<table id="example1" class="table table-bordered display nowrap table-hover table-sm">
		<thead>
			<tr>
				<th class="text-center" width="30px">No</th>
				<th> Kegiatan / Sub Kegiatan </th>
				<th class="text-center">
					<div style="width:100px; margin:auto;">Aksi</div>
				</th>
			</tr>
		</thead>
		<tfoot>
			<tr>
				<th class="text-center">No</th>
				<th>Kegiatan / Sub Kegiatan</th>
				<th class="text-center">Aksi</th>
			</tr>
		</tfoot>
		<tbody>
			<?php
			$nomor = 1;
			foreach ($program_kegiatan as $rol) : ?>
				<tr class="font-weight-bold" style="background-color: blanchedalmond;">
					<td class="text-center"><?= $nomor++; ?></td>
					<td class="text-wrap align-top"><?= $rol['rkpd_program_n']; ?> </td>
					<td style="text-align: center;">
						<a class="btn btn-info btn-circle btn-xs" href="<?= base_url() . '/user/simonela/simonela/program_progres/' . $rol['rkpd_program_n']; ?>">
							<i class="nav-icon fas fa-chart-bar"> Progres</i>
						</a>
					</td>
				</tr>
				<?php $query = $db->table('tb_ropk_keuangan_rkpd_kegiatan_sub')
					->select('set_kegiatan_90.id_kegiatan, tb_rkpd_kegiatan.rkpd_kegiatan_n')
					->distinct('set_kegiatan_90.id_kegiatan, tb_rkpd_kegiatan.rkpd_kegiatan_n')
					->join('tb_rkpd_kegiatan', 'tb_ropk_keuangan_rkpd_kegiatan_sub.rkpd_kegiatan_n = tb_rkpd_kegiatan.rkpd_kegiatan_n AND tb_ropk_keuangan_rkpd_kegiatan_sub.opd_id = tb_rkpd_kegiatan.opd_id AND tb_ropk_keuangan_rkpd_kegiatan_sub.perubahan = tb_rkpd_kegiatan.perubahan AND tb_ropk_keuangan_rkpd_kegiatan_sub.tahun = tb_rkpd_kegiatan.tahun', 'left')
					->join('tb_rkpd_program', 'tb_rkpd_kegiatan.rkpd_program_n = tb_rkpd_program.rkpd_program_n AND tb_rkpd_kegiatan.opd_id = tb_rkpd_program.opd_id AND tb_rkpd_kegiatan.tahun = tb_rkpd_program.tahun AND tb_rkpd_kegiatan.perubahan = tb_rkpd_program.perubahan', 'left')
					->join('set_kegiatan_90', 'tb_rkpd_kegiatan.rkpd_kegiatan_n = set_kegiatan_90.kegiatan', 'left')
					->getWhere([
						'tb_rkpd_kegiatan.rkpd_program_n' => $rol['rkpd_program_n'],
						'tb_ropk_keuangan_rkpd_kegiatan_sub.opd_id' => user()->opd_id,
						'tb_ropk_keuangan_rkpd_kegiatan_sub.tahun' => $_SESSION['tahun'],
						'tb_ropk_keuangan_rkpd_kegiatan_sub.perubahan' => $_SESSION['perubahan']
					])->getResultArray();

				foreach ($query as $ros) : ?>
					<tr>
						<td class="align-top"><?= $ros['id_kegiatan']; ?></td>
						<td class="text-wrap align-top"> <?= $ros['rkpd_kegiatan_n']; ?> </td>
						<td style="text-align: center;">
							<a class="btn btn-info btn-circle btn-xs" href="<?= base_url() . '/user/simonela/simonela/kegiatan_progres/' . $ros['rkpd_kegiatan_n']; ?>">
								<i class="nav-icon fas fa-chart-bar"> Progres</i>
							</a>
						</td>
					</tr>

				<?php endforeach; ?>
			<?php endforeach; ?>
		</tbody>
	</table>
</div>
<?= $this->endSection(); ?>

<?= $this->section('Javascript'); ?>
<!-- DataTables  & Plugins -->
<script src="<?= base_url('/toping/plugins/datatables/jquery.dataTables.min.js') ?>"></script>
<script src="<?= base_url('/toping/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') ?>"></script>
<script>
	$(function() {
		bsCustomFileInput.init();
	});
	$(function() {
		$("#example1").DataTable({
			"scrollX": true,
			"scrollY": '65vh',
			"scrollCollapse": true,
			"paging": false,
			"responsive": true,
			"autoWidth": false,
			"ordering": false,
			"lengthMenu": [
				[20, 40, 60, 100, -1],
				[20, 40, 60, 100, 'All']
			]
		});

		$('#example2').DataTable({
			"paging": true,
			"lengthChange": false,
			"searching": false,
			"ordering": true,
			"info": true,
			"autoWidth": false,
			"responsive": true,
		});
	});
</script>

<?= $this->endSection(); ?>