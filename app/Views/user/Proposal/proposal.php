<?= $this->extend('_layout/template'); ?>

<?= $this->section('stylesheet'); ?>
<link rel="stylesheet" href="<?= base_url('/toping/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') ?>">
<link rel="stylesheet" href="<?= base_url('/toping/plugins/datatables-rowgroup/css/rowGroup.bootstrap4.min.js') ?>">
<?= $this->endSection(); ?>

<?= $this->section('tombol'); ?>
<div style="width:90px;">
	<a href="<?= base_url('/user/proposal/pengajuan/proposal_add'); ?>">
		<li class="btn btn-block btn-warning btn-sm" active><i class="nav-icon fa fa-plus"></i> Add</li>
	</a>
</div>
<?= $this->endSection(); ?>

<?= $this->section('content'); ?>
<div class="card-body">
	<table id="example1" class="table table-bordered display nowrap table-sm" cellspacing="0">
		<thead>
			<tr>
				<th class="text-center align-middle" width="30px">No</th>
				<th class="align-middle">Usulan Kagiatan</th>
				<th class="align-middle">
					<div style="width: 350px;">Judul Kegiatan</div>
				</th>
				<th class="align-middle">
					<div style="width: 300px;">Permasalahan</div>
				</th>
				<th class="text-center align-middle">Usulan Anggaran</th>
				<th class="text-center align-middle">Titik Lokasi</th>
				<th class="text-center align-middle">
					<div style="width: 350px;">Alamat</div>
				</th>
				<th class="text-center align-middle">
					<div sytle="width: 80px;">Dokumen</div>
				</th>
				<th class="text-center align-middle">
					<div style="width:100px;">Aksi</div>
				</th>
			</tr>
		</thead>
		<!-- <tfoot>
			<tr>
				<th style="text-align: center;" width="30px">No</th>
				<th>Usulan Kagiatan</th>
				<th>Judul Kegiatan</th>
				<th>Permasalahan</th>
				<th>Usulan Anggaran</th>
				<th>Titik Lokasi</th>
				<th>Alamat</th>
				<th>Dokumen</th>
				<th style="width: 60px; text-align:center;">Aksi</th>
			</tr>
		</tfoot> -->
		<tbody>
			<?php $nomor = 1;
			foreach ($proposal as $row) : ?>
				<tr>
					<td class="text-center"><?= $nomor++; ?></td>
					<td class=""><?= $row['usulan_kegiatan_id']; ?></td>
					<td class="text-wrap"><?= $row['judul_kegiatan']; ?></td>
					<td class="text-wrap"><?= $row['permasalahan']; ?></td>
					<td class=""><?= $row['usulan_anggaran']; ?></td>
					<td class=""><?= str_replace(['[', ']', 'LatLng', '(', ')'], '', $row['titik_lokasi']); ?></td>
					<td class="text-wrap"><?= $row['alamat']; ?></td>
					<td class="text-center"><a href="<?= base_url('/user/proposal/pengajuan/show/' . kunci($row['id_proposal'])); ?>" target="_blank"><i class="fa fa-paperclip" aria-hidden="true" title="<?= $row['dokumen']; ?>"></i></a><?= ' ' . $row['size'] . ' Mb'; ?></td>
					<td class="text-center align-baseline">
						<div class="justify-content-center">
							<?php $jawab = $db->table('tb_proposal_verifikasi')
								->join('auth_groups', 'tb_proposal_verifikasi.opd_id = auth_groups.id', 'left')
								->getWhere(['proposal_id' => $row['id_proposal']])->getRow();
							if (isset($jawab)) : ?>
								<?php if ($jawab->verifikasi == 'lolos') : ?>
									<a class="dropdown-toggle btn btn-success btn-circle btn-xs" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="width: 152px;">
										<i class="nav-icon fa fa-thumbs-up"></i> Lolos Verifikasi
									</a>
									<div class="dropdown-menu dropdown-menu-right" style="width: 600px;" aria-labelledby="navbarDropdown">
										<a class="dropdown-item" href="#">
											<div class="media">
												<div class="media-body">
													<h3 class="dropdown-item-title">
														Verifikator:
													</h3>
													<p class="text-sm"><?= $jawab->nm_verifikator; ?></p>
												</div>
											</div>
										</a>
									</div>
								<?php elseif ($jawab->verifikasi == 'memenuhi_syarat') : ?>
									<a class="dropdown-toggle btn btn-info btn-circle btn-xs" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="width:152px;">
										<i class="nav-icon fa fa-paper-check"></i> Memenuhi Syarat
									</a>
									<div class="dropdown-menu dropdown-menu-right" style="width: 600px;" aria-labelledby="navbarDropdown">
										<div class="dropdown-item">
											<div class="media">
												<div class="media-body">
													<a class="btn btn-info btn-circle btn-md" href="<?= base_url('/user/proposal/pengajuan/proposal_lembar_verifikasi/' . $row['id_proposal']); ?>" style="width: -webkit-fill-available;">
														<i class="nav-icon fas fa-file"></i> Lembar Verifikasi
													</a>
												</div>
											</div>
										</div>
										<a class="dropdown-item" href="#">
											<div class="media">
												<div class="media-body">
													<h3 class="dropdown-item-title">
														Keterangan:
													</h3>
													<p class="text-sm" style="white-space: pre-wrap;">Proposal telah di Verifikasi olah bappeda bidang PPEPD dan akan di teruskan ke tahap selanjutnya</p>
													<h3 class="dropdown-item-title">
														Verifikator:
													</h3>
													<p class="text-sm"><?= $jawab->nm_verifikator; ?></p>
												</div>
											</div>
										</a>
									</div>
								<?php elseif ($jawab->verifikasi == 'dikembalikan') : ?>
									<a class="dropdown-toggle btn btn-danger btn-circle btn-xs" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="width:152px;">
										<i class="nav-icon fa fa-undo"></i> Dikembalikan
									</a>
									<div class="dropdown-menu dropdown-menu-right" style="width: 600px;" aria-labelledby="navbarDropdown">
										<a class="dropdown-item" href="#">
											<div class="media">
												<div class="media-body">
													<h3 class="dropdown-item-title">
														Keterangan:
													</h3>
													<p class="text-sm" style="white-space: pre-wrap;"><?= $jawab->verifikasi_keterangan; ?></p>
													<h3 class="dropdown-item-title">
														Verifikator:
													</h3>
													<p class="text-sm"><?= $jawab->nm_verifikator; ?></p>
												</div>
											</div>
										</a>
									</div>
								<?php elseif ($jawab->verifikasi == 'diajukan') : ?>
									<a class="dropdown-toggle btn btn-warning btn-circle btn-xs" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="width: 152px;">
										Menunggu Verifikasi
									</a>
								<?php endif; ?>
							<?php else : ?>
								<!-- ------------------------------------------------------------------------------------ -->
								<a class="btn btn-success btn-circle btn-xs" onclick="if(confirm('Ajukan Verifikasi ??')){location.href='<?= base_url() . '/user/proposal/pengajuan/ajukan_proposal/' . $row['id_proposal']; ?>'}">
									Ajukan Verifikasi
								</a>
								<a class="btn btn-info btn-circle btn-xs" href="<?= base_url('/user/proposal/pengajuan/proposal_edit/' . $row['id_proposal']); ?>">
									<i class="nav-icon fas fa-pen-alt"></i>
								</a>
								<a class="btn btn-danger btn-circle btn-xs" onclick="if(confirm('Apakah anda yakin ingin menghapus data ini ??')){location.href='<?= base_url('/user/proposal/pengajuan/proposal_hapus/' . $row['id_proposal']); ?>'}" href="#">
									<i class="nav-icon fas fa-trash-alt"></i>
								</a>
								<!-- ------------------------------------------------------------------------------------ -->
							<?php endif; ?>
						</div>
					</td>
					<!-- ---------------------------------------------------------------------------------------------------------------------- -->
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
			"scrollY": '55vh',
			// "scrollCollapse": true,
			"paging": false,
			"responsive": false,
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