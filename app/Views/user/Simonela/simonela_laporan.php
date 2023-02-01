<?= $this->extend('_layout/template'); ?>

<?= $this->section('stylesheet'); ?>
<link rel="stylesheet" href="<?= base_url('/toping/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') ?>">
<link rel="stylesheet" href="<?= base_url('/toping/plugins/datatables-rowgroup/css/rowGroup.bootstrap4.min.js') ?>">
<?= $this->endSection(); ?>

<?= $this->section('tombol'); ?>
<div style="width:80px;">
	<a href="<?= base_url('/user/simonela/simonela/laporan_pdf/' . $bulan_long . '?bu=' . $_GET['bu']); ?>" target="BLINK">
		<li class="btn btn-block btn-danger btn-sm" active><i class="nav-icon fa fa-file-pdf"></i> Celak</li>
	</a>
</div>
<?= $this->endSection(); ?>

<?= $this->section('content'); ?>
<div class="card-body">
	<div class="row">
		<div class="col-md-1">Bulan:</div>
		<div class="col-md-11">
			<select class="form-control" onchange="location = this.value;">
				<option <?= $_GET['bu'] == 'b1' ? 'selected' : ''; ?> value="<?= base_url('/user/simonela/simonela/laporan/Januari?bu=b1'); ?>">Januari</option>
				<option <?= $_GET['bu'] == 'b2' ? 'selected' : ''; ?> value="<?= base_url('/user/simonela/simonela/laporan/Februari?bu=b2'); ?>">Februari</option>
				<option <?= $_GET['bu'] == 'b3' ? 'selected' : ''; ?> value="<?= base_url('/user/simonela/simonela/laporan/Maret?bu=b3'); ?>">Maret</option>
				<option <?= $_GET['bu'] == 'b4' ? 'selected' : ''; ?> value="<?= base_url('/user/simonela/simonela/laporan/April?bu=b4'); ?>">April</option>
				<option <?= $_GET['bu'] == 'b5' ? 'selected' : ''; ?> value="<?= base_url('/user/simonela/simonela/laporan/Mei?bu=b5'); ?>">Mei</option>
				<option <?= $_GET['bu'] == 'b6' ? 'selected' : ''; ?> value="<?= base_url('/user/simonela/simonela/laporan/Juni?bu=b6'); ?>">Juni</option>
				<option <?= $_GET['bu'] == 'b7' ? 'selected' : ''; ?> value="<?= base_url('/user/simonela/simonela/laporan/Juli?bu=b7'); ?>">Juli</option>
				<option <?= $_GET['bu'] == 'b8' ? 'selected' : ''; ?> value="<?= base_url('/user/simonela/simonela/laporan/Agustus?bu=b8'); ?>">Agustus</option>
				<option <?= $_GET['bu'] == 'b9' ? 'selected' : ''; ?> value="<?= base_url('/user/simonela/simonela/laporan/September?bu=b9'); ?>">September</option>
				<option <?= $_GET['bu'] == 'b10' ? 'selected' : ''; ?> value="<?= base_url('/user/simonela/simonela/laporan/Oktober?bu=b10'); ?>">Oktober</option>
				<option <?= $_GET['bu'] == 'b11' ? 'selected' : ''; ?> value="<?= base_url('/user/simonela/simonela/laporan/November?bu=b11'); ?>">November</option>
				<option <?= $_GET['bu'] == 'b12' ? 'selected' : ''; ?> value="<?= base_url('/user/simonela/simonela/laporan/Desember?bu=b12'); ?>">Desember</option>
			</select>
		</div>
	</div><br>

	<table id="example1" class="table table-bordered display nowrap table-hover table-sm">
		<thead>
			<tr>
				<th rowspan="2" class="text-center align-middle">
					<div style="min-width: 700px; width:auto; max-width:1200px;">Kegiatan/Sub Kegiatan</div>
				</th>
				<th rowspan="2"></th>
				<th rowspan="2" class="text-center align-middle">
					<div style="min-width: 400px; width:auto; max-width:600px;">Tahapan Aktifitas</div>
				</th>
				<th rowspan="2" class="text-center align-middle">
					<div style="min-width: 400px; width:auto; max-width:600px;">Faktor Penghambat</div>
				</th>
				<th rowspan="2" class="text-center align-middle">
					<div style="min-width: 400px; width:auto; max-width:600px;">Faktor Pendukung</div>
				</th>
				<th rowspan="2" class="text-center align-middle">
					<div style="min-width: 400px; width:auto; max-width:600px;">Rencana Tindak Lanjut</div>
				</th>
				<th class="text-center" colspan="2">Target</th>
				<th class="text-center" colspan="2">Realisasi</th>
				<th class="text-center" colspan="2">Konsistensi (%)</th>
				<th class="text-center" colspan="2">Deviasi</th>
			</tr>
			<tr>
				<th class="text-center">Keu</th>
				<th class="text-center">Fisik</th>
				<th class="text-center">Keu</th>
				<th class="text-center">Fisik</th>
				<th class="text-center">Keu</th>
				<th class="text-center">Fisik</th>
				<th class="text-center">Keu</th>
				<th class="text-center">Fisik</th>
			</tr>
		</thead>
		<tbody>
			<?php
			$sub_kegiatan = $db->table('tb_ropk_keuangan_rkpd_kegiatan_sub')
				->distinct('rkpd_kegiatan_n, rkpd_kegiatan_sub_n, rkpd_indikator_kegiatan_sub, rp_tahun, id_ropk_keuangan_rkpd_kegiatan_sub')
				->select('rkpd_kegiatan_n, rkpd_kegiatan_sub_n, rkpd_indikator_kegiatan_sub, rp_tahun, id_ropk_keuangan_rkpd_kegiatan_sub')
				->orderBy('rkpd_kegiatan_n', 'ASC')
				->orderBy('rkpd_kegiatan_sub_n', 'ASC')
				->getWhere(['tb_ropk_keuangan_rkpd_kegiatan_sub.opd_id' => user()->opd_id, 'tb_ropk_keuangan_rkpd_kegiatan_sub.perubahan' => $_SESSION['perubahan'], 'tb_ropk_keuangan_rkpd_kegiatan_sub.tahun' => $_SESSION['tahun']])->getResultArray();

			foreach ($sub_kegiatan as $rol) : ?>

				<?php
				$id_ropk = $rol['id_ropk_keuangan_rkpd_kegiatan_sub'];
				$bulan = $_GET['bu'];
				?>

				<?php $keuangan = $db->table('tb_ropk_keuangan')->getWhere([
					'tb_ropk_keuangan.rkpd_kegiatan' => $rol['rkpd_kegiatan_n'],
					'tb_ropk_keuangan.rkpd_kegiatan_sub' => $rol['rkpd_kegiatan_sub_n'],
					'tb_ropk_keuangan.rkpd_indikator_kegiatan_sub' => $rol['rkpd_indikator_kegiatan_sub'],
					'tb_ropk_keuangan.opd_id' => user()->opd_id,
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
					'tb_ropk_fisik.rkpd_kegiatan' => $rol['rkpd_kegiatan_n'],
					'tb_ropk_fisik.rkpd_kegiatan_sub' => $rol['rkpd_kegiatan_sub_n'],
					'tb_ropk_fisik.rkpd_indikator_kegiatan_sub' => $rol['rkpd_indikator_kegiatan_sub'],
					'tb_ropk_fisik.opd_id' => user()->opd_id,
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
							'kegiatan' => $rol['rkpd_kegiatan_n'],
							'kegiatan_sub' => $rol['rkpd_kegiatan_sub_n'],
							'indikator_kegiatan_sub' => $rol['rkpd_indikator_kegiatan_sub'],
							'opd_id' => user()->opd_id,
							'tahun' => $_SESSION['tahun'],
							'perubahan' => $_SESSION['perubahan'],
							'bulan' => $bulan
						])->getRowArray();
					//dd($progres1); 
					?>
					<td class="align-top text-wrap" style="padding-left: 20px;"><?= $rol['rkpd_kegiatan_sub_n']; ?></td>
					<td><b><?= $rol['rkpd_kegiatan_n']; ?></b></td>

					<td class="align-top text-wrap">
						<?php $tahap_aktifitas1 = $db->table('tb_simonela_progres')->select('tahap_aktifitas')->getWhere(['kegiatan' => $rol['rkpd_kegiatan_n'], 'kegiatan_sub' => $rol['rkpd_kegiatan_sub_n'], 'indikator_kegiatan_sub' => $rol['rkpd_indikator_kegiatan_sub'], 'opd_id' => user()->opd_id, 'tahun' => $_SESSION['tahun'], 'perubahan' => $_SESSION['perubahan'], 'bulan' => $bulan])->getResultArray(); ?>
						<?php foreach ($tahap_aktifitas1 as $tahap1) {
							echo '-' . $tahap1['tahap_aktifitas'] . '<br>';
						} ?>
					</td>
					<td class="align-top text-wrap">
						<?php $faktor_penghambat1 = $db->table('tb_simonela_progres')->select('faktor_penghambat')->getWhere(['kegiatan' => $rol['rkpd_kegiatan_n'], 'kegiatan_sub' => $rol['rkpd_kegiatan_sub_n'], 'indikator_kegiatan_sub' => $rol['rkpd_indikator_kegiatan_sub'], 'opd_id' => user()->opd_id, 'tahun' => $_SESSION['tahun'], 'perubahan' => $_SESSION['perubahan'], 'bulan' => $bulan])->getResultArray(); ?>
						<?php foreach ($faktor_penghambat1 as $penghambat1) {
							echo '-' . $penghambat1['faktor_penghambat'] . '<br>';
						} ?>
					</td>
					<td class="align-top text-wrap">
						<?php $faktor_pendukung1 = $db->table('tb_simonela_progres')->select('faktor_pendukung')->getWhere(['kegiatan' => $rol['rkpd_kegiatan_n'], 'kegiatan_sub' => $rol['rkpd_kegiatan_sub_n'], 'indikator_kegiatan_sub' => $rol['rkpd_indikator_kegiatan_sub'], 'opd_id' => user()->opd_id, 'tahun' => $_SESSION['tahun'], 'perubahan' => $_SESSION['perubahan'], 'bulan' => $bulan])->getResultArray(); ?>
						<?php foreach ($faktor_pendukung1 as $pendukung1) {
							echo '-' . $pendukung1['faktor_pendukung'] . '<br>';
						} ?>
					</td>
					<td class="align-top text-wrap">
						<?php $rencana_tindak_lanjut1 = $db->table('tb_simonela_progres')->select('rencana_tindak_lanjut')->getWhere(['kegiatan' => $rol['rkpd_kegiatan_n'], 'kegiatan_sub' => $rol['rkpd_kegiatan_sub_n'], 'indikator_kegiatan_sub' => $rol['rkpd_indikator_kegiatan_sub'], 'opd_id' => user()->opd_id, 'tahun' => $_SESSION['tahun'], 'perubahan' => $_SESSION['perubahan'], 'bulan' => $bulan])->getResultArray(); ?>
						<?php foreach ($rencana_tindak_lanjut1 as $tindak_lanjut1) {
							echo '-' . $tindak_lanjut1['rencana_tindak_lanjut'] . '<br>';
						} ?>
					</td>
					<td class="align-top text-right"><?= number_format($b[$bulan][$id_ropk], 0, ',', '.'); ?></td>
					<td class="align-top text-right"><?= number_format($fb[$bulan][$id_ropk], 2, ',', '.'); ?></td>
					<!-------------- Realisasi -->
					<td class="align-top text-right"><?= isset($progres1['realisasi_keu']) ? number_format($progres1['realisasi_keu'], 0, ',', '.') : ''; ?></td>
					<td class="align-top text-right"><?= isset($progres1['realisasi_fisik']) ? number_format($progres1['realisasi_fisik'], 2, ',', '.') : ''; ?></td>
					<!-------------- /Realisasi -->
					<!-------------- Kosistensi -->
					<td class="align-top text-right">
						<?php
						try {
							echo isset($progres1['realisasi_keu']) ? round(($progres1['realisasi_keu'] / $b[$bulan][$id_ropk]) * 100, 2) : '';
						} catch (DivisionByZeroError $e) {
							echo "0";
						}
						?>
					</td>
					<td class="align-top text-right">
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
						$deviasi_keu[$id_ropk] = isset($progres1['realisasi_keu']) ? number_format((((($progres1['realisasi_keu'] / $rol['rp_tahun']) * 100) - (($b[$bulan][$id_ropk] / $rol['rp_tahun']) * 100))), 2, ',', '.') : '';
						$deviasi_keu_w[$id_ropk] = isset($progres1['realisasi_keu']) ? ((($progres1['realisasi_keu'] / $rol['rp_tahun']) * 100) - (($b[$bulan][$id_ropk] / $rol['rp_tahun']) * 100)) : '';
					} catch (DivisionByZeroError $e) {
						$deviasi_keu[$id_ropk] = "";
					}
					?>
					<td class="align-top text-right" style=" <?= $deviasi_keu_w[$id_ropk] == "" ? "" : ($deviasi_keu_w[$id_ropk] > '-5' ? "background: green" : ($deviasi_keu_w[$id_ropk] <= '-5' && $deviasi_keu_w[$id_ropk] >= '-10' ? "background: yellow" : ($deviasi_keu_w[$id_ropk] < '-10' ? "background: red" : ""))); ?>">
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
					<td class="align-top text-right" style=" <?= $deviasi_fis_w[$id_ropk] == "" ? "" : ($deviasi_fis_w[$id_ropk] > '-5' ? "background: green" : ($deviasi_fis_w[$id_ropk] <= '-5' && $deviasi_fis_w[$id_ropk] >= '-10' ? "background: yellow" : ($deviasi_fis_w[$id_ropk] < '-10' ? "background: red" : ""))); ?>">
						<?= $deviasi_fis[$id_ropk]; ?>
					</td>
					<!-------------- //Deviasi-->
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
			"paging": false,
			"responsive": false,
			"autoWidth": false,
			"ordering": false,
			"lengthMenu": [
				[20, 40, 60, 100, -1],
				[20, 40, 60, 100, 'All']
			],
			columnDefs: [{
				visible: false,
				targets: [1]
			}],
			order: [
				[1, 'asc']
			],
			rowGroup: {
				startRender: function(rows, group) {

					if (rows.data().pluck(1)[0] == group) {
						return $('<tr class="font-weight-bold" style="background-color: blanchedalmond;" />')
							.append('<td class="align-top text-wrap">' + group + '</td>')
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
					}
				},
				dataSrc: [1]
			},
		});

	});
</script>

<?= $this->endSection(); ?>