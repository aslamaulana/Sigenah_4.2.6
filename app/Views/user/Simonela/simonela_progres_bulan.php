<?= $this->extend('_layout/template'); ?>

<?= $this->section('stylesheet'); ?>
<link rel="stylesheet" href="<?= base_url('/toping/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') ?>">
<?= $this->endSection(); ?>

<?= $this->section('tombol'); ?>
<div style="width:90px;">
	<a href="<?= base_url('/user/simonela/simonela/progres_add/' . $id_ropk_keuangan . '/' . $b . '/' . $nm . '?keu=' . $_GET['keu'] . '&fis=' . $_GET['fis']); ?>">
		<li class="btn btn-block btn-warning btn-sm" active><i class="nav-icon fa fa-plus"></i> Add</li>
	</a>
</div>
<?= $this->endSection(); ?>

<?= $this->section('content'); ?>
<div class="card-body">
	<table class="table table-bordered">
		<tr>
			<th class="col-md-6">Kegiatan / Sub Kegiatan</th>
			<th style="width:30px;" rowspan="3">&nbsp;</th>
			<th class="col-md-6">Keluaran (indikator sub kegiatan)</th>
		</tr>
		<tr>
			<td><b>[KEGIATAN]</b> <?= $DT['rkpd_kegiatan_n']; ?></td>
			<td rowspan="2" class="align-top">
				<div style="display: inline-flex;">
					<li></li>
					<div><?= ' ' . $DT['rkpd_indikator_kegiatan_sub'] . ': ' . $DT['t_tahun'] . ' ' . $DT['satuan']; ?></div>
				</div><br>
				<div style="display: inline-flex;">
					<li></li>
					<div>Rp. <?= number_format($DT['rp_tahun'], 2, ',', '.'); ?></div>
				</div><br>
			</td>
		</tr>
		<tr>
			<td>
				<div style="padding-left:40px;">
					<b>[SUB KEGIATAN]</b> <?= $DT['rkpd_kegiatan_sub_n']; ?>
				</div>
			</td>
		</tr>
	</table><br>
	<table class="table table-bordered table-sm">
		<thead>
			<tr>
				<th rowspan="2" class="text-center align-middle">Bulan</th>
				<th class="text-center" colspan="2">Target</th>
			</tr>
			<tr>
				<th class="text-center">Keuangan (Rp)</th>
				<th class="text-center">Fisik (%)</th>
			</tr>
		</thead>
		<tr>
			<td class="text-center"><?= $nm; ?></td>
			<td class="text-center"><?= $_GET['keu']; ?></td>
			<td class="text-center"><?= $_GET['fis']; ?></td>
		</tr>
	</table>
	<p>&nbsp;</p>
	<table id="example1" class="table table-bordered display nowrap table-sm">
		<thead>
			<tr>
				<th class="text-center" width="40px">No</th>
				<th class="text-wrap">Tahapan pekerjaan (fisik) yang sudah dilakukan</th>
				<th class="align-middle">Faktor Penghambat</th>
				<th class="align-middle">Faktor Pendukung</th>
				<th class="align-middle">Rencana Tindak lanjut</th>
				<th class="text-wrap">Realisasi Keuangan Hingga Bulan <?= $nm; ?> (Rp)</th>
				<th class="text-wrap">Realisasi Fisik Hingga Bulan <?= $nm; ?> (%)</th>
				<th class="text-center" width="60px">Aksi</th>
			</tr>
		</thead>
		<tbody>
			<?php
			$no = 1;
			$query = $db->table('tb_simonela_progres')->getWhere([
				'tb_simonela_progres.kegiatan' => $DT['rkpd_kegiatan_n'],
				'tb_simonela_progres.kegiatan_sub' => $DT['rkpd_kegiatan_sub_n'],
				'tb_simonela_progres.indikator_kegiatan_sub' => $DT['rkpd_indikator_kegiatan_sub'],
				'tb_simonela_progres.bulan' => $b,
				//'tb_simonela_progres.ropk_tahap' => 'Persiapan',
				'tb_simonela_progres.opd_id' => user()->opd_id,
				'tb_simonela_progres.tahun' => $_SESSION['tahun'],
				'tb_simonela_progres.perubahan' => $_SESSION['perubahan']
			])->getResultArray();
			foreach ($query as $row) : ?>
				<tr>
					<td class="text-center"><?= $no++; ?></td>
					<td class="align-top"><?= $row['tahap_aktifitas']; ?></td>
					<td class="align-top"><?= $row['faktor_penghambat']; ?></td>
					<td class="align-top"><?= $row['faktor_pendukung']; ?></td>
					<td class="align-top"><?= $row['rencana_tindak_lanjut']; ?></td>
					<td class="align-top"><?= $row['realisasi_keu']; ?></td>
					<td class="align-top"><?= $row['realisasi_fisik']; ?></td>
					<td class="text-center align-top">
						<a class="btn btn-info btn-circle btn-xs" href="<?= base_url('/user/simonela/simonela/progres_edit/' . $id_ropk_keuangan . '/' . $row['id_simonela_progres'] . '/' . $b . '/' . $nm . '?keu=' . $_GET['keu'] . '&fis=' . $_GET['fis']); ?>">
							<i class="nav-icon fas fa-pen-alt"></i>
						</a>
						<a class="btn btn-danger btn-circle btn-xs" onclick="if(confirm('Apakah anda yakin ingin menghapus data ini ??')){location.href='<?= base_url() . '/user/simonela/simonela/progres_hapus/' . $row['id_simonela_progres']; ?>'}" href="#">
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
			"searching": false,
			"info": false,
			"lengthMenu": [
				[20, 40, 60, 100, -1],
				[20, 40, 60, 100, 'All']
			],
		});
	});
</script>
<?= $this->endSection(); ?>