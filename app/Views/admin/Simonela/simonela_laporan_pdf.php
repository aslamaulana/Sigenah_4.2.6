<!DOCTYPE html>
<html>

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<style type="text/css">
		.c25 {
			border-spacing: 0;
			border-collapse: collapse;
			margin-right: auto;
			width: 100%;
			font-size: 11px;
		}

		.c28 {
			border-right-style: solid;
			padding: 5pt 5pt 5pt 5pt;
			border-bottom-color: #000000;
			border-top-width: 1.2pt;
			border-right-width: 1.2pt;
			border-left-color: #000000;
			vertical-align: middle;
			border-right-color: #000000;
			border-left-width: 1.2pt;
			border-top-style: solid;
			border-left-style: solid;
			border-bottom-width: 1.2pt;
			text-align: center;
			border-top-color: #000000;
			border-bottom-style: solid
		}

		.c29 {
			padding: 5pt 5pt 5pt 5pt;
			border-color: #000000;
			vertical-align: top;
			border-width: 0.7pt;
			border-style: solid;
		}

		.c30 {
			text-align: center;
		}

		.c31 {
			text-align: right;
		}

		.bordered th {
			border: 1px solid #dee2e6;
		}

		.bordered td {
			border: 1px solid #dee2e6;
		}
	</style>
</head>

<center>
	<div align="center">
		Laporan Realisasi Kegiatan/Sub Kegiatan Tahun Anggaran <?= $_SESSION['tahun']; ?><br>
		s/d Bulan <?= $bulan_long; ?><br>
		<b><?= $opd['description']; ?></b>
	</div>
</center><br><br>

