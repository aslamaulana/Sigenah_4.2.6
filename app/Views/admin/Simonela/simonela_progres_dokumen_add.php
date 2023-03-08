<?= $this->extend('_layout/template'); ?>

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
	<p>&nbsp;</p>
	<div class="row">
		<table id="example1" class="table table-bordered">
			<thead>
				<tr>
					<th>Keteranga Dokumen</th>
					<th style="width:600px;">Dokumen</th>
					<th class="text-center" width="140px">Aksi</th>
				</tr>
			</thead>
			<tbody>
				<?php $querz = $db->table('tb_simonela_progres_dokumen')
					->getWhere([
						'kegiatan' => $DT['rkpd_kegiatan_n'],
						'kegiatan_sub' => $DT['rkpd_kegiatan_sub_n'],
						'indikator_kegiatan_sub' => $DT['rkpd_indikator_kegiatan_sub'],
						'opd_id' => user()->opd_id,
						'tahun' => $_SESSION['tahun'],
						'perubahan' => $_SESSION['perubahan'],
						'bulan' => $b
					])->getResultArray();
				foreach ($querz as $rom) : ?>
					<tr>
						<td><?= $rom['keterangan']; ?></td>
						<td class="align-top">
							<a href="<?= base_url('/simonela/dokumen/' . user()->opd_id . '/' . kunci($rom['id_simonela_progres_berkas'])); ?>"> <?= substr($rom['dokumen'], 0, 50); ?> </a><?= '... (' . formatBytes2($rom['size']) . 'b)'; ?>
						</td>
						<td class="text-center align-top">
							<!-- ======================================== -->
							<button title="Copy link dokumen" class="btn btn-info btn-circle btn-xs" onclick="copyToClipboard<?= $rom['id_simonela_progres_berkas']; ?>()"><i class="nav-icon fas fa-link"></i> Copy Link</button>

							<script>
								function copyToClipboard<?= $rom['id_simonela_progres_berkas']; ?>(text) {
									var inputc<?= $rom['id_simonela_progres_berkas']; ?> = document.body.appendChild(document.createElement("input"));
									/*inputc<?= $rom['id_simonela_progres_berkas']; ?>.value = window.location.href;*/
									inputc<?= $rom['id_simonela_progres_berkas']; ?>.value = "<?= base_url('/simonela/dokumen/' . user()->opd_id . '/' . kunci($rom['id_simonela_progres_berkas'])); ?>";
									inputc<?= $rom['id_simonela_progres_berkas']; ?>.focus();
									inputc<?= $rom['id_simonela_progres_berkas']; ?>.select();
									document.execCommand('copy');
									inputc<?= $rom['id_simonela_progres_berkas']; ?>.parentNode.removeChild(inputc<?= $rom['id_simonela_progres_berkas']; ?>);
									alert("URL Copied.");
								}
							</script>
							<!-- ======================================== -->
							<a class="btn btn-danger btn-circle btn-xs" onclick="if(confirm('Apakah anda yakin ingin menghapus data ini ??')){location.href='<?= base_url() . '/user/simonela/simonela/dokumen_hapus/' . $rom['id_simonela_progres_berkas']; ?>'}" href="#">
								<i class="nav-icon fas fa-trash-alt"></i>
							</a>
						</td>
					</tr>
				<?php endforeach; ?>
			</tbody>
		</table>
	</div>
</div>
<?= $this->endSection(); ?>

<?= $this->section('Javascript'); ?>

<script>
	$(".custom-file-input").on("change", function() {
		var fileName = $(this).val().split("\\").pop();
		$(this).siblings(".custom-file-label").addClass("selected").html(fileName);
	});
	$(".file-input").on("change", function() {
		var fileName = $(this).val().split("\\").pop();
		$(this).siblings(".file-label").addClass("selected").html(fileName);
	});
</script>
<?= $this->endSection(); ?>