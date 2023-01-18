<?= $this->extend('_layout/template'); ?>

<?= $this->section('stylesheet'); ?>
<link rel="stylesheet" href="<?= base_url('/toping/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') ?>">
<?= $this->endSection(); ?>

<?= $this->section('content'); ?>
<div class="card-body">

	<table id="example1" class="table table-bordered display nowrap table-sm">
		<thead>
			<tr>
				<th rowspan="2" class="text-center align-middle" width="40px">Bulan</th>
				<th class="text-center" colspan="2">Konsistensi (%)</th>
			</tr>
			<tr>
				<th class="text-center">Keu</th>
				<th class="text-center">Fisik</th>
			</tr>
		</thead>

		<tbody>

			<?php $qu = $db->table('tb_ropk_keuangan_rkpd_kegiatan_sub')
				->select('tb_ropk_keuangan_rkpd_kegiatan_sub.rkpd_kegiatan_sub_n, id_ropk_keuangan_rkpd_kegiatan_sub')
				->distinct('tb_ropk_keuangan_rkpd_kegiatan_sub.rkpd_kegiatan_sub_n, id_ropk_keuangan_rkpd_kegiatan_sub')
				->getWhere([
					'tb_ropk_keuangan_rkpd_kegiatan_sub.rkpd_kegiatan_n' => $DT,
					'tb_ropk_keuangan_rkpd_kegiatan_sub.opd_id' => user()->opd_id,
					'tb_ropk_keuangan_rkpd_kegiatan_sub.tahun' => $_SESSION['tahun'],
					'tb_ropk_keuangan_rkpd_kegiatan_sub.perubahan' => $_SESSION['perubahan']
				])->getResultArray();

			foreach ($qu as $row) :
				$id_sub = $row['id_ropk_keuangan_rkpd_kegiatan_sub'];
			?>
				<?php $keuangan = $db->table('tb_ropk_keuangan')->getWhere([
					'tb_ropk_keuangan.rkpd_kegiatan' => $DT,
					'tb_ropk_keuangan.rkpd_kegiatan_sub' => $row['rkpd_kegiatan_sub_n'],
					'tb_ropk_keuangan.opd_id' => user()->opd_id,
					'tb_ropk_keuangan.tahun' => $_SESSION['tahun'],
					'tb_ropk_keuangan.perubahan' => $_SESSION['perubahan']
				])->getResultArray();
				foreach ($keuangan as $ros) {
					isset($ros['ropk_bobot_acuan']) ? $acu[] = ($ros['ropk_bobot_acuan']) : $acu[] = ['0'];
					isset($ros['b1']) ? $keu1[$id_sub][] = ($ros['b1']) : $keu1[$id_sub][] = ['0'];
					isset($ros['b2']) ? $keu2[$id_sub][] = ($ros['b2']) : $keu2[$id_sub][] = ['0'];
					isset($ros['b3']) ? $keu3[$id_sub][] = ($ros['b3']) : $keu3[$id_sub][] = ['0'];
					isset($ros['b4']) ? $keu4[$id_sub][] = ($ros['b4']) : $keu4[$id_sub][] = ['0'];
					isset($ros['b5']) ? $keu5[$id_sub][] = ($ros['b5']) : $keu5[$id_sub][] = ['0'];
					isset($ros['b6']) ? $keu6[$id_sub][] = ($ros['b6']) : $keu6[$id_sub][] = ['0'];
					isset($ros['b7']) ? $keu7[$id_sub][] = ($ros['b7']) : $keu7[$id_sub][] = ['0'];
					isset($ros['b8']) ? $keu8[$id_sub][] = ($ros['b8']) : $keu8[$id_sub][] = ['0'];
					isset($ros['b9']) ? $keu9[$id_sub][] = ($ros['b9']) : $keu9[$id_sub][] = ['0'];
					isset($ros['b10']) ? $keu10[$id_sub][] = ($ros['b10']) : $keu10[$id_sub][] = ['0'];
					isset($ros['b11']) ? $keu11[$id_sub][] = ($ros['b11']) : $keu11[$id_sub][] = ['0'];
					isset($ros['b12']) ? $keu12[$id_sub][] = ($ros['b12']) : $keu12[$id_sub][] = ['0'];
				}
				$bb1[$id_sub] = !empty($keu1[$id_sub]) ? array_sum($keu1[$id_sub]) : '0';
				$bb2[$id_sub] = (!empty($keu1[$id_sub]) ? array_sum($keu1[$id_sub]) : '0') + (!empty($keu2[$id_sub]) ? array_sum($keu2[$id_sub]) : '0');
				$bb3[$id_sub] = (!empty($keu1[$id_sub]) ? array_sum($keu1[$id_sub]) : '0') + (!empty($keu2[$id_sub]) ? array_sum($keu2[$id_sub]) : '0') + (!empty($keu3[$id_sub]) ? array_sum($keu3[$id_sub]) : '0');
				$bb4[$id_sub] = (!empty($keu1[$id_sub]) ? array_sum($keu1[$id_sub]) : '0') + (!empty($keu2[$id_sub]) ? array_sum($keu2[$id_sub]) : '0') + (!empty($keu3[$id_sub]) ? array_sum($keu3[$id_sub]) : '0') + (!empty($keu4[$id_sub]) ? array_sum($keu4[$id_sub]) : '0');
				$bb5[$id_sub] = (!empty($keu1[$id_sub]) ? array_sum($keu1[$id_sub]) : '0') + (!empty($keu2[$id_sub]) ? array_sum($keu2[$id_sub]) : '0') + (!empty($keu3[$id_sub]) ? array_sum($keu3[$id_sub]) : '0') + (!empty($keu4[$id_sub]) ? array_sum($keu4[$id_sub]) : '0') + (!empty($keu5[$id_sub]) ? array_sum($keu5[$id_sub]) : '0');
				$bb6[$id_sub] = (!empty($keu1[$id_sub]) ? array_sum($keu1[$id_sub]) : '0') + (!empty($keu2[$id_sub]) ? array_sum($keu2[$id_sub]) : '0') + (!empty($keu3[$id_sub]) ? array_sum($keu3[$id_sub]) : '0') + (!empty($keu4[$id_sub]) ? array_sum($keu4[$id_sub]) : '0') + (!empty($keu5[$id_sub]) ? array_sum($keu5[$id_sub]) : '0') + (!empty($keu6[$id_sub]) ? array_sum($keu6[$id_sub]) : '0');
				$bb7[$id_sub] = (!empty($keu1[$id_sub]) ? array_sum($keu1[$id_sub]) : '0') + (!empty($keu2[$id_sub]) ? array_sum($keu2[$id_sub]) : '0') + (!empty($keu3[$id_sub]) ? array_sum($keu3[$id_sub]) : '0') + (!empty($keu4[$id_sub]) ? array_sum($keu4[$id_sub]) : '0') + (!empty($keu5[$id_sub]) ? array_sum($keu5[$id_sub]) : '0') + (!empty($keu6[$id_sub]) ? array_sum($keu6[$id_sub]) : '0') + (!empty($keu7[$id_sub]) ? array_sum($keu7[$id_sub]) : '0');
				$bb8[$id_sub] = (!empty($keu1[$id_sub]) ? array_sum($keu1[$id_sub]) : '0') + (!empty($keu2[$id_sub]) ? array_sum($keu2[$id_sub]) : '0') + (!empty($keu3[$id_sub]) ? array_sum($keu3[$id_sub]) : '0') + (!empty($keu4[$id_sub]) ? array_sum($keu4[$id_sub]) : '0') + (!empty($keu5[$id_sub]) ? array_sum($keu5[$id_sub]) : '0') + (!empty($keu6[$id_sub]) ? array_sum($keu6[$id_sub]) : '0') + (!empty($keu7[$id_sub]) ? array_sum($keu7[$id_sub]) : '0') + (!empty($keu8[$id_sub]) ? array_sum($keu8[$id_sub]) : '0');
				$bb9[$id_sub] = (!empty($keu1[$id_sub]) ? array_sum($keu1[$id_sub]) : '0') + (!empty($keu2[$id_sub]) ? array_sum($keu2[$id_sub]) : '0') + (!empty($keu3[$id_sub]) ? array_sum($keu3[$id_sub]) : '0') + (!empty($keu4[$id_sub]) ? array_sum($keu4[$id_sub]) : '0') + (!empty($keu5[$id_sub]) ? array_sum($keu5[$id_sub]) : '0') + (!empty($keu6[$id_sub]) ? array_sum($keu6[$id_sub]) : '0') + (!empty($keu7[$id_sub]) ? array_sum($keu7[$id_sub]) : '0') + (!empty($keu8[$id_sub]) ? array_sum($keu8[$id_sub]) : '0') + (!empty($keu9[$id_sub]) ? array_sum($keu9[$id_sub]) : '0');
				$bb10[$id_sub] = (!empty($keu1[$id_sub]) ? array_sum($keu1[$id_sub]) : '0') + (!empty($keu2[$id_sub]) ? array_sum($keu2[$id_sub]) : '0') + (!empty($keu3[$id_sub]) ? array_sum($keu3[$id_sub]) : '0') + (!empty($keu4[$id_sub]) ? array_sum($keu4[$id_sub]) : '0') + (!empty($keu5[$id_sub]) ? array_sum($keu5[$id_sub]) : '0') + (!empty($keu6[$id_sub]) ? array_sum($keu6[$id_sub]) : '0') + (!empty($keu7[$id_sub]) ? array_sum($keu7[$id_sub]) : '0') + (!empty($keu8[$id_sub]) ? array_sum($keu8[$id_sub]) : '0') + (!empty($keu9[$id_sub]) ? array_sum($keu9[$id_sub]) : '0') + (!empty($keu10[$id_sub]) ? array_sum($keu10[$id_sub]) : '0');
				$bb11[$id_sub] = (!empty($keu1[$id_sub]) ? array_sum($keu1[$id_sub]) : '0') + (!empty($keu2[$id_sub]) ? array_sum($keu2[$id_sub]) : '0') + (!empty($keu3[$id_sub]) ? array_sum($keu3[$id_sub]) : '0') + (!empty($keu4[$id_sub]) ? array_sum($keu4[$id_sub]) : '0') + (!empty($keu5[$id_sub]) ? array_sum($keu5[$id_sub]) : '0') + (!empty($keu6[$id_sub]) ? array_sum($keu6[$id_sub]) : '0') + (!empty($keu7[$id_sub]) ? array_sum($keu7[$id_sub]) : '0') + (!empty($keu8[$id_sub]) ? array_sum($keu8[$id_sub]) : '0') + (!empty($keu9[$id_sub]) ? array_sum($keu9[$id_sub]) : '0') + (!empty($keu10[$id_sub]) ? array_sum($keu10[$id_sub]) : '0') + (!empty($keu11[$id_sub]) ? array_sum($keu11[$id_sub]) : '0');
				$bb12[$id_sub] = (!empty($keu1[$id_sub]) ? array_sum($keu1[$id_sub]) : '0') + (!empty($keu2[$id_sub]) ? array_sum($keu2[$id_sub]) : '0') + (!empty($keu3[$id_sub]) ? array_sum($keu3[$id_sub]) : '0') + (!empty($keu4[$id_sub]) ? array_sum($keu4[$id_sub]) : '0') + (!empty($keu5[$id_sub]) ? array_sum($keu5[$id_sub]) : '0') + (!empty($keu6[$id_sub]) ? array_sum($keu6[$id_sub]) : '0') + (!empty($keu7[$id_sub]) ? array_sum($keu7[$id_sub]) : '0') + (!empty($keu8[$id_sub]) ? array_sum($keu8[$id_sub]) : '0') + (!empty($keu9[$id_sub]) ? array_sum($keu9[$id_sub]) : '0') + (!empty($keu10[$id_sub]) ? array_sum($keu10[$id_sub]) : '0') + (!empty($keu11[$id_sub]) ? array_sum($keu11[$id_sub]) : '0') + (!empty($keu12[$id_sub]) ? array_sum($keu12[$id_sub]) : '0');
				?>

				<?php $fisik = $db->table('tb_ropk_fisik')->getWhere([
					'tb_ropk_fisik.rkpd_kegiatan' => $DT,
					'tb_ropk_fisik.rkpd_kegiatan_sub' => $row['rkpd_kegiatan_sub_n'],
					'tb_ropk_fisik.opd_id' => user()->opd_id,
					'tb_ropk_fisik.tahun' => $_SESSION['tahun'],
					'tb_ropk_fisik.perubahan' => $_SESSION['perubahan']
				])->getResultArray();
				foreach ($fisik as $ros) {
					isset($ros['ropk_bobot_acuan']) ? $acu[] = ($ros['ropk_bobot_acuan']) : $acu[] = ['0'];
					isset($ros['b1']) ? $fis1[$id_sub][] = ($ros['b1']) : $fis1[$id_sub][] = ['0'];
					isset($ros['b2']) ? $fis2[$id_sub][] = ($ros['b2']) : $fis2[$id_sub][] = ['0'];
					isset($ros['b3']) ? $fis3[$id_sub][] = ($ros['b3']) : $fis3[$id_sub][] = ['0'];
					isset($ros['b4']) ? $fis4[$id_sub][] = ($ros['b4']) : $fis4[$id_sub][] = ['0'];
					isset($ros['b5']) ? $fis5[$id_sub][] = ($ros['b5']) : $fis5[$id_sub][] = ['0'];
					isset($ros['b6']) ? $fis6[$id_sub][] = ($ros['b6']) : $fis6[$id_sub][] = ['0'];
					isset($ros['b7']) ? $fis7[$id_sub][] = ($ros['b7']) : $fis7[$id_sub][] = ['0'];
					isset($ros['b8']) ? $fis8[$id_sub][] = ($ros['b8']) : $fis8[$id_sub][] = ['0'];
					isset($ros['b9']) ? $fis9[$id_sub][] = ($ros['b9']) : $fis9[$id_sub][] = ['0'];
					isset($ros['b10']) ? $fis10[$id_sub][] = ($ros['b10']) : $fis10[$id_sub][] = ['0'];
					isset($ros['b11']) ? $fis11[$id_sub][] = ($ros['b11']) : $fis11[$id_sub][] = ['0'];
					isset($ros['b12']) ? $fis12[$id_sub][] = ($ros['b12']) : $fis12[$id_sub][] = ['0'];
				}
				$fbb1[$id_sub] = !empty($fis1[$id_sub]) ? array_sum($fis1[$id_sub]) : '0';
				$fbb2[$id_sub] = (!empty($fis1[$id_sub]) ? array_sum($fis1[$id_sub]) : '0') + (!empty($fis2[$id_sub]) ? array_sum($fis2[$id_sub]) : '0');
				$fbb3[$id_sub] = (!empty($fis1[$id_sub]) ? array_sum($fis1[$id_sub]) : '0') + (!empty($fis2[$id_sub]) ? array_sum($fis2[$id_sub]) : '0') + (!empty($fis3[$id_sub]) ? array_sum($fis3[$id_sub]) : '0');
				$fbb4[$id_sub] = (!empty($fis1[$id_sub]) ? array_sum($fis1[$id_sub]) : '0') + (!empty($fis2[$id_sub]) ? array_sum($fis2[$id_sub]) : '0') + (!empty($fis3[$id_sub]) ? array_sum($fis3[$id_sub]) : '0') + (!empty($fis4[$id_sub]) ? array_sum($fis4[$id_sub]) : '0');
				$fbb5[$id_sub] = (!empty($fis1[$id_sub]) ? array_sum($fis1[$id_sub]) : '0') + (!empty($fis2[$id_sub]) ? array_sum($fis2[$id_sub]) : '0') + (!empty($fis3[$id_sub]) ? array_sum($fis3[$id_sub]) : '0') + (!empty($fis4[$id_sub]) ? array_sum($fis4[$id_sub]) : '0') + (!empty($fis5[$id_sub]) ? array_sum($fis5[$id_sub]) : '0');
				$fbb6[$id_sub] = (!empty($fis1[$id_sub]) ? array_sum($fis1[$id_sub]) : '0') + (!empty($fis2[$id_sub]) ? array_sum($fis2[$id_sub]) : '0') + (!empty($fis3[$id_sub]) ? array_sum($fis3[$id_sub]) : '0') + (!empty($fis4[$id_sub]) ? array_sum($fis4[$id_sub]) : '0') + (!empty($fis5[$id_sub]) ? array_sum($fis5[$id_sub]) : '0') + (!empty($fis6[$id_sub]) ? array_sum($fis6[$id_sub]) : '0');
				$fbb7[$id_sub] = (!empty($fis1[$id_sub]) ? array_sum($fis1[$id_sub]) : '0') + (!empty($fis2[$id_sub]) ? array_sum($fis2[$id_sub]) : '0') + (!empty($fis3[$id_sub]) ? array_sum($fis3[$id_sub]) : '0') + (!empty($fis4[$id_sub]) ? array_sum($fis4[$id_sub]) : '0') + (!empty($fis5[$id_sub]) ? array_sum($fis5[$id_sub]) : '0') + (!empty($fis6[$id_sub]) ? array_sum($fis6[$id_sub]) : '0') + (!empty($fis7[$id_sub]) ? array_sum($fis7[$id_sub]) : '0');
				$fbb8[$id_sub] = (!empty($fis1[$id_sub]) ? array_sum($fis1[$id_sub]) : '0') + (!empty($fis2[$id_sub]) ? array_sum($fis2[$id_sub]) : '0') + (!empty($fis3[$id_sub]) ? array_sum($fis3[$id_sub]) : '0') + (!empty($fis4[$id_sub]) ? array_sum($fis4[$id_sub]) : '0') + (!empty($fis5[$id_sub]) ? array_sum($fis5[$id_sub]) : '0') + (!empty($fis6[$id_sub]) ? array_sum($fis6[$id_sub]) : '0') + (!empty($fis7[$id_sub]) ? array_sum($fis7[$id_sub]) : '0') + (!empty($fis8[$id_sub]) ? array_sum($fis8[$id_sub]) : '0');
				$fbb9[$id_sub] = (!empty($fis1[$id_sub]) ? array_sum($fis1[$id_sub]) : '0') + (!empty($fis2[$id_sub]) ? array_sum($fis2[$id_sub]) : '0') + (!empty($fis3[$id_sub]) ? array_sum($fis3[$id_sub]) : '0') + (!empty($fis4[$id_sub]) ? array_sum($fis4[$id_sub]) : '0') + (!empty($fis5[$id_sub]) ? array_sum($fis5[$id_sub]) : '0') + (!empty($fis6[$id_sub]) ? array_sum($fis6[$id_sub]) : '0') + (!empty($fis7[$id_sub]) ? array_sum($fis7[$id_sub]) : '0') + (!empty($fis8[$id_sub]) ? array_sum($fis8[$id_sub]) : '0') + (!empty($fis9[$id_sub]) ? array_sum($fis9[$id_sub]) : '0');
				$fbb10[$id_sub] = (!empty($fis1[$id_sub]) ? array_sum($fis1[$id_sub]) : '0') + (!empty($fis2[$id_sub]) ? array_sum($fis2[$id_sub]) : '0') + (!empty($fis3[$id_sub]) ? array_sum($fis3[$id_sub]) : '0') + (!empty($fis4[$id_sub]) ? array_sum($fis4[$id_sub]) : '0') + (!empty($fis5[$id_sub]) ? array_sum($fis5[$id_sub]) : '0') + (!empty($fis6[$id_sub]) ? array_sum($fis6[$id_sub]) : '0') + (!empty($fis7[$id_sub]) ? array_sum($fis7[$id_sub]) : '0') + (!empty($fis8[$id_sub]) ? array_sum($fis8[$id_sub]) : '0') + (!empty($fis9[$id_sub]) ? array_sum($fis9[$id_sub]) : '0') + (!empty($fis10[$id_sub]) ? array_sum($fis10[$id_sub]) : '0');
				$fbb11[$id_sub] = (!empty($fis1[$id_sub]) ? array_sum($fis1[$id_sub]) : '0') + (!empty($fis2[$id_sub]) ? array_sum($fis2[$id_sub]) : '0') + (!empty($fis3[$id_sub]) ? array_sum($fis3[$id_sub]) : '0') + (!empty($fis4[$id_sub]) ? array_sum($fis4[$id_sub]) : '0') + (!empty($fis5[$id_sub]) ? array_sum($fis5[$id_sub]) : '0') + (!empty($fis6[$id_sub]) ? array_sum($fis6[$id_sub]) : '0') + (!empty($fis7[$id_sub]) ? array_sum($fis7[$id_sub]) : '0') + (!empty($fis8[$id_sub]) ? array_sum($fis8[$id_sub]) : '0') + (!empty($fis9[$id_sub]) ? array_sum($fis9[$id_sub]) : '0') + (!empty($fis10[$id_sub]) ? array_sum($fis10[$id_sub]) : '0') + (!empty($fis11[$id_sub]) ? array_sum($fis11[$id_sub]) : '0');
				$fbb12[$id_sub] = (!empty($fis1[$id_sub]) ? array_sum($fis1[$id_sub]) : '0') + (!empty($fis2[$id_sub]) ? array_sum($fis2[$id_sub]) : '0') + (!empty($fis3[$id_sub]) ? array_sum($fis3[$id_sub]) : '0') + (!empty($fis4[$id_sub]) ? array_sum($fis4[$id_sub]) : '0') + (!empty($fis5[$id_sub]) ? array_sum($fis5[$id_sub]) : '0') + (!empty($fis6[$id_sub]) ? array_sum($fis6[$id_sub]) : '0') + (!empty($fis7[$id_sub]) ? array_sum($fis7[$id_sub]) : '0') + (!empty($fis8[$id_sub]) ? array_sum($fis8[$id_sub]) : '0') + (!empty($fis9[$id_sub]) ? array_sum($fis9[$id_sub]) : '0') + (!empty($fis10[$id_sub]) ? array_sum($fis10[$id_sub]) : '0') + (!empty($fis11[$id_sub]) ? array_sum($fis11[$id_sub]) : '0') + (!empty($fis12[$id_sub]) ? array_sum($fis12[$id_sub]) : '0');
				?>

				<?php $progres1 = $db->table('tb_simonela_progres')
					->select('bulan_lapor, created_at')
					->selectsum('realisasi_keu')
					->selectsum('realisasi_fisik')
					->getWhere([
						'kegiatan_sub' => $row['rkpd_kegiatan_sub_n'],
						'kegiatan' => $DT,
						'opd_id' => user()->opd_id,
						'tahun' => $_SESSION['tahun'],
						'perubahan' => $_SESSION['perubahan'],
						'bulan' => 'b1'
					])->getRowArray();
				//dd($progres1); 

				try {
					isset($progres1['realisasi_keu']) ? $real1[] = ($progres1['realisasi_keu'] / $bb1[$id_sub]) * 100 : $real1[] = '0';
				} catch (DivisionByZeroError $e) {
					$real1[] = '0';
				}

				try {
					isset($progres1['realisasi_fisik']) ? $realf1[] = number_format(round(($progres1['realisasi_fisik'] / $fbb1[$id_sub]) * 100, 2), 2, ',', '.') : $realf1[] = '0';
				} catch (DivisionByZeroError $e) {
					$realf1[] = '0';
				}
				?>

				<!-------------- /Konsistensi -->

				<tr>
					<?php $progres2 = $db->table('tb_simonela_progres')
						->select('bulan_lapor, created_at')
						->selectsum('realisasi_keu')
						->selectsum('realisasi_fisik')
						->getWhere([
							'kegiatan_sub' => $row['rkpd_kegiatan_sub_n'],
							'kegiatan' => $DT,
							'opd_id' => user()->opd_id,
							'tahun' => $_SESSION['tahun'],
							'perubahan' => $_SESSION['perubahan'],
							'bulan' => 'b2'
						])->getRowArray();

					$realisasi2['realisasi_keu'] = $progres1['realisasi_keu'] + $progres2['realisasi_keu'];
					$realisasi2['realisasi_fisik'] = $progres1['realisasi_fisik'] + $progres2['realisasi_fisik'];

					try {
						isset($realisasi2['realisasi_keu']) ? $real2[] = round(($realisasi2['realisasi_keu'] / $bb2[$id_sub]) * 100, 2) : $real2[] = '0';
					} catch (DivisionByZeroError $e) {
						$real2[] = '0';
					}

					try {
						isset($realisasi2['realisasi_fisik']) ? $realf2[] = number_format(round(($realisasi2['realisasi_fisik'] / $fbb2[$id_sub]) * 100, 2), 2, ',', '.') : $realf2[] = '0';
					} catch (DivisionByZeroError $e) {
						$realf2[] = '0';
					}
					?>

				<tr>
					<?php $progres3 = $db->table('tb_simonela_progres')
						->select('bulan_lapor, created_at')
						->selectsum('realisasi_keu')
						->selectsum('realisasi_fisik')
						->getWhere([
							'kegiatan_sub' => $row['rkpd_kegiatan_sub_n'],
							'kegiatan' => $DT,
							'opd_id' => user()->opd_id,
							'tahun' => $_SESSION['tahun'],
							'perubahan' => $_SESSION['perubahan'],
							'bulan' => 'b3'
						])->getRowArray();

					$realisasi3['realisasi_keu'] = $progres1['realisasi_keu'] + $progres2['realisasi_keu'] + $progres3['realisasi_keu'];
					$realisasi3['realisasi_fisik'] = $progres1['realisasi_fisik'] + $progres2['realisasi_fisik'] + $progres3['realisasi_fisik'];

					try {
						isset($realisasi3['realisasi_keu']) ? $real3[] = round(($realisasi3['realisasi_keu'] / $bb3[$id_sub]) * 100, 2) : $real3[] = '0';
					} catch (DivisionByZeroError $e) {
						$real3[] = '0';
					}

					try {
						isset($realisasi3['realisasi_fisik']) ? $realf3[] = number_format(round(($realisasi3['realisasi_fisik'] / $fbb3[$id_sub]) * 100, 2), 2, ',', '.') : $realf3[] = '0';
					} catch (DivisionByZeroError $e) {
						$realf3[] = '0';
					}
					?>

					<?php $progres4 = $db->table('tb_simonela_progres')
						->select('bulan_lapor, created_at')
						->selectsum('realisasi_keu')
						->selectsum('realisasi_fisik')
						->getWhere([
							'kegiatan_sub' => $row['rkpd_kegiatan_sub_n'],
							'kegiatan' => $DT,
							'opd_id' => user()->opd_id,
							'tahun' => $_SESSION['tahun'],
							'perubahan' => $_SESSION['perubahan'],
							'bulan' => 'b4'
						])->getRowArray();

					$realisasi4['realisasi_keu'] = $progres1['realisasi_keu'] + $progres2['realisasi_keu'] + $progres3['realisasi_keu'] + $progres4['realisasi_keu'];
					$realisasi4['realisasi_fisik'] = $progres1['realisasi_fisik'] + $progres2['realisasi_fisik'] + $progres3['realisasi_fisik'] + $progres4['realisasi_fisik'];

					try {
						isset($realisasi4['realisasi_keu']) ? $real4[] = round(($realisasi4['realisasi_keu'] / $bb4[$id_sub]) * 100, 2) : $real4[] = '0';
					} catch (DivisionByZeroError $e) {
						$real4[] = '0';
					}

					try {
						isset($realisasi4['realisasi_fisik']) ? $realf4[] = number_format(round(($realisasi4['realisasi_fisik'] / $fbb4[$id_sub]) * 100, 2), 2, ',', '.') : $realf4[] = '0';
					} catch (DivisionByZeroError $e) {
						$realf4[] = '0';
					}
					?>

					<?php $progres5 = $db->table('tb_simonela_progres')
						->select('bulan_lapor, created_at')
						->selectsum('realisasi_keu')
						->selectsum('realisasi_fisik')
						->getWhere([
							'kegiatan_sub' => $row['rkpd_kegiatan_sub_n'],
							'kegiatan' => $DT,
							'opd_id' => user()->opd_id,
							'tahun' => $_SESSION['tahun'],
							'perubahan' => $_SESSION['perubahan'],
							'bulan' => 'b5'
						])->getRowArray();

					$realisasi5['realisasi_keu'] = $progres1['realisasi_keu'] + $progres2['realisasi_keu'] + $progres3['realisasi_keu'] + $progres4['realisasi_keu'] + $progres5['realisasi_keu'];
					$realisasi5['realisasi_fisik'] = $progres1['realisasi_fisik'] + $progres2['realisasi_fisik'] + $progres3['realisasi_fisik'] + $progres4['realisasi_fisik'] + $progres5['realisasi_fisik'];

					try {
						isset($realisasi5['realisasi_keu']) ? $real5[] = round(($realisasi5['realisasi_keu'] / $bb5[$id_sub]) * 100, 2) : $real5[] = '0';
					} catch (DivisionByZeroError $e) {
						$real5[] = '0';
					}

					try {
						isset($realisasi5['realisasi_fisik']) ? $realf5[] = number_format(round(($realisasi5['realisasi_fisik'] / $fbb5[$id_sub]) * 100, 2), 2, ',', '.') : $realf5[] = '0';
					} catch (DivisionByZeroError $e) {
						$realf5[] = '0';
					}
					?>

					<?php $progres6 = $db->table('tb_simonela_progres')
						->select('bulan_lapor, created_at')
						->selectsum('realisasi_keu')
						->selectsum('realisasi_fisik')
						->getWhere([
							'kegiatan_sub' => $row['rkpd_kegiatan_sub_n'],
							'kegiatan' => $DT,
							'opd_id' => user()->opd_id,
							'tahun' => $_SESSION['tahun'],
							'perubahan' => $_SESSION['perubahan'],
							'bulan' => 'b6'
						])->getRowArray();
					$realisasi6['realisasi_keu'] = $progres1['realisasi_keu'] + $progres2['realisasi_keu'] + $progres3['realisasi_keu'] + $progres4['realisasi_keu'] + $progres5['realisasi_keu'] + $progres6['realisasi_keu'];
					$realisasi6['realisasi_fisik'] = $progres1['realisasi_fisik'] + $progres2['realisasi_fisik'] + $progres3['realisasi_fisik'] + $progres4['realisasi_fisik'] + $progres5['realisasi_fisik'] + $progres6['realisasi_fisik'];

					try {
						isset($realisasi6['realisasi_keu']) ? $real6[] = round(($realisasi6['realisasi_keu'] / $bb6[$id_sub]) * 100, 2) : $real6[] = '0';
					} catch (DivisionByZeroError $e) {
						$real6[] = '0';
					}

					try {
						isset($realisasi6['realisasi_fisik']) ? $realf6[] = number_format(round(($realisasi6['realisasi_fisik'] / $fbb6[$id_sub]) * 100, 2), 2, ',', '.') : $realf6[] = '0';
					} catch (DivisionByZeroError $e) {
						$realf6[] = '0';
					}
					?>

					<?php $progres7 = $db->table('tb_simonela_progres')
						->select('bulan_lapor, created_at')
						->selectsum('realisasi_keu')
						->selectsum('realisasi_fisik')
						->getWhere([
							'kegiatan_sub' => $row['rkpd_kegiatan_sub_n'],
							'kegiatan' => $DT,
							'opd_id' => user()->opd_id,
							'tahun' => $_SESSION['tahun'],
							'perubahan' => $_SESSION['perubahan'],
							'bulan' => 'b7'
						])->getRowArray();

					$realisasi7['realisasi_keu'] = $progres1['realisasi_keu'] + $progres2['realisasi_keu'] + $progres3['realisasi_keu'] + $progres4['realisasi_keu'] + $progres5['realisasi_keu'] + $progres6['realisasi_keu'] + $progres7['realisasi_keu'];
					$realisasi7['realisasi_fisik'] = $progres1['realisasi_fisik'] + $progres2['realisasi_fisik'] + $progres3['realisasi_fisik'] + $progres4['realisasi_fisik'] + $progres5['realisasi_fisik'] + $progres6['realisasi_fisik'] + $progres7['realisasi_fisik'];

					try {
						isset($realisasi7['realisasi_keu']) ? $real7[] = round(($realisasi7['realisasi_keu'] / $bb7[$id_sub]) * 100, 2) : $real7[] = '0';
					} catch (DivisionByZeroError $e) {
						$real7[] = '0';
					}

					try {
						isset($realisasi7['realisasi_fisik']) ? $realf7[] = number_format(round(($realisasi7['realisasi_fisik'] / $fbb7[$id_sub]) * 100, 2), 2, ',', '.') : $realf7[] = '0';
					} catch (DivisionByZeroError $e) {
						$realf7[] = '0';
					}
					?>

					<?php $progres8 = $db->table('tb_simonela_progres')
						->select('bulan_lapor, created_at')
						->selectsum('realisasi_keu')
						->selectsum('realisasi_fisik')
						->getWhere([
							'kegiatan_sub' => $row['rkpd_kegiatan_sub_n'],
							'kegiatan' => $DT,
							'opd_id' => user()->opd_id,
							'tahun' => $_SESSION['tahun'],
							'perubahan' => $_SESSION['perubahan'],
							'bulan' => 'b8'
						])->getRowArray();

					$realisasi8['realisasi_keu'] = $progres1['realisasi_keu'] + $progres2['realisasi_keu'] + $progres3['realisasi_keu'] + $progres4['realisasi_keu'] + $progres5['realisasi_keu'] + $progres6['realisasi_keu'] + $progres7['realisasi_keu'] + $progres8['realisasi_keu'];
					$realisasi8['realisasi_fisik'] = $progres1['realisasi_fisik'] + $progres2['realisasi_fisik'] + $progres3['realisasi_fisik'] + $progres4['realisasi_fisik'] + $progres5['realisasi_fisik'] + $progres6['realisasi_fisik'] + $progres7['realisasi_fisik'] + $progres8['realisasi_fisik'];

					try {
						isset($realisasi8['realisasi_keu']) ? $real8[] = round(($realisasi8['realisasi_keu'] / $bb8[$id_sub]) * 100, 2) : $real8[] = '0';
					} catch (DivisionByZeroError $e) {
						$real8[] = '0';
					}

					try {
						isset($realisasi8['realisasi_fisik']) ? $realf8[] = number_format(round(($realisasi8['realisasi_fisik'] / $fbb8[$id_sub]) * 100, 2), 2, ',', '.') : $realf8[] = '0';
					} catch (DivisionByZeroError $e) {
						$realf8[] = '0';
					}
					?>

					<?php $progres9 = $db->table('tb_simonela_progres')
						->select('bulan_lapor, created_at')
						->selectsum('realisasi_keu')
						->selectsum('realisasi_fisik')
						->getWhere([
							'kegiatan_sub' => $row['rkpd_kegiatan_sub_n'],
							'kegiatan' => $DT,
							'opd_id' => user()->opd_id,
							'tahun' => $_SESSION['tahun'],
							'perubahan' => $_SESSION['perubahan'],
							'bulan' => 'b9'
						])->getRowArray();

					$realisasi9['realisasi_keu'] = $progres1['realisasi_keu'] + $progres2['realisasi_keu'] + $progres3['realisasi_keu'] + $progres4['realisasi_keu'] + $progres5['realisasi_keu'] + $progres6['realisasi_keu'] + $progres7['realisasi_keu'] + $progres8['realisasi_keu'] + $progres9['realisasi_keu'];
					$realisasi9['realisasi_fisik'] = $progres1['realisasi_fisik'] + $progres2['realisasi_fisik'] + $progres3['realisasi_fisik'] + $progres4['realisasi_fisik'] + $progres5['realisasi_fisik'] + $progres6['realisasi_fisik'] + $progres7['realisasi_fisik'] + $progres8['realisasi_fisik'] + $progres9['realisasi_fisik'];

					try {
						isset($realisasi9['realisasi_keu']) ? $real9[] = round(($realisasi9['realisasi_keu'] / $bb9[$id_sub]) * 100, 2) : $real9[] = '0';
					} catch (DivisionByZeroError $e) {
						$real9[] = '0';
					}

					try {
						isset($realisasi9['realisasi_fisik']) ? $realf9[] = number_format(round(($realisasi9['realisasi_fisik'] / $fbb9[$id_sub]) * 100, 2), 2, ',', '.') : $realf9[] = '0';
					} catch (DivisionByZeroError $e) {
						$realf9[] = '0';
					}
					?>

					<?php $progres10 = $db->table('tb_simonela_progres')
						->select('bulan_lapor, created_at')
						->selectsum('realisasi_keu')
						->selectsum('realisasi_fisik')
						->getWhere([
							'kegiatan_sub' => $row['rkpd_kegiatan_sub_n'],
							'kegiatan' => $DT,
							'opd_id' => user()->opd_id,
							'tahun' => $_SESSION['tahun'],
							'perubahan' => $_SESSION['perubahan'],
							'bulan' => 'b10'
						])->getRowArray();

					$realisasi10['realisasi_keu'] = $progres1['realisasi_keu'] + $progres2['realisasi_keu'] + $progres3['realisasi_keu'] + $progres4['realisasi_keu'] + $progres5['realisasi_keu'] + $progres6['realisasi_keu'] + $progres7['realisasi_keu'] + $progres8['realisasi_keu'] + $progres9['realisasi_keu'] + $progres10['realisasi_keu'];
					$realisasi10['realisasi_fisik'] = $progres1['realisasi_fisik'] + $progres2['realisasi_fisik'] + $progres3['realisasi_fisik'] + $progres4['realisasi_fisik'] + $progres5['realisasi_fisik'] + $progres6['realisasi_fisik'] + $progres7['realisasi_fisik'] + $progres8['realisasi_fisik'] + $progres9['realisasi_fisik'] + $progres10['realisasi_fisik'];

					try {
						isset($realisasi10['realisasi_keu']) ? $real10[] = round(($realisasi10['realisasi_keu'] / $bb10[$id_sub]) * 100, 2) : $real10[] = '0';
					} catch (DivisionByZeroError $e) {
						$real10[] = '0';
					}

					try {
						isset($realisasi10['realisasi_fisik']) ? $realf10[] = number_format(round(($realisasi10['realisasi_fisik'] / $fbb10[$id_sub]) * 100, 2), 2, ',', '.') : $realf10[] = '0';
					} catch (DivisionByZeroError $e) {
						$realf10[] = '0';
					}
					?>

					<?php $progres11 = $db->table('tb_simonela_progres')
						->select('bulan_lapor, created_at')
						->selectsum('realisasi_keu')
						->selectsum('realisasi_fisik')
						->getWhere([
							'kegiatan_sub' => $row['rkpd_kegiatan_sub_n'],
							'kegiatan' => $DT,
							'opd_id' => user()->opd_id,
							'tahun' => $_SESSION['tahun'],
							'perubahan' => $_SESSION['perubahan'],
							'bulan' => 'b11'
						])->getRowArray();

					$realisasi11['realisasi_keu'] = $progres1['realisasi_keu'] + $progres2['realisasi_keu'] + $progres3['realisasi_keu'] + $progres4['realisasi_keu'] + $progres5['realisasi_keu'] + $progres6['realisasi_keu'] + $progres7['realisasi_keu'] + $progres8['realisasi_keu'] + $progres9['realisasi_keu'] + $progres10['realisasi_keu'] + $progres11['realisasi_keu'];
					$realisasi11['realisasi_fisik'] = $progres1['realisasi_fisik'] + $progres2['realisasi_fisik'] + $progres3['realisasi_fisik'] + $progres4['realisasi_fisik'] + $progres5['realisasi_fisik'] + $progres6['realisasi_fisik'] + $progres7['realisasi_fisik'] + $progres8['realisasi_fisik'] + $progres9['realisasi_fisik'] + $progres10['realisasi_fisik'] + $progres11['realisasi_fisik'];

					try {
						isset($realisasi11['realisasi_keu']) ? $real11[] = round(($realisasi11['realisasi_keu'] / $bb11[$id_sub]) * 100, 2) : $real11[] = '0';
					} catch (DivisionByZeroError $e) {
						$real11[] = '0';
					}

					try {
						isset($realisasi11['realisasi_fisik']) ? $realf11[] = number_format(round(($realisasi11['realisasi_fisik'] / $fbb11[$id_sub]) * 100, 2), 2, ',', '.') : $realf11[] = '0';
					} catch (DivisionByZeroError $e) {
						$realf11[] = '0';
					}
					?>

					<?php $progres12 = $db->table('tb_simonela_progres')
						->select('bulan_lapor, created_at')
						->selectsum('realisasi_keu')
						->selectsum('realisasi_fisik')
						->getWhere([
							'kegiatan_sub' => $row['rkpd_kegiatan_sub_n'],
							'kegiatan' => $DT,
							'opd_id' => user()->opd_id,
							'tahun' => $_SESSION['tahun'],
							'perubahan' => $_SESSION['perubahan'],
							'bulan' => 'b12'
						])->getRowArray();

					$realisasi12['realisasi_keu'] = $progres1['realisasi_keu'] + $progres2['realisasi_keu'] + $progres3['realisasi_keu'] + $progres4['realisasi_keu'] + $progres5['realisasi_keu'] + $progres6['realisasi_keu'] + $progres7['realisasi_keu'] + $progres8['realisasi_keu'] + $progres9['realisasi_keu'] + $progres10['realisasi_keu'] + $progres11['realisasi_keu'] + $progres12['realisasi_keu'];
					$realisasi12['realisasi_fisik'] = $progres1['realisasi_fisik'] + $progres2['realisasi_fisik'] + $progres3['realisasi_fisik'] + $progres4['realisasi_fisik'] + $progres5['realisasi_fisik'] + $progres6['realisasi_fisik'] + $progres7['realisasi_fisik'] + $progres8['realisasi_fisik'] + $progres9['realisasi_fisik'] + $progres10['realisasi_fisik'] + $progres11['realisasi_fisik'] + $progres12['realisasi_fisik'];

					try {
						isset($realisasi12['realisasi_keu']) ? $real12[] = round(($realisasi12['realisasi_keu'] / $bb12[$id_sub]) * 100, 2) : $real12[] = '0';
					} catch (DivisionByZeroError $e) {
						$real12[] = '0';
					}

					try {
						isset($realisasi12['realisasi_fisik']) ? $realf12[] = number_format(round(($realisasi12['realisasi_fisik'] / $fbb12[$id_sub]) * 100, 2), 2, ',', '.') : $realf12[] = '0';
					} catch (DivisionByZeroError $e) {
						$realf12[] = '0';
					}
					?>
				<?php endforeach; ?>
				<tr>
					<td class="align-top">Januari</td>
					<td class="align-top text-right">
						<?php if (count($real1)) {
							echo array_sum($real1) / count($real1);
						} ?>
					</td>
					<td class="align-top text-right">
						<?php if (count($realf1)) {
							echo array_sum($realf1) / count($realf1);
						} ?>
					</td>
				</tr>
				<tr>
					<td class="align-top">Februari</td>
					<td class="align-top text-right">
						<?php if (count($real2)) {
							echo array_sum($real2) / count($real2);
						} ?>
					</td>
					<td class="align-top text-right">
						<?php if (count($realf2)) {
							echo array_sum($realf2) / count($realf2);
						} ?>
					</td>
				</tr>
				<tr>
					<td class="align-top">Maret</td>
					<td class="align-top text-right">
						<?php if (count($real3)) {
							echo array_sum($real3) / count($real3);
						} ?>
					</td>
					<td class="align-top text-right">
						<?php if (count($realf3)) {
							echo array_sum($realf3) / count($realf3);
						} ?>
					</td>
				</tr>
				<tr>
					<td class="align-top">April</td>
					<td class="align-top text-right">
						<?php if (count($real4)) {
							echo array_sum($real4) / count($real4);
						} ?>
					</td>
					<td class="align-top text-right">
						<?php if (count($realf4)) {
							echo array_sum($realf4) / count($realf4);
						} ?>
					</td>
				</tr>
				<tr>
					<td class="align-top">Mei</td>
					<td class="align-top text-right">
						<?php if (count($real5)) {
							echo array_sum($real5) / count($real5);
						} ?>
					</td>
					<td class="align-top text-right">
						<?php if (count($realf5)) {
							echo array_sum($realf5) / count($realf5);
						} ?>
					</td>
				</tr>
				<tr>
					<td class="align-top">Juni</td>
					<td class="align-top text-right">
						<?php if (count($real6)) {
							echo array_sum($real6) / count($real6);
						} ?>
					</td>
					<td class="align-top text-right">
						<?php if (count($realf6)) {
							echo array_sum($realf6) / count($realf6);
						} ?>
					</td>
				</tr>
				<tr>
					<td class="align-top">Juli</td>
					<td class="align-top text-right">
						<?php if (count($real7)) {
							echo array_sum($real7) / count($real7);
						} ?>
					</td>
					<td class="align-top text-right">
						<?php if (count($realf7)) {
							echo array_sum($realf7) / count($realf7);
						} ?>
					</td>
				</tr>
				<tr>
					<td class="align-top">Agustus</td>
					<td class="align-top text-right">
						<?php if (count($real8)) {
							echo array_sum($real8) / count($real8);
						} ?>
					</td>
					<td class="align-top text-right">
						<?php if (count($realf8)) {
							echo array_sum($realf8) / count($realf8);
						} ?>
					</td>
				</tr>
				<tr>
					<td class="align-top">September</td>
					<td class="align-top text-right">
						<?php if (count($real9)) {
							echo array_sum($real9) / count($real9);
						} ?>
					</td>
					<td class="align-top text-right">
						<?php if (count($realf9)) {
							echo array_sum($realf9) / count($realf9);
						} ?>
					</td>
				</tr>
				<tr>
					<td class="align-top">Oktober</td>
					<td class="align-top text-right">
						<?php if (count($real10)) {
							echo array_sum($real10) / count($real10);
						} ?>
					</td>
					<td class="align-top text-right">
						<?php if (count($realf10)) {
							echo array_sum($realf10) / count($realf10);
						} ?>
					</td>
				</tr>
				<tr>
					<td class="align-top">November</td>
					<td class="align-top text-right">
						<?php if (count($real11)) {
							echo array_sum($real11) / count($real11);
						} ?>
					</td>
					<td class="align-top text-right">
						<?php if (count($realf11)) {
							echo array_sum($realf11) / count($realf11);
						} ?>
					</td>
				</tr>
				<tr>
					<td class="align-top">Desember</td>
					<td class="align-top text-right">
						<?php if (count($real12)) {
							echo array_sum($real12) / count($real12);
						} ?>
					</td>
					<td class="align-top text-right">
						<?php if (count($realf12)) {
							echo array_sum($realf12) / count($realf12);
						} ?>
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