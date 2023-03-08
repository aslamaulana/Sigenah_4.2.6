<?= $this->extend('_layout/template'); ?>

<?= $this->section('stylesheet'); ?>
<link rel="stylesheet" href="<?= base_url('/toping/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') ?>">
<?= $this->endSection(); ?>

<?= $this->section('tombol'); ?>
<div style="width:80px;">
	<a href="<?= base_url('admin/simonela/simonela/progres_grafik/' . $DT['id_ropk_keuangan_rkpd_kegiatan_sub']); ?>">
		<li class="btn btn-block btn-danger btn-sm" active><i class="nav-icon fa fa-chart-bar"></i> Grafik</li>
	</a>
</div>
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
					<div>Rp. <?= (float) $DT['rp_tahun'] == $DT['rp_tahun'] ? number_format($DT['rp_tahun'], 2, ',', '.') : "ERROR"; ?></div>
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
	<table id="example1" class="table table-bordered display nowrap table-sm">
		<thead>
			<tr>
				<th rowspan="2" class="text-center align-middle" width="40px">Bulan</th>
				<th rowspan="2" class="text-center align-middle">
					<div style="width:350px;">Tahapan Aktifitas</div>
				</th>
				<th rowspan="2" class="text-center align-middle">
					<div style="width:300px;">Faktor Penghambat</div>
				</th>
				<th rowspan="2" class="text-center align-middle">
					<div style="width:300px;">Faktor Pendukung</div>
				</th>
				<th rowspan="2" class="text-center align-middle">
					<div style="width:300px;">Rencana Tindak Lanjut</div>
				</th>
				<th class="text-center" colspan="2">Target</th>
				<!-- <th class="text-center" colspan="2">Target Dikurangi Efisiensi</th> -->
				<th class="text-center" colspan="2">Realisasi</th>
				<th class="text-center" colspan="2">Konsistensi (%)</th>
				<th class="text-center" colspan="2">Deviasi</th>
				<th rowspan="2" class="text-center align-middle">Tanggal Proses</th>
				<th rowspan="2" class="text-center align-middle">Status</th>
				<th rowspan="2" class="text-center align-middle" style="width: 90px;">Aksi</th>
				<th rowspan="2" class="text-center align-middle" style="width: 90px;">Aksi</th>
			</tr>
			<tr>
				<th class="text-center">Keu</th>
				<th class="text-center">Fisik</th>
				<!-- <th class="text-center">Keu</th>
				<th class="text-center">Fisik</th> -->
				<th class="text-center">Keu</th>
				<th class="text-center">Fisik</th>
				<th class="text-center">Keu</th>
				<th class="text-center">Fisik</th>
				<th class="text-center">Keu</th>
				<th class="text-center">Fisik</th>
			</tr>
		</thead>
		<?php $keuangan = $db->table('tb_ropk_keuangan')->getWhere([
			'tb_ropk_keuangan.rkpd_kegiatan' => $DT['rkpd_kegiatan_n'],
			'tb_ropk_keuangan.rkpd_kegiatan_sub' => $DT['rkpd_kegiatan_sub_n'],
			'tb_ropk_keuangan.rkpd_indikator_kegiatan_sub' => $DT['rkpd_indikator_kegiatan_sub'],
			'tb_ropk_keuangan.opd_id' => $_SESSION['opd_set'],
			'tb_ropk_keuangan.tahun' => $_SESSION['tahun'],
			'tb_ropk_keuangan.perubahan' => $_SESSION['perubahan']
		])->getResultArray();
		foreach ($keuangan as $ros) {
			isset($ros['ropk_bobot_acuan']) ? $acu[] = ($ros['ropk_bobot_acuan']) : $acu[] = ['0'];
			isset($ros['b1']) ? $keu1[] = ($ros['b1']) : $keu1[] = ['0'];
			isset($ros['b2']) ? $keu2[] = ($ros['b2']) : $keu2[] = ['0'];
			isset($ros['b3']) ? $keu3[] = ($ros['b3']) : $keu3[] = ['0'];
			isset($ros['b4']) ? $keu4[] = ($ros['b4']) : $keu4[] = ['0'];
			isset($ros['b5']) ? $keu5[] = ($ros['b5']) : $keu5[] = ['0'];
			isset($ros['b6']) ? $keu6[] = ($ros['b6']) : $keu6[] = ['0'];
			isset($ros['b7']) ? $keu7[] = ($ros['b7']) : $keu7[] = ['0'];
			isset($ros['b8']) ? $keu8[] = ($ros['b8']) : $keu8[] = ['0'];
			isset($ros['b9']) ? $keu9[] = ($ros['b9']) : $keu9[] = ['0'];
			isset($ros['b10']) ? $keu10[] = ($ros['b10']) : $keu10[] = ['0'];
			isset($ros['b11']) ? $keu11[] = ($ros['b11']) : $keu11[] = ['0'];
			isset($ros['b12']) ? $keu12[] = ($ros['b12']) : $keu12[] = ['0'];
		}
		$bb1 = !empty($keu1) ? array_sum($keu1) : '0';
		$bb2 = (!empty($keu1) ? array_sum($keu1) : '0') + (!empty($keu2) ? array_sum($keu2) : '0');
		$bb3 = (!empty($keu1) ? array_sum($keu1) : '0') + (!empty($keu2) ? array_sum($keu2) : '0') + (!empty($keu3) ? array_sum($keu3) : '0');
		$bb4 = (!empty($keu1) ? array_sum($keu1) : '0') + (!empty($keu2) ? array_sum($keu2) : '0') + (!empty($keu3) ? array_sum($keu3) : '0') + (!empty($keu4) ? array_sum($keu4) : '0');
		$bb5 = (!empty($keu1) ? array_sum($keu1) : '0') + (!empty($keu2) ? array_sum($keu2) : '0') + (!empty($keu3) ? array_sum($keu3) : '0') + (!empty($keu4) ? array_sum($keu4) : '0') + (!empty($keu5) ? array_sum($keu5) : '0');
		$bb6 = (!empty($keu1) ? array_sum($keu1) : '0') + (!empty($keu2) ? array_sum($keu2) : '0') + (!empty($keu3) ? array_sum($keu3) : '0') + (!empty($keu4) ? array_sum($keu4) : '0') + (!empty($keu5) ? array_sum($keu5) : '0') + (!empty($keu6) ? array_sum($keu6) : '0');
		$bb7 = (!empty($keu1) ? array_sum($keu1) : '0') + (!empty($keu2) ? array_sum($keu2) : '0') + (!empty($keu3) ? array_sum($keu3) : '0') + (!empty($keu4) ? array_sum($keu4) : '0') + (!empty($keu5) ? array_sum($keu5) : '0') + (!empty($keu6) ? array_sum($keu6) : '0') + (!empty($keu7) ? array_sum($keu7) : '0');
		$bb8 = (!empty($keu1) ? array_sum($keu1) : '0') + (!empty($keu2) ? array_sum($keu2) : '0') + (!empty($keu3) ? array_sum($keu3) : '0') + (!empty($keu4) ? array_sum($keu4) : '0') + (!empty($keu5) ? array_sum($keu5) : '0') + (!empty($keu6) ? array_sum($keu6) : '0') + (!empty($keu7) ? array_sum($keu7) : '0') + (!empty($keu8) ? array_sum($keu8) : '0');
		$bb9 = (!empty($keu1) ? array_sum($keu1) : '0') + (!empty($keu2) ? array_sum($keu2) : '0') + (!empty($keu3) ? array_sum($keu3) : '0') + (!empty($keu4) ? array_sum($keu4) : '0') + (!empty($keu5) ? array_sum($keu5) : '0') + (!empty($keu6) ? array_sum($keu6) : '0') + (!empty($keu7) ? array_sum($keu7) : '0') + (!empty($keu8) ? array_sum($keu8) : '0') + (!empty($keu9) ? array_sum($keu9) : '0');
		$bb10 = (!empty($keu1) ? array_sum($keu1) : '0') + (!empty($keu2) ? array_sum($keu2) : '0') + (!empty($keu3) ? array_sum($keu3) : '0') + (!empty($keu4) ? array_sum($keu4) : '0') + (!empty($keu5) ? array_sum($keu5) : '0') + (!empty($keu6) ? array_sum($keu6) : '0') + (!empty($keu7) ? array_sum($keu7) : '0') + (!empty($keu8) ? array_sum($keu8) : '0') + (!empty($keu9) ? array_sum($keu9) : '0') + (!empty($keu10) ? array_sum($keu10) : '0');
		$bb11 = (!empty($keu1) ? array_sum($keu1) : '0') + (!empty($keu2) ? array_sum($keu2) : '0') + (!empty($keu3) ? array_sum($keu3) : '0') + (!empty($keu4) ? array_sum($keu4) : '0') + (!empty($keu5) ? array_sum($keu5) : '0') + (!empty($keu6) ? array_sum($keu6) : '0') + (!empty($keu7) ? array_sum($keu7) : '0') + (!empty($keu8) ? array_sum($keu8) : '0') + (!empty($keu9) ? array_sum($keu9) : '0') + (!empty($keu10) ? array_sum($keu10) : '0') + (!empty($keu11) ? array_sum($keu11) : '0');
		$bb12 = (!empty($keu1) ? array_sum($keu1) : '0') + (!empty($keu2) ? array_sum($keu2) : '0') + (!empty($keu3) ? array_sum($keu3) : '0') + (!empty($keu4) ? array_sum($keu4) : '0') + (!empty($keu5) ? array_sum($keu5) : '0') + (!empty($keu6) ? array_sum($keu6) : '0') + (!empty($keu7) ? array_sum($keu7) : '0') + (!empty($keu8) ? array_sum($keu8) : '0') + (!empty($keu9) ? array_sum($keu9) : '0') + (!empty($keu10) ? array_sum($keu10) : '0') + (!empty($keu11) ? array_sum($keu11) : '0') + (!empty($keu12) ? array_sum($keu12) : '0');
		?>

		<?php $fisik = $db->table('tb_ropk_fisik')->getWhere([
			'tb_ropk_fisik.rkpd_kegiatan' => $DT['rkpd_kegiatan_n'],
			'tb_ropk_fisik.rkpd_kegiatan_sub' => $DT['rkpd_kegiatan_sub_n'],
			'tb_ropk_fisik.rkpd_indikator_kegiatan_sub' => $DT['rkpd_indikator_kegiatan_sub'],
			'tb_ropk_fisik.opd_id' => $_SESSION['opd_set'],
			'tb_ropk_fisik.tahun' => $_SESSION['tahun'],
			'tb_ropk_fisik.perubahan' => $_SESSION['perubahan']
		])->getResultArray();
		foreach ($fisik as $ros) {
			isset($ros['ropk_bobot_acuan']) ? $acu[] = ($ros['ropk_bobot_acuan']) : $acu[] = ['0'];
			isset($ros['b1']) ? $fis1[] = ($ros['b1']) : $fis1[] = ['0'];
			isset($ros['b2']) ? $fis2[] = ($ros['b2']) : $fis2[] = ['0'];
			isset($ros['b3']) ? $fis3[] = ($ros['b3']) : $fis3[] = ['0'];
			isset($ros['b4']) ? $fis4[] = ($ros['b4']) : $fis4[] = ['0'];
			isset($ros['b5']) ? $fis5[] = ($ros['b5']) : $fis5[] = ['0'];
			isset($ros['b6']) ? $fis6[] = ($ros['b6']) : $fis6[] = ['0'];
			isset($ros['b7']) ? $fis7[] = ($ros['b7']) : $fis7[] = ['0'];
			isset($ros['b8']) ? $fis8[] = ($ros['b8']) : $fis8[] = ['0'];
			isset($ros['b9']) ? $fis9[] = ($ros['b9']) : $fis9[] = ['0'];
			isset($ros['b10']) ? $fis10[] = ($ros['b10']) : $fis10[] = ['0'];
			isset($ros['b11']) ? $fis11[] = ($ros['b11']) : $fis11[] = ['0'];
			isset($ros['b12']) ? $fis12[] = ($ros['b12']) : $fis12[] = ['0'];
		}
		$fbb1 = !empty($fis1) ? array_sum($fis1) : '0';
		$fbb2 = (!empty($fis1) ? array_sum($fis1) : '0') + (!empty($fis2) ? array_sum($fis2) : '0');
		$fbb3 = (!empty($fis1) ? array_sum($fis1) : '0') + (!empty($fis2) ? array_sum($fis2) : '0') + (!empty($fis3) ? array_sum($fis3) : '0');
		$fbb4 = (!empty($fis1) ? array_sum($fis1) : '0') + (!empty($fis2) ? array_sum($fis2) : '0') + (!empty($fis3) ? array_sum($fis3) : '0') + (!empty($fis4) ? array_sum($fis4) : '0');
		$fbb5 = (!empty($fis1) ? array_sum($fis1) : '0') + (!empty($fis2) ? array_sum($fis2) : '0') + (!empty($fis3) ? array_sum($fis3) : '0') + (!empty($fis4) ? array_sum($fis4) : '0') + (!empty($fis5) ? array_sum($fis5) : '0');
		$fbb6 = (!empty($fis1) ? array_sum($fis1) : '0') + (!empty($fis2) ? array_sum($fis2) : '0') + (!empty($fis3) ? array_sum($fis3) : '0') + (!empty($fis4) ? array_sum($fis4) : '0') + (!empty($fis5) ? array_sum($fis5) : '0') + (!empty($fis6) ? array_sum($fis6) : '0');
		$fbb7 = (!empty($fis1) ? array_sum($fis1) : '0') + (!empty($fis2) ? array_sum($fis2) : '0') + (!empty($fis3) ? array_sum($fis3) : '0') + (!empty($fis4) ? array_sum($fis4) : '0') + (!empty($fis5) ? array_sum($fis5) : '0') + (!empty($fis6) ? array_sum($fis6) : '0') + (!empty($fis7) ? array_sum($fis7) : '0');
		$fbb8 = (!empty($fis1) ? array_sum($fis1) : '0') + (!empty($fis2) ? array_sum($fis2) : '0') + (!empty($fis3) ? array_sum($fis3) : '0') + (!empty($fis4) ? array_sum($fis4) : '0') + (!empty($fis5) ? array_sum($fis5) : '0') + (!empty($fis6) ? array_sum($fis6) : '0') + (!empty($fis7) ? array_sum($fis7) : '0') + (!empty($fis8) ? array_sum($fis8) : '0');
		$fbb9 = (!empty($fis1) ? array_sum($fis1) : '0') + (!empty($fis2) ? array_sum($fis2) : '0') + (!empty($fis3) ? array_sum($fis3) : '0') + (!empty($fis4) ? array_sum($fis4) : '0') + (!empty($fis5) ? array_sum($fis5) : '0') + (!empty($fis6) ? array_sum($fis6) : '0') + (!empty($fis7) ? array_sum($fis7) : '0') + (!empty($fis8) ? array_sum($fis8) : '0') + (!empty($fis9) ? array_sum($fis9) : '0');
		$fbb10 = (!empty($fis1) ? array_sum($fis1) : '0') + (!empty($fis2) ? array_sum($fis2) : '0') + (!empty($fis3) ? array_sum($fis3) : '0') + (!empty($fis4) ? array_sum($fis4) : '0') + (!empty($fis5) ? array_sum($fis5) : '0') + (!empty($fis6) ? array_sum($fis6) : '0') + (!empty($fis7) ? array_sum($fis7) : '0') + (!empty($fis8) ? array_sum($fis8) : '0') + (!empty($fis9) ? array_sum($fis9) : '0') + (!empty($fis10) ? array_sum($fis10) : '0');
		$fbb11 = (!empty($fis1) ? array_sum($fis1) : '0') + (!empty($fis2) ? array_sum($fis2) : '0') + (!empty($fis3) ? array_sum($fis3) : '0') + (!empty($fis4) ? array_sum($fis4) : '0') + (!empty($fis5) ? array_sum($fis5) : '0') + (!empty($fis6) ? array_sum($fis6) : '0') + (!empty($fis7) ? array_sum($fis7) : '0') + (!empty($fis8) ? array_sum($fis8) : '0') + (!empty($fis9) ? array_sum($fis9) : '0') + (!empty($fis10) ? array_sum($fis10) : '0') + (!empty($fis11) ? array_sum($fis11) : '0');
		$fbb12 = (!empty($fis1) ? array_sum($fis1) : '0') + (!empty($fis2) ? array_sum($fis2) : '0') + (!empty($fis3) ? array_sum($fis3) : '0') + (!empty($fis4) ? array_sum($fis4) : '0') + (!empty($fis5) ? array_sum($fis5) : '0') + (!empty($fis6) ? array_sum($fis6) : '0') + (!empty($fis7) ? array_sum($fis7) : '0') + (!empty($fis8) ? array_sum($fis8) : '0') + (!empty($fis9) ? array_sum($fis9) : '0') + (!empty($fis10) ? array_sum($fis10) : '0') + (!empty($fis11) ? array_sum($fis11) : '0') + (!empty($fis1) ? array_sum($fis12) : '0');
		?>
		<tbody>
			<tr>
				<?php $progres1 = $db->table('tb_simonela_progres')
					->select('bulan_lapor, created_at')
					->selectsum('realisasi_keu')
					->selectsum('realisasi_fisik')
					->getWhere([
						'kegiatan' => $DT['rkpd_kegiatan_n'],
						'kegiatan_sub' => $DT['rkpd_kegiatan_sub_n'],
						'indikator_kegiatan_sub' => $DT['rkpd_indikator_kegiatan_sub'],
						'opd_id' => $_SESSION['opd_set'],
						'tahun' => $_SESSION['tahun'],
						'perubahan' => $_SESSION['perubahan'],
						'bulan' => 'b1'
					])->getRowArray();
				//dd($progres1); 
				?>
				<td class="align-top">Januari</td>
				<td class="align-top text-wrap">
					<?php $tahap_aktifitas1 = $db->table('tb_simonela_progres')->select('tahap_aktifitas')->getWhere(['kegiatan' => $DT['rkpd_kegiatan_n'], 'kegiatan_sub' => $DT['rkpd_kegiatan_sub_n'], 'indikator_kegiatan_sub' => $DT['rkpd_indikator_kegiatan_sub'], 'opd_id' => $_SESSION['opd_set'], 'tahun' => $_SESSION['tahun'], 'perubahan' => $_SESSION['perubahan'], 'bulan' => 'b1'])->getResultArray(); ?>
					<?php foreach ($tahap_aktifitas1 as $tahap1) {
						echo '-' . $tahap1['tahap_aktifitas'] . '<br>';
					} ?>
				</td>
				<td class="align-top text-wrap">
					<?php $faktor_penghambat1 = $db->table('tb_simonela_progres')->select('faktor_penghambat')->getWhere(['kegiatan' => $DT['rkpd_kegiatan_n'], 'kegiatan_sub' => $DT['rkpd_kegiatan_sub_n'], 'indikator_kegiatan_sub' => $DT['rkpd_indikator_kegiatan_sub'], 'opd_id' => $_SESSION['opd_set'], 'tahun' => $_SESSION['tahun'], 'perubahan' => $_SESSION['perubahan'], 'bulan' => 'b1'])->getResultArray(); ?>
					<?php foreach ($faktor_penghambat1 as $penghambat1) {
						echo '-' . $penghambat1['faktor_penghambat'] . '<br>';
					} ?>
				</td>
				<td class="align-top text-wrap">
					<?php $faktor_pendukung1 = $db->table('tb_simonela_progres')->select('faktor_pendukung')->getWhere(['kegiatan' => $DT['rkpd_kegiatan_n'], 'kegiatan_sub' => $DT['rkpd_kegiatan_sub_n'], 'indikator_kegiatan_sub' => $DT['rkpd_indikator_kegiatan_sub'], 'opd_id' => $_SESSION['opd_set'], 'tahun' => $_SESSION['tahun'], 'perubahan' => $_SESSION['perubahan'], 'bulan' => 'b1'])->getResultArray(); ?>
					<?php foreach ($faktor_pendukung1 as $pendukung1) {
						echo '-' . $pendukung1['faktor_pendukung'] . '<br>';
					} ?>
				</td>
				<td class="align-top text-wrap">
					<?php $rencana_tindak_lanjut1 = $db->table('tb_simonela_progres')->select('rencana_tindak_lanjut')->getWhere(['kegiatan' => $DT['rkpd_kegiatan_n'], 'kegiatan_sub' => $DT['rkpd_kegiatan_sub_n'], 'indikator_kegiatan_sub' => $DT['rkpd_indikator_kegiatan_sub'], 'opd_id' => $_SESSION['opd_set'], 'tahun' => $_SESSION['tahun'], 'perubahan' => $_SESSION['perubahan'], 'bulan' => 'b1'])->getResultArray(); ?>
					<?php foreach ($rencana_tindak_lanjut1 as $tindak_lanjut1) {
						echo '-' . $tindak_lanjut1['rencana_tindak_lanjut'] . '<br>';
					} ?>
				</td>
				<td class="align-top text-right"><?= number_format($bb1, 0, ',', '.'); ?></td>
				<td class="align-top text-right"><?= number_format($fbb1, 2, ',', '.'); ?></td>
				<!-- <td class="align-top text-right"></td>
				<td class="align-top text-right"></td> -->
				<!-------------- Realisasi -->
				<td class="align-top text-right"><?= isset($progres1['realisasi_keu']) ? number_format($progres1['realisasi_keu'], 0, ',', '.') : ''; ?></td>
				<td class="align-top text-right"><?= isset($progres1['realisasi_fisik']) ? number_format($progres1['realisasi_fisik'], 2, ',', '.') : ''; ?></td>
				<!-------------- /Realisasi -->
				<!-------------- Kosistensi -->
				<td class="align-top text-right">
					<?php
					try {
						echo isset($progres1['realisasi_keu']) ? round(($progres1['realisasi_keu'] / $bb1) * 100, 2) : '';
					} catch (DivisionByZeroError $e) {
						echo "Null";
					}
					?>
				</td>
				<td class="align-top text-right">
					<?php
					try {
						echo isset($progres1['realisasi_fisik']) ? number_format(round(($progres1['realisasi_fisik'] / $fbb1) * 100, 2), 2, ',', '.') : '';
					} catch (DivisionByZeroError $e) {
						echo "Null";
					}
					?>
				</td>
				<!-------------- /Konsistensi -->
				<!-------------- Deviasi -->
				<td class="align-top text-right">
					<?php
					try {
						echo isset($progres1['realisasi_keu']) ? number_format(round(((($progres1['realisasi_keu'] / $DT['rp_tahun']) * 100) - (($bb1 / $DT['rp_tahun']) * 100)), 2), 2, ',', '.') : '';
					} catch (DivisionByZeroError $e) {
						echo "Null";
					}
					?>
				</td>
				<td class="align-top text-right">
					<?php
					try {
						echo isset($progres1['realisasi_fisik']) ? number_format(round((($progres1['realisasi_fisik'] - $fbb1)), 2), 2, ',', '.') : '';
					} catch (DivisionByZeroError $e) {
						echo "Null";
					}
					?>
				</td>
				<!-------------- //Deviasi-->

				<td class="align-top text-center"><?= isset($progres1['created_at']) ? $progres1['created_at'] : ''; ?></td>
				<td class="align-top text-center"><?= isset($progres1['bulan_lapor']) ? ($progres1['bulan_lapor'] > '01' ? '<text style="color: red;">Terlambat</text>' : '<text style="color:green;">Sudah Lapor</text>') : 'Belum Lapor'; ?> </td>
				<td class="align-top text-right">
					<?php if (isset($progres1['id_simonela_progres'])) { ?>
						<a href="<?= base_url('/admin/simonela/simonela/progres_bulan/' . $DT['id_ropk_keuangan_rkpd_kegiatan_sub'] . '/' . 'b1' . '/Januari?keu=' . number_format($bb1, 0, ',', '.') . '&fis=' . number_format($fbb1, 0, ',', '.')); ?>">
							<li class="btn btn-block btn-warning btn-xs" active><i class="nav-icon fa fa-chart-pie"></i> Progres</li>
						</a>
					<?php } else { ?>
						<a href="<?= base_url('/admin/simonela/simonela/progres_bulan/' . $DT['id_ropk_keuangan_rkpd_kegiatan_sub'] . '/' . 'b1' . '/Januari?keu=' . number_format($bb1, 0, ',', '.') . '&fis=' . number_format($fbb1, 0, ',', '.')); ?>">
							<li class="btn btn-block btn-warning btn-xs" active><i class="nav-icon fa fa-chart-pie"></i> Progres</li>
						</a>
					<?php } ?>
				</td>
				<td class="align-top">
					<a href="<?= base_url('/admin/simonela/simonela/dokumen_add/' . $DT['id_ropk_keuangan_rkpd_kegiatan_sub'] . '/'  . 'b1' . '/Januari'); ?>">
						<li class="btn btn-block btn-info btn-xs" active><i class="nav-icon fa fa-file"></i> Dokumen</li>
					</a>
				</td>
			</tr>
			<!-------------- /Januari -->
			<tr>
				<?php $progres2 = $db->table('tb_simonela_progres')
					->select('bulan_lapor, created_at')
					->selectsum('realisasi_keu')
					->selectsum('realisasi_fisik')
					->getWhere([
						'kegiatan' => $DT['rkpd_kegiatan_n'],
						'kegiatan_sub' => $DT['rkpd_kegiatan_sub_n'],
						'indikator_kegiatan_sub' => $DT['rkpd_indikator_kegiatan_sub'],
						'opd_id' => $_SESSION['opd_set'],
						'tahun' => $_SESSION['tahun'],
						'perubahan' => $_SESSION['perubahan'],
						'bulan' => 'b2'
					])->getRowArray();

				$realisasi2['realisasi_keu'] = $progres1['realisasi_keu'] + $progres2['realisasi_keu'];
				$realisasi2['realisasi_fisik'] = $progres1['realisasi_fisik'] + $progres2['realisasi_fisik'];

				?>

				<td class="align-top">Februari</td>
				<td class="align-top text-wrap">
					<?php $tahap_aktifitas2 = $db->table('tb_simonela_progres')->select('tahap_aktifitas')->getWhere(['kegiatan' => $DT['rkpd_kegiatan_n'], 'kegiatan_sub' => $DT['rkpd_kegiatan_sub_n'], 'indikator_kegiatan_sub' => $DT['rkpd_indikator_kegiatan_sub'], 'opd_id' => $_SESSION['opd_set'], 'tahun' => $_SESSION['tahun'], 'perubahan' => $_SESSION['perubahan'], 'bulan' => 'b2'])->getResultArray(); ?>
					<?php foreach ($tahap_aktifitas2 as $tahap2) {
						echo '-' . $tahap2['tahap_aktifitas'] . '<br>';
					} ?>
				</td>
				<td class="align-top text-wrap">
					<?php $faktor_penghambat2 = $db->table('tb_simonela_progres')->select('faktor_penghambat')->getWhere(['kegiatan' => $DT['rkpd_kegiatan_n'], 'kegiatan_sub' => $DT['rkpd_kegiatan_sub_n'], 'indikator_kegiatan_sub' => $DT['rkpd_indikator_kegiatan_sub'], 'opd_id' => $_SESSION['opd_set'], 'tahun' => $_SESSION['tahun'], 'perubahan' => $_SESSION['perubahan'], 'bulan' => 'b2'])->getResultArray(); ?>
					<?php foreach ($faktor_penghambat2 as $penghambat2) {
						echo '-' . $penghambat2['faktor_penghambat'] . '<br>';
					} ?>
				</td>
				<td class="align-top text-wrap">
					<?php $faktor_pendukung2 = $db->table('tb_simonela_progres')->select('faktor_pendukung')->getWhere(['kegiatan' => $DT['rkpd_kegiatan_n'], 'kegiatan_sub' => $DT['rkpd_kegiatan_sub_n'], 'indikator_kegiatan_sub' => $DT['rkpd_indikator_kegiatan_sub'], 'opd_id' => $_SESSION['opd_set'], 'tahun' => $_SESSION['tahun'], 'perubahan' => $_SESSION['perubahan'], 'bulan' => 'b2'])->getResultArray(); ?>
					<?php foreach ($faktor_pendukung2 as $pendukung2) {
						echo '-' . $pendukung2['faktor_pendukung'] . '<br>';
					} ?>
				</td>
				<td class="align-top text-wrap">
					<?php $rencana_tindak_lanjut2 = $db->table('tb_simonela_progres')->select('rencana_tindak_lanjut')->getWhere(['kegiatan' => $DT['rkpd_kegiatan_n'], 'kegiatan_sub' => $DT['rkpd_kegiatan_sub_n'], 'indikator_kegiatan_sub' => $DT['rkpd_indikator_kegiatan_sub'], 'opd_id' => $_SESSION['opd_set'], 'tahun' => $_SESSION['tahun'], 'perubahan' => $_SESSION['perubahan'], 'bulan' => 'b2'])->getResultArray(); ?>
					<?php foreach ($rencana_tindak_lanjut2 as $tindak_lanjut2) {
						echo '-' . $tindak_lanjut2['rencana_tindak_lanjut'] . '<br>';
					} ?>
				</td>
				<td class="align-top text-right"><?= number_format($bb2, 0, ',', '.'); ?></td>
				<td class="align-top text-right"><?= number_format($fbb2, 2, ',', '.'); ?></td>
				<!-- <td class="align-top text-right"></td>
				<td class="align-top text-right"></td> -->
				<td class="align-top text-right"><?= isset($realisasi2['realisasi_keu']) ? number_format($realisasi2['realisasi_keu'], 0, ',', '.') : ''; ?></td>
				<td class="align-top text-right"><?= isset($realisasi2['realisasi_fisik']) ? number_format($realisasi2['realisasi_fisik'], 2, ',', '.') : ''; ?></td>
				<td class="align-top text-right">
					<?php
					try {
						echo isset($realisasi2['realisasi_keu']) ? round(($realisasi2['realisasi_keu'] / $bb2) * 100, 2) : '';
					} catch (DivisionByZeroError $e) {
						echo "Null";
					}
					?>
				</td>
				<td class="align-top text-right">
					<?php
					try {
						echo isset($realisasi2['realisasi_fisik']) ? number_format(round(($realisasi2['realisasi_fisik'] / $fbb2) * 100, 2), 2, ',', '.') : '';
					} catch (DivisionByZeroError $e) {
						echo "Null";
					}
					?>
				</td>
				<!-------------- Deviasi -->
				<td class="align-top text-right">
					<?php
					try {
						echo isset($realisasi2['realisasi_keu']) ? number_format(round(((($realisasi2['realisasi_keu'] / $DT['rp_tahun']) * 100) - (($bb2 / $DT['rp_tahun']) * 100)), 2), 2, ',', '.') : '';
					} catch (DivisionByZeroError $e) {
						echo "Null";
					}
					?>
				</td>
				<td class="align-top text-right">
					<?php
					try {
						echo isset($realisasi2['realisasi_fisik']) ? number_format(round((($realisasi2['realisasi_fisik'] - $fbb2)), 2), 2, ',', '.') : '';
					} catch (DivisionByZeroError $e) {
						echo "Null";
					}
					?>
				</td>
				<!-------------- //Deviasi-->

				<td class="align-top text-center"><?= isset($progres2['created_at']) ? $progres2['created_at'] : ''; ?></td>
				<td class="align-top text-center"><?= isset($progres2['bulan_lapor']) ? ($progres2['bulan_lapor'] > '02' ? '<text style="color: red;">Terlambat</text>' : '<text style="color:green;">Sudah Lapor</text>') : 'Belum Lapor'; ?> </td>
				<td class="align-top text-right">
					<a href="<?= base_url('/admin/simonela/simonela/progres_bulan/' . $DT['id_ropk_keuangan_rkpd_kegiatan_sub'] . '/' . 'b2' . '/Februari?keu=' . number_format($bb2, 0, ',', '.') . '&fis=' . number_format($fbb2, 0, ',', '.')); ?>">
						<li class="btn btn-block btn-warning btn-xs" active><i class="nav-icon fa fa-chart-pie"></i> Progres</li>
					</a>
				</td>
				<td class="align-top">
					<a href="<?= base_url('/admin/simonela/simonela/dokumen_add/' . $DT['id_ropk_keuangan_rkpd_kegiatan_sub'] . '/' . 'b2' . '/Februari'); ?>">
						<li class="btn btn-block btn-info btn-xs" active><i class="nav-icon fa fa-file"></i> Dokumen</li>
					</a>
				</td>
			</tr>
			<!-------------- /Februari -->
			<tr>
				<?php $progres3 = $db->table('tb_simonela_progres')
					->select('bulan_lapor, created_at')
					->selectsum('realisasi_keu')
					->selectsum('realisasi_fisik')
					->getWhere([
						'kegiatan' => $DT['rkpd_kegiatan_n'],
						'kegiatan_sub' => $DT['rkpd_kegiatan_sub_n'],
						'indikator_kegiatan_sub' => $DT['rkpd_indikator_kegiatan_sub'],
						'opd_id' => $_SESSION['opd_set'],
						'tahun' => $_SESSION['tahun'],
						'perubahan' => $_SESSION['perubahan'],
						'bulan' => 'b3'
					])->getRowArray();

				$realisasi3['realisasi_keu'] = $progres1['realisasi_keu'] + $progres2['realisasi_keu'] + $progres3['realisasi_keu'];
				$realisasi3['realisasi_fisik'] = $progres1['realisasi_fisik'] + $progres2['realisasi_fisik'] + $progres3['realisasi_fisik'];
				?>
				<td class="align-top">Maret</td>
				<td class="align-top text-wrap">
					<?php $tahap_aktifitas3 = $db->table('tb_simonela_progres')->select('tahap_aktifitas')->getWhere(['kegiatan' => $DT['rkpd_kegiatan_n'], 'kegiatan_sub' => $DT['rkpd_kegiatan_sub_n'], 'indikator_kegiatan_sub' => $DT['rkpd_indikator_kegiatan_sub'], 'opd_id' => $_SESSION['opd_set'], 'tahun' => $_SESSION['tahun'], 'perubahan' => $_SESSION['perubahan'], 'bulan' => 'b3'])->getResultArray(); ?>
					<?php foreach ($tahap_aktifitas3 as $tahap3) {
						echo '-' . $tahap3['tahap_aktifitas'] . '<br>';
					} ?>
				</td>
				<td class="align-top text-wrap">
					<?php $faktor_penghambat3 = $db->table('tb_simonela_progres')->select('faktor_penghambat')->getWhere(['kegiatan' => $DT['rkpd_kegiatan_n'], 'kegiatan_sub' => $DT['rkpd_kegiatan_sub_n'], 'indikator_kegiatan_sub' => $DT['rkpd_indikator_kegiatan_sub'], 'opd_id' => $_SESSION['opd_set'], 'tahun' => $_SESSION['tahun'], 'perubahan' => $_SESSION['perubahan'], 'bulan' => 'b3'])->getResultArray(); ?>
					<?php foreach ($faktor_penghambat3 as $penghambat3) {
						echo '-' . $penghambat3['faktor_penghambat'] . '<br>';
					} ?>
				</td>
				<td class="align-top text-wrap">
					<?php $faktor_pendukung3 = $db->table('tb_simonela_progres')->select('faktor_pendukung')->getWhere(['kegiatan' => $DT['rkpd_kegiatan_n'], 'kegiatan_sub' => $DT['rkpd_kegiatan_sub_n'], 'indikator_kegiatan_sub' => $DT['rkpd_indikator_kegiatan_sub'], 'opd_id' => $_SESSION['opd_set'], 'tahun' => $_SESSION['tahun'], 'perubahan' => $_SESSION['perubahan'], 'bulan' => 'b3'])->getResultArray(); ?>
					<?php foreach ($faktor_pendukung3 as $pendukung3) {
						echo '-' . $pendukung3['faktor_pendukung'] . '<br>';
					} ?>
				</td>
				<td class="align-top text-wrap">
					<?php $rencana_tindak_lanjut3 = $db->table('tb_simonela_progres')->select('rencana_tindak_lanjut')->getWhere(['kegiatan' => $DT['rkpd_kegiatan_n'], 'kegiatan_sub' => $DT['rkpd_kegiatan_sub_n'], 'indikator_kegiatan_sub' => $DT['rkpd_indikator_kegiatan_sub'], 'opd_id' => $_SESSION['opd_set'], 'tahun' => $_SESSION['tahun'], 'perubahan' => $_SESSION['perubahan'], 'bulan' => 'b3'])->getResultArray(); ?>
					<?php foreach ($rencana_tindak_lanjut3 as $tindak_lanjut3) {
						echo '-' . $tindak_lanjut3['rencana_tindak_lanjut'] . '<br>';
					} ?>
				</td>
				<td class="align-top text-right"><?= number_format($bb3, 0, ',', '.'); ?></td>
				<td class="align-top text-right"><?= number_format($fbb3, 2, ',', '.'); ?></td>
				<!-- <td class="align-top text-right"></td>
				<td class="align-top text-right"></td> -->
				<td class="align-top text-right"><?= isset($realisasi3['realisasi_keu']) ? number_format($realisasi3['realisasi_keu'], 0, ',', '.') : ''; ?></td>
				<td class="align-top text-right"><?= isset($realisasi3['realisasi_fisik']) ? number_format($realisasi3['realisasi_fisik'], 2, ',', '.') : ''; ?></td>
				<td class="align-top text-right">
					<?php
					try {
						echo isset($realisasi3['realisasi_keu']) ? round(($realisasi3['realisasi_keu'] / $bb3) * 100, 2) : '';
					} catch (DivisionByZeroError $e) {
						echo "Null";
					}
					?>
				</td>
				<td class="align-top text-right">
					<?php
					try {
						echo isset($realisasi3['realisasi_fisik']) ? number_format(round(($realisasi3['realisasi_fisik'] / $fbb3) * 100, 2), 2, ',', '.') : '';
					} catch (DivisionByZeroError $e) {
						echo "Null";
					}
					?>
				</td>
				<!-------------- Deviasi -->
				<td class="align-top text-right">
					<?php
					try {
						echo isset($realisasi3['realisasi_keu']) ? number_format(round(((($realisasi3['realisasi_keu'] / $DT['rp_tahun']) * 100) - (($bb3 / $DT['rp_tahun']) * 100)), 2), 2, ',', '.') : '';
					} catch (DivisionByZeroError $e) {
						echo "Null";
					}
					?>
				</td>
				<td class="align-top text-right">
					<?php
					try {
						echo isset($realisasi3['realisasi_fisik']) ? number_format(round((($realisasi3['realisasi_fisik'] - $fbb3)), 2), 2, ',', '.') : '';
					} catch (DivisionByZeroError $e) {
						echo "Null";
					}
					?>
				</td>
				<!-------------- //Deviasi-->

				<td class="align-top text-center"><?= isset($progres3['created_at']) ? $progres3['created_at'] : ''; ?></td>
				<td class="align-top text-center"><?= isset($progres3['bulan_lapor']) ? ($progres3['bulan_lapor'] > '03' ? '<text style="color: red;">Terlambat</text>' : '<text style="color:green;">Sudah Lapor</text>') : 'Belum Lapor'; ?> </td>
				<td class="align-top text-right">

					<a href="<?= base_url('/admin/simonela/simonela/progres_bulan/' . $DT['id_ropk_keuangan_rkpd_kegiatan_sub'] . '/' . 'b3' . '/Maret?keu=' . number_format($bb3, 0, ',', '.') . '&fis=' . number_format($fbb3, 0, ',', '.')); ?>">
						<li class="btn btn-block btn-warning btn-xs" active><i class="nav-icon fa fa-chart-pie"></i> Progres</li>
					</a>
				</td>
				<td class="align-top">
					<a href="<?= base_url('/admin/simonela/simonela/dokumen_add/' . $DT['id_ropk_keuangan_rkpd_kegiatan_sub'] . '/' . 'b3' . '/Maret'); ?>">
						<li class="btn btn-block btn-info btn-xs" active><i class="nav-icon fa fa-file"></i> Dokumen</li>
					</a>
				</td>
			</tr>
			<tr>
				<?php $progres4 = $db->table('tb_simonela_progres')
					->select('bulan_lapor, created_at')
					->selectsum('realisasi_keu')
					->selectsum('realisasi_fisik')
					->getWhere([
						'kegiatan' => $DT['rkpd_kegiatan_n'],
						'kegiatan_sub' => $DT['rkpd_kegiatan_sub_n'],
						'indikator_kegiatan_sub' => $DT['rkpd_indikator_kegiatan_sub'],
						'opd_id' => $_SESSION['opd_set'],
						'tahun' => $_SESSION['tahun'],
						'perubahan' => $_SESSION['perubahan'],
						'bulan' => 'b4'
					])->getRowArray();

				$realisasi4['realisasi_keu'] = $progres1['realisasi_keu'] + $progres2['realisasi_keu'] + $progres3['realisasi_keu'] + $progres4['realisasi_keu'];
				$realisasi4['realisasi_fisik'] = $progres1['realisasi_fisik'] + $progres2['realisasi_fisik'] + $progres3['realisasi_fisik'] + $progres4['realisasi_fisik'];
				?>
				<td class="align-top">April</td>
				<td class="align-top text-wrap">
					<?php $tahap_aktifitas4 = $db->table('tb_simonela_progres')->select('tahap_aktifitas')->getWhere(['kegiatan' => $DT['rkpd_kegiatan_n'], 'kegiatan_sub' => $DT['rkpd_kegiatan_sub_n'], 'indikator_kegiatan_sub' => $DT['rkpd_indikator_kegiatan_sub'], 'opd_id' => $_SESSION['opd_set'], 'tahun' => $_SESSION['tahun'], 'perubahan' => $_SESSION['perubahan'], 'bulan' => 'b4'])->getResultArray(); ?>
					<?php foreach ($tahap_aktifitas4 as $tahap4) {
						echo '-' . $tahap4['tahap_aktifitas'] . '<br>';
					} ?>
				</td>
				<td class="align-top text-wrap">
					<?php $faktor_penghambat4 = $db->table('tb_simonela_progres')->select('faktor_penghambat')->getWhere(['kegiatan' => $DT['rkpd_kegiatan_n'], 'kegiatan_sub' => $DT['rkpd_kegiatan_sub_n'], 'indikator_kegiatan_sub' => $DT['rkpd_indikator_kegiatan_sub'], 'opd_id' => $_SESSION['opd_set'], 'tahun' => $_SESSION['tahun'], 'perubahan' => $_SESSION['perubahan'], 'bulan' => 'b4'])->getResultArray(); ?>
					<?php foreach ($faktor_penghambat4 as $penghambat4) {
						echo '-' . $penghambat4['faktor_penghambat'] . '<br>';
					} ?>
				</td>
				<td class="align-top text-wrap">
					<?php $faktor_pendukung4 = $db->table('tb_simonela_progres')->select('faktor_pendukung')->getWhere(['kegiatan' => $DT['rkpd_kegiatan_n'], 'kegiatan_sub' => $DT['rkpd_kegiatan_sub_n'], 'indikator_kegiatan_sub' => $DT['rkpd_indikator_kegiatan_sub'], 'opd_id' => $_SESSION['opd_set'], 'tahun' => $_SESSION['tahun'], 'perubahan' => $_SESSION['perubahan'], 'bulan' => 'b4'])->getResultArray(); ?>
					<?php foreach ($faktor_pendukung4 as $pendukung4) {
						echo '-' . $pendukung4['faktor_pendukung'] . '<br>';
					} ?>
				</td>
				<td class="align-top text-wrap">
					<?php $rencana_tindak_lanjut4 = $db->table('tb_simonela_progres')->select('rencana_tindak_lanjut')->getWhere(['kegiatan' => $DT['rkpd_kegiatan_n'], 'kegiatan_sub' => $DT['rkpd_kegiatan_sub_n'], 'indikator_kegiatan_sub' => $DT['rkpd_indikator_kegiatan_sub'], 'opd_id' => $_SESSION['opd_set'], 'tahun' => $_SESSION['tahun'], 'perubahan' => $_SESSION['perubahan'], 'bulan' => 'b4'])->getResultArray(); ?>
					<?php foreach ($rencana_tindak_lanjut4 as $tindak_lanjut4) {
						echo '-' . $tindak_lanjut4['rencana_tindak_lanjut'] . '<br>';
					} ?>
				</td>
				<td class="align-top text-right"><?= number_format($bb4, 0, ',', '.'); ?></td>
				<td class="align-top text-right"><?= number_format($fbb4, 2, ',', '.'); ?></td>
				<!-- <td class="align-top text-right"></td>
				<td class="align-top text-right"></td> -->
				<td class="align-top text-right"><?= isset($realisasi4['realisasi_keu']) ? number_format($realisasi4['realisasi_keu'], 0, ',', '.') : ''; ?></td>
				<td class="align-top text-right"><?= isset($realisasi4['realisasi_fisik']) ? number_format($realisasi4['realisasi_fisik'], 2, ',', '.') : ''; ?></td>
				<td class="align-top text-right">
					<?php
					try {
						echo isset($realisasi4['realisasi_keu']) ? round(($realisasi4['realisasi_keu'] / $bb4) * 100, 2) : '';
					} catch (DivisionByZeroError $e) {
						echo "Null";
					}
					?>
				</td>
				<td class="align-top text-right">
					<?php
					try {
						echo isset($realisasi4['realisasi_fisik']) ? number_format(round(($realisasi4['realisasi_fisik'] / $fbb4) * 100, 2), 2, ',', '.') : '';
					} catch (DivisionByZeroError $e) {
						echo "Null";
					}
					?>
				</td>
				<!-------------- Deviasi -->
				<td class="align-top text-right">
					<?php
					try {
						echo isset($realisasi4['realisasi_keu']) ? number_format(round(((($realisasi4['realisasi_keu'] / $DT['rp_tahun']) * 100) - (($bb4 / $DT['rp_tahun']) * 100)), 2), 2, ',', '.') : '';
					} catch (DivisionByZeroError $e) {
						echo "Null";
					}
					?>
				</td>
				<td class="align-top text-right">
					<?php
					try {
						echo isset($realisasi4['realisasi_fisik']) ? number_format(round((($realisasi4['realisasi_fisik'] - $fbb4)), 2), 2, ',', '.') : '';
					} catch (DivisionByZeroError $e) {
						echo "Null";
					}
					?>
				</td>
				<!-------------- //Deviasi-->

				<td class="align-top text-center"><?= isset($progres4['created_at']) ? $progres4['created_at'] : ''; ?></td>
				<td class="align-top text-center"><?= isset($progres4['bulan_lapor']) ? ($progres4['bulan_lapor'] > '04' ? '<text style="color: red;">Terlambat</text>' : '<text style="color:green;">Sudah Lapor</text>') : 'Belum Lapor'; ?> </td>
				<td class="align-top text-right">
					<a href="<?= base_url('/admin/simonela/simonela/progres_bulan/' . $DT['id_ropk_keuangan_rkpd_kegiatan_sub'] . '/' . 'b4' . '/April?keu=' . number_format($bb4, 0, ',', '.') . '&fis=' . number_format($fbb4, 0, ',', '.')); ?>">
						<li class="btn btn-block btn-warning btn-xs" active><i class="nav-icon fa fa-chart-pie"></i> Progres</li>
					</a>
				</td>
				<td class="align-top">
					<a href="<?= base_url('/admin/simonela/simonela/dokumen_add/' . $DT['id_ropk_keuangan_rkpd_kegiatan_sub'] . '/' . 'b4' . '/April'); ?>">
						<li class="btn btn-block btn-info btn-xs" active><i class="nav-icon fa fa-file"></i> Dokumen</li>
					</a>
				</td>
			</tr>
			<tr>
				<?php $progres5 = $db->table('tb_simonela_progres')
					->select('bulan_lapor, created_at')
					->selectsum('realisasi_keu')
					->selectsum('realisasi_fisik')
					->getWhere([
						'kegiatan' => $DT['rkpd_kegiatan_n'],
						'kegiatan_sub' => $DT['rkpd_kegiatan_sub_n'],
						'indikator_kegiatan_sub' => $DT['rkpd_indikator_kegiatan_sub'],
						'opd_id' => $_SESSION['opd_set'],
						'tahun' => $_SESSION['tahun'],
						'perubahan' => $_SESSION['perubahan'],
						'bulan' => 'b5'
					])->getRowArray();

				$realisasi5['realisasi_keu'] = $progres1['realisasi_keu'] + $progres2['realisasi_keu'] + $progres3['realisasi_keu'] + $progres4['realisasi_keu'] + $progres5['realisasi_keu'];
				$realisasi5['realisasi_fisik'] = $progres1['realisasi_fisik'] + $progres2['realisasi_fisik'] + $progres3['realisasi_fisik'] + $progres4['realisasi_fisik'] + $progres5['realisasi_fisik'];
				?>
				<td class="align-top">Mei</td>
				<td class="align-top text-wrap">
					<?php $tahap_aktifitas5 = $db->table('tb_simonela_progres')->select('tahap_aktifitas')->getWhere(['kegiatan' => $DT['rkpd_kegiatan_n'], 'kegiatan_sub' => $DT['rkpd_kegiatan_sub_n'], 'indikator_kegiatan_sub' => $DT['rkpd_indikator_kegiatan_sub'], 'opd_id' => $_SESSION['opd_set'], 'tahun' => $_SESSION['tahun'], 'perubahan' => $_SESSION['perubahan'], 'bulan' => 'b5'])->getResultArray(); ?>
					<?php foreach ($tahap_aktifitas5 as $tahap5) {
						echo '-' . $tahap5['tahap_aktifitas'] . '<br>';
					} ?>
				</td>
				<td class="align-top text-wrap">
					<?php $faktor_penghambat5 = $db->table('tb_simonela_progres')->select('faktor_penghambat')->getWhere(['kegiatan' => $DT['rkpd_kegiatan_n'], 'kegiatan_sub' => $DT['rkpd_kegiatan_sub_n'], 'indikator_kegiatan_sub' => $DT['rkpd_indikator_kegiatan_sub'], 'opd_id' => $_SESSION['opd_set'], 'tahun' => $_SESSION['tahun'], 'perubahan' => $_SESSION['perubahan'], 'bulan' => 'b5'])->getResultArray(); ?>
					<?php foreach ($faktor_penghambat5 as $penghambat5) {
						echo '-' . $penghambat5['faktor_penghambat'] . '<br>';
					} ?>
				</td>
				<td class="align-top text-wrap">
					<?php $faktor_pendukung5 = $db->table('tb_simonela_progres')->select('faktor_pendukung')->getWhere(['kegiatan' => $DT['rkpd_kegiatan_n'], 'kegiatan_sub' => $DT['rkpd_kegiatan_sub_n'], 'indikator_kegiatan_sub' => $DT['rkpd_indikator_kegiatan_sub'], 'opd_id' => $_SESSION['opd_set'], 'tahun' => $_SESSION['tahun'], 'perubahan' => $_SESSION['perubahan'], 'bulan' => 'b5'])->getResultArray(); ?>
					<?php foreach ($faktor_pendukung5 as $pendukung5) {
						echo '-' . $pendukung5['faktor_pendukung'] . '<br>';
					} ?>
				</td>
				<td class="align-top text-wrap">
					<?php $rencana_tindak_lanjut5 = $db->table('tb_simonela_progres')->select('rencana_tindak_lanjut')->getWhere(['kegiatan' => $DT['rkpd_kegiatan_n'], 'kegiatan_sub' => $DT['rkpd_kegiatan_sub_n'], 'indikator_kegiatan_sub' => $DT['rkpd_indikator_kegiatan_sub'], 'opd_id' => $_SESSION['opd_set'], 'tahun' => $_SESSION['tahun'], 'perubahan' => $_SESSION['perubahan'], 'bulan' => 'b5'])->getResultArray(); ?>
					<?php foreach ($rencana_tindak_lanjut5 as $tindak_lanjut5) {
						echo '-' . $tindak_lanjut5['rencana_tindak_lanjut'] . '<br>';
					} ?>
				</td>
				<td class="align-top text-right"><?= number_format($bb5, 0, ',', '.'); ?></td>
				<td class="align-top text-right"><?= number_format($fbb5, 2, ',', '.'); ?></td>
				<!-- <td class="align-top text-right"></td>
				<td class="align-top text-right"></td> -->
				<td class="align-top text-right"><?= isset($realisasi5['realisasi_keu']) ? number_format($realisasi5['realisasi_keu'], 0, ',', '.') : ''; ?></td>
				<td class="align-top text-right"><?= isset($realisasi5['realisasi_fisik']) ? number_format($realisasi5['realisasi_fisik'], 2, ',', '.') : ''; ?></td>
				<td class="align-top text-right">
					<?php
					try {
						echo isset($realisasi5['realisasi_keu']) ? round(($realisasi5['realisasi_keu'] / $bb5) * 100, 2) : '';
					} catch (DivisionByZeroError $e) {
						echo "Null";
					}
					?>
				</td>
				<td class="align-top text-right">
					<?php
					try {
						echo isset($realisasi5['realisasi_fisik']) ? number_format(round(($realisasi5['realisasi_fisik'] / $fbb5) * 100, 2), 2, ',', '.') : '';
					} catch (DivisionByZeroError $e) {
						echo "Null";
					}
					?>
				</td>
				<!-------------- Deviasi -->
				<td class="align-top text-right">
					<?php
					try {
						echo isset($realisasi5['realisasi_keu']) ? number_format(round(((($realisasi5['realisasi_keu'] / $DT['rp_tahun']) * 100) - (($bb5 / $DT['rp_tahun']) * 100)), 2), 2, ',', '.') : '';
					} catch (DivisionByZeroError $e) {
						echo "Null";
					}
					?>
				</td>
				<td class="align-top text-right">
					<?php
					try {
						echo isset($realisasi5['realisasi_fisik']) ? number_format(round((($realisasi5['realisasi_fisik'] - $fbb5)), 2), 2, ',', '.') : '';
					} catch (DivisionByZeroError $e) {
						echo "Null";
					}
					?>
				</td>
				<!-------------- //Deviasi-->

				<td class="align-top text-center"><?= isset($progres5['created_at']) ? $progres5['created_at'] : ''; ?></td>
				<td class="align-top text-center"><?= isset($progres5['bulan_lapor']) ? ($progres5['bulan_lapor'] > '05' ? '<text style="color: red;">Terlambat</text>' : '<text style="color:green;">Sudah Lapor</text>') : 'Belum Lapor'; ?> </td>
				<td class="align-top text-right">
					<a href="<?= base_url('/admin/simonela/simonela/progres_bulan/' . $DT['id_ropk_keuangan_rkpd_kegiatan_sub'] . '/' . 'b5' . '/Mei?keu=' . number_format($bb5, 0, ',', '.') . '&fis=' . number_format($fbb5, 0, ',', '.')); ?>">
						<li class="btn btn-block btn-warning btn-xs" active><i class="nav-icon fa fa-chart-pie"></i> Progres</li>
					</a>
				</td>
				<td class="align-top">
					<a href="<?= base_url('/admin/simonela/simonela/dokumen_add/' . $DT['id_ropk_keuangan_rkpd_kegiatan_sub'] . '/' . 'b5' . '/Mei'); ?>">
						<li class="btn btn-block btn-info btn-xs" active><i class="nav-icon fa fa-file"></i> Dokumen</li>
					</a>
				</td>
			</tr>
			<tr>
				<?php $progres6 = $db->table('tb_simonela_progres')
					->select('bulan_lapor, created_at')
					->selectsum('realisasi_keu')
					->selectsum('realisasi_fisik')
					->getWhere([
						'kegiatan' => $DT['rkpd_kegiatan_n'],
						'kegiatan_sub' => $DT['rkpd_kegiatan_sub_n'],
						'indikator_kegiatan_sub' => $DT['rkpd_indikator_kegiatan_sub'],
						'opd_id' => $_SESSION['opd_set'],
						'tahun' => $_SESSION['tahun'],
						'perubahan' => $_SESSION['perubahan'],
						'bulan' => 'b6'
					])->getRowArray();

				$realisasi6['realisasi_keu'] = $progres1['realisasi_keu'] + $progres2['realisasi_keu'] + $progres3['realisasi_keu'] + $progres4['realisasi_keu'] + $progres5['realisasi_keu'] + $progres6['realisasi_keu'];
				$realisasi6['realisasi_fisik'] = $progres1['realisasi_fisik'] + $progres2['realisasi_fisik'] + $progres3['realisasi_fisik'] + $progres4['realisasi_fisik'] + $progres5['realisasi_fisik'] + $progres6['realisasi_fisik'];
				?>
				<td class="align-top">Juni</td>
				<td class="align-top text-wrap">
					<?php $tahap_aktifitas6 = $db->table('tb_simonela_progres')->select('tahap_aktifitas')->getWhere(['kegiatan' => $DT['rkpd_kegiatan_n'], 'kegiatan_sub' => $DT['rkpd_kegiatan_sub_n'], 'indikator_kegiatan_sub' => $DT['rkpd_indikator_kegiatan_sub'], 'opd_id' => $_SESSION['opd_set'], 'tahun' => $_SESSION['tahun'], 'perubahan' => $_SESSION['perubahan'], 'bulan' => 'b6'])->getResultArray(); ?>
					<?php foreach ($tahap_aktifitas6 as $tahap6) {
						echo '-' . $tahap6['tahap_aktifitas'] . '<br>';
					} ?>
				</td>
				<td class="align-top text-wrap">
					<?php $faktor_penghambat6 = $db->table('tb_simonela_progres')->select('faktor_penghambat')->getWhere(['kegiatan' => $DT['rkpd_kegiatan_n'], 'kegiatan_sub' => $DT['rkpd_kegiatan_sub_n'], 'indikator_kegiatan_sub' => $DT['rkpd_indikator_kegiatan_sub'], 'opd_id' => $_SESSION['opd_set'], 'tahun' => $_SESSION['tahun'], 'perubahan' => $_SESSION['perubahan'], 'bulan' => 'b6'])->getResultArray(); ?>
					<?php foreach ($faktor_penghambat6 as $penghambat6) {
						echo '-' . $penghambat6['faktor_penghambat'] . '<br>';
					} ?>
				</td>
				<td class="align-top text-wrap">
					<?php $faktor_pendukung6 = $db->table('tb_simonela_progres')->select('faktor_pendukung')->getWhere(['kegiatan' => $DT['rkpd_kegiatan_n'], 'kegiatan_sub' => $DT['rkpd_kegiatan_sub_n'], 'indikator_kegiatan_sub' => $DT['rkpd_indikator_kegiatan_sub'], 'opd_id' => $_SESSION['opd_set'], 'tahun' => $_SESSION['tahun'], 'perubahan' => $_SESSION['perubahan'], 'bulan' => 'b6'])->getResultArray(); ?>
					<?php foreach ($faktor_pendukung6 as $pendukung6) {
						echo '-' . $pendukung6['faktor_pendukung'] . '<br>';
					} ?>
				</td>
				<td class="align-top text-wrap">
					<?php $rencana_tindak_lanjut6 = $db->table('tb_simonela_progres')->select('rencana_tindak_lanjut')->getWhere(['kegiatan' => $DT['rkpd_kegiatan_n'], 'kegiatan_sub' => $DT['rkpd_kegiatan_sub_n'], 'indikator_kegiatan_sub' => $DT['rkpd_indikator_kegiatan_sub'], 'opd_id' => $_SESSION['opd_set'], 'tahun' => $_SESSION['tahun'], 'perubahan' => $_SESSION['perubahan'], 'bulan' => 'b6'])->getResultArray(); ?>
					<?php foreach ($rencana_tindak_lanjut6 as $tindak_lanjut6) {
						echo '-' . $tindak_lanjut6['rencana_tindak_lanjut'] . '<br>';
					} ?>
				</td>
				<td class="align-top text-right"><?= number_format($bb6, 0, ',', '.'); ?></td>
				<td class="align-top text-right"><?= number_format($fbb6, 2, ',', '.'); ?></td>
				<!-- <td class="align-top text-right"></td>
				<td class="align-top text-right"></td> -->
				<td class="align-top text-right"><?= isset($realisasi6['realisasi_keu']) ? number_format($realisasi6['realisasi_keu'], 0, ',', '.') : ''; ?></td>
				<td class="align-top text-right"><?= isset($realisasi6['realisasi_fisik']) ? number_format($realisasi6['realisasi_fisik'], 2, ',', '.') : ''; ?></td>
				<td class="align-top text-right">
					<?php
					try {
						echo isset($realisasi6['realisasi_keu']) ? round(($realisasi6['realisasi_keu'] / $bb6) * 100, 2) : '';
					} catch (DivisionByZeroError $e) {
						echo "Null";
					}
					?>
				</td>
				<td class="align-top text-right">
					<?php
					try {
						echo isset($realisasi6['realisasi_fisik']) ? number_format(round(($realisasi6['realisasi_fisik'] / $fbb6) * 100, 2), 2, ',', '.') : '';
					} catch (DivisionByZeroError $e) {
						echo "Null";
					}
					?>
				</td>
				<!-------------- Deviasi -->
				<td class="align-top text-right">
					<?php
					try {
						echo isset($realisasi6['realisasi_keu']) ? number_format(round(((($realisasi6['realisasi_keu'] / $DT['rp_tahun']) * 100) - (($bb6 / $DT['rp_tahun']) * 100)), 2), 2, ',', '.') : '';
					} catch (DivisionByZeroError $e) {
						echo "Null";
					}
					?>
				</td>
				<td class="align-top text-right">
					<?php
					try {
						echo isset($realisasi6['realisasi_fisik']) ? number_format(round((($realisasi6['realisasi_fisik'] - $fbb6)), 2), 2, ',', '.') : '';
					} catch (DivisionByZeroError $e) {
						echo "Null";
					}
					?>
				</td>
				<!-------------- //Deviasi-->

				<td class="align-top text-center"><?= isset($progres6['created_at']) ? $progres6['created_at'] : ''; ?></td>
				<td class="align-top text-center"><?= isset($progres6['bulan_lapor']) ? ($progres6['bulan_lapor'] > '06' ? '<text style="color: red;">Terlambat</text>' : '<text style="color:green;">Sudah Lapor</text>') : 'Belum Lapor'; ?> </td>
				<td class="align-top text-right">
					<a href="<?= base_url('/admin/simonela/simonela/progres_bulan/' . $DT['id_ropk_keuangan_rkpd_kegiatan_sub'] . '/' . 'b6' . '/Juni?keu=' . number_format($bb6, 0, ',', '.') . '&fis=' . number_format($fbb6, 0, ',', '.')); ?>">
						<li class="btn btn-block btn-warning btn-xs" active><i class="nav-icon fa fa-chart-pie"></i> Progres</li>
					</a>
				</td>
				<td class="align-top">
					<a href="<?= base_url('/admin/simonela/simonela/dokumen_add/' . $DT['id_ropk_keuangan_rkpd_kegiatan_sub'] . '/' . 'b6' . '/Juni'); ?>">
						<li class="btn btn-block btn-info btn-xs" active><i class="nav-icon fa fa-file"></i> Dokumen</li>
					</a>
				</td>
			</tr>
			<tr>
				<?php $progres7 = $db->table('tb_simonela_progres')
					->select('bulan_lapor, created_at')
					->selectsum('realisasi_keu')
					->selectsum('realisasi_fisik')
					->getWhere([
						'kegiatan' => $DT['rkpd_kegiatan_n'],
						'kegiatan_sub' => $DT['rkpd_kegiatan_sub_n'],
						'indikator_kegiatan_sub' => $DT['rkpd_indikator_kegiatan_sub'],
						'opd_id' => $_SESSION['opd_set'],
						'tahun' => $_SESSION['tahun'],
						'perubahan' => $_SESSION['perubahan'],
						'bulan' => 'b7'
					])->getRowArray();

				$realisasi7['realisasi_keu'] = $progres1['realisasi_keu'] + $progres2['realisasi_keu'] + $progres3['realisasi_keu'] + $progres4['realisasi_keu'] + $progres5['realisasi_keu'] + $progres6['realisasi_keu'] + $progres7['realisasi_keu'];
				$realisasi7['realisasi_fisik'] = $progres1['realisasi_fisik'] + $progres2['realisasi_fisik'] + $progres3['realisasi_fisik'] + $progres4['realisasi_fisik'] + $progres5['realisasi_fisik'] + $progres6['realisasi_fisik'] + $progres7['realisasi_fisik'];

				?>
				<td class="align-top">Juli</td>
				<td class="align-top text-wrap">
					<?php $tahap_aktifitas7 = $db->table('tb_simonela_progres')->select('tahap_aktifitas')->getWhere(['kegiatan' => $DT['rkpd_kegiatan_n'], 'kegiatan_sub' => $DT['rkpd_kegiatan_sub_n'], 'indikator_kegiatan_sub' => $DT['rkpd_indikator_kegiatan_sub'], 'opd_id' => $_SESSION['opd_set'], 'tahun' => $_SESSION['tahun'], 'perubahan' => $_SESSION['perubahan'], 'bulan' => 'b7'])->getResultArray(); ?>
					<?php foreach ($tahap_aktifitas7 as $tahap7) {
						echo '-' . $tahap7['tahap_aktifitas'] . '<br>';
					} ?>
				</td>
				<td class="align-top text-wrap">
					<?php $faktor_penghambat7 = $db->table('tb_simonela_progres')->select('faktor_penghambat')->getWhere(['kegiatan' => $DT['rkpd_kegiatan_n'], 'kegiatan_sub' => $DT['rkpd_kegiatan_sub_n'], 'indikator_kegiatan_sub' => $DT['rkpd_indikator_kegiatan_sub'], 'opd_id' => $_SESSION['opd_set'], 'tahun' => $_SESSION['tahun'], 'perubahan' => $_SESSION['perubahan'], 'bulan' => 'b7'])->getResultArray(); ?>
					<?php foreach ($faktor_penghambat7 as $penghambat7) {
						echo '-' . $penghambat7['faktor_penghambat'] . '<br>';
					} ?>
				</td>
				<td class="align-top text-wrap">
					<?php $faktor_pendukung7 = $db->table('tb_simonela_progres')->select('faktor_pendukung')->getWhere(['kegiatan' => $DT['rkpd_kegiatan_n'], 'kegiatan_sub' => $DT['rkpd_kegiatan_sub_n'], 'indikator_kegiatan_sub' => $DT['rkpd_indikator_kegiatan_sub'], 'opd_id' => $_SESSION['opd_set'], 'tahun' => $_SESSION['tahun'], 'perubahan' => $_SESSION['perubahan'], 'bulan' => 'b7'])->getResultArray(); ?>
					<?php foreach ($faktor_pendukung7 as $pendukung7) {
						echo '-' . $pendukung7['faktor_pendukung'] . '<br>';
					} ?>
				</td>
				<td class="align-top text-wrap">
					<?php $rencana_tindak_lanjut7 = $db->table('tb_simonela_progres')->select('rencana_tindak_lanjut')->getWhere(['kegiatan' => $DT['rkpd_kegiatan_n'], 'kegiatan_sub' => $DT['rkpd_kegiatan_sub_n'], 'indikator_kegiatan_sub' => $DT['rkpd_indikator_kegiatan_sub'], 'opd_id' => $_SESSION['opd_set'], 'tahun' => $_SESSION['tahun'], 'perubahan' => $_SESSION['perubahan'], 'bulan' => 'b7'])->getResultArray(); ?>
					<?php foreach ($rencana_tindak_lanjut7 as $tindak_lanjut7) {
						echo '-' . $tindak_lanjut7['rencana_tindak_lanjut'] . '<br>';
					} ?>
				</td>
				<td class="align-top text-right"><?= number_format($bb7, 0, ',', '.'); ?></td>
				<td class="align-top text-right"><?= number_format($fbb7, 2, ',', '.'); ?></td>
				<!-- <td class="align-top text-right"></td>
				<td class="align-top text-right"></td> -->
				<td class="align-top text-right"><?= isset($realisasi7['realisasi_keu']) ? number_format($realisasi7['realisasi_keu'], 0, ',', '.') : ''; ?></td>
				<td class="align-top text-right"><?= isset($realisasi7['realisasi_fisik']) ? number_format($realisasi7['realisasi_fisik'], 2, ',', '.') : ''; ?></td>
				<td class="align-top text-right">
					<?php
					try {
						echo isset($realisasi7['realisasi_keu']) ? round(($realisasi7['realisasi_keu'] / $bb7) * 100, 2) : '';
					} catch (DivisionByZeroError $e) {
						echo "Null";
					}
					?>
				</td>
				<td class="align-top text-right">
					<?php
					try {
						echo isset($realisasi7['realisasi_fisik']) ? number_format(round(($realisasi7['realisasi_fisik'] / $fbb7) * 100, 2), 2, ',', '.') : '';
					} catch (DivisionByZeroError $e) {
						echo "Null";
					}
					?>
				</td>
				<!-------------- Deviasi -->
				<td class="align-top text-right">
					<?php
					try {
						echo isset($realisasi7['realisasi_keu']) ? number_format(round(((($realisasi7['realisasi_keu'] / $DT['rp_tahun']) * 100) - (($bb7 / $DT['rp_tahun']) * 100)), 2), 2, ',', '.') : '';
					} catch (DivisionByZeroError $e) {
						echo "Null";
					}
					?>
				</td>
				<td class="align-top text-right">
					<?php
					try {
						echo isset($realisasi7['realisasi_fisik']) ? number_format(round((($realisasi7['realisasi_fisik'] - $fbb7)), 2), 2, ',', '.') : '';
					} catch (DivisionByZeroError $e) {
						echo "Null";
					}
					?>
				</td>
				<!-------------- //Deviasi-->

				<td class="align-top text-center"><?= isset($progres7['created_at']) ? $progres7['created_at'] : ''; ?></td>
				<td class="align-top text-center"><?= isset($progres7['bulan_lapor']) ? ($progres7['bulan_lapor'] > '07' ? '<text style="color: red;">Terlambat</text>' : '<text style="color:green;">Sudah Lapor</text>') : 'Belum Lapor'; ?> </td>
				<td class="align-top text-right">
					<a href="<?= base_url('/admin/simonela/simonela/progres_bulan/' . $DT['id_ropk_keuangan_rkpd_kegiatan_sub'] . '/' . 'b7' . '/Juli?keu=' . number_format($bb7, 0, ',', '.') . '&fis=' . number_format($fbb7, 0, ',', '.')); ?>">
						<li class="btn btn-block btn-warning btn-xs" active><i class="nav-icon fa fa-chart-pie"></i> Progres</li>
					</a>
				</td>
				<td class="align-top">
					<a href="<?= base_url('/admin/simonela/simonela/dokumen_add/' . $DT['id_ropk_keuangan_rkpd_kegiatan_sub'] . '/' . 'b7' . '/Juli'); ?>">
						<li class="btn btn-block btn-info btn-xs" active><i class="nav-icon fa fa-file"></i> Dokumen</li>
					</a>
				</td>
			</tr>
			<tr>
				<?php $progres8 = $db->table('tb_simonela_progres')
					->select('bulan_lapor, created_at')
					->selectsum('realisasi_keu')
					->selectsum('realisasi_fisik')
					->getWhere([
						'kegiatan' => $DT['rkpd_kegiatan_n'],
						'kegiatan_sub' => $DT['rkpd_kegiatan_sub_n'],
						'indikator_kegiatan_sub' => $DT['rkpd_indikator_kegiatan_sub'],
						'opd_id' => $_SESSION['opd_set'],
						'tahun' => $_SESSION['tahun'],
						'perubahan' => $_SESSION['perubahan'],
						'bulan' => 'b8'
					])->getRowArray();

				$realisasi8['realisasi_keu'] = $progres1['realisasi_keu'] + $progres2['realisasi_keu'] + $progres3['realisasi_keu'] + $progres4['realisasi_keu'] + $progres5['realisasi_keu'] + $progres6['realisasi_keu'] + $progres7['realisasi_keu'] + $progres8['realisasi_keu'];
				$realisasi8['realisasi_fisik'] = $progres1['realisasi_fisik'] + $progres2['realisasi_fisik'] + $progres3['realisasi_fisik'] + $progres4['realisasi_fisik'] + $progres5['realisasi_fisik'] + $progres6['realisasi_fisik'] + $progres7['realisasi_fisik'] + $progres8['realisasi_fisik'];
				?>
				<td class="align-top">Agustus</td>
				<td class="align-top text-wrap">
					<?php $tahap_aktifitas8 = $db->table('tb_simonela_progres')->select('tahap_aktifitas')->getWhere(['kegiatan' => $DT['rkpd_kegiatan_n'], 'kegiatan_sub' => $DT['rkpd_kegiatan_sub_n'], 'indikator_kegiatan_sub' => $DT['rkpd_indikator_kegiatan_sub'], 'opd_id' => $_SESSION['opd_set'], 'tahun' => $_SESSION['tahun'], 'perubahan' => $_SESSION['perubahan'], 'bulan' => 'b8'])->getResultArray(); ?>
					<?php foreach ($tahap_aktifitas8 as $tahap8) {
						echo '-' . $tahap8['tahap_aktifitas'] . '<br>';
					} ?>
				</td>
				<td class="align-top text-wrap">
					<?php $faktor_penghambat8 = $db->table('tb_simonela_progres')->select('faktor_penghambat')->getWhere(['kegiatan' => $DT['rkpd_kegiatan_n'], 'kegiatan_sub' => $DT['rkpd_kegiatan_sub_n'], 'indikator_kegiatan_sub' => $DT['rkpd_indikator_kegiatan_sub'], 'opd_id' => $_SESSION['opd_set'], 'tahun' => $_SESSION['tahun'], 'perubahan' => $_SESSION['perubahan'], 'bulan' => 'b8'])->getResultArray(); ?>
					<?php foreach ($faktor_penghambat8 as $penghambat8) {
						echo '-' . $penghambat8['faktor_penghambat'] . '<br>';
					} ?>
				</td>
				<td class="align-top text-wrap">
					<?php $faktor_pendukung8 = $db->table('tb_simonela_progres')->select('faktor_pendukung')->getWhere(['kegiatan' => $DT['rkpd_kegiatan_n'], 'kegiatan_sub' => $DT['rkpd_kegiatan_sub_n'], 'indikator_kegiatan_sub' => $DT['rkpd_indikator_kegiatan_sub'], 'opd_id' => $_SESSION['opd_set'], 'tahun' => $_SESSION['tahun'], 'perubahan' => $_SESSION['perubahan'], 'bulan' => 'b8'])->getResultArray(); ?>
					<?php foreach ($faktor_pendukung8 as $pendukung8) {
						echo '-' . $pendukung8['faktor_pendukung'] . '<br>';
					} ?>
				</td>
				<td class="align-top text-wrap">
					<?php $rencana_tindak_lanjut8 = $db->table('tb_simonela_progres')->select('rencana_tindak_lanjut')->getWhere(['kegiatan' => $DT['rkpd_kegiatan_n'], 'kegiatan_sub' => $DT['rkpd_kegiatan_sub_n'], 'indikator_kegiatan_sub' => $DT['rkpd_indikator_kegiatan_sub'], 'opd_id' => $_SESSION['opd_set'], 'tahun' => $_SESSION['tahun'], 'perubahan' => $_SESSION['perubahan'], 'bulan' => 'b8'])->getResultArray(); ?>
					<?php foreach ($rencana_tindak_lanjut8 as $tindak_lanjut8) {
						echo '-' . $tindak_lanjut8['rencana_tindak_lanjut'] . '<br>';
					} ?>
				</td>
				<td class="align-top text-right"><?= number_format($bb8, 0, ',', '.'); ?></td>
				<td class="align-top text-right"><?= number_format($fbb8, 2, ',', '.'); ?></td>
				<!-- <td class="align-top text-right"></td>
				<td class="align-top text-right"></td> -->
				<td class="align-top text-right"><?= isset($realisasi8['realisasi_keu']) ? number_format($realisasi8['realisasi_keu'], 0, ',', '.') : ''; ?></td>
				<td class="align-top text-right"><?= isset($realisasi8['realisasi_fisik']) ? number_format($realisasi8['realisasi_fisik'], 2, ',', '.') : ''; ?></td>
				<td class="align-top text-right">
					<?php
					try {
						echo isset($realisasi8['realisasi_keu']) ? round(($realisasi8['realisasi_keu'] / $bb8) * 100, 2) : '';
					} catch (DivisionByZeroError $e) {
						echo "Null";
					}
					?>
				</td>
				<td class="align-top text-right">
					<?php
					try {
						echo isset($realisasi8['realisasi_fisik']) ? number_format(round(($realisasi8['realisasi_fisik'] / $fbb8) * 100, 2), 2, ',', '.') : '';
					} catch (DivisionByZeroError $e) {
						echo "Null";
					}
					?>
				</td>
				<!-------------- Deviasi -->
				<td class="align-top text-right">
					<?php
					try {
						echo isset($realisasi8['realisasi_keu']) ? number_format(round(((($realisasi8['realisasi_keu'] / $DT['rp_tahun']) * 100) - (($bb8 / $DT['rp_tahun']) * 100)), 2), 2, ',', '.') : '';
					} catch (DivisionByZeroError $e) {
						echo "Null";
					}
					?>
				</td>
				<td class="align-top text-right">
					<?php
					try {
						echo isset($realisasi8['realisasi_fisik']) ? number_format(round((($realisasi8['realisasi_fisik'] - $fbb8)), 2), 2, ',', '.') : '';
					} catch (DivisionByZeroError $e) {
						echo "Null";
					}
					?>
				</td>
				<!-------------- //Deviasi-->

				<td class="align-top text-center"><?= isset($progres8['created_at']) ? $progres8['created_at'] : ''; ?></td>
				<td class="align-top text-center"><?= isset($progres8['bulan_lapor']) ? ($progres8['bulan_lapor'] > '08' ? '<text style="color: red;">Terlambat</text>' : '<text style="color:green;">Sudah Lapor</text>') : 'Belum Lapor'; ?> </td>
				<td class="align-top text-right">
					<a href="<?= base_url('/admin/simonela/simonela/progres_bulan/' . $DT['id_ropk_keuangan_rkpd_kegiatan_sub'] . '/' . 'b8' . '/Agustus?keu=' . number_format($bb8, 0, ',', '.') . '&fis=' . number_format($fbb8, 0, ',', '.')); ?>">
						<li class="btn btn-block btn-warning btn-xs" active><i class="nav-icon fa fa-chart-pie"></i> Progres</li>
					</a>
				</td>
				<td class="align-top">
					<a href="<?= base_url('/admin/simonela/simonela/dokumen_add/' . $DT['id_ropk_keuangan_rkpd_kegiatan_sub'] . '/' . 'b8' . '/Agustus'); ?>">
						<li class="btn btn-block btn-info btn-xs" active><i class="nav-icon fa fa-file"></i> Dokumen</li>
					</a>
				</td>
			</tr>
			<tr>
				<?php $progres9 = $db->table('tb_simonela_progres')
					->select('bulan_lapor, created_at')
					->selectsum('realisasi_keu')
					->selectsum('realisasi_fisik')
					->getWhere([
						'kegiatan' => $DT['rkpd_kegiatan_n'],
						'kegiatan_sub' => $DT['rkpd_kegiatan_sub_n'],
						'indikator_kegiatan_sub' => $DT['rkpd_indikator_kegiatan_sub'],
						'opd_id' => $_SESSION['opd_set'],
						'tahun' => $_SESSION['tahun'],
						'perubahan' => $_SESSION['perubahan'],
						'bulan' => 'b9'
					])->getRowArray();

				$realisasi9['realisasi_keu'] = $progres1['realisasi_keu'] + $progres2['realisasi_keu'] + $progres3['realisasi_keu'] + $progres4['realisasi_keu'] + $progres5['realisasi_keu'] + $progres6['realisasi_keu'] + $progres7['realisasi_keu'] + $progres8['realisasi_keu'] + $progres9['realisasi_keu'];
				$realisasi9['realisasi_fisik'] = $progres1['realisasi_fisik'] + $progres2['realisasi_fisik'] + $progres3['realisasi_fisik'] + $progres4['realisasi_fisik'] + $progres5['realisasi_fisik'] + $progres6['realisasi_fisik'] + $progres7['realisasi_fisik'] + $progres8['realisasi_fisik'] + $progres9['realisasi_fisik'];
				?>
				<td class="align-top">September</td>
				<td class="align-top text-wrap">
					<?php $tahap_aktifitas9 = $db->table('tb_simonela_progres')->select('tahap_aktifitas')->getWhere(['kegiatan' => $DT['rkpd_kegiatan_n'], 'kegiatan_sub' => $DT['rkpd_kegiatan_sub_n'], 'indikator_kegiatan_sub' => $DT['rkpd_indikator_kegiatan_sub'], 'opd_id' => $_SESSION['opd_set'], 'tahun' => $_SESSION['tahun'], 'perubahan' => $_SESSION['perubahan'], 'bulan' => 'b9'])->getResultArray(); ?>
					<?php foreach ($tahap_aktifitas9 as $tahap9) {
						echo '-' . $tahap9['tahap_aktifitas'] . '<br>';
					} ?>
				</td>
				<td class="align-top text-wrap">
					<?php $faktor_penghambat9 = $db->table('tb_simonela_progres')->select('faktor_penghambat')->getWhere(['kegiatan' => $DT['rkpd_kegiatan_n'], 'kegiatan_sub' => $DT['rkpd_kegiatan_sub_n'], 'indikator_kegiatan_sub' => $DT['rkpd_indikator_kegiatan_sub'], 'opd_id' => $_SESSION['opd_set'], 'tahun' => $_SESSION['tahun'], 'perubahan' => $_SESSION['perubahan'], 'bulan' => 'b9'])->getResultArray(); ?>
					<?php foreach ($faktor_penghambat9 as $penghambat9) {
						echo '-' . $penghambat9['faktor_penghambat'] . '<br>';
					} ?>
				</td>
				<td class="align-top text-wrap">
					<?php $faktor_pendukung9 = $db->table('tb_simonela_progres')->select('faktor_pendukung')->getWhere(['kegiatan' => $DT['rkpd_kegiatan_n'], 'kegiatan_sub' => $DT['rkpd_kegiatan_sub_n'], 'indikator_kegiatan_sub' => $DT['rkpd_indikator_kegiatan_sub'], 'opd_id' => $_SESSION['opd_set'], 'tahun' => $_SESSION['tahun'], 'perubahan' => $_SESSION['perubahan'], 'bulan' => 'b9'])->getResultArray(); ?>
					<?php foreach ($faktor_pendukung9 as $pendukung9) {
						echo '-' . $pendukung9['faktor_pendukung'] . '<br>';
					} ?>
				</td>
				<td class="align-top text-wrap">
					<?php $rencana_tindak_lanjut9 = $db->table('tb_simonela_progres')->select('rencana_tindak_lanjut')->getWhere(['kegiatan' => $DT['rkpd_kegiatan_n'], 'kegiatan_sub' => $DT['rkpd_kegiatan_sub_n'], 'indikator_kegiatan_sub' => $DT['rkpd_indikator_kegiatan_sub'], 'opd_id' => $_SESSION['opd_set'], 'tahun' => $_SESSION['tahun'], 'perubahan' => $_SESSION['perubahan'], 'bulan' => 'b9'])->getResultArray(); ?>
					<?php foreach ($rencana_tindak_lanjut9 as $tindak_lanjut9) {
						echo '-' . $tindak_lanjut9['rencana_tindak_lanjut'] . '<br>';
					} ?>
				</td>
				<td class="align-top text-right"><?= number_format($bb9, 0, ',', '.'); ?></td>
				<td class="align-top text-right"><?= number_format($fbb9, 2, ',', '.'); ?></td>
				<!-- <td class="align-top text-right"></td>
				<td class="align-top text-right"></td> -->
				<td class="align-top text-right"><?= isset($realisasi9['realisasi_keu']) ? number_format($realisasi9['realisasi_keu'], 0, ',', '.') : ''; ?></td>
				<td class="align-top text-right"><?= isset($realisasi9['realisasi_fisik']) ? number_format($realisasi9['realisasi_fisik'], 2, ',', '.') : ''; ?></td>
				<td class="align-top text-right">
					<?php
					try {
						echo isset($realisasi9['realisasi_keu']) ? round(($realisasi9['realisasi_keu'] / $bb9) * 100, 2) : '';
					} catch (DivisionByZeroError $e) {
						echo "Null";
					}
					?>
				</td>
				<td class="align-top text-right">
					<?php
					try {
						echo isset($realisasi9['realisasi_fisik']) ? number_format(round(($realisasi9['realisasi_fisik'] / $fbb9) * 100, 2), 2, ',', '.') : '';
					} catch (DivisionByZeroError $e) {
						echo "Null";
					}
					?>
				</td>
				<!-------------- Deviasi -->
				<td class="align-top text-right">
					<?php
					try {
						echo isset($realisasi9['realisasi_keu']) ? number_format(round(((($realisasi9['realisasi_keu'] / $DT['rp_tahun']) * 100) - (($bb9 / $DT['rp_tahun']) * 100)), 2), 2, ',', '.') : '';
					} catch (DivisionByZeroError $e) {
						echo "Null";
					}
					?>
				</td>
				<td class="align-top text-right">
					<?php
					try {
						echo isset($realisasi9['realisasi_fisik']) ? number_format(round((($realisasi9['realisasi_fisik'] - $fbb9)), 2), 2, ',', '.') : '';
					} catch (DivisionByZeroError $e) {
						echo "Null";
					}
					?>
				</td>
				<!-------------- //Deviasi-->

				<td class="align-top text-center"><?= isset($progres9['created_at']) ? $progres9['created_at'] : ''; ?></td>
				<td class="align-top text-center"><?= isset($progres9['bulan_lapor']) ? ($progres9['bulan_lapor'] > '09' ? '<text style="color: red;">Terlambat</text>' : '<text style="color:green;">Sudah Lapor</text>') : 'Belum Lapor'; ?> </td>
				<td class="align-top text-right">
					<a href="<?= base_url('/admin/simonela/simonela/progres_bulan/' . $DT['id_ropk_keuangan_rkpd_kegiatan_sub'] . '/' . 'b9' . '/September?keu=' . number_format($bb9, 0, ',', '.') . '&fis=' . number_format($fbb9, 0, ',', '.')); ?>">
						<li class="btn btn-block btn-warning btn-xs" active><i class="nav-icon fa fa-chart-pie"></i> Progres</li>
					</a>
				</td>
				<td class="align-top">
					<a href="<?= base_url('/admin/simonela/simonela/dokumen_add/' . $DT['id_ropk_keuangan_rkpd_kegiatan_sub'] . '/' . 'b9' . '/September'); ?>">
						<li class="btn btn-block btn-info btn-xs" active><i class="nav-icon fa fa-file"></i> Dokumen</li>
					</a>
				</td>
			</tr>
			<tr>
				<?php $progres10 = $db->table('tb_simonela_progres')
					->select('bulan_lapor, created_at')
					->selectsum('realisasi_keu')
					->selectsum('realisasi_fisik')
					->getWhere([
						'kegiatan' => $DT['rkpd_kegiatan_n'],
						'kegiatan_sub' => $DT['rkpd_kegiatan_sub_n'],
						'indikator_kegiatan_sub' => $DT['rkpd_indikator_kegiatan_sub'],
						'opd_id' => $_SESSION['opd_set'],
						'tahun' => $_SESSION['tahun'],
						'perubahan' => $_SESSION['perubahan'],
						'bulan' => 'b10'
					])->getRowArray();

				$realisasi10['realisasi_keu'] = $progres1['realisasi_keu'] + $progres2['realisasi_keu'] + $progres3['realisasi_keu'] + $progres4['realisasi_keu'] + $progres5['realisasi_keu'] + $progres6['realisasi_keu'] + $progres7['realisasi_keu'] + $progres8['realisasi_keu'] + $progres9['realisasi_keu'] + $progres10['realisasi_keu'];
				$realisasi10['realisasi_fisik'] = $progres1['realisasi_fisik'] + $progres2['realisasi_fisik'] + $progres3['realisasi_fisik'] + $progres4['realisasi_fisik'] + $progres5['realisasi_fisik'] + $progres6['realisasi_fisik'] + $progres7['realisasi_fisik'] + $progres8['realisasi_fisik'] + $progres9['realisasi_fisik'] + $progres10['realisasi_fisik'];

				?>
				<td class="align-top">Oktober</td>
				<td class="align-top text-wrap">
					<?php $tahap_aktifitas10 = $db->table('tb_simonela_progres')->select('tahap_aktifitas')->getWhere(['kegiatan' => $DT['rkpd_kegiatan_n'], 'kegiatan_sub' => $DT['rkpd_kegiatan_sub_n'], 'indikator_kegiatan_sub' => $DT['rkpd_indikator_kegiatan_sub'], 'opd_id' => $_SESSION['opd_set'], 'tahun' => $_SESSION['tahun'], 'perubahan' => $_SESSION['perubahan'], 'bulan' => 'b10'])->getResultArray(); ?>
					<?php foreach ($tahap_aktifitas10 as $tahap10) {
						echo '-' . $tahap10['tahap_aktifitas'] . '<br>';
					} ?>
				</td>
				<td class="align-top text-wrap">
					<?php $faktor_penghambat10 = $db->table('tb_simonela_progres')->select('faktor_penghambat')->getWhere(['kegiatan' => $DT['rkpd_kegiatan_n'], 'kegiatan_sub' => $DT['rkpd_kegiatan_sub_n'], 'indikator_kegiatan_sub' => $DT['rkpd_indikator_kegiatan_sub'], 'opd_id' => $_SESSION['opd_set'], 'tahun' => $_SESSION['tahun'], 'perubahan' => $_SESSION['perubahan'], 'bulan' => 'b10'])->getResultArray(); ?>
					<?php foreach ($faktor_penghambat10 as $penghambat10) {
						echo '-' . $penghambat10['faktor_penghambat'] . '<br>';
					} ?>
				</td>
				<td class="align-top text-wrap">
					<?php $faktor_pendukung10 = $db->table('tb_simonela_progres')->select('faktor_pendukung')->getWhere(['kegiatan' => $DT['rkpd_kegiatan_n'], 'kegiatan_sub' => $DT['rkpd_kegiatan_sub_n'], 'indikator_kegiatan_sub' => $DT['rkpd_indikator_kegiatan_sub'], 'opd_id' => $_SESSION['opd_set'], 'tahun' => $_SESSION['tahun'], 'perubahan' => $_SESSION['perubahan'], 'bulan' => 'b10'])->getResultArray(); ?>
					<?php foreach ($faktor_pendukung10 as $pendukung10) {
						echo '-' . $pendukung10['faktor_pendukung'] . '<br>';
					} ?>
				</td>
				<td class="align-top text-wrap">
					<?php $rencana_tindak_lanjut10 = $db->table('tb_simonela_progres')->select('rencana_tindak_lanjut')->getWhere(['kegiatan' => $DT['rkpd_kegiatan_n'], 'kegiatan_sub' => $DT['rkpd_kegiatan_sub_n'], 'indikator_kegiatan_sub' => $DT['rkpd_indikator_kegiatan_sub'], 'opd_id' => $_SESSION['opd_set'], 'tahun' => $_SESSION['tahun'], 'perubahan' => $_SESSION['perubahan'], 'bulan' => 'b10'])->getResultArray(); ?>
					<?php foreach ($rencana_tindak_lanjut10 as $tindak_lanjut10) {
						echo '-' . $tindak_lanjut10['rencana_tindak_lanjut'] . '<br>';
					} ?>
				</td>
				<td class="align-top text-right"><?= number_format($bb10, 0, ',', '.'); ?></td>
				<td class="align-top text-right"><?= number_format($fbb10, 2, ',', '.'); ?></td>
				<!-- <td class="align-top text-right"></td>
				<td class="align-top text-right"></td> -->
				<td class="align-top text-right"><?= isset($realisasi10['realisasi_keu']) ? number_format($realisasi10['realisasi_keu'], 0, ',', '.') : ''; ?></td>
				<td class="align-top text-right"><?= isset($realisasi10['realisasi_fisik']) ? number_format($realisasi10['realisasi_fisik'], 2, ',', '.') : ''; ?></td>
				<td class="align-top text-right">
					<?php
					try {
						echo isset($realisasi10['realisasi_keu']) ? round(($realisasi10['realisasi_keu'] / $bb10) * 100, 2) : '';
					} catch (DivisionByZeroError $e) {
						echo "Null";
					}
					?>
				</td>
				<td class="align-top text-right">
					<?php
					try {
						echo isset($realisasi10['realisasi_fisik']) ? number_format(round(($realisasi10['realisasi_fisik'] / $fbb10) * 100, 2), 2, ',', '.') : '';
					} catch (DivisionByZeroError $e) {
						echo "Null";
					}
					?>
				</td>
				<!-------------- Deviasi -->
				<td class="align-top text-right">
					<?php
					try {
						echo isset($realisasi10['realisasi_keu']) ? number_format(round(((($realisasi10['realisasi_keu'] / $DT['rp_tahun']) * 100) - (($bb10 / $DT['rp_tahun']) * 100)), 2), 2, ',', '.') : '';
					} catch (DivisionByZeroError $e) {
						echo "Null";
					}
					?>
				</td>
				<td class="align-top text-right">
					<?php
					try {
						echo isset($realisasi10['realisasi_fisik']) ? number_format(round((($realisasi10['realisasi_fisik'] - $fbb10)), 2), 2, ',', '.') : '';
					} catch (DivisionByZeroError $e) {
						echo "Null";
					}
					?>
				</td>
				<!-------------- //Deviasi-->

				<td class="align-top text-center"><?= isset($progres10['created_at']) ? $progres10['created_at'] : ''; ?></td>
				<td class="align-top text-center"><?= isset($progres10['bulan_lapor']) ? ($progres10['bulan_lapor'] > '10' ? '<text style="color: red;">Terlambat</text>' : '<text style="color:green;">Sudah Lapor</text>') : 'Belum Lapor'; ?> </td>
				<td class="align-top text-right">
					<a href="<?= base_url('/admin/simonela/simonela/progres_bulan/' . $DT['id_ropk_keuangan_rkpd_kegiatan_sub'] . '/' . 'b10' . '/Oktober?keu=' . number_format($bb10, 0, ',', '.') . '&fis=' . number_format($fbb10, 0, ',', '.')); ?>">
						<li class="btn btn-block btn-warning btn-xs" active><i class="nav-icon fa fa-chart-pie"></i> Progres</li>
					</a>
				</td>
				<td class="align-top">
					<a href="<?= base_url('/admin/simonela/simonela/dokumen_add/' . $DT['id_ropk_keuangan_rkpd_kegiatan_sub'] . '/' . 'b10' . '/Oktober'); ?>">
						<li class="btn btn-block btn-info btn-xs" active><i class="nav-icon fa fa-file"></i> Dokumen</li>
					</a>
				</td>
			</tr>
			<tr>
				<?php $progres11 = $db->table('tb_simonela_progres')
					->select('bulan_lapor, created_at')
					->selectsum('realisasi_keu')
					->selectsum('realisasi_fisik')
					->getWhere([
						'kegiatan' => $DT['rkpd_kegiatan_n'],
						'kegiatan_sub' => $DT['rkpd_kegiatan_sub_n'],
						'indikator_kegiatan_sub' => $DT['rkpd_indikator_kegiatan_sub'],
						'opd_id' => $_SESSION['opd_set'],
						'tahun' => $_SESSION['tahun'],
						'perubahan' => $_SESSION['perubahan'],
						'bulan' => 'b11'
					])->getRowArray();

				$realisasi11['realisasi_keu'] = $progres1['realisasi_keu'] + $progres2['realisasi_keu'] + $progres3['realisasi_keu'] + $progres4['realisasi_keu'] + $progres5['realisasi_keu'] + $progres6['realisasi_keu'] + $progres7['realisasi_keu'] + $progres8['realisasi_keu'] + $progres9['realisasi_keu'] + $progres10['realisasi_keu'] + $progres11['realisasi_keu'];
				$realisasi11['realisasi_fisik'] = $progres1['realisasi_fisik'] + $progres2['realisasi_fisik'] + $progres3['realisasi_fisik'] + $progres4['realisasi_fisik'] + $progres5['realisasi_fisik'] + $progres6['realisasi_fisik'] + $progres7['realisasi_fisik'] + $progres8['realisasi_fisik'] + $progres9['realisasi_fisik'] + $progres10['realisasi_fisik'] + $progres11['realisasi_fisik'];
				?>
				<td class="align-top">November</td>
				<td class="align-top text-wrap">
					<?php $tahap_aktifitas11 = $db->table('tb_simonela_progres')->select('tahap_aktifitas')->getWhere(['kegiatan' => $DT['rkpd_kegiatan_n'], 'kegiatan_sub' => $DT['rkpd_kegiatan_sub_n'], 'indikator_kegiatan_sub' => $DT['rkpd_indikator_kegiatan_sub'], 'opd_id' => $_SESSION['opd_set'], 'tahun' => $_SESSION['tahun'], 'perubahan' => $_SESSION['perubahan'], 'bulan' => 'b11'])->getResultArray(); ?>
					<?php foreach ($tahap_aktifitas11 as $tahap11) {
						echo '-' . $tahap11['tahap_aktifitas'] . '<br>';
					} ?>
				</td>
				<td class="align-top text-wrap">
					<?php $faktor_penghambat11 = $db->table('tb_simonela_progres')->select('faktor_penghambat')->getWhere(['kegiatan' => $DT['rkpd_kegiatan_n'], 'kegiatan_sub' => $DT['rkpd_kegiatan_sub_n'], 'indikator_kegiatan_sub' => $DT['rkpd_indikator_kegiatan_sub'], 'opd_id' => $_SESSION['opd_set'], 'tahun' => $_SESSION['tahun'], 'perubahan' => $_SESSION['perubahan'], 'bulan' => 'b11'])->getResultArray(); ?>
					<?php foreach ($faktor_penghambat11 as $penghambat11) {
						echo '-' . $penghambat11['faktor_penghambat'] . '<br>';
					} ?>
				</td>
				<td class="align-top text-wrap">
					<?php $faktor_pendukung11 = $db->table('tb_simonela_progres')->select('faktor_pendukung')->getWhere(['kegiatan' => $DT['rkpd_kegiatan_n'], 'kegiatan_sub' => $DT['rkpd_kegiatan_sub_n'], 'indikator_kegiatan_sub' => $DT['rkpd_indikator_kegiatan_sub'], 'opd_id' => $_SESSION['opd_set'], 'tahun' => $_SESSION['tahun'], 'perubahan' => $_SESSION['perubahan'], 'bulan' => 'b11'])->getResultArray(); ?>
					<?php foreach ($faktor_pendukung11 as $pendukung11) {
						echo '-' . $pendukung11['faktor_pendukung'] . '<br>';
					} ?>
				</td>
				<td class="align-top text-wrap">
					<?php $rencana_tindak_lanjut11 = $db->table('tb_simonela_progres')->select('rencana_tindak_lanjut')->getWhere(['kegiatan' => $DT['rkpd_kegiatan_n'], 'kegiatan_sub' => $DT['rkpd_kegiatan_sub_n'], 'indikator_kegiatan_sub' => $DT['rkpd_indikator_kegiatan_sub'], 'opd_id' => $_SESSION['opd_set'], 'tahun' => $_SESSION['tahun'], 'perubahan' => $_SESSION['perubahan'], 'bulan' => 'b11'])->getResultArray(); ?>
					<?php foreach ($rencana_tindak_lanjut11 as $tindak_lanjut11) {
						echo '-' . $tindak_lanjut11['rencana_tindak_lanjut'] . '<br>';
					} ?>
				</td>
				<td class="align-top text-right"><?= number_format($bb11, 0, ',', '.'); ?></td>
				<td class="align-top text-right"><?= number_format($fbb11, 2, ',', '.'); ?></td>
				<!-- <td class="align-top text-right"></td>
				<td class="align-top text-right"></td> -->
				<td class="align-top text-right"><?= isset($realisasi11['realisasi_keu']) ? number_format($realisasi11['realisasi_keu'], 0, ',', '.') : ''; ?></td>
				<td class="align-top text-right"><?= isset($realisasi11['realisasi_fisik']) ? number_format($realisasi11['realisasi_fisik'], 2, ',', '.') : ''; ?></td>
				<td class="align-top text-right">
					<?php
					try {
						echo isset($realisasi11['realisasi_keu']) ? round(($realisasi11['realisasi_keu'] / $bb11) * 100, 2) : '';
					} catch (DivisionByZeroError $e) {
						echo "Null";
					}
					?>
				</td>
				<td class="align-top text-right">
					<?php
					try {
						echo isset($realisasi11['realisasi_fisik']) ? number_format(round(($realisasi11['realisasi_fisik'] / $fbb11) * 100, 2), 2, ',', '.') : '';
					} catch (DivisionByZeroError $e) {
						echo "Null";
					}
					?>
				</td>
				<!-------------- Deviasi -->
				<td class="align-top text-right">
					<?php
					try {
						echo isset($realisasi11['realisasi_keu']) ? number_format(round(((($realisasi11['realisasi_keu'] / $DT['rp_tahun']) * 100) - (($bb11 / $DT['rp_tahun']) * 100)), 2), 2, ',', '.') : '';
					} catch (DivisionByZeroError $e) {
						echo "Null";
					}
					?>
				</td>
				<td class="align-top text-right">
					<?php
					try {
						echo isset($realisasi11['realisasi_fisik']) ? number_format(round((($realisasi11['realisasi_fisik'] - $fbb11)), 2), 2, ',', '.') : '';
					} catch (DivisionByZeroError $e) {
						echo "Null";
					}
					?>
				</td>
				<!-------------- //Deviasi-->

				<td class="align-top text-center"><?= isset($progres11['created_at']) ? $progres11['created_at'] : ''; ?></td>
				<td class="align-top text-center"><?= isset($progres11['bulan_lapor']) ? ($progres11['bulan_lapor'] > '11' ? '<text style="color: red;">Terlambat</text>' : '<text style="color:green;">Sudah Lapor</text>') : 'Belum Lapor'; ?> </td>
				<td class="align-top text-right">
					<a href="<?= base_url('/admin/simonela/simonela/progres_bulan/' . $DT['id_ropk_keuangan_rkpd_kegiatan_sub'] . '/' . 'b11' . '/November?keu=' . number_format($bb11, 0, ',', '.') . '&fis=' . number_format($fbb11, 0, ',', '.')); ?>">
						<li class="btn btn-block btn-warning btn-xs" active><i class="nav-icon fa fa-chart-pie"></i> Progres</li>
					</a>
				</td>
				<td class="align-top">
					<a href="<?= base_url('/admin/simonela/simonela/dokumen_add/' . $DT['id_ropk_keuangan_rkpd_kegiatan_sub'] . '/' . 'b11' . '/November'); ?>">
						<li class="btn btn-block btn-info btn-xs" active><i class="nav-icon fa fa-file"></i> Dokumen</li>
					</a>
				</td>
			</tr>
			<tr>
				<?php $progres12 = $db->table('tb_simonela_progres')
					->select('bulan_lapor, created_at')
					->selectsum('realisasi_keu')
					->selectsum('realisasi_fisik')
					->getWhere([
						'kegiatan' => $DT['rkpd_kegiatan_n'],
						'kegiatan_sub' => $DT['rkpd_kegiatan_sub_n'],
						'indikator_kegiatan_sub' => $DT['rkpd_indikator_kegiatan_sub'],
						'opd_id' => $_SESSION['opd_set'],
						'tahun' => $_SESSION['tahun'],
						'perubahan' => $_SESSION['perubahan'],
						'bulan' => 'b12'
					])->getRowArray();

				$realisasi12['realisasi_keu'] = $progres1['realisasi_keu'] + $progres2['realisasi_keu'] + $progres3['realisasi_keu'] + $progres4['realisasi_keu'] + $progres5['realisasi_keu'] + $progres6['realisasi_keu'] + $progres7['realisasi_keu'] + $progres8['realisasi_keu'] + $progres9['realisasi_keu'] + $progres10['realisasi_keu'] + $progres11['realisasi_keu'] + $progres12['realisasi_keu'];
				$realisasi12['realisasi_fisik'] = $progres1['realisasi_fisik'] + $progres2['realisasi_fisik'] + $progres3['realisasi_fisik'] + $progres4['realisasi_fisik'] + $progres5['realisasi_fisik'] + $progres6['realisasi_fisik'] + $progres7['realisasi_fisik'] + $progres8['realisasi_fisik'] + $progres9['realisasi_fisik'] + $progres10['realisasi_fisik'] + $progres11['realisasi_fisik'] + $progres12['realisasi_fisik'];

				?>
				<td class="align-top">Desember</td>
				<td class="align-top text-wrap">
					<?php $tahap_aktifitas12 = $db->table('tb_simonela_progres')->select('tahap_aktifitas')->getWhere(['kegiatan' => $DT['rkpd_kegiatan_n'], 'kegiatan_sub' => $DT['rkpd_kegiatan_sub_n'], 'indikator_kegiatan_sub' => $DT['rkpd_indikator_kegiatan_sub'], 'opd_id' => $_SESSION['opd_set'], 'tahun' => $_SESSION['tahun'], 'perubahan' => $_SESSION['perubahan'], 'bulan' => 'b12'])->getResultArray(); ?>
					<?php foreach ($tahap_aktifitas12 as $tahap12) {
						echo '-' . $tahap12['tahap_aktifitas'] . '<br>';
					} ?>
				</td>
				<td class="align-top text-wrap">
					<?php $faktor_penghambat12 = $db->table('tb_simonela_progres')->select('faktor_penghambat')->getWhere(['kegiatan' => $DT['rkpd_kegiatan_n'], 'kegiatan_sub' => $DT['rkpd_kegiatan_sub_n'], 'indikator_kegiatan_sub' => $DT['rkpd_indikator_kegiatan_sub'], 'opd_id' => $_SESSION['opd_set'], 'tahun' => $_SESSION['tahun'], 'perubahan' => $_SESSION['perubahan'], 'bulan' => 'b12'])->getResultArray(); ?>
					<?php foreach ($faktor_penghambat12 as $penghambat12) {
						echo '-' . $penghambat12['faktor_penghambat'] . '<br>';
					} ?>
				</td>
				<td class="align-top text-wrap">
					<?php $faktor_pendukung12 = $db->table('tb_simonela_progres')->select('faktor_pendukung')->getWhere(['kegiatan' => $DT['rkpd_kegiatan_n'], 'kegiatan_sub' => $DT['rkpd_kegiatan_sub_n'], 'indikator_kegiatan_sub' => $DT['rkpd_indikator_kegiatan_sub'], 'opd_id' => $_SESSION['opd_set'], 'tahun' => $_SESSION['tahun'], 'perubahan' => $_SESSION['perubahan'], 'bulan' => 'b12'])->getResultArray(); ?>
					<?php foreach ($faktor_pendukung12 as $pendukung12) {
						echo '-' . $pendukung12['faktor_pendukung'] . '<br>';
					} ?>
				</td>
				<td class="align-top text-wrap">
					<?php $rencana_tindak_lanjut12 = $db->table('tb_simonela_progres')->select('rencana_tindak_lanjut')->getWhere(['kegiatan' => $DT['rkpd_kegiatan_n'], 'kegiatan_sub' => $DT['rkpd_kegiatan_sub_n'], 'indikator_kegiatan_sub' => $DT['rkpd_indikator_kegiatan_sub'], 'opd_id' => $_SESSION['opd_set'], 'tahun' => $_SESSION['tahun'], 'perubahan' => $_SESSION['perubahan'], 'bulan' => 'b12'])->getResultArray(); ?>
					<?php foreach ($rencana_tindak_lanjut12 as $tindak_lanjut12) {
						echo '-' . $tindak_lanjut12['rencana_tindak_lanjut'] . '<br>';
					} ?>
				</td>
				<td class="align-top text-right"><?= number_format($bb12, 0, ',', '.'); ?></td>
				<td class="align-top text-right"><?= number_format($fbb12, 2, ',', '.'); ?></td>
				<!-- <td class="align-top text-right"></td>
				<td class="align-top text-right"></td> -->
				<td class="align-top text-right"><?= isset($realisasi12['realisasi_keu']) ? number_format($realisasi12['realisasi_keu'], 0, ',', '.') : ''; ?></td>
				<td class="align-top text-right"><?= isset($realisasi12['realisasi_fisik']) ? number_format($realisasi12['realisasi_fisik'], 2, ',', '.') : ''; ?></td>
				<td class="align-top text-right">
					<?php
					try {
						echo isset($realisasi12['realisasi_keu']) ? round(($realisasi12['realisasi_keu'] / $bb12) * 100, 2) : '';
					} catch (DivisionByZeroError $e) {
						echo "Null";
					}
					?>
				</td>
				<td class="align-top text-right">
					<?php
					try {
						echo isset($realisasi12['realisasi_fisik']) ? number_format(round(($realisasi12['realisasi_fisik'] / $fbb12) * 100, 2), 2, ',', '.') : '';
					} catch (DivisionByZeroError $e) {
						echo "Null";
					}
					?>
				</td>
				<!-------------- Deviasi -->
				<td class="align-top text-right">
					<?php
					try {
						echo isset($realisasi12['realisasi_keu']) ? number_format(round(((($realisasi12['realisasi_keu'] / $DT['rp_tahun']) * 100) - (($bb12 / $DT['rp_tahun']) * 100)), 2), 2, ',', '.') : '';
					} catch (DivisionByZeroError $e) {
						echo "Null";
					}
					?>
				</td>
				<td class="align-top text-right">
					<?php
					try {
						echo isset($realisasi12['realisasi_fisik']) ? number_format(round((($realisasi12['realisasi_fisik'] - $fbb12)), 2), 2, ',', '.') : '';
					} catch (DivisionByZeroError $e) {
						echo "Null";
					}
					?>
				</td>
				<!-------------- //Deviasi-->
				<td class="align-top text-center"><?= isset($progres12['created_at']) ? $progres12['created_at'] : ''; ?></td>
				<td class="align-top text-center"><?= isset($progres12['bulan_lapor']) ? ($progres12['bulan_lapor'] > '12' ? '<text style="color: red;">Terlambat</text>' : '<text style="color:green;">Sudah Lapor</text>') : 'Belum Lapor'; ?> </td>
				<td class="align-top text-right">
					<a href="<?= base_url('/admin/simonela/simonela/progres_bulan/' . $DT['id_ropk_keuangan_rkpd_kegiatan_sub'] . '/' . 'b12' . '/Desember?keu=' . number_format($bb12, 0, ',', '.') . '&fis=' . number_format($fbb12, 0, ',', '.')); ?>">
						<li class="btn btn-block btn-warning btn-xs" active><i class="nav-icon fa fa-chart-pie"></i> Progres</li>
					</a>
				</td>
				<td class="align-top">
					<a href="<?= base_url('/admin/simonela/simonela/dokumen_add/' . $DT['id_ropk_keuangan_rkpd_kegiatan_sub'] . '/' . 'b12' . '/Desember'); ?>">
						<li class="btn btn-block btn-info btn-xs" active><i class="nav-icon fa fa-file"></i> Dokumen</li>
					</a>
				</td>
			</tr>
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