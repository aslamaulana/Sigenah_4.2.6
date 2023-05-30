<table id="example1" class="table table-bordered">
	<?php
	$user = user()->opd_id;
	?>
	<thead>
		<tr>
			<th rowspan="3">Kode</th><!-- A -->
			<th rowspan="3" colspan="4">SKPD/Urusan/Bidang Urusan Pemerintahan Daerah dan Program/Kegiatan/Sub Kegiatan</th><!-- B -->
			<!-- <th rowspan="3">Program</th> --><!-- C -->
			<!-- <th rowspan="3">Kegiatan</th> --><!-- D -->
			<!-- <th rowspan="3">Sub Kegiatan</th> --><!-- E -->
			<th rowspan="2" colspan="2">Indikator Kinerja Program (Outcome)/Kegiatan/Sub Kegiatan (output)</th><!-- F -->
			<th rowspan="2" colspan="2">Target Renstra PD Tahun 2021-2026</th><!-- H T_2021_2026-->
			<th rowspan="2" colspan="2">Realisasi capaian Kinerja Renstra Tahun 2021 (n-2)</th><!-- J C_2021_2026-->
			<th rowspan="2" colspan="2">Target Kinerja dan Anggaran Renja PD Tahun 2022 (Tahun berjalan) yang dievaluasi </th><!-- L TK_2021_2026-->
			<th colspan="8">Realisasi Kinerja Pada Triwulan</th><!-- N TW_1-->
			<th rowspan="2" colspan="2">Realisasi Capaian Kinerja dan Anggaran Renja yang dievaluasi tahun 2022</th><!-- N TW_1-->
			<th rowspan="2" colspan="2">Tingkat Capaian Kinerja dan Realisasi Anggaran Renja (%)</th><!-- N TW_1-->
			<th rowspan="2" colspan="2">Realisasi Kinerja dan Anggaran Renstra s/d Tahun 2022 (Akhir Tahun Pelaksanaan Renja)</th><!-- N TW_1-->
			<th rowspan="2" colspan="2">Tingkat Capaian Kinerja dan Realisasi Anggaran Renstra s/d tahun 2022 (%)</th><!-- N TW_1-->
			<th rowspan="3">SKPD Penanggungjawab</th><!-- N TW_1-->
			<th rowspan="3">Ket.</th><!-- N TW_1-->
		</tr>
		<tr>
			<th colspan="2">I</th><!-- N TW_1-->
			<th colspan="2">II</th><!-- P TW_2-->
			<th colspan="2">III</th><!-- R TW_3-->
			<th colspan="2">IV</th><!-- T TW_4-->
		</tr>
		<tr>
			<th>Indikator Kinerja</th><!-- F -->
			<th>Satuan</th><!-- G -->
			<th>Kinerja</th><!-- H T_2021_2026-->
			<th>rp</th><!-- I T_2021_2026-->
			<th>Kinerja</th><!-- J C_2021_2026-->
			<th>rp</th><!-- K C_2021_2026-->
			<th>Kinerja</th><!-- L TK_2021_2026-->
			<th>rp</th><!-- M TK_2021_2026-->
			<th>Kinerja</th><!-- N TW_1-->
			<th>rp</th><!-- O TW_1-->
			<th>Kinerja</th><!-- P TW_2-->
			<th>rp</th><!-- Q TW_2-->
			<th>Kinerja</th><!-- R TW_3-->
			<th>rp</th><!-- S TW_3-->
			<th>Kinerja</th><!-- T TW_4-->
			<th>rp</th><!-- U TW_4-->

			<th>Kinerja</th><!-- V TW_4-->
			<th>rp</th><!-- W TW_4-->
			<th>Kinerja</th><!-- X TW_4-->
			<th>%</th><!-- Y TW_4-->
			<th>Kinerja</th><!-- Z TW_4-->
			<th>rp</th><!-- AA TW_4-->
			<th>Kinerja</th><!-- AB TW_4-->
			<th>%</th><!-- AC TW_4-->
		</tr>
		<tr>
			<th>2</th><!-- A -->
			<th colspan="4">3</th><!-- B -->
			<!-- <th></th> --><!-- C -->
			<!-- <th></th> --><!-- D -->
			<!-- <th></th> --><!-- E -->
			<th colspan="2">4</th><!-- F -->
			<!-- <th></th> --><!-- G -->
			<th colspan="2">5</th><!-- H T_2021_2026-->
			<!-- <th></th> --><!-- I T_2021_2026-->
			<th colspan="2">6</th><!-- J C_2021_2026-->
			<!-- <th></th> --><!-- K C_2021_2026-->
			<th colspan="2">7</th><!-- L TK_2021_2026-->
			<!-- <th></th> --><!-- M TK_2021_2026-->
			<th colspan="2">8</th><!-- N TW_1-->
			<!-- <th></th> --><!-- O TW_1-->
			<th colspan="2">9</th><!-- P TW_2-->
			<!-- <th></th> --><!-- Q TW_2-->
			<th colspan="2">10</th><!-- R TW_3-->
			<!-- <th></th> --><!-- S TW_3-->
			<th colspan="2">11</th><!-- T TW_4-->
			<!-- <th></th> --><!-- U TW_4-->
			<th colspan="2">12 = 8+9+10+11 </th><!-- V TW_4-->
			<!-- <th>rp</th> --><!-- W TW_4-->
			<th colspan="2">13 = 12/7*100</th><!-- X TW_4-->
			<!-- <th>%</th> --><!-- Y TW_4-->
			<th colspan="2">14 = 6+12</th><!-- Z TW_4-->
			<!-- <th>rp</th> --><!-- AA TW_4-->
			<th colspan="2">15 = 14/5*100</th><!-- AB TW_4-->
			<th>16</th><!-- AC TW_4-->
			<th>17</th><!-- AC TW_4-->
		</tr>
	</thead>
	<tbody>
		<?php
		$urusan = $db->table('tb_renstra_program')
			->select('tb_renstra_program.opd_id, set_bidang_90.bidang')
			->distinct('tb_renstra_program.opd_id, set_bidang_90.bidang')
			->join('set_program_90', 'tb_renstra_program.opd_program_n = set_program_90.program', 'Left')
			->join('set_bidang_90', 'set_program_90.bidang_id = set_bidang_90.id_bidang', 'Left')
			->getWhere(['tb_renstra_program.opd_id' => user()->opd_id, 'tb_renstra_program.perubahan' => 'Perubahan'])->getResultArray();
		foreach ($urusan as $urusan_f) {
		?>
			<tr>
				<th></th><!-- A -->
				<th colspan="4"><?= $urusan_f['bidang']; ?></th><!-- B -->
				<!-- <th></th> --><!-- C -->
				<!-- <th></th> --><!-- D -->
				<!-- <th></th> --><!-- E -->
				<th></th><!-- F -->
				<th></th><!-- G -->
				<th></th><!-- H T_2021_2026-->
				<th></th><!-- I T_2021_2026-->
				<th></th><!-- J C_2021_2026-->
				<th></th><!-- K C_2021_2026-->
				<th></th><!-- L TK_2021_2026-->
				<th></th><!-- M TK_2021_2026-->
				<th></th><!-- N TW_1-->
				<th></th><!-- O TW_1-->
				<th></th><!-- P TW_2-->
				<th></th><!-- Q TW_2-->
				<th></th><!-- R TW_3-->
				<th></th><!-- S TW_3-->
				<th></th><!-- T TW_4-->
				<th></th><!-- U TW_4-->
				<th></th><!-- V TW_4-->
				<th></th><!-- W TW_4-->
				<th></th><!-- X TW_4-->
				<th></th><!-- Y TW_4-->
				<th></th><!-- Z TW_4-->
				<th></th><!-- AA TW_4-->
				<th></th><!-- AB TW_4-->
				<th></th><!-- AC TW_4-->
			</tr>
			<?php
			$program = $db->table('tb_renstra_program')
				->select('tb_renstra_program.opd_program_n, set_program_90.id_program')
				->distinct('tb_renstra_program.opd_program_n, set_program_90.id_program')
				->orderBy('id_program', 'ASC')
				->join('set_program_90', 'tb_renstra_program.opd_program_n = set_program_90.program', 'Left')
				->join('set_bidang_90', 'set_program_90.bidang_id = set_bidang_90.id_bidang', 'Left')
				->getWhere(['tb_renstra_program.opd_id' => user()->opd_id, 'tb_renstra_program.perubahan' => 'Perubahan', 'set_bidang_90.bidang' => $urusan_f['bidang']])->getResultArray();
			foreach ($program as $program_f) {
			?>
				<tr>
					<th><?= $program_f['id_program']; ?></th><!-- A -->
					<th></th><!-- B -->
					<th colspan="3"><?= $program_f['opd_program_n']; ?></th><!-- C -->
					<!-- <th></th> --><!-- D -->
					<!-- <th></th> --><!-- E -->
					<th></th><!-- F -->
					<th></th><!-- G -->
					<th></th><!-- H T_2021_2026-->
					<th></th><!-- I T_2021_2026-->
					<th></th><!-- J C_2021_2026-->
					<th></th><!-- K C_2021_2026-->
					<th></th><!-- L TK_2021_2026-->
					<th></th><!-- M TK_2021_2026-->
					<th></th><!-- N TW_1-->
					<th></th><!-- O TW_1-->
					<th></th><!-- P TW_2-->
					<th></th><!-- Q TW_2-->
					<th></th><!-- R TW_3-->
					<th></th><!-- S TW_3-->
					<th></th><!-- T TW_4-->
					<th></th><!-- U TW_4-->
					<th></th><!-- V TW_4-->
					<th></th><!-- W TW_4-->
					<th></th><!-- X TW_4-->
					<th></th><!-- Y TW_4-->
					<th></th><!-- Z TW_4-->
					<th></th><!-- AA TW_4-->
					<th></th><!-- AB TW_4-->
					<th></th><!-- AC TW_4-->
				</tr>
				<?php
				$program_indikator = $db->table('tb_renstra_program')
					->select('tb_renstra_program.opd_indikator_program, tb_renstra_program.satuan, tb_renstra_program.t_2026')
					->getWhere(['tb_renstra_program.opd_id' => user()->opd_id, 'tb_renstra_program.perubahan' => 'Perubahan', 'tb_renstra_program.opd_program_n' => $program_f['opd_program_n']])->getResultArray();
				foreach ($program_indikator as $program_indikator_f) {

					$program_indikator_renja = $db->table('tb_rkpd_program')
						->select('tb_rkpd_program.t_tahun')
						->getWhere([
							'tb_rkpd_program.opd_id' => user()->opd_id,
							'tb_rkpd_program.perubahan' => $_SESSION['perubahan'],
							'tb_rkpd_program.tahun' => $_SESSION['tahun'],
							'tb_rkpd_program.rkpd_program_n' => $program_f['opd_program_n'],
							'tb_rkpd_program.rkpd_indikator_program' => $program_indikator_f['opd_indikator_program']
						])->getRow();
				?>
					<tr>
						<th></th><!-- A -->
						<th></th><!-- B -->
						<th></th><!-- C -->
						<th></th><!-- D -->
						<th></th><!-- E -->
						<th><?= $program_indikator_f['opd_indikator_program']; ?></th><!-- F -->
						<th><?= $program_indikator_f['satuan']; ?></th><!-- G -->
						<th><?= $program_indikator_f['t_2026']; ?></th><!-- H T_2021_2026-->
						<th></th><!-- I T_2021_2026-->
						<th></th><!-- J C_2021_2026-->
						<th></th><!-- K C_2021_2026-->
						<th><?= isset($program_indikator_renja->t_tahun) ? $program_indikator_renja->t_tahun : ''; ?></th><!-- L TK_2021_2026-->
						<th></th><!-- M TK_2021_2026-->
						<th></th><!-- N TW_1-->
						<th></th><!-- O TW_1-->
						<th></th><!-- P TW_2-->
						<th></th><!-- Q TW_2-->
						<th></th><!-- R TW_3-->
						<th></th><!-- S TW_3-->
						<th></th><!-- T TW_4-->
						<th></th><!-- U TW_4-->
						<th></th><!-- V TW_4-->
						<th></th><!-- W TW_4-->
						<th></th><!-- X TW_4-->
						<th></th><!-- Y TW_4-->
						<th></th><!-- Z TW_4-->
						<th></th><!-- AA TW_4-->
						<th></th><!-- AB TW_4-->
						<th></th><!-- AC TW_4-->
					</tr>
				<?php } ?> <!-- Program_indikator -->
				<?php
				$kegiatan = $db->table('tb_renstra_kegiatan')
					->select('tb_renstra_kegiatan.opd_kegiatan_n, set_kegiatan_90.id_kegiatan')
					->distinct('tb_renstra_kegiatan.opd_kegiatan_n, set_kegiatan_90.id_kegiatan')
					->orderBy('id_kegiatan', 'ASC')
					->join('set_kegiatan_90', 'tb_renstra_kegiatan.opd_kegiatan_n = set_kegiatan_90.kegiatan', 'left')
					->getWhere(['tb_renstra_kegiatan.opd_id' => user()->opd_id, 'tb_renstra_kegiatan.perubahan' => 'Perubahan', 'tb_renstra_kegiatan.opd_program_n' => $program_f['opd_program_n']])->getResultArray();
				foreach ($kegiatan as $kegiatan_f) {
				?>
					<tr>
						<th><?= $kegiatan_f['id_kegiatan']; ?></th><!-- A -->
						<th></th><!-- B -->
						<th></th><!-- C -->
						<th colspan="2"><?= $kegiatan_f['opd_kegiatan_n']; ?></th><!-- D -->
						<!-- <th></th> --><!-- E -->
						<th></th><!-- F -->
						<th></th><!-- G -->
						<th></th><!-- H T_2021_2026-->
						<th></th><!-- I T_2021_2026-->
						<th></th><!-- J C_2021_2026-->
						<th></th><!-- K C_2021_2026-->
						<th></th><!-- L TK_2021_2026-->
						<th></th><!-- M TK_2021_2026-->
						<th></th><!-- N TW_1-->
						<th></th><!-- O TW_1-->
						<th></th><!-- P TW_2-->
						<th></th><!-- Q TW_2-->
						<th></th><!-- R TW_3-->
						<th></th><!-- S TW_3-->
						<th></th><!-- T TW_4-->
						<th></th><!-- U TW_4-->
						<th></th><!-- V TW_4-->
						<th></th><!-- W TW_4-->
						<th></th><!-- X TW_4-->
						<th></th><!-- Y TW_4-->
						<th></th><!-- Z TW_4-->
						<th></th><!-- AA TW_4-->
						<th></th><!-- AB TW_4-->
						<th></th><!-- AC TW_4-->
					</tr>
					<?php
					$kegiatan_indikator = $db->table('tb_renstra_kegiatan')
						->select('tb_renstra_kegiatan.opd_indikator_kegiatan, tb_renstra_kegiatan.satuan, tb_renstra_kegiatan.t_2026')
						->getWhere(['tb_renstra_kegiatan.opd_id' => user()->opd_id, 'tb_renstra_kegiatan.perubahan' => 'Perubahan', 'tb_renstra_kegiatan.opd_kegiatan_n' => $kegiatan_f['opd_kegiatan_n']])->getResultArray();
					foreach ($kegiatan_indikator as $kegiatan_indikator_f) {

						$kegiatan_indikator_renja = $db->table('tb_rkpd_kegiatan')
							->select('tb_rkpd_kegiatan.t_tahun')
							->getWhere([
								'tb_rkpd_kegiatan.opd_id' => user()->opd_id,
								'tb_rkpd_kegiatan.perubahan' => $_SESSION['perubahan'],
								'tb_rkpd_kegiatan.tahun' => $_SESSION['tahun'],
								'tb_rkpd_kegiatan.rkpd_kegiatan_n' => $kegiatan_f['opd_kegiatan_n'],
								'tb_rkpd_kegiatan.rkpd_indikator_kegiatan' => $kegiatan_indikator_f['opd_indikator_kegiatan']
							])->getRow();

						// dd($kegiatan_indikator_renja);
					?>
						<tr>
							<th></th><!-- A -->
							<th></th><!-- B -->
							<th></th><!-- C -->
							<th></th><!-- D -->
							<th></th><!-- E -->
							<th><?= $kegiatan_indikator_f['opd_indikator_kegiatan']; ?></th><!-- F -->
							<th><?= $kegiatan_indikator_f['satuan']; ?></th><!-- G -->
							<th><?= $kegiatan_indikator_f['t_2026']; ?></th><!-- H T_2021_2026-->
							<th></th><!-- I T_2021_2026-->
							<th></th><!-- J C_2021_2026-->
							<th></th><!-- K C_2021_2026-->
							<th><?= isset($kegiatan_indikator_renja->t_tahun) ? $kegiatan_indikator_renja->t_tahun : ''; ?></th><!-- L TK_2021_2026-->
							<th></th><!-- M TK_2021_2026-->
							<th></th><!-- N TW_1-->
							<th></th><!-- O TW_1-->
							<th></th><!-- P TW_2-->
							<th></th><!-- Q TW_2-->
							<th></th><!-- R TW_3-->
							<th></th><!-- S TW_3-->
							<th></th><!-- T TW_4-->
							<th></th><!-- U TW_4-->
							<th></th><!-- V TW_4-->
							<th></th><!-- W TW_4-->
							<th></th><!-- X TW_4-->
							<th></th><!-- Y TW_4-->
							<th></th><!-- Z TW_4-->
							<th></th><!-- AA TW_4-->
							<th></th><!-- AB TW_4-->
							<th></th><!-- AC TW_4-->
						</tr>
					<?php } ?> <!-- Kegiatan_indikator -->
					<?php
					$kegiatan_sub = $db->table('tb_renstra_kegiatan_sub')
						->select('tb_renstra_kegiatan_sub.opd_kegiatan_sub_n, set_sub_kegiatan_90.id_sub_kegiatan')
						->distinct('tb_renstra_kegiatan_sub.opd_kegiatan_sub_n, set_sub_kegiatan_90.id_sub_kegiatan')
						->orderBy('id_sub_kegiatan', 'ASC')
						->join('set_sub_kegiatan_90', 'tb_renstra_kegiatan_sub.opd_kegiatan_sub_n = set_sub_kegiatan_90.sub_kegiatan', 'left')
						->join('set_kegiatan_90', 'tb_renstra_kegiatan_sub.opd_kegiatan_n = set_kegiatan_90.kegiatan AND set_sub_kegiatan_90.kegiatan_id = set_kegiatan_90.id_kegiatan', 'left')

						->getWhere(['tb_renstra_kegiatan_sub.opd_id' => user()->opd_id, 'tb_renstra_kegiatan_sub.perubahan' => 'Perubahan', 'tb_renstra_kegiatan_sub.opd_kegiatan_n' => $kegiatan_f['opd_kegiatan_n']])->getResultArray();
					foreach ($kegiatan_sub as $kegiatan_sub_f) {
					?>
						<tr>
							<th><?= $kegiatan_sub_f['id_sub_kegiatan']; ?></th><!-- A -->
							<th></th><!-- B -->
							<th></th><!-- C -->
							<th></th><!-- D -->
							<th><?= $kegiatan_sub_f['opd_kegiatan_sub_n']; ?></th><!-- E -->
							<th></th><!-- F -->
							<th></th><!-- G -->
							<th></th><!-- H T_2021_2026-->
							<th></th><!-- I T_2021_2026-->
							<th></th><!-- J C_2021_2026-->
							<th></th><!-- K C_2021_2026-->
							<th></th><!-- L TK_2021_2026-->
							<th></th><!-- M TK_2021_2026-->
							<th></th><!-- N TW_1-->
							<th></th><!-- O TW_1-->
							<th></th><!-- P TW_2-->
							<th></th><!-- Q TW_2-->
							<th></th><!-- R TW_3-->
							<th></th><!-- S TW_3-->
							<th></th><!-- T TW_4-->
							<th></th><!-- U TW_4-->
							<th></th><!-- V TW_4-->
							<th></th><!-- W TW_4-->
							<th></th><!-- X TW_4-->
							<th></th><!-- Y TW_4-->
							<th></th><!-- Z TW_4-->
							<th></th><!-- AA TW_4-->
							<th></th><!-- AB TW_4-->
							<th></th><!-- AC TW_4-->
						</tr>
						<?php
						$kegiatan_sub_indikator = $db->table('tb_renstra_kegiatan_sub')
							->select('opd_indikator_kegiatan_sub, satuan, tag, (rp_2021 + rp_2022 + rp_2023 + rp_2024 + rp_2025 + rp_2026) as total')
							->getWhere(['tb_renstra_kegiatan_sub.opd_id' => user()->opd_id, 'tb_renstra_kegiatan_sub.perubahan' => 'Perubahan', 'tb_renstra_kegiatan_sub.opd_kegiatan_sub_n' => $kegiatan_sub_f['opd_kegiatan_sub_n']])->getResultArray();
						foreach ($kegiatan_sub_indikator as $kegiatan_sub_indikator_f) {

							if ($kegiatan_sub_indikator_f['tag'] == 'Akumulasi') {
								$total_target = $db->table('tb_renstra_kegiatan_sub')->select('(t_2021 + t_2022 + t_2023 + t_2024 + t_2025 + t_2026) as total_target')->getWhere(['tb_renstra_kegiatan_sub.opd_id' => user()->opd_id,	'tb_renstra_kegiatan_sub.perubahan' => 'Perubahan',	'tb_renstra_kegiatan_sub.opd_kegiatan_sub_n' => $kegiatan_sub_f['opd_kegiatan_sub_n']])->getRow();
							} elseif ($kegiatan_sub_indikator_f['tag'] == 'Absolut') {
								$total_target = $db->table('tb_renstra_kegiatan_sub')->select('t_2026 as total_target')->getWhere(['tb_renstra_kegiatan_sub.opd_id' => user()->opd_id,	'tb_renstra_kegiatan_sub.perubahan' => 'Perubahan',	'tb_renstra_kegiatan_sub.opd_kegiatan_sub_n' => $kegiatan_sub_f['opd_kegiatan_sub_n']])->getRow();
							}

							$kegiatan_sub_indikator_renja = $db->table('tb_rkpd_kegiatan_sub')
								->select('tb_rkpd_kegiatan_sub.t_tahun, tb_rkpd_kegiatan_sub.rp_tahun')
								->getWhere([
									'tb_rkpd_kegiatan_sub.opd_id' => user()->opd_id,
									'tb_rkpd_kegiatan_sub.perubahan' => $_SESSION['perubahan'],
									'tb_rkpd_kegiatan_sub.tahun' => $_SESSION['tahun'],
									'tb_rkpd_kegiatan_sub.rkpd_kegiatan_sub_n' => $kegiatan_sub_f['opd_kegiatan_sub_n'],
									// 'tb_rkpd_kegiatan_sub.rkpd_indikator_kegiatan_sub' => $kegiatan_sub_indikator_f['opd_indikator_kegiatan_sub']
								])->getRow();

							$simonela_progrest1 = $db->table('tb_simonela_progres')->select('(SUM(tb_simonela_progres.realisasi_keu)) AS tr_1,	(SUM(tb_simonela_progres.realisasi_fisik)) AS t_1')->where("tb_simonela_progres.opd_id = '{$user}' AND	tb_simonela_progres.tahun = '{$_SESSION['tahun']}' AND tb_simonela_progres.perubahan = '{$_SESSION['perubahan']}' AND tb_simonela_progres.kegiatan = '{$kegiatan_f['opd_kegiatan_n']}' AND tb_simonela_progres.kegiatan_sub = '{$kegiatan_sub_f['opd_kegiatan_sub_n']}' AND	(tb_simonela_progres.bulan = 'b1' OR tb_simonela_progres.bulan = 'b2' OR tb_simonela_progres.bulan = 'b3')")->get()->getRow();
							$simonela_progrest2 = $db->table('tb_simonela_progres')->select('(SUM(tb_simonela_progres.realisasi_keu)) AS tr_2, (SUM(tb_simonela_progres.realisasi_fisik)) AS t_2')->where("tb_simonela_progres.opd_id = '{$user}' AND	tb_simonela_progres.tahun = '{$_SESSION['tahun']}' AND tb_simonela_progres.perubahan = '{$_SESSION['perubahan']}' AND tb_simonela_progres.kegiatan = '{$kegiatan_f['opd_kegiatan_n']}' AND tb_simonela_progres.kegiatan_sub = '{$kegiatan_sub_f['opd_kegiatan_sub_n']}' AND	(tb_simonela_progres.bulan = 'b4' OR tb_simonela_progres.bulan = 'b5' OR tb_simonela_progres.bulan = 'b6')")->get()->getRow();
							$simonela_progrest3 = $db->table('tb_simonela_progres')->select('(SUM(tb_simonela_progres.realisasi_keu)) AS tr_3, (SUM(tb_simonela_progres.realisasi_fisik)) AS t_3')->where("tb_simonela_progres.opd_id = '{$user}' AND	tb_simonela_progres.tahun = '{$_SESSION['tahun']}' AND tb_simonela_progres.perubahan = '{$_SESSION['perubahan']}' AND tb_simonela_progres.kegiatan = '{$kegiatan_f['opd_kegiatan_n']}' AND tb_simonela_progres.kegiatan_sub = '{$kegiatan_sub_f['opd_kegiatan_sub_n']}' AND	(tb_simonela_progres.bulan = 'b7' OR tb_simonela_progres.bulan = 'b8' OR tb_simonela_progres.bulan = 'b9')")->get()->getRow();
							$simonela_progrest4 = $db->table('tb_simonela_progres')->select('(SUM(tb_simonela_progres.realisasi_keu)) AS tr_4, (SUM(tb_simonela_progres.realisasi_fisik)) AS t_4')->where("tb_simonela_progres.opd_id = '{$user}' AND	tb_simonela_progres.tahun = '{$_SESSION['tahun']}' AND tb_simonela_progres.perubahan = '{$_SESSION['perubahan']}' AND tb_simonela_progres.kegiatan = '{$kegiatan_f['opd_kegiatan_n']}' AND tb_simonela_progres.kegiatan_sub = '{$kegiatan_sub_f['opd_kegiatan_sub_n']}' AND (tb_simonela_progres.bulan = 'b10' OR tb_simonela_progres.bulan = 'b11' OR tb_simonela_progres.bulan = 'b12')")->get()->getRow();
						?>

							<tr>
								<th></th><!-- A -->
								<th></th><!-- B -->
								<th></th><!-- C -->
								<th></th><!-- D -->
								<th></th><!-- E -->
								<th><?= $kegiatan_sub_indikator_f['opd_indikator_kegiatan_sub']; ?></th><!-- F -->
								<th><?= $kegiatan_sub_indikator_f['satuan']; ?></th><!-- G -->
								<th><?= isset($total_target->total_target) ? $total_target->total_target : ''; ?></th><!-- H T_2021_2026-->
								<th><?= round($kegiatan_sub_indikator_f['total'], 0); ?></th><!-- I T_2021_2026-->
								<th></th><!-- J C_2021_2026-->
								<th></th><!-- K C_2021_2026-->
								<th><?= isset($kegiatan_sub_indikator_renja->t_tahun) ? $kegiatan_sub_indikator_renja->t_tahun : ''; ?></th><!-- L TK_2021_2026-->
								<th><?= isset($kegiatan_sub_indikator_renja->rp_tahun) ? $kegiatan_sub_indikator_renja->rp_tahun : ''; ?></th><!-- M TK_2021_2026-->
								<th><?= isset($simonela_progrest1->t_1) ? $simonela_progrest1->t_1 : ''; ?></th><!-- N TW_1-->
								<th><?= isset($simonela_progrest1->tr_1) ? $simonela_progrest1->tr_1 : ''; ?></th><!-- O TW_1-->
								<th><?= isset($simonela_progrest2->t_2) ? $simonela_progrest2->t_2 : ''; ?></th><!-- P TW_2-->
								<th><?= isset($simonela_progrest2->tr_2) ? $simonela_progrest2->tr_2 : ''; ?></th><!-- Q TW_2-->
								<th><?= isset($simonela_progrest3->t_3) ? $simonela_progrest3->t_3 : ''; ?></th><!-- R TW_3-->
								<th><?= isset($simonela_progrest3->tr_3) ? $simonela_progrest3->tr_3 : ''; ?></th><!-- S TW_3-->
								<th><?= isset($simonela_progrest4->t_4) ? $simonela_progrest4->t_4 : ''; ?></th><!-- T TW_4-->
								<th><?= isset($simonela_progrest4->tr_4) ? $simonela_progrest4->tr_4 : ''; ?></th><!-- U TW_4-->
								<th><?= $simonela_progrest1->t_1 + $simonela_progrest2->t_2 + $simonela_progrest3->t_3 + $simonela_progrest4->t_4; ?></th><!-- V TW_4  =N24+P24+R24+T24-->
								<th><?= $simonela_progrest1->tr_1 + $simonela_progrest2->tr_2 + $simonela_progrest3->tr_3 + $simonela_progrest4->tr_4; ?></th><!-- W TW_4 =SUM(O30+Q30+S30+U30)-->
								<th>
									<?php
									try {
										echo isset($kegiatan_sub_indikator_renja->t_tahun) && ($simonela_progrest1->t_1 + $simonela_progrest2->t_2 + $simonela_progrest3->t_3 + $simonela_progrest4->t_4) > 0 ? (($simonela_progrest1->t_1 + $simonela_progrest2->t_2 + $simonela_progrest3->t_3 + $simonela_progrest4->t_4) / $kegiatan_sub_indikator_renja->t_tahun) * 100 : '';
									} catch (DivisionByZeroError $e) {
										echo "";
									}
									?>
								</th><!-- X TW_4 =V30/L30*100-->
								<th>
									<?php
									try {
										echo isset($kegiatan_sub_indikator_renja->rp_tahun) && ($simonela_progrest1->tr_1 + $simonela_progrest2->tr_2 + $simonela_progrest3->tr_3 + $simonela_progrest4->tr_4) > 0 ? (($simonela_progrest1->tr_1 + $simonela_progrest2->tr_2 + $simonela_progrest3->tr_3 + $simonela_progrest4->tr_4) / $kegiatan_sub_indikator_renja->rp_tahun) * 100 : '';
									} catch (DivisionByZeroError $e) {
										echo "";
									}
									?>
								</th><!-- Y TW_4 =W30/M30*100-->
								<th></th><!-- Z TW_4 =(J36+V36)/2-->
								<th></th><!-- AA TW_4 =K36+W36-->
								<th></th><!-- AB TW_4 =Z36/H36*100-->
								<th></th><!-- AC TW_4 =AA36/I36*100-->
							</tr>
						<?php } ?> <!-- Kegiatan_sub -->
					<?php } ?> <!-- Kegiatan_sub -->
				<?php } ?> <!-- Kegiatan -->
			<?php } ?> <!-- Program -->
		<?php } ?> <!-- Urusan -->
	</tbody>
</table>
</div>