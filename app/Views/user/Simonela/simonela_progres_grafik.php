<?= $this->extend('_layout/template'); ?>

<?= $this->section('stylesheet'); ?>
<link rel="stylesheet" href="<?= base_url('/toping/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') ?>">
<?= $this->endSection(); ?>

<?= $this->section('tombol'); ?>
<div style="width:90px;">
	<a href="#" onclick="history.back(-1)">
		<li class="btn btn-block btn-info btn-sm" active><i class="nav-icon fa fa-chevron-left"></i> Kembali</li>
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

	<!-- =========================================================== -->
	<?php $rkpd_kegiatan = $db->table('tb_ropk_keuangan_rkpd_kegiatan_sub')
		->getWhere([
			'rkpd_kegiatan_n' => $DT['rkpd_kegiatan_n'],
			'rkpd_kegiatan_sub_n' => $DT['rkpd_kegiatan_sub_n'],
			'rkpd_indikator_kegiatan_sub' => $DT['rkpd_indikator_kegiatan_sub'],
			'opd_id' => user()->opd_id,
			'tahun' => $_SESSION['tahun'],
			'perubahan' => $_SESSION['perubahan']
		])->getResultArray();
	?>
	<?php foreach ($rkpd_kegiatan as $rol) {
		$query = $db->table('tb_ropk_keuangan')
			->getWhere([
				'tb_ropk_keuangan.rkpd_kegiatan' => $DT['rkpd_kegiatan_n'],
				'tb_ropk_keuangan.rkpd_kegiatan_sub' => $DT['rkpd_kegiatan_sub_n'],
				'tb_ropk_keuangan.rkpd_indikator_kegiatan_sub' => $DT['rkpd_indikator_kegiatan_sub'],
				/* 'tb_ropk_keuangan.ropk_tahap' => 'Persiapan', */
				'tb_ropk_keuangan.opd_id' => user()->opd_id,
				'tb_ropk_keuangan.perubahan' => $_SESSION['perubahan'],
				'tb_ropk_keuangan.tahun' => $_SESSION['tahun']
			])->getResultArray();
		foreach ($query as $ros) {
			isset($ros['ropk_bobot_acuan']) ? $acu[] = ($ros['ropk_bobot_acuan']) : $acu[] = ['0'];
		}
	}
	?>

	<!-- =========================================================== -->
	<?php $progres1 = $db->table('tb_simonela_progres')->select('bulan_lapor, created_at')->selectsum('realisasi_keu')->selectsum('realisasi_fisik')->getWhere(['kegiatan' => $DT['rkpd_kegiatan_n'], 'kegiatan_sub' => $DT['rkpd_kegiatan_sub_n'], 'indikator_kegiatan_sub' => $DT['rkpd_indikator_kegiatan_sub'], 'opd_id' => user()->opd_id, 'tahun' => $_SESSION['tahun'], 'perubahan' => $_SESSION['perubahan'], 'bulan' => 'b1'])->getRowArray();
	try {
		!empty($acu) ? $s1 = round(($progres1['realisasi_keu'] / $DT['rp_tahun']) * 100, 2) : $s1 = '0';
	} catch (DivisionByZeroError $e) {
		$s1 = '0';
	}
	?>

	<?php $progres2 = $db->table('tb_simonela_progres')->select('bulan_lapor, created_at')->selectsum('realisasi_keu')->selectsum('realisasi_fisik')->getWhere(['kegiatan' => $DT['rkpd_kegiatan_n'], 'kegiatan_sub' => $DT['rkpd_kegiatan_sub_n'], 'indikator_kegiatan_sub' => $DT['rkpd_indikator_kegiatan_sub'], 'opd_id' => user()->opd_id, 'tahun' => $_SESSION['tahun'], 'perubahan' => $_SESSION['perubahan'], 'bulan' => 'b2'])->getRowArray();
	$realisasi2['realisasi_keu'] = $progres1['realisasi_keu'] + $progres2['realisasi_keu'];
	try {
		!empty($acu) ? $s2 = round(($realisasi2['realisasi_keu'] / $DT['rp_tahun']) * 100, 2) : $s2 = '0';
	} catch (DivisionByZeroError $e) {
		$s2 = '0';
	}
	$realisasi2['realisasi_fisik'] = $progres1['realisasi_fisik'] + $progres2['realisasi_fisik'];
	?>

	<?php $progres3 = $db->table('tb_simonela_progres')->select('bulan_lapor, created_at')->selectsum('realisasi_keu')->selectsum('realisasi_fisik')->getWhere(['kegiatan' => $DT['rkpd_kegiatan_n'], 'kegiatan_sub' => $DT['rkpd_kegiatan_sub_n'], 'indikator_kegiatan_sub' => $DT['rkpd_indikator_kegiatan_sub'], 'opd_id' => user()->opd_id, 'tahun' => $_SESSION['tahun'], 'perubahan' => $_SESSION['perubahan'], 'bulan' => 'b3'])->getRowArray();
	$realisasi3['realisasi_keu'] = $progres1['realisasi_keu'] + $progres2['realisasi_keu'] + $progres3['realisasi_keu'];
	try {
		!empty($acu) ? $s3 = round(($realisasi3['realisasi_keu'] / $DT['rp_tahun']) * 100, 2) : $s3 = '0';
	} catch (DivisionByZeroError $e) {
		$s3 = '0';
	}
	$realisasi3['realisasi_fisik'] = $progres1['realisasi_fisik'] + $progres2['realisasi_fisik'] + $progres3['realisasi_fisik'];
	?>

	<?php $progres4 = $db->table('tb_simonela_progres')->select('bulan_lapor, created_at')->selectsum('realisasi_keu')->selectsum('realisasi_fisik')->getWhere(['kegiatan' => $DT['rkpd_kegiatan_n'], 'kegiatan_sub' => $DT['rkpd_kegiatan_sub_n'], 'indikator_kegiatan_sub' => $DT['rkpd_indikator_kegiatan_sub'], 'opd_id' => user()->opd_id, 'tahun' => $_SESSION['tahun'], 'perubahan' => $_SESSION['perubahan'], 'bulan' => 'b4'])->getRowArray();
	$realisasi4['realisasi_keu'] = $progres1['realisasi_keu'] + $progres2['realisasi_keu'] + $progres3['realisasi_keu'] + $progres4['realisasi_keu'];
	try {
		!empty($acu) ? $s4 = round(($realisasi4['realisasi_keu'] / $DT['rp_tahun']) * 100, 2) : $s4 = '0';
	} catch (DivisionByZeroError $e) {
		$s4 = '0';
	}
	$realisasi4['realisasi_fisik'] = $progres1['realisasi_fisik'] + $progres2['realisasi_fisik'] + $progres3['realisasi_fisik'] + $progres4['realisasi_fisik'];
	?>

	<?php $progres5 = $db->table('tb_simonela_progres')->select('bulan_lapor, created_at')->selectsum('realisasi_keu')->selectsum('realisasi_fisik')->getWhere(['kegiatan' => $DT['rkpd_kegiatan_n'], 'kegiatan_sub' => $DT['rkpd_kegiatan_sub_n'], 'indikator_kegiatan_sub' => $DT['rkpd_indikator_kegiatan_sub'],	'opd_id' => user()->opd_id, 'tahun' => $_SESSION['tahun'], 'perubahan' => $_SESSION['perubahan'], 'bulan' => 'b5'])->getRowArray();
	$realisasi5['realisasi_keu'] = $progres1['realisasi_keu'] + $progres2['realisasi_keu'] + $progres3['realisasi_keu'] + $progres4['realisasi_keu'] + $progres5['realisasi_keu'];
	try {
		!empty($acu) ? $s5 = round(($realisasi5['realisasi_keu'] / $DT['rp_tahun']) * 100, 2) : $s5 = '0';
	} catch (DivisionByZeroError $e) {
		$s5 = '0';
	}
	$realisasi5['realisasi_fisik'] = $progres1['realisasi_fisik'] + $progres2['realisasi_fisik'] + $progres3['realisasi_fisik'] + $progres4['realisasi_fisik'] + $progres5['realisasi_fisik'];
	?>

	<?php $progres6 = $db->table('tb_simonela_progres')->select('bulan_lapor, created_at')->selectsum('realisasi_keu')->selectsum('realisasi_fisik')->getWhere(['kegiatan' => $DT['rkpd_kegiatan_n'], 'kegiatan_sub' => $DT['rkpd_kegiatan_sub_n'], 'indikator_kegiatan_sub' => $DT['rkpd_indikator_kegiatan_sub'],	'opd_id' => user()->opd_id, 'tahun' => $_SESSION['tahun'], 'perubahan' => $_SESSION['perubahan'], 'bulan' => 'b6'])->getRowArray();
	$realisasi6['realisasi_keu'] = $progres1['realisasi_keu'] + $progres2['realisasi_keu'] + $progres3['realisasi_keu'] + $progres4['realisasi_keu'] + $progres5['realisasi_keu'] + $progres6['realisasi_keu'];
	try {
		!empty($acu) ? $s6 = round(($realisasi6['realisasi_keu'] / $DT['rp_tahun']) * 100, 2) : $s6 = '0';
	} catch (DivisionByZeroError $e) {
		$s6 = '0';
	}
	$realisasi6['realisasi_fisik'] = $progres1['realisasi_fisik'] + $progres2['realisasi_fisik'] + $progres3['realisasi_fisik'] + $progres4['realisasi_fisik'] + $progres5['realisasi_fisik'] + $progres6['realisasi_fisik'];
	?>

	<?php $progres7 = $db->table('tb_simonela_progres')->select('bulan_lapor, created_at')->selectsum('realisasi_keu')->selectsum('realisasi_fisik')->getWhere(['kegiatan' => $DT['rkpd_kegiatan_n'], 'kegiatan_sub' => $DT['rkpd_kegiatan_sub_n'], 'indikator_kegiatan_sub' => $DT['rkpd_indikator_kegiatan_sub'],	'opd_id' => user()->opd_id, 'tahun' => $_SESSION['tahun'], 'perubahan' => $_SESSION['perubahan'], 'bulan' => 'b7'])->getRowArray();
	$realisasi7['realisasi_keu'] = $progres1['realisasi_keu'] + $progres2['realisasi_keu'] + $progres3['realisasi_keu'] + $progres4['realisasi_keu'] + $progres5['realisasi_keu'] + $progres6['realisasi_keu'] + $progres7['realisasi_keu'];
	try {
		!empty($acu) ? $s7 = round(($realisasi7['realisasi_keu'] / $DT['rp_tahun']) * 100, 2) : $s7 = '0';
	} catch (DivisionByZeroError $e) {
		$s7 = '0';
	}
	$realisasi7['realisasi_fisik'] = $progres1['realisasi_fisik'] + $progres2['realisasi_fisik'] + $progres3['realisasi_fisik'] + $progres4['realisasi_fisik'] + $progres5['realisasi_fisik'] + $progres6['realisasi_fisik'] + $progres7['realisasi_fisik'];
	?>

	<?php $progres8 = $db->table('tb_simonela_progres')->select('bulan_lapor, created_at')->selectsum('realisasi_keu')->selectsum('realisasi_fisik')->getWhere(['kegiatan' => $DT['rkpd_kegiatan_n'], 'kegiatan_sub' => $DT['rkpd_kegiatan_sub_n'], 'indikator_kegiatan_sub' => $DT['rkpd_indikator_kegiatan_sub'],	'opd_id' => user()->opd_id, 'tahun' => $_SESSION['tahun'], 'perubahan' => $_SESSION['perubahan'], 'bulan' => 'b8'])->getRowArray();
	$realisasi8['realisasi_keu'] = $progres1['realisasi_keu'] + $progres2['realisasi_keu'] + $progres3['realisasi_keu'] + $progres4['realisasi_keu'] + $progres5['realisasi_keu'] + $progres6['realisasi_keu'] + $progres7['realisasi_keu'] + $progres8['realisasi_keu'];
	try {
		!empty($acu) ? $s8 = round(($realisasi8['realisasi_keu'] / $DT['rp_tahun']) * 100, 2) : $s8 = '0';
	} catch (DivisionByZeroError $e) {
		$s8 = '0';
	}
	$realisasi8['realisasi_fisik'] = $progres1['realisasi_fisik'] + $progres2['realisasi_fisik'] + $progres3['realisasi_fisik'] + $progres4['realisasi_fisik'] + $progres5['realisasi_fisik'] + $progres6['realisasi_fisik'] + $progres7['realisasi_fisik'] + $progres8['realisasi_fisik'];
	?>

	<?php $progres9 = $db->table('tb_simonela_progres')->select('bulan_lapor, created_at')->selectsum('realisasi_keu')->selectsum('realisasi_fisik')->getWhere(['kegiatan' => $DT['rkpd_kegiatan_n'], 'kegiatan_sub' => $DT['rkpd_kegiatan_sub_n'], 'indikator_kegiatan_sub' => $DT['rkpd_indikator_kegiatan_sub'],	'opd_id' => user()->opd_id, 'tahun' => $_SESSION['tahun'], 'perubahan' => $_SESSION['perubahan'], 'bulan' => 'b9'])->getRowArray();
	$realisasi9['realisasi_keu'] = $progres1['realisasi_keu'] + $progres2['realisasi_keu'] + $progres3['realisasi_keu'] + $progres4['realisasi_keu'] + $progres5['realisasi_keu'] + $progres6['realisasi_keu'] + $progres7['realisasi_keu'] + $progres8['realisasi_keu'] + $progres9['realisasi_keu'];
	try {
		!empty($acu) ? $s9 = round(($realisasi9['realisasi_keu'] / $DT['rp_tahun']) * 100, 2) : $s9 = '0';
	} catch (DivisionByZeroError $e) {
		$s9 = '0';
	}
	$realisasi9['realisasi_fisik'] = $progres1['realisasi_fisik'] + $progres2['realisasi_fisik'] + $progres3['realisasi_fisik'] + $progres4['realisasi_fisik'] + $progres5['realisasi_fisik'] + $progres6['realisasi_fisik'] + $progres7['realisasi_fisik'] + $progres8['realisasi_fisik'] + $progres9['realisasi_fisik'];
	?>

	<?php $progres10 = $db->table('tb_simonela_progres')->select('bulan_lapor, created_at')->selectsum('realisasi_keu')->selectsum('realisasi_fisik')->getWhere(['kegiatan' => $DT['rkpd_kegiatan_n'], 'kegiatan_sub' => $DT['rkpd_kegiatan_sub_n'], 'indikator_kegiatan_sub' => $DT['rkpd_indikator_kegiatan_sub'],	'opd_id' => user()->opd_id, 'tahun' => $_SESSION['tahun'], 'perubahan' => $_SESSION['perubahan'], 'bulan' => 'b10'])->getRowArray();
	$realisasi10['realisasi_keu'] = $progres1['realisasi_keu'] + $progres2['realisasi_keu'] + $progres3['realisasi_keu'] + $progres4['realisasi_keu'] + $progres5['realisasi_keu'] + $progres6['realisasi_keu'] + $progres7['realisasi_keu'] + $progres8['realisasi_keu'] + $progres9['realisasi_keu'] + $progres10['realisasi_keu'];
	try {
		!empty($acu) ? $s10 = round(($realisasi10['realisasi_keu'] / $DT['rp_tahun']) * 100, 2) : $s10 = '0';
	} catch (DivisionByZeroError $e) {
		$s10 = '0';
	}
	$realisasi10['realisasi_fisik'] = $progres1['realisasi_fisik'] + $progres2['realisasi_fisik'] + $progres3['realisasi_fisik'] + $progres4['realisasi_fisik'] + $progres5['realisasi_fisik'] + $progres6['realisasi_fisik'] + $progres7['realisasi_fisik'] + $progres8['realisasi_fisik'] + $progres9['realisasi_fisik'] + $progres10['realisasi_fisik'];
	?>

	<?php $progres11 = $db->table('tb_simonela_progres')->select('bulan_lapor, created_at')->selectsum('realisasi_keu')->selectsum('realisasi_fisik')->getWhere(['kegiatan' => $DT['rkpd_kegiatan_n'], 'kegiatan_sub' => $DT['rkpd_kegiatan_sub_n'], 'indikator_kegiatan_sub' => $DT['rkpd_indikator_kegiatan_sub'],	'opd_id' => user()->opd_id, 'tahun' => $_SESSION['tahun'], 'perubahan' => $_SESSION['perubahan'], 'bulan' => 'b11'])->getRowArray();
	$realisasi11['realisasi_keu'] = $progres1['realisasi_keu'] + $progres2['realisasi_keu'] + $progres3['realisasi_keu'] + $progres4['realisasi_keu'] + $progres5['realisasi_keu'] + $progres6['realisasi_keu'] + $progres7['realisasi_keu'] + $progres8['realisasi_keu'] + $progres9['realisasi_keu'] + $progres10['realisasi_keu'] + $progres11['realisasi_keu'];
	try {
		!empty($acu) ? $s11 = round(($realisasi11['realisasi_keu'] / $DT['rp_tahun']) * 100, 2) : $s11 = '0';
	} catch (DivisionByZeroError $e) {
		$s11 = '0';
	}
	$realisasi11['realisasi_fisik'] = $progres1['realisasi_fisik'] + $progres2['realisasi_fisik'] + $progres3['realisasi_fisik'] + $progres4['realisasi_fisik'] + $progres5['realisasi_fisik'] + $progres6['realisasi_fisik'] + $progres7['realisasi_fisik'] + $progres8['realisasi_fisik'] + $progres9['realisasi_fisik'] + $progres10['realisasi_fisik'] + $progres11['realisasi_fisik'];
	?>

	<?php $progres12 = $db->table('tb_simonela_progres')->select('bulan_lapor, created_at')->selectsum('realisasi_keu')->selectsum('realisasi_fisik')->getWhere(['kegiatan' => $DT['rkpd_kegiatan_n'], 'kegiatan_sub' => $DT['rkpd_kegiatan_sub_n'], 'indikator_kegiatan_sub' => $DT['rkpd_indikator_kegiatan_sub'],	'opd_id' => user()->opd_id, 'tahun' => $_SESSION['tahun'], 'perubahan' => $_SESSION['perubahan'], 'bulan' => 'b12'])->getRowArray();
	$realisasi12['realisasi_keu'] = $progres1['realisasi_keu'] + $progres2['realisasi_keu'] + $progres3['realisasi_keu'] + $progres4['realisasi_keu'] + $progres5['realisasi_keu'] + $progres6['realisasi_keu'] + $progres7['realisasi_keu'] + $progres8['realisasi_keu'] + $progres9['realisasi_keu'] + $progres10['realisasi_keu'] + $progres11['realisasi_keu'] + $progres12['realisasi_keu'];
	try {
		!empty($acu) ? $s12 = round(($realisasi12['realisasi_keu'] / $DT['rp_tahun']) * 100, 2) : $s12 = '0';
	} catch (DivisionByZeroError $e) {
		$s12 = '0';
	}
	$realisasi12['realisasi_fisik'] = $progres1['realisasi_fisik'] + $progres2['realisasi_fisik'] + $progres3['realisasi_fisik'] + $progres4['realisasi_fisik'] + $progres5['realisasi_fisik'] + $progres6['realisasi_fisik'] + $progres7['realisasi_fisik'] + $progres8['realisasi_fisik'] + $progres9['realisasi_fisik'] + $progres10['realisasi_fisik'] + $progres11['realisasi_fisik'] + $progres12['realisasi_fisik'];
	?>
	<!-- =========================================================== -->
	<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
	<script type="text/javascript">
		google.charts.load('current', {
			'packages': ['corechart']
		});
		google.charts.setOnLoadCallback(drawChart);

		function drawChart() {
			var data = new google.visualization.arrayToDataTable(
				[
					["BULAN", "Realisasi (Keuangan)", "Realisasi (Fisik)"],
					['Januari', <?= isset($s1) ? $s1 : '0'; ?>, <?= isset($progres1['realisasi_fisik']) ? $progres1['realisasi_fisik'] : '0'; ?>],
					['Februari', <?= isset($s2) ? $s2 : '0'; ?>, <?= isset($realisasi2['realisasi_fisik']) ? $realisasi2['realisasi_fisik'] : '0'; ?>],
					['Maret', <?= isset($s3) ? $s3 : '0'; ?>, <?= isset($realisasi3['realisasi_fisik']) ? $realisasi3['realisasi_fisik'] : '0'; ?>],
					['April', <?= isset($s4) ? $s4 : '0'; ?>, <?= isset($realisasi4['realisasi_fisik']) ? $realisasi4['realisasi_fisik'] : '0'; ?>],
					['Mei', <?= isset($s5) ? $s5 : '0'; ?>, <?= isset($realisasi5['realisasi_fisik']) ? $realisasi5['realisasi_fisik'] : '0'; ?>],
					['Juni', <?= isset($s6) ? $s6 : '0'; ?>, <?= isset($realisasi6['realisasi_fisik']) ? $realisasi6['realisasi_fisik'] : '0'; ?>],
					['Juli', <?= isset($s7) ? $s7 : '0'; ?>, <?= isset($realisasi7['realisasi_fisik']) ? $realisasi7['realisasi_fisik'] : '0'; ?>],
					['Agustus', <?= isset($s8) ? $s8 : '0'; ?>, <?= isset($realisasi8['realisasi_fisik']) ? $realisasi8['realisasi_fisik'] : '0'; ?>],
					['September', <?= isset($s9) ? $s9 : '0'; ?>, <?= isset($realisasi9['realisasi_fisik']) ? $realisasi9['realisasi_fisik'] : '0'; ?>],
					['Oktober', <?= isset($s10) ? $s10 : '0'; ?>, <?= isset($realisasi10['realisasi_fisik']) ? $realisasi10['realisasi_fisik'] : '0'; ?>],
					['November', <?= isset($s11) ? $s11 : '0'; ?>, <?= isset($realisasi11['realisasi_fisik']) ? $realisasi11['realisasi_fisik'] : '0'; ?>],
					['Desember', <?= isset($s12) ? $s12 : '0'; ?>, <?= isset($realisasi12['realisasi_fisik']) ? $realisasi12['realisasi_fisik'] : '0'; ?>]
				]);
			var view = new google.visualization.DataView(data);
			view.setColumns(
				[
					0,
					1, {
						calc: "stringify",
						sourceColumn: 1,
						type: "string",
						role: "annotation"
					},
					2, {
						calc: "stringify",
						sourceColumn: 2,
						type: "string",
						role: "annotation"
					}

				]
			);
			var options = {
				'title': null,
				'width': '100%',
				'height': 600,
				legend: 'bottom'
			};
			var chart = new google.visualization.LineChart(document.getElementById('chart_div'));
			chart.draw(view, options);
		}
	</script>
	<div class="card-body text-center">
		<div class="card-body row" id="chart_div"></div>
	</div>
</div>
<?= $this->endSection(); ?>