<table class="c25" border="1">
	<thead>
		<tr>
			<th rowspan="2" class="text-center align-middle" width="350px">
				Kegiatan/Sub Kegiatan
			</th>
			<th rowspan="2" class="text-center align-middle">
				Tahapan Aktifitas
			</th>
			<th rowspan="2" class="text-center align-middle">
				Faktor Penghambat
			</th>
			<th rowspan="2" class="text-center align-middle">
				Faktor Pendukung
			</th>
			<th rowspan="2" class="text-center align-middle">
				Rencana Tindak Lanjut
			</th>
			<th class="text-center" colspan="2">Target</th>
			<th class="text-center" colspan="2">Realisasi</th>
			<th class="text-center" colspan="2">Konsistensi (%)</th>
			<th class="text-center" colspan="2">Deviasi</th>
		</tr>
		<tr>
			<th class="text-center" width="60px">Keu</th>
			<th class="text-center" width="40px">Fisik</th>
			<th class="text-center" width="60px">Keu</th>
			<th class="text-center" width="40px">Fisik</th>
			<th class="text-center" width="40px">Keu</th>
			<th class="text-center" width="40px">Fisik</th>
			<th class="text-center" width="40px">Keu</th>
			<th class="text-center" width="40px">Fisik</th>
		</tr>
	</thead>
	<tbody>
		<?php
		$kegiatan = $db->table('tb_ropk_keuangan_rkpd_kegiatan_sub')
			->distinct('rkpd_kegiatan_n')
			->select('rkpd_kegiatan_n')
			->orderBy('rkpd_kegiatan_n', 'ASC')
			->getWhere([
				'tb_ropk_keuangan_rkpd_kegiatan_sub.opd_id' => $_SESSION['opd_set'],
				'tb_ropk_keuangan_rkpd_kegiatan_sub.perubahan' => $_SESSION['perubahan'],
				'tb_ropk_keuangan_rkpd_kegiatan_sub.tahun' => $_SESSION['tahun']
			])->getResultArray();

		foreach ($kegiatan as $rom) : ?>
			<tr class="font-weight-bold" style="background-color: blanchedalmond;">
				<td><b><?= $rom['rkpd_kegiatan_n']; ?></b></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
			</tr>
			<?php
			$sub_kegiatan = $db->table('tb_ropk_keuangan_rkpd_kegiatan_sub')
				->distinct('rkpd_kegiatan_sub_n, rkpd_indikator_kegiatan_sub, rp_tahun, id_ropk_keuangan_rkpd_kegiatan_sub')
				->select('rkpd_kegiatan_sub_n, rkpd_indikator_kegiatan_sub, rp_tahun, id_ropk_keuangan_rkpd_kegiatan_sub')
				->orderBy('rkpd_kegiatan_sub_n', 'ASC')
				->getWhere([
					'tb_ropk_keuangan_rkpd_kegiatan_sub.rkpd_kegiatan_n' => $rom['rkpd_kegiatan_n'],
					'tb_ropk_keuangan_rkpd_kegiatan_sub.opd_id' => $_SESSION['opd_set'],
					'tb_ropk_keuangan_rkpd_kegiatan_sub.perubahan' => $_SESSION['perubahan'],
					'tb_ropk_keuangan_rkpd_kegiatan_sub.tahun' => $_SESSION['tahun']
				])->getResultArray();

			foreach ($sub_kegiatan as $rol) : ?>

				<?php
				$id_ropk = $rol['id_ropk_keuangan_rkpd_kegiatan_sub'];
				$bulan = $_GET['bu'];
				?>

				<?php $keuangan = $db->table('tb_ropk_keuangan')->getWhere([
					'tb_ropk_keuangan.rkpd_kegiatan' => $rom['rkpd_kegiatan_n'],
					'tb_ropk_keuangan.rkpd_kegiatan_sub' => $rol['rkpd_kegiatan_sub_n'],
					'tb_ropk_keuangan.rkpd_indikator_kegiatan_sub' => $rol['rkpd_indikator_kegiatan_sub'],
					'tb_ropk_keuangan.opd_id' => $_SESSION['opd_set'],
					'tb_ropk_keuangan.tahun' => $_SESSION['tahun'],
					'tb_ropk_keuangan.perubahan' => $_SESSION['perubahan']
				])->getResultArray();
				foreach ($keuangan as $ros) {
					isset($ros['ropk_bobot_acuan']) ? $acu[] = ($ros['ropk_bobot_acuan']) : $acu[] = ['0'];
					isset($ros['b1']) ? $keu1[$id_ropk][] = ($ros['b1']) : $keu1[$id_ropk][] = ['0'];
					isset($ros['b2']) ? $keu2[$id_ropk][] = ($ros['b2']) : $keu2[$id_ropk][] = ['0'];
					isset($ros['b3']) ? $keu3[$id_ropk][] = ($ros['b3']) : $keu3[$id_ropk][] = ['0'];
					isset($ros['b4']) ? $keu4[$id_ropk][] = ($ros['b4']) : $keu4[$id_ropk][] = ['0'];
					isset($ros['b5']) ? $keu5[$id_ropk][] = ($ros['b5']) : $keu5[$id_ropk][] = ['0'];
					isset($ros['b6']) ? $keu6[$id_ropk][] = ($ros['b6']) : $keu6[$id_ropk][] = ['0'];
					isset($ros['b7']) ? $keu7[$id_ropk][] = ($ros['b7']) : $keu7[$id_ropk][] = ['0'];
					isset($ros['b8']) ? $keu8[$id_ropk][] = ($ros['b8']) : $keu8[$id_ropk][] = ['0'];
					isset($ros['b9']) ? $keu9[$id_ropk][] = ($ros['b9']) : $keu9[$id_ropk][] = ['0'];
					isset($ros['b10']) ? $keu10[$id_ropk][] = ($ros['b10']) : $keu10[$id_ropk][] = ['0'];
					isset($ros['b11']) ? $keu11[$id_ropk][] = ($ros['b11']) : $keu11[$id_ropk][] = ['0'];
					isset($ros['b12']) ? $keu12[$id_ropk][] = ($ros['b12']) : $keu12[$id_ropk][] = ['0'];
				}
				$b['b1'][$id_ropk] = !empty($keu1[$id_ropk]) ? array_sum($keu1[$id_ropk]) : '0';
				$b['b2'][$id_ropk] = (!empty($keu1[$id_ropk]) ? array_sum($keu1[$id_ropk]) : '0') + (!empty($keu2[$id_ropk]) ? array_sum($keu2[$id_ropk]) : '0');
				$b['b3'][$id_ropk] = (!empty($keu1[$id_ropk]) ? array_sum($keu1[$id_ropk]) : '0') + (!empty($keu2[$id_ropk]) ? array_sum($keu2[$id_ropk]) : '0') + (!empty($keu3[$id_ropk]) ? array_sum($keu3[$id_ropk]) : '0');
				$b['b4'][$id_ropk] = (!empty($keu1[$id_ropk]) ? array_sum($keu1[$id_ropk]) : '0') + (!empty($keu2[$id_ropk]) ? array_sum($keu2[$id_ropk]) : '0') + (!empty($keu3[$id_ropk]) ? array_sum($keu3[$id_ropk]) : '0') + (!empty($keu4[$id_ropk]) ? array_sum($keu4[$id_ropk]) : '0');
				$b['b5'][$id_ropk] = (!empty($keu1[$id_ropk]) ? array_sum($keu1[$id_ropk]) : '0') + (!empty($keu2[$id_ropk]) ? array_sum($keu2[$id_ropk]) : '0') + (!empty($keu3[$id_ropk]) ? array_sum($keu3[$id_ropk]) : '0') + (!empty($keu4[$id_ropk]) ? array_sum($keu4[$id_ropk]) : '0') + (!empty($keu5[$id_ropk]) ? array_sum($keu5[$id_ropk]) : '0');
				$b['b6'][$id_ropk] = (!empty($keu1[$id_ropk]) ? array_sum($keu1[$id_ropk]) : '0') + (!empty($keu2[$id_ropk]) ? array_sum($keu2[$id_ropk]) : '0') + (!empty($keu3[$id_ropk]) ? array_sum($keu3[$id_ropk]) : '0') + (!empty($keu4[$id_ropk]) ? array_sum($keu4[$id_ropk]) : '0') + (!empty($keu5[$id_ropk]) ? array_sum($keu5[$id_ropk]) : '0') + (!empty($keu6[$id_ropk]) ? array_sum($keu6[$id_ropk]) : '0');
				$b['b7'][$id_ropk] = (!empty($keu1[$id_ropk]) ? array_sum($keu1[$id_ropk]) : '0') + (!empty($keu2[$id_ropk]) ? array_sum($keu2[$id_ropk]) : '0') + (!empty($keu3[$id_ropk]) ? array_sum($keu3[$id_ropk]) : '0') + (!empty($keu4[$id_ropk]) ? array_sum($keu4[$id_ropk]) : '0') + (!empty($keu5[$id_ropk]) ? array_sum($keu5[$id_ropk]) : '0') + (!empty($keu6[$id_ropk]) ? array_sum($keu6[$id_ropk]) : '0') + (!empty($keu7[$id_ropk]) ? array_sum($keu7[$id_ropk]) : '0');
				$b['b8'][$id_ropk] = (!empty($keu1[$id_ropk]) ? array_sum($keu1[$id_ropk]) : '0') + (!empty($keu2[$id_ropk]) ? array_sum($keu2[$id_ropk]) : '0') + (!empty($keu3[$id_ropk]) ? array_sum($keu3[$id_ropk]) : '0') + (!empty($keu4[$id_ropk]) ? array_sum($keu4[$id_ropk]) : '0') + (!empty($keu5[$id_ropk]) ? array_sum($keu5[$id_ropk]) : '0') + (!empty($keu6[$id_ropk]) ? array_sum($keu6[$id_ropk]) : '0') + (!empty($keu7[$id_ropk]) ? array_sum($keu7[$id_ropk]) : '0') + (!empty($keu8[$id_ropk]) ? array_sum($keu8[$id_ropk]) : '0');
				$b['b9'][$id_ropk] = (!empty($keu1[$id_ropk]) ? array_sum($keu1[$id_ropk]) : '0') + (!empty($keu2[$id_ropk]) ? array_sum($keu2[$id_ropk]) : '0') + (!empty($keu3[$id_ropk]) ? array_sum($keu3[$id_ropk]) : '0') + (!empty($keu4[$id_ropk]) ? array_sum($keu4[$id_ropk]) : '0') + (!empty($keu5[$id_ropk]) ? array_sum($keu5[$id_ropk]) : '0') + (!empty($keu6[$id_ropk]) ? array_sum($keu6[$id_ropk]) : '0') + (!empty($keu7[$id_ropk]) ? array_sum($keu7[$id_ropk]) : '0') + (!empty($keu8[$id_ropk]) ? array_sum($keu8[$id_ropk]) : '0') + (!empty($keu9[$id_ropk]) ? array_sum($keu9[$id_ropk]) : '0');
				$b['b10'][$id_ropk] = (!empty($keu1[$id_ropk]) ? array_sum($keu1[$id_ropk]) : '0') + (!empty($keu2[$id_ropk]) ? array_sum($keu2[$id_ropk]) : '0') + (!empty($keu3[$id_ropk]) ? array_sum($keu3[$id_ropk]) : '0') + (!empty($keu4[$id_ropk]) ? array_sum($keu4[$id_ropk]) : '0') + (!empty($keu5[$id_ropk]) ? array_sum($keu5[$id_ropk]) : '0') + (!empty($keu6[$id_ropk]) ? array_sum($keu6[$id_ropk]) : '0') + (!empty($keu7[$id_ropk]) ? array_sum($keu7[$id_ropk]) : '0') + (!empty($keu8[$id_ropk]) ? array_sum($keu8[$id_ropk]) : '0') + (!empty($keu9[$id_ropk]) ? array_sum($keu9[$id_ropk]) : '0') + (!empty($keu10[$id_ropk]) ? array_sum($keu10[$id_ropk]) : '0');
				$b['b11'][$id_ropk] = (!empty($keu1[$id_ropk]) ? array_sum($keu1[$id_ropk]) : '0') + (!empty($keu2[$id_ropk]) ? array_sum($keu2[$id_ropk]) : '0') + (!empty($keu3[$id_ropk]) ? array_sum($keu3[$id_ropk]) : '0') + (!empty($keu4[$id_ropk]) ? array_sum($keu4[$id_ropk]) : '0') + (!empty($keu5[$id_ropk]) ? array_sum($keu5[$id_ropk]) : '0') + (!empty($keu6[$id_ropk]) ? array_sum($keu6[$id_ropk]) : '0') + (!empty($keu7[$id_ropk]) ? array_sum($keu7[$id_ropk]) : '0') + (!empty($keu8[$id_ropk]) ? array_sum($keu8[$id_ropk]) : '0') + (!empty($keu9[$id_ropk]) ? array_sum($keu9[$id_ropk]) : '0') + (!empty($keu10[$id_ropk]) ? array_sum($keu10[$id_ropk]) : '0') + (!empty($keu11[$id_ropk]) ? array_sum($keu11[$id_ropk]) : '0');
				$b['b12'][$id_ropk] = (!empty($keu1[$id_ropk]) ? array_sum($keu1[$id_ropk]) : '0') + (!empty($keu2[$id_ropk]) ? array_sum($keu2[$id_ropk]) : '0') + (!empty($keu3[$id_ropk]) ? array_sum($keu3[$id_ropk]) : '0') + (!empty($keu4[$id_ropk]) ? array_sum($keu4[$id_ropk]) : '0') + (!empty($keu5[$id_ropk]) ? array_sum($keu5[$id_ropk]) : '0') + (!empty($keu6[$id_ropk]) ? array_sum($keu6[$id_ropk]) : '0') + (!empty($keu7[$id_ropk]) ? array_sum($keu7[$id_ropk]) : '0') + (!empty($keu8[$id_ropk]) ? array_sum($keu8[$id_ropk]) : '0') + (!empty($keu9[$id_ropk]) ? array_sum($keu9[$id_ropk]) : '0') + (!empty($keu10[$id_ropk]) ? array_sum($keu10[$id_ropk]) : '0') + (!empty($keu11[$id_ropk]) ? array_sum($keu11[$id_ropk]) : '0') + (!empty($keu12[$id_ropk]) ? array_sum($keu12[$id_ropk]) : '0');
				?>

				<?php $fisik = $db->table('tb_ropk_fisik')->getWhere([
					'tb_ropk_fisik.rkpd_kegiatan' => $rom['rkpd_kegiatan_n'],
					'tb_ropk_fisik.rkpd_kegiatan_sub' => $rol['rkpd_kegiatan_sub_n'],
					'tb_ropk_fisik.rkpd_indikator_kegiatan_sub' => $rol['rkpd_indikator_kegiatan_sub'],
					'tb_ropk_fisik.opd_id' => $_SESSION['opd_set'],
					'tb_ropk_fisik.tahun' => $_SESSION['tahun'],
					'tb_ropk_fisik.perubahan' => $_SESSION['perubahan']
				])->getResultArray();
				foreach ($fisik as $ros) {
					isset($ros['ropk_bobot_acuan']) ? $acu[] = ($ros['ropk_bobot_acuan']) : $acu[] = ['0'];
					isset($ros['b1']) ? $fis1[$id_ropk][] = ($ros['b1']) : $fis1[$id_ropk][] = ['0'];
					isset($ros['b2']) ? $fis2[$id_ropk][] = ($ros['b2']) : $fis2[$id_ropk][] = ['0'];
					isset($ros['b3']) ? $fis3[$id_ropk][] = ($ros['b3']) : $fis3[$id_ropk][] = ['0'];
					isset($ros['b4']) ? $fis4[$id_ropk][] = ($ros['b4']) : $fis4[$id_ropk][] = ['0'];
					isset($ros['b5']) ? $fis5[$id_ropk][] = ($ros['b5']) : $fis5[$id_ropk][] = ['0'];
					isset($ros['b6']) ? $fis6[$id_ropk][] = ($ros['b6']) : $fis6[$id_ropk][] = ['0'];
					isset($ros['b7']) ? $fis7[$id_ropk][] = ($ros['b7']) : $fis7[$id_ropk][] = ['0'];
					isset($ros['b8']) ? $fis8[$id_ropk][] = ($ros['b8']) : $fis8[$id_ropk][] = ['0'];
					isset($ros['b9']) ? $fis9[$id_ropk][] = ($ros['b9']) : $fis9[$id_ropk][] = ['0'];
					isset($ros['b10']) ? $fis10[$id_ropk][] = ($ros['b10']) : $fis10[$id_ropk][] = ['0'];
					isset($ros['b11']) ? $fis11[$id_ropk][] = ($ros['b11']) : $fis11[$id_ropk][] = ['0'];
					isset($ros['b12']) ? $fis12[$id_ropk][] = ($ros['b12']) : $fis12[$id_ropk][] = ['0'];
				}
				$fb['b1'][$id_ropk] = !empty($fis1[$id_ropk]) ? array_sum($fis1[$id_ropk]) : '0';
				$fb['b2'][$id_ropk] = (!empty($fis1[$id_ropk]) ? array_sum($fis1[$id_ropk]) : '0') + (!empty($fis2[$id_ropk]) ? array_sum($fis2[$id_ropk]) : '0');
				$fb['b3'][$id_ropk] = (!empty($fis1[$id_ropk]) ? array_sum($fis1[$id_ropk]) : '0') + (!empty($fis2[$id_ropk]) ? array_sum($fis2[$id_ropk]) : '0') + (!empty($fis3[$id_ropk]) ? array_sum($fis3[$id_ropk]) : '0');
				$fb['b4'][$id_ropk] = (!empty($fis1[$id_ropk]) ? array_sum($fis1[$id_ropk]) : '0') + (!empty($fis2[$id_ropk]) ? array_sum($fis2[$id_ropk]) : '0') + (!empty($fis3[$id_ropk]) ? array_sum($fis3[$id_ropk]) : '0') + (!empty($fis4[$id_ropk]) ? array_sum($fis4[$id_ropk]) : '0');
				$fb['b5'][$id_ropk] = (!empty($fis1[$id_ropk]) ? array_sum($fis1[$id_ropk]) : '0') + (!empty($fis2[$id_ropk]) ? array_sum($fis2[$id_ropk]) : '0') + (!empty($fis3[$id_ropk]) ? array_sum($fis3[$id_ropk]) : '0') + (!empty($fis4[$id_ropk]) ? array_sum($fis4[$id_ropk]) : '0') + (!empty($fis5[$id_ropk]) ? array_sum($fis5[$id_ropk]) : '0');
				$fb['b6'][$id_ropk] = (!empty($fis1[$id_ropk]) ? array_sum($fis1[$id_ropk]) : '0') + (!empty($fis2[$id_ropk]) ? array_sum($fis2[$id_ropk]) : '0') + (!empty($fis3[$id_ropk]) ? array_sum($fis3[$id_ropk]) : '0') + (!empty($fis4[$id_ropk]) ? array_sum($fis4[$id_ropk]) : '0') + (!empty($fis5[$id_ropk]) ? array_sum($fis5[$id_ropk]) : '0') + (!empty($fis6[$id_ropk]) ? array_sum($fis6[$id_ropk]) : '0');
				$fb['b7'][$id_ropk] = (!empty($fis1[$id_ropk]) ? array_sum($fis1[$id_ropk]) : '0') + (!empty($fis2[$id_ropk]) ? array_sum($fis2[$id_ropk]) : '0') + (!empty($fis3[$id_ropk]) ? array_sum($fis3[$id_ropk]) : '0') + (!empty($fis4[$id_ropk]) ? array_sum($fis4[$id_ropk]) : '0') + (!empty($fis5[$id_ropk]) ? array_sum($fis5[$id_ropk]) : '0') + (!empty($fis6[$id_ropk]) ? array_sum($fis6[$id_ropk]) : '0') + (!empty($fis7[$id_ropk]) ? array_sum($fis7[$id_ropk]) : '0');
				$fb['b8'][$id_ropk] = (!empty($fis1[$id_ropk]) ? array_sum($fis1[$id_ropk]) : '0') + (!empty($fis2[$id_ropk]) ? array_sum($fis2[$id_ropk]) : '0') + (!empty($fis3[$id_ropk]) ? array_sum($fis3[$id_ropk]) : '0') + (!empty($fis4[$id_ropk]) ? array_sum($fis4[$id_ropk]) : '0') + (!empty($fis5[$id_ropk]) ? array_sum($fis5[$id_ropk]) : '0') + (!empty($fis6[$id_ropk]) ? array_sum($fis6[$id_ropk]) : '0') + (!empty($fis7[$id_ropk]) ? array_sum($fis7[$id_ropk]) : '0') + (!empty($fis8[$id_ropk]) ? array_sum($fis8[$id_ropk]) : '0');
				$fb['b9'][$id_ropk] = (!empty($fis1[$id_ropk]) ? array_sum($fis1[$id_ropk]) : '0') + (!empty($fis2[$id_ropk]) ? array_sum($fis2[$id_ropk]) : '0') + (!empty($fis3[$id_ropk]) ? array_sum($fis3[$id_ropk]) : '0') + (!empty($fis4[$id_ropk]) ? array_sum($fis4[$id_ropk]) : '0') + (!empty($fis5[$id_ropk]) ? array_sum($fis5[$id_ropk]) : '0') + (!empty($fis6[$id_ropk]) ? array_sum($fis6[$id_ropk]) : '0') + (!empty($fis7[$id_ropk]) ? array_sum($fis7[$id_ropk]) : '0') + (!empty($fis8[$id_ropk]) ? array_sum($fis8[$id_ropk]) : '0') + (!empty($fis9[$id_ropk]) ? array_sum($fis9[$id_ropk]) : '0');
				$fb['b10'][$id_ropk] = (!empty($fis1[$id_ropk]) ? array_sum($fis1[$id_ropk]) : '0') + (!empty($fis2[$id_ropk]) ? array_sum($fis2[$id_ropk]) : '0') + (!empty($fis3[$id_ropk]) ? array_sum($fis3[$id_ropk]) : '0') + (!empty($fis4[$id_ropk]) ? array_sum($fis4[$id_ropk]) : '0') + (!empty($fis5[$id_ropk]) ? array_sum($fis5[$id_ropk]) : '0') + (!empty($fis6[$id_ropk]) ? array_sum($fis6[$id_ropk]) : '0') + (!empty($fis7[$id_ropk]) ? array_sum($fis7[$id_ropk]) : '0') + (!empty($fis8[$id_ropk]) ? array_sum($fis8[$id_ropk]) : '0') + (!empty($fis9[$id_ropk]) ? array_sum($fis9[$id_ropk]) : '0') + (!empty($fis10[$id_ropk]) ? array_sum($fis10[$id_ropk]) : '0');
				$fb['b11'][$id_ropk] = (!empty($fis1[$id_ropk]) ? array_sum($fis1[$id_ropk]) : '0') + (!empty($fis2[$id_ropk]) ? array_sum($fis2[$id_ropk]) : '0') + (!empty($fis3[$id_ropk]) ? array_sum($fis3[$id_ropk]) : '0') + (!empty($fis4[$id_ropk]) ? array_sum($fis4[$id_ropk]) : '0') + (!empty($fis5[$id_ropk]) ? array_sum($fis5[$id_ropk]) : '0') + (!empty($fis6[$id_ropk]) ? array_sum($fis6[$id_ropk]) : '0') + (!empty($fis7[$id_ropk]) ? array_sum($fis7[$id_ropk]) : '0') + (!empty($fis8[$id_ropk]) ? array_sum($fis8[$id_ropk]) : '0') + (!empty($fis9[$id_ropk]) ? array_sum($fis9[$id_ropk]) : '0') + (!empty($fis10[$id_ropk]) ? array_sum($fis10[$id_ropk]) : '0') + (!empty($fis11[$id_ropk]) ? array_sum($fis11[$id_ropk]) : '0');
				$fb['b12'][$id_ropk] = (!empty($fis1[$id_ropk]) ? array_sum($fis1[$id_ropk]) : '0') + (!empty($fis2[$id_ropk]) ? array_sum($fis2[$id_ropk]) : '0') + (!empty($fis3[$id_ropk]) ? array_sum($fis3[$id_ropk]) : '0') + (!empty($fis4[$id_ropk]) ? array_sum($fis4[$id_ropk]) : '0') + (!empty($fis5[$id_ropk]) ? array_sum($fis5[$id_ropk]) : '0') + (!empty($fis6[$id_ropk]) ? array_sum($fis6[$id_ropk]) : '0') + (!empty($fis7[$id_ropk]) ? array_sum($fis7[$id_ropk]) : '0') + (!empty($fis8[$id_ropk]) ? array_sum($fis8[$id_ropk]) : '0') + (!empty($fis9[$id_ropk]) ? array_sum($fis9[$id_ropk]) : '0') + (!empty($fis10[$id_ropk]) ? array_sum($fis10[$id_ropk]) : '0') + (!empty($fis11[$id_ropk]) ? array_sum($fis11[$id_ropk]) : '0') + (!empty($fis12[$id_ropk]) ? array_sum($fis12[$id_ropk]) : '0');
				?>
				<tr>
					<?php $progres1 = $db->table('tb_simonela_progres')
						->select('bulan_lapor, created_at')
						->selectsum('realisasi_keu')
						->selectsum('realisasi_fisik')
						->getWhere([
							'kegiatan' => $rom['rkpd_kegiatan_n'],
							'kegiatan_sub' => $rol['rkpd_kegiatan_sub_n'],
							'indikator_kegiatan_sub' => $rol['rkpd_indikator_kegiatan_sub'],
							'opd_id' => $_SESSION['opd_set'],
							'tahun' => $_SESSION['tahun'],
							'perubahan' => $_SESSION['perubahan'],
							'bulan' => $bulan
						])->getRowArray();
					//dd($progres1); 
					?>
					<td valign="top" class="text-wrap" style="padding-left: 20px;"><?= $rol['rkpd_kegiatan_sub_n']; ?></td>

					<td valign="top" class="text-wrap">
						<?php $tahap_aktifitas1 = $db->table('tb_simonela_progres')->select('tahap_aktifitas')->getWhere(['kegiatan' => $rom['rkpd_kegiatan_n'], 'kegiatan_sub' => $rol['rkpd_kegiatan_sub_n'], 'indikator_kegiatan_sub' => $rol['rkpd_indikator_kegiatan_sub'], 'opd_id' => $_SESSION['opd_set'], 'tahun' => $_SESSION['tahun'], 'perubahan' => $_SESSION['perubahan'], 'bulan' => $bulan])->getResultArray(); ?>
						<?php foreach ($tahap_aktifitas1 as $tahap1) {
							echo '-' . $tahap1['tahap_aktifitas'] . '<br>';
						} ?>
					</td>
					<td valign="top" class="text-wrap">
						<?php $faktor_penghambat1 = $db->table('tb_simonela_progres')->select('faktor_penghambat')->getWhere(['kegiatan' => $rom['rkpd_kegiatan_n'], 'kegiatan_sub' => $rol['rkpd_kegiatan_sub_n'], 'indikator_kegiatan_sub' => $rol['rkpd_indikator_kegiatan_sub'], 'opd_id' => $_SESSION['opd_set'], 'tahun' => $_SESSION['tahun'], 'perubahan' => $_SESSION['perubahan'], 'bulan' => $bulan])->getResultArray(); ?>
						<?php foreach ($faktor_penghambat1 as $penghambat1) {
							echo '-' . $penghambat1['faktor_penghambat'] . '<br>';
						} ?>
					</td>
					<td valign="top" class="text-wrap">
						<?php $faktor_pendukung1 = $db->table('tb_simonela_progres')->select('faktor_pendukung')->getWhere(['kegiatan' => $rom['rkpd_kegiatan_n'], 'kegiatan_sub' => $rol['rkpd_kegiatan_sub_n'], 'indikator_kegiatan_sub' => $rol['rkpd_indikator_kegiatan_sub'], 'opd_id' => $_SESSION['opd_set'], 'tahun' => $_SESSION['tahun'], 'perubahan' => $_SESSION['perubahan'], 'bulan' => $bulan])->getResultArray(); ?>
						<?php foreach ($faktor_pendukung1 as $pendukung1) {
							echo '-' . $pendukung1['faktor_pendukung'] . '<br>';
						} ?>
					</td>
					<td valign="top" class="text-wrap">
						<?php $rencana_tindak_lanjut1 = $db->table('tb_simonela_progres')->select('rencana_tindak_lanjut')->getWhere(['kegiatan' => $rom['rkpd_kegiatan_n'], 'kegiatan_sub' => $rol['rkpd_kegiatan_sub_n'], 'indikator_kegiatan_sub' => $rol['rkpd_indikator_kegiatan_sub'], 'opd_id' => $_SESSION['opd_set'], 'tahun' => $_SESSION['tahun'], 'perubahan' => $_SESSION['perubahan'], 'bulan' => $bulan])->getResultArray(); ?>
						<?php foreach ($rencana_tindak_lanjut1 as $tindak_lanjut1) {
							echo '-' . $tindak_lanjut1['rencana_tindak_lanjut'] . '<br>';
						} ?>
					</td>
					<td valign="top" align="center"><?= number_format($b[$bulan][$id_ropk], 0, ',', '.'); ?></td>
					<td valign="top" align="center"><?= number_format($fb[$bulan][$id_ropk], 2, ',', '.'); ?></td>
					<!-------------- Realisasi -->
					<td valign="top" align="center"><?= isset($progres1['realisasi_keu']) ? number_format($progres1['realisasi_keu'], 0, ',', '.') : ''; ?></td>
					<td valign="top" align="center"><?= isset($progres1['realisasi_fisik']) ? number_format($progres1['realisasi_fisik'], 2, ',', '.') : ''; ?></td>
					<!-------------- /Realisasi -->
					<!-------------- Kosistensi -->
					<td valign="top" align="center">
						<?php
						try {
							echo isset($progres1['realisasi_keu']) ? round(($progres1['realisasi_keu'] / $b[$bulan][$id_ropk]) * 100, 2) : '';
						} catch (DivisionByZeroError $e) {
							echo "0";
						}
						?>
					</td>
					<td valign="top" align="center">
						<?php
						try {
							echo isset($progres1['realisasi_fisik']) ? number_format(round(($progres1['realisasi_fisik'] / $fb[$bulan][$id_ropk]) * 100, 2), 2, ',', '.') : '';
						} catch (DivisionByZeroError $e) {
							echo "0";
						}
						?>
					</td>
					<!-------------- /Konsistensi -->
					<!-------------- Deviasi -->
					<?php
					try {
						$deviasi_keu[$id_ropk] = isset($progres1['realisasi_keu']) ? number_format(((($progres1['realisasi_keu'] / $rol['rp_tahun']) * 100) - (($b[$bulan][$id_ropk] / $rol['rp_tahun']) * 100)), 2, ',', '.') : '';
						$deviasi_keu_w[$id_ropk] = isset($progres1['realisasi_keu']) ? ((($progres1['realisasi_keu'] / $rol['rp_tahun']) * 100) - (($b[$bulan][$id_ropk] / $rol['rp_tahun']) * 100)) : '';
					} catch (DivisionByZeroError $e) {
						$deviasi_keu[$id_ropk] = "";
					}
					?>
					<td valign="top" align="center" style=" <?= $deviasi_keu_w[$id_ropk] == "" ? "" : ($deviasi_keu_w[$id_ropk] > '-5' ? "background: green" : ($deviasi_keu_w[$id_ropk] <= '-5' && $deviasi_keu_w[$id_ropk] >= '-10' ? "background: yellow" : ($deviasi_keu_w[$id_ropk] < '-10' ? "background: red" : ""))); ?>">
						<?= $deviasi_keu[$id_ropk]; ?>
					</td>
					<?php
					try {
						$deviasi_fis[$id_ropk] = isset($progres1['realisasi_fisik']) ? number_format((($progres1['realisasi_fisik'] - $fb[$bulan][$id_ropk])), 2, ',', '.') : '';
						$deviasi_fis_w[$id_ropk] = isset($progres1['realisasi_fisik']) ? (($progres1['realisasi_fisik'] - $fb[$bulan][$id_ropk])) : '';
					} catch (DivisionByZeroError $e) {
						$deviasi_fis[$id_ropk] = "";
					}
					?>
					<td valign="top" align="center" style=" <?= $deviasi_fis_w[$id_ropk] == "" ? "" : ($deviasi_fis_w[$id_ropk] > '-5' ? "background: green" : ($deviasi_fis_w[$id_ropk] <= '-5' && $deviasi_fis_w[$id_ropk] >= '-10' ? "background: yellow" : ($deviasi_fis_w[$id_ropk] < '-10' ? "background: red" : ""))); ?>">
						<?= $deviasi_fis[$id_ropk]; ?>
					</td>
					<!-------------- //Deviasi-->
				</tr>
			<?php endforeach; ?>
		<?php endforeach; ?>
	</tbody>
</table>

</html>