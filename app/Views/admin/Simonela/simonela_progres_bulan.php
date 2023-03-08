<?= $this->extend('_layout/template'); ?>

<?= $this->section('stylesheet'); ?>
<link rel="stylesheet" href="<?= base_url('/toping/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') ?>">
<?= $this->endSection(); ?>

<?= $this->section('content'); ?>
<div class="card-body">
	<div class="row">
		<div class="col-md">
			<select class="form-control" disabled>
				<?php foreach ($opd as $row) : ?>
					<option <?= $_SESSION['opd_set'] == $row['id'] ? 'selected' : ''; ?>><?= $row['description']; ?></option>
				<?php endforeach; ?>
			</select>
		</div>
	</div><br>
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
				<th class="align-middle text-center" width="40px">No</th>
				<th class="align-middle text-wrap">
					<div style="width:350px;">Tahapan pekerjaan (fisik) yang sudah dilakukan</div>
				</th>
				<th class="align-middle">
					<div style="width:300px;">Faktor Penghambat</div>
				</th>
				<th class="align-middle">
					<div style="width:300px;">Faktor Pendukung</div>
				</th>
				<th class="align-middle">
					<div style="width:300px;"> Tindak lanjut</div>
				</th>
				<th class="align-middle text-wrap">
					<div style="width:200px;">Realisasi Keuangan Hingga Bulan <?= $nm; ?> (Rp)</div>
				</th>
				<th class="align-middle text-wrap">
					<div style="width:200px;">Realisasi Fisik Hingga Bulan <?= $nm; ?> (%)</div>
				</th>
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
				'tb_simonela_progres.opd_id' => $_SESSION['opd_set'],
				'tb_simonela_progres.tahun' => $_SESSION['tahun'],
				'tb_simonela_progres.perubahan' => $_SESSION['perubahan']
			])->getResultArray();
			foreach ($query as $row) : ?>
				<tr>
					<td class="text-center"><?= $no++; ?></td>
					<td class="align-top text-wrap"><?= $row['tahap_aktifitas']; ?></td>
					<td class="align-top text-wrap"><?= $row['faktor_penghambat']; ?></td>
					<td class="align-top text-wrap"><?= $row['faktor_pendukung']; ?></td>
					<td class="align-top text-wrap"><?= $row['rencana_tindak_lanjut']; ?></td>
					<td class="align-top"><?= $row['realisasi_keu']; ?></td>
					<td class="align-top"><?= $row['realisasi_fisik']; ?></td>
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