<?= $this->extend('_layout/template'); ?>

<?= $this->section('stylesheet'); ?>
<link rel="stylesheet" href="<?= base_url('/toping/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') ?>">
<?= $this->endSection(); ?>

<?= $this->section('tombol'); ?>
<?php if (menu('cantik')->kunci == 'tidak') { ?>
	<div style="width:90px;">
		<a href="<?= base_url('/user/ropk/ropk_kegiatan_sub/fisik'); ?>">
			<li class="btn btn-block btn-info btn-sm" active><i class="nav-icon fa fa-chevron-left"></i> Kembali</li>
		</a>
	</div>
	<div style="width:80px;">
		<a href="<?= base_url('/user/ropk/ropk_fisik/grafik?k=' . $DT['rkpd_kegiatan_n'] . '&s=' . $DT['rkpd_kegiatan_sub_n']); ?>">
			<li class="btn btn-block btn-danger btn-sm" active><i class="nav-icon fa fa-chart-bar"></i> Grafik</li>
		</a>
	</div>
	<div>
		<a href="<?= base_url('/user/ropk/ropk_fisik/import/' . $DT['id_ropk_keuangan_rkpd_kegiatan_sub']); ?>">
			<li class="btn btn-block btn-success btn-sm" active><i class="nav-icon fa fa-file-excel"></i> Import</li>
		</a>
	</div>
	<div style="width:90px;">
		<a href="<?= base_url('/user/ropk/ropk_fisik/fisik_add/' . $DT['id_ropk_keuangan_rkpd_kegiatan_sub']); ?>">
			<li class="btn btn-block btn-warning btn-sm" active><i class="nav-icon fa fa-plus"></i> Add</li>
		</a>
	</div>
<?php } else { ?>
	<div style="width:90px;">
		<a href="<?= base_url('/user/ropk/ropk_kegiatan_sub/fisik'); ?>">
			<li class="btn btn-block btn-info btn-sm" active><i class="nav-icon fa fa-chevron-left"></i> Kembali</li>
		</a>
	</div>
	<div style="width:80px;">
		<a href="<?= base_url('/user/ropk/ropk_fisik/grafik?k=' . $DT['rkpd_kegiatan_n'] . '&s=' . $DT['rkpd_kegiatan_sub_n']); ?>">
			<li class="btn btn-block btn-danger btn-sm" active><i class="nav-icon fa fa-chart-bar"></i> Grafik</li>
		</a>
	</div>
	<div>
		<a href="#">
			<li class="btn btn-block btn-success btn-sm" active><i class="nav-icon fa fa-lock"></i> Import</li>
		</a>
	</div>
	<div style="width:90px;">
		<a href="#">
			<li class="btn btn-block btn-warning btn-sm" active><i class="nav-icon fa fa-lock"></i> Add</li>
		</a>
	</div>
<?php } ?>
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
	<div class="">
		<table id="example1" class="table table-bordered display nowrap table-responsive table-sm" cellspacing="0">
			<thead>
				<tr>
					<th rowspan="2" class="text-center align-middle" width="30px">NO</th>
					<th rowspan="2" class="align-middle">
						<div style="width:500px;">Tahap Aktivitas</div>
					</th>
					<!--<th rowspan="2" class="align-middle" style="width: 300px;">Sub Unit Organisasi SKPD</th>-->
					<th rowspan="2" class="text-center align-middle">
						<div style="width:500px;">Sasaran / Target Sasaran</div>
					</th>
					<th rowspan="2" class="text-center align-middle" style="width: 60px;">Acuan</th>
					<th colspan="3" class="text-center" style="width: 60px;">Triwulan 1</th>
					<th colspan="3" class="text-center" style="width: 60px;">Triwulan 2</th>
					<th colspan="3" class="text-center" style="width: 60px;">Triwulan 3</th>
					<th colspan="3" class="text-center" style="width: 60px;">Triwulan 4</th>
					<th rowspan="2" class="text-center align-middle" style="width: 80px;">Aksi</th>
				</tr>
				<tr>
					<th class="text-center" style="width: 60px;">1</th>
					<th class="text-center" style="width: 60px;">2</th>
					<th class="text-center" style="width: 60px;">3</th>
					<th class="text-center" style="width: 60px;">4</th>
					<th class="text-center" style="width: 60px;">5</th>
					<th class="text-center" style="width: 60px;">6</th>
					<th class="text-center" style="width: 60px;">7</th>
					<th class="text-center" style="width: 60px;">8</th>
					<th class="text-center" style="width: 60px;">9</th>
					<th class="text-center" style="width: 60px;">10</th>
					<th class="text-center" style="width: 60px;">11</th>
					<th class="text-center" style="width: 60px;">12</th>
				</tr>
			</thead>
			<tbody>
				<?php
				$group = $db->table('tb_ropk_fisik')
					->select('ropk_group')
					->distinct('ropk_group')
					->getWhere([
						'tb_ropk_fisik.rkpd_kegiatan' => $DT['rkpd_kegiatan_n'],
						'tb_ropk_fisik.rkpd_kegiatan_sub' => $DT['rkpd_kegiatan_sub_n'],
						'tb_ropk_fisik.rkpd_indikator_kegiatan_sub' => $DT['rkpd_indikator_kegiatan_sub'],
						// 'tb_ropk_fisik.ropk_tahap' => 'Persiapan',
						'tb_ropk_fisik.opd_id' => user()->opd_id,
						'tb_ropk_fisik.tahun' => $_SESSION['tahun'],
						'tb_ropk_fisik.perubahan' => $_SESSION['perubahan']
					])->getResultArray();
				foreach ($group as $rol) : ?>
					<tr class="font-weight-bold" style="background-color: blanchedalmond;">
						<td colspan="17" class="text-wrap align-top"> <?= $rol['ropk_group']; ?> </td>
						<!-- <td style="text-align: center;">
							<a class="btn btn-info btn-circle btn-xs" href="<?= base_url() . '/user/ropk/ropk_organisasi/organisasi_edit/'; ?>">
								<i class="nav-icon fas fa-pen-alt"></i>
							</a>
							<a class="btn btn-danger btn-circle btn-xs" onclick="if(confirm('Apakah anda yakin ingin menghapus data ini ??')){location.href='<?= base_url() . '/user/ropk/ropk_organisasi/organisasi_hapus/'; ?>'}" href="#">
								<i class="nav-icon fas fa-trash-alt"></i>
							</a>
						</td> -->
					</tr>
					<?php $i = 1;
					$query = $db->table('tb_ropk_fisik')->getWhere([
						'tb_ropk_fisik.rkpd_kegiatan' => $DT['rkpd_kegiatan_n'],
						'tb_ropk_fisik.rkpd_kegiatan_sub' => $DT['rkpd_kegiatan_sub_n'],
						'tb_ropk_fisik.rkpd_indikator_kegiatan_sub' => $DT['rkpd_indikator_kegiatan_sub'],
						'tb_ropk_fisik.ropk_group' => $rol['ropk_group'],
						'tb_ropk_fisik.opd_id' => user()->opd_id,
						'tb_ropk_fisik.tahun' => $_SESSION['tahun'],
						'tb_ropk_fisik.perubahan' => $_SESSION['perubahan']
					])->getResultArray();
					foreach ($query as $ros) : ?>
						<tr>
							<td class="align-top text-center"><?= $i++; ?></td>
							<td class="text-wrap align-top"> <?= $ros['ropk_tahap_aktivitas']; ?> </td>
							<!--<td class="align-top text-right"></td>-->
							<td class="text-wrap align-top"><?= isset($ros['ropk_sasaran']) ? $ros['ropk_sasaran'] . ': ' . $ros['ropk_sasaran_target'] . ' ' . $ros['ropk_sasaran_satuan'] : ''; ?></td>
							<td class="text-center"><?php isset($ros['ropk_bobot_acuan']) ? ((float) $ros['ropk_bobot_acuan'] == $ros['ropk_bobot_acuan'] ? $acu[] = ($ros['ropk_bobot_acuan']) : $acu[] = ['0']) : $acu[] = ['0']; ?> <?= (float) $ros['ropk_bobot_acuan'] != $ros['ropk_bobot_acuan'] ? "ERROR" : $ros['ropk_bobot_acuan']; ?></td>
							<td class="text-center"><?php isset($ros['b1']) ? ((float) $ros['b1'] == $ros['b1'] ? $num1[] = ($ros['b1']) : $num1[] = ['0']) : $num1[] = ['0']; ?><?= (float) $ros['b1'] == $ros['b1'] ? $ros['b1'] : "ERROR"; ?></td>
							<td class="text-center"><?php isset($ros['b2']) ? ((float) $ros['b2'] == $ros['b2'] ? $num2[] = ($ros['b2']) : $num2[] = ['0']) : $num2[] = ['0']; ?><?= (float) $ros['b2'] == $ros['b2'] ? $ros['b2'] : "ERROR"; ?></td>
							<td class="text-center"><?php isset($ros['b3']) ? ((float) $ros['b3'] == $ros['b3'] ? $num3[] = ($ros['b3']) : $num3[] = ['0']) : $num3[] = ['0']; ?><?= (float) $ros['b3'] == $ros['b3'] ? $ros['b3'] : "ERROR"; ?></td>
							<td class="text-center"><?php isset($ros['b4']) ? ((float) $ros['b4'] == $ros['b4'] ? $num4[] = ($ros['b4']) : $num4[] = ['0']) : $num4[] = ['0']; ?><?= (float) $ros['b4'] == $ros['b4'] ? $ros['b4'] : "ERROR"; ?></td>
							<td class="text-center"><?php isset($ros['b5']) ? ((float) $ros['b5'] == $ros['b5'] ? $num5[] = ($ros['b5']) : $num5[] = ['0']) : $num5[] = ['0']; ?><?= (float) $ros['b5'] == $ros['b5'] ? $ros['b5'] : "ERROR"; ?></td>
							<td class="text-center"><?php isset($ros['b6']) ? ((float) $ros['b6'] == $ros['b6'] ? $num6[] = ($ros['b6']) : $num6[] = ['0']) : $num6[] = ['0']; ?><?= (float) $ros['b6'] == $ros['b6'] ? $ros['b6'] : "ERROR"; ?></td>
							<td class="text-center"><?php isset($ros['b7']) ? ((float) $ros['b7'] == $ros['b7'] ? $num7[] = ($ros['b7']) : $num7[] = ['0']) : $num7[] = ['0']; ?><?= (float) $ros['b7'] == $ros['b7'] ? $ros['b7'] : "ERROR"; ?></td>
							<td class="text-center"><?php isset($ros['b8']) ? ((float) $ros['b8'] == $ros['b8'] ? $num8[] = ($ros['b8']) : $num8[] = ['0']) : $num8[] = ['0']; ?><?= (float) $ros['b8'] == $ros['b8'] ? $ros['b8'] : "ERROR"; ?></td>
							<td class="text-center"><?php isset($ros['b9']) ? ((float) $ros['b9'] == $ros['b9'] ? $num9[] = ($ros['b9']) : $num9[] = ['0']) : $num9[] = ['0']; ?><?= (float) $ros['b9'] == $ros['b9'] ? $ros['b9'] : "ERROR"; ?></td>
							<td class="text-center"><?php isset($ros['b10']) ? ((float) $ros['b10'] == $ros['b10'] ? $num10[] = ($ros['b10']) : $num10[] = ['0']) : $num10[] = ['0']; ?><?= (float) $ros['b10'] == $ros['b10'] ? $ros['b10'] : "ERROR"; ?></td>
							<td class="text-center"><?php isset($ros['b11']) ? ((float) $ros['b11'] == $ros['b11'] ? $num11[] = ($ros['b11']) : $num11[] = ['0']) : $num11[] = ['0']; ?><?= (float) $ros['b11'] == $ros['b11'] ? $ros['b11'] : "ERROR"; ?></td>
							<td class="text-center"><?php isset($ros['b12']) ? ((float) $ros['b12'] == $ros['b12'] ? $num12[] = ($ros['b12']) : $num12[] = ['0']) : $num12[] = ['0']; ?><?= (float) $ros['b12'] == $ros['b12'] ? $ros['b12'] : "ERROR"; ?></td>
							<td style="text-align: center;">
								<?php if (menu('cantik')->kunci == 'tidak') { ?>
									<a class="btn btn-info btn-circle btn-xs" href="<?= base_url() . '/user/ropk/ropk_fisik/fisik_edit/' . $ros['id_ropk_fisik'] . '/' . $DT['id_ropk_keuangan_rkpd_kegiatan_sub']; ?>">
										<i class="nav-icon fas fa-pen-alt"></i>
									</a>
									<a class="btn btn-danger btn-circle btn-xs" onclick="if(confirm('Apakah anda yakin ingin menghapus data ini ??')){location.href='<?= base_url() . '/user/ropk/ropk_fisik/fisik_hapus/' . $ros['id_ropk_fisik']; ?>'}" href="#">
										<i class="nav-icon fas fa-trash-alt"></i>
									</a>
								<?php } else { ?>
									<a class="btn btn-danger btn-circle btn-xs">
										<i class="nav-icon fas fa-lock"></i>
									</a>
								<?php } ?>
							</td>
						</tr>
					<?php endforeach; ?>
				<?php endforeach; ?>
				<tr style="background-color:beige;">
					<td colspan="3"><b>Acuan Perbulan</b></td>
					<td class="text-right" style="<?= !empty($acu) ? (array_sum($acu) < '100' ? 'background: #ffc107;' : (array_sum($acu) == '100' ? 'background: #20c997;' : 'background: #e74c3c;')) : ''; ?>">
						<?= !empty($acu) ? array_sum($acu) : '0.00'; ?>
					</td>
					<td class="text-right"><?= !empty($num1) ? array_sum($num1) : '0.00'; ?></td>
					<td class="text-right"><?= !empty($num2) ? array_sum($num2) : '0.00'; ?></td>
					<td class="text-right"><?= !empty($num3) ? array_sum($num3) : '0.00'; ?></td>
					<td class="text-right"><?= !empty($num4) ? array_sum($num4) : '0.00'; ?></td>
					<td class="text-right"><?= !empty($num5) ? array_sum($num5) : '0.00'; ?></td>
					<td class="text-right"><?= !empty($num6) ? array_sum($num6) : '0.00'; ?></td>
					<td class="text-right"><?= !empty($num7) ? array_sum($num7) : '0.00'; ?></td>
					<td class="text-right"><?= !empty($num8) ? array_sum($num8) : '0.00'; ?></td>
					<td class="text-right"><?= !empty($num9) ? array_sum($num9) : '0.00'; ?></td>
					<td class="text-right"><?= !empty($num10) ? array_sum($num10) : '0.00'; ?></td>
					<td class="text-right"><?= !empty($num11) ? array_sum($num11) : '0.00'; ?></td>
					<td class="text-right"><?= !empty($num12) ? array_sum($num12) : '0.00'; ?></td>
					<td></td>
				</tr>

				<?php
				$bb1 = !empty($num1) ? array_sum($num1) : '0';
				$bb2 = (!empty($num1) ? array_sum($num1) : '0') + (!empty($num2) ? array_sum($num2) : '0');
				$bb3 = (!empty($num1) ? array_sum($num1) : '0') + (!empty($num2) ? array_sum($num2) : '0') + (!empty($num3) ? array_sum($num3) : '0');
				$bb4 = (!empty($num1) ? array_sum($num1) : '0') + (!empty($num2) ? array_sum($num2) : '0') + (!empty($num3) ? array_sum($num3) : '0') + (!empty($num4) ? array_sum($num4) : '0');
				$bb5 = (!empty($num1) ? array_sum($num1) : '0') + (!empty($num2) ? array_sum($num2) : '0') + (!empty($num3) ? array_sum($num3) : '0') + (!empty($num4) ? array_sum($num4) : '0') + (!empty($num5) ? array_sum($num5) : '0');
				$bb6 = (!empty($num1) ? array_sum($num1) : '0') + (!empty($num2) ? array_sum($num2) : '0') + (!empty($num3) ? array_sum($num3) : '0') + (!empty($num4) ? array_sum($num4) : '0') + (!empty($num5) ? array_sum($num5) : '0') + (!empty($num6) ? array_sum($num6) : '0');
				$bb7 = (!empty($num1) ? array_sum($num1) : '0') + (!empty($num2) ? array_sum($num2) : '0') + (!empty($num3) ? array_sum($num3) : '0') + (!empty($num4) ? array_sum($num4) : '0') + (!empty($num5) ? array_sum($num5) : '0') + (!empty($num6) ? array_sum($num6) : '0') + (!empty($num7) ? array_sum($num7) : '0');
				$bb8 = (!empty($num1) ? array_sum($num1) : '0') + (!empty($num2) ? array_sum($num2) : '0') + (!empty($num3) ? array_sum($num3) : '0') + (!empty($num4) ? array_sum($num4) : '0') + (!empty($num5) ? array_sum($num5) : '0') + (!empty($num6) ? array_sum($num6) : '0') + (!empty($num7) ? array_sum($num7) : '0') + (!empty($num8) ? array_sum($num8) : '0');
				$bb9 = (!empty($num1) ? array_sum($num1) : '0') + (!empty($num2) ? array_sum($num2) : '0') + (!empty($num3) ? array_sum($num3) : '0') + (!empty($num4) ? array_sum($num4) : '0') + (!empty($num5) ? array_sum($num5) : '0') + (!empty($num6) ? array_sum($num6) : '0') + (!empty($num7) ? array_sum($num7) : '0') + (!empty($num8) ? array_sum($num8) : '0') + (!empty($num9) ? array_sum($num9) : '0');
				$bb10 = (!empty($num1) ? array_sum($num1) : '0') + (!empty($num2) ? array_sum($num2) : '0') + (!empty($num3) ? array_sum($num3) : '0') + (!empty($num4) ? array_sum($num4) : '0') + (!empty($num5) ? array_sum($num5) : '0') + (!empty($num6) ? array_sum($num6) : '0') + (!empty($num7) ? array_sum($num7) : '0') + (!empty($num8) ? array_sum($num8) : '0') + (!empty($num9) ? array_sum($num9) : '0') + (!empty($num10) ? array_sum($num10) : '0');
				$bb11 = (!empty($num1) ? array_sum($num1) : '0') + (!empty($num2) ? array_sum($num2) : '0') + (!empty($num3) ? array_sum($num3) : '0') + (!empty($num4) ? array_sum($num4) : '0') + (!empty($num5) ? array_sum($num5) : '0') + (!empty($num6) ? array_sum($num6) : '0') + (!empty($num7) ? array_sum($num7) : '0') + (!empty($num8) ? array_sum($num8) : '0') + (!empty($num9) ? array_sum($num9) : '0') + (!empty($num10) ? array_sum($num10) : '0') + (!empty($num11) ? array_sum($num11) : '0');
				$bb12 = (!empty($num1) ? array_sum($num1) : '0') + (!empty($num2) ? array_sum($num2) : '0') + (!empty($num3) ? array_sum($num3) : '0') + (!empty($num4) ? array_sum($num4) : '0') + (!empty($num5) ? array_sum($num5) : '0') + (!empty($num6) ? array_sum($num6) : '0') + (!empty($num7) ? array_sum($num7) : '0') + (!empty($num8) ? array_sum($num8) : '0') + (!empty($num9) ? array_sum($num9) : '0') + (!empty($num10) ? array_sum($num10) : '0') + (!empty($num11) ? array_sum($num11) : '0') + (!empty($num12) ? array_sum($num12) : '0');
				?>
				<tr style="background-color:beige;">
					<td colspan="4"><b>Kumulatif per Bulan</b></td>
					<!--<td class="text-right"></td>-->
					<td class="text-right"><?= $bb1; ?></td>
					<td class="text-right"><?= $bb2; ?></td>
					<td class="text-right"><?= $bb3; ?></td>
					<td class="text-right"><?= $bb4; ?></td>
					<td class="text-right"><?= $bb5; ?></td>
					<td class="text-right"><?= $bb6; ?></td>
					<td class="text-right"><?= $bb7; ?></td>
					<td class="text-right"><?= $bb8; ?></td>
					<td class="text-right"><?= $bb9; ?></td>
					<td class="text-right"><?= $bb10; ?></td>
					<td class="text-right"><?= $bb11; ?></td>
					<td class="text-right" style="<?= !empty($acu) ? ($bb12 < array_sum($acu) ? 'background: #ffc107;' : ($bb12 == array_sum($acu) ? 'background: #20c997;' : 'background: #e74c3c;')) : ''; ?>">
						<?= $bb12; ?>
					</td>
					<td></td>
				</tr>
			</tbody>
		</table>
	</div>
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
			"paging": true,
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