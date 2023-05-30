<?= $this->extend('_layout/template'); ?>

<?= $this->section('stylesheet'); ?>
<link rel="stylesheet" href="<?= base_url('/toping/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') ?>">
<link rel="stylesheet" href="<?= base_url('toping/leaflet/leaflet.css'); ?>" /> <!-- memanggil css di folder leaflet -->
<script src="<?= base_url('toping/leaflet/leaflet.js'); ?>"></script> <!-- memanggil leaflet.js di folder leaflet -->
<script src="<?= base_url('toping/leaflet/jquery-3.1.0.min.js'); ?>"></script> <!-- memanggil jquery di folder js -->
<script src="<?= base_url('toping/leaflet/leaflet-providers.js'); ?>"></script> <!-- memanggil leaflet-providers.js di folder leaflet provider -->
<link rel="stylesheet" href="<?= base_url('toping/leaflet/leaflet-search.css'); ?>" />
<link rel="stylesheet" href="<?= base_url('toping/leaflet/leaflet.defaultextent.css'); ?>" />
<script src="<?= base_url('toping/leaflet/leaflet.ajax.js'); ?>"></script>
<script src="<?= base_url('toping/leaflet/leaflet-search.js'); ?>"></script>
<script src="<?= base_url('toping/leaflet/leaflet.defaultextent.js'); ?>"></script>
<link rel="stylesheet" href="<?= base_url('toping/leaflet/leaflet.groupedlayercontrol.css'); ?>" />
<script src="<?= base_url('toping/leaflet/leaflet.groupedlayercontrol.js'); ?>"></script>
<style>
	/* ukuran peta */
	#mapid {
		height: 50%;
	}

	#map {
		height: 100%;
		/* position: inherit; */
	}

	.jumbotron {
		height: 100%;
		border-radius: 0;
	}

	body {
		background-color: #ebe7e1;
	}
</style>
<style>
	#sub {
		padding-left: 40px;
	}

	input[type=radio] {
		width: 15px;
		height: 15px;
	}
</style>
<style>
	.popup-overlay {
		display: none;
		position: fixed;
		top: 0;
		left: 0;
		width: 100%;
		height: 100%;
		background-color: rgba(0, 0, 0, 0.5);
		z-index: 9999;
	}

	.popup-content {
		position: absolute;
		top: 50%;
		left: 50%;
		transform: translate(-50%, -50%);
		background-color: #fff;
		padding: 20px;
		border-radius: 5px;
		box-shadow: 0 2px 5px rgba(0, 0, 0, 0.3);
		height: 70vh;
		width: 70vh;
	}

	.close-btn {
		position: absolute;
		top: 10px;
		right: 10px;
		font-size: 20px;
		cursor: pointer;
	}
</style>
<?= $this->endSection(); ?>

<?= $this->section('content'); ?>
<div class="card-body">
	<table id="example2" class="table table-bordered display nowrap table-sm" cellspacing="0">
		<thead>
			<tr>
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
			</tr>
		</thead>
		<tbody>
			<tr>
				<td class=""><?= $proposal['usulan_kegiatan_id']; ?></td>
				<td class="text-wrap"><?= $proposal['judul_kegiatan']; ?></td>
				<td class="text-wrap"><?= $proposal['permasalahan']; ?></td>
				<td class=""><?= $proposal['usulan_anggaran']; ?></td>
				<td class=""><?= str_replace(['[', ']', 'LatLng', '(', ')'], '', $proposal['titik_lokasi']); ?></td>
				<td class="text-wrap"><?= $proposal['alamat']; ?></td>
			</tr>
		</tbody>
	</table>
	<button type="button" class="btn btn-primary" onclick="showMap()">Survei Lokai</button>
	<!-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".bd-example-modal-xl" onclick="openPopup()">Survei Lokai</button> -->
	<br>
	<div class="row"> <!-- class row digunakan sebelum membuat column  -->
		<div class="col-7 overflow-auto" style="height: 68vh;">
			<form action="<?= base_url('/user/proposal/verifikator/proposal_varifikasi_update'); ?>" method="POST">
				<?= csrf_field() ?>
				<input type="hidden" value="<?= $verifikasi['id_proposal_verifikasi']; ?>" name="id_proposal_verifikasi">
				<table id="example2" class="table table-bordered display table-sm" cellspacing="0">
					<thead>
						<tr>
							<th rowspan="3" class="text-center align-middle" style="width: 60px;">No</th>
							<th rowspan="3" class="text-center align-middle" style="width: 40%;">Uraian</th>
							<th colspan="4" class="text-center align-middle">Pemerikasaan Isi Proposal</th>
							<th rowspan="3" class="text-center align-middle">Penjelasan dan Rekomendasi</th>
						</tr>
						<tr>
							<th colspan="3" class="text-center align-middle">Ada</th>
							<th rowspan="2" class="text-center align-middle">Tidak ada</th>
						</tr>
						<tr>
							<th class="text-center align-middle">Layak</th>
							<th class="text-center align-middle">Kurang</th>
							<th class="text-center align-middle">Salah</th>
						</tr>
					</thead>
					<tbody>
						<tr class="font-weight-bold">
							<td class="text-center">I</td>
							<td class="">VERIFIKASI FISIK PROPOSAL</td>
							<td class=""></td>
							<td class=""></td>
							<td class=""></td>
							<td class=""></td>
							<td class=""></td>
						</tr>
						<tr>
							<td class=" text-center">1</td>
							<td class="">HALAMAN JUDUL</td>
							<td class="text-center">
								<div class="form-check">
									<input class="form-check-input" type="radio" value="Layak" <?= ($verifikasi['i_1'] == 'Layak') ? 'checked' : ''; ?> name="radio1">
								</div>
							</td>
							<td class="text-center">
								<div class="form-check">
									<input class="form-check-input" type="radio" value="Kurang" <?= ($verifikasi['i_1'] == 'Kurang') ? 'checked' : ''; ?> name="radio1">
								</div>
							</td>
							<td class="text-center">
								<div class="form-check">
									<input class="form-check-input" type="radio" value="Salah" <?= ($verifikasi['i_1'] == 'Salah') ? 'checked' : ''; ?> name="radio1">
								</div>
							</td>
							<td class="text-center">
								<div class="form-check">
									<input class="form-check-input" type="radio" value="Tidak_ada" <?= ($verifikasi['i_1'] == 'Tidak_ada') ? 'checked' : ''; ?> name="radio1">
								</div>
							</td>
							<td class="" style="padding-left: 8px;padding-right: 8px;padding-bottom: unset;padding-top: unset;">
								<input placeholder="catatan..." type="text" value="<?= $verifikasi['c_1']; ?>" style="border: none;padding: unset;height: 33px;border-radius: unset;" class="form-control" name="1">
							</td>
						</tr>
						<tr>
							<td class=" text-center">2</td>
							<td class="">SURAT PENGANTAR BUPATI</td>
							<td class="text-center">
								<div class="form-check">
									<input class="form-check-input" type="radio" value="Layak" <?= ($verifikasi['i_2'] == 'Layak') ? 'checked' : ''; ?> name="radio2">
								</div>
							</td>
							<td class="text-center">
								<div class="form-check">
									<input class="form-check-input" type="radio" value="Kurang" <?= ($verifikasi['i_2'] == 'Kurang') ? 'checked' : ''; ?> name="radio2">
								</div>
							</td>
							<td class="text-center">
								<div class="form-check">
									<input class="form-check-input" type="radio" value="Salah" <?= ($verifikasi['i_2'] == 'Salah') ? 'checked' : ''; ?> name="radio2">
								</div>
							</td>
							<td class="text-center">
								<div class="form-check">
									<input class="form-check-input" type="radio" value="Tidak_ada" <?= ($verifikasi['i_2'] == 'Tidak_ada') ? 'checked' : ''; ?> name="radio2">
								</div>
							</td>
							<td class="" style="padding-left: 8px;padding-right: 8px;padding-bottom: unset;padding-top: unset;">
								<input placeholder="catatan..." type="text" value="<?= $verifikasi['c_2']; ?>" style="border: none;padding: unset;height: 33px;border-radius: unset;" class="form-control" name="2">
							</td>
						</tr>
						<tr>
							<td class=" text-center">3</td>
							<td class="">SURAT PENGANTAR KEPALA SKPD</td>
							<td class="text-center">
								<div class="form-check">
									<input class="form-check-input" type="radio" value="Layak" <?= ($verifikasi['i_3'] == 'Layak') ? 'checked' : ''; ?> name="radio3">
								</div>
							</td>
							<td class="text-center">
								<div class="form-check">
									<input class="form-check-input" type="radio" value="Kurang" <?= ($verifikasi['i_3'] == 'Kurang') ? 'checked' : ''; ?> name="radio3">
								</div>
							</td>
							<td class="text-center">
								<div class="form-check">
									<input class="form-check-input" type="radio" value="Salah" <?= ($verifikasi['i_3'] == 'Salah') ? 'checked' : ''; ?> name="radio3">
								</div>
							</td>
							<td class="text-center">
								<div class="form-check">
									<input class="form-check-input" type="radio" value="Tidak_ada" <?= ($verifikasi['i_3'] == 'Tidak_ada') ? 'checked' : ''; ?> name="radio3">
								</div>
							</td>
							<td class="" style="padding-left: 8px;padding-right: 8px;padding-bottom: unset;padding-top: unset;">
								<input placeholder="catatan..." type="text" value="<?= $verifikasi['c_3']; ?>" style="border: none;padding: unset;height: 33px;border-radius: unset;" class="form-control" name="3">
							</td>
						</tr>
						<tr>
							<td class=" text-center">4</td>
							<td class="">PENDAHULUAN</td>
							<td class="text-center">
								<div class="form-check">
									<input class="form-check-input" type="radio" value="Layak" <?= ($verifikasi['i_4'] == 'Layak') ? 'checked' : ''; ?> name="radio4">
								</div>
							</td>
							<td class="text-center">
								<div class="form-check">
									<input class="form-check-input" type="radio" value="Kurang" <?= ($verifikasi['i_4'] == 'Kurang') ? 'checked' : ''; ?> name="radio4">
								</div>
							</td>
							<td class="text-center">
								<div class="form-check">
									<input class="form-check-input" type="radio" value="Salah" <?= ($verifikasi['i_4'] == 'Salah') ? 'checked' : ''; ?> name="radio4">
								</div>
							</td>
							<td class="text-center">
								<div class="form-check">
									<input class="form-check-input" type="radio" value="Tidak_ada" <?= ($verifikasi['i_4'] == 'Tidak_ada') ? 'checked' : ''; ?> name="radio4">
								</div>
							</td>
							<td class="" style="padding-left: 8px;padding-right: 8px;padding-bottom: unset;padding-top: unset;">
								<input placeholder="catatan..." type="text" value="<?= $verifikasi['c_4']; ?>" style="border: none;padding: unset;height: 33px;border-radius: unset;" class="form-control" name="4">
							</td>
						</tr>
						<tr>
							<td class=" text-center">5</td>
							<td id="sub">- Latar Belakang</td>
							<td class="text-center">
								<div class="form-check">
									<input class="form-check-input" type="radio" value="Layak" <?= ($verifikasi['i_5'] == 'Layak') ? 'checked' : ''; ?> name="radio5">
								</div>
							</td>
							<td class="text-center">
								<div class="form-check">
									<input class="form-check-input" type="radio" value="Kurang" <?= ($verifikasi['i_5'] == 'Kurang') ? 'checked' : ''; ?> name="radio5">
								</div>
							</td>
							<td class="text-center">
								<div class="form-check">
									<input class="form-check-input" type="radio" value="Salah" <?= ($verifikasi['i_5'] == 'Salah') ? 'checked' : ''; ?> name="radio5">
								</div>
							</td>
							<td class="text-center">
								<div class="form-check">
									<input class="form-check-input" type="radio" value="Tidak_ada" <?= ($verifikasi['i_5'] == 'Tidak_ada') ? 'checked' : ''; ?> name="radio5">
								</div>
							</td>
							<td class="" style="padding-left: 8px;padding-right: 8px;padding-bottom: unset;padding-top: unset;">
								<input placeholder="catatan..." type="text" value="<?= $verifikasi['c_5']; ?>" style="border: none;padding: unset;height: 33px;border-radius: unset;" class="form-control" name="5">
							</td>
						</tr>
						<tr>
							<td class="text-center">6</td>
							<td id="sub">- Dasar Hukum</td>
							<td class="text-center">
								<div class="form-check">
									<input class="form-check-input" type="radio" value="Layak" <?= ($verifikasi['i_6'] == 'Layak') ? 'checked' : ''; ?> name="radio6">
								</div>
							</td>
							<td class="text-center">
								<div class="form-check">
									<input class="form-check-input" type="radio" value="Kurang" <?= ($verifikasi['i_6'] == 'Kurang') ? 'checked' : ''; ?> name="radio6">
								</div>
							</td>
							<td class="text-center">
								<div class="form-check">
									<input class="form-check-input" type="radio" value="Salah" <?= ($verifikasi['i_6'] == 'Salah') ? 'checked' : ''; ?> name="radio6">
								</div>
							</td>
							<td class="text-center">
								<div class="form-check">
									<input class="form-check-input" type="radio" value="Tidak_ada" <?= ($verifikasi['i_6'] == 'Tidak_ada') ? 'checked' : ''; ?> name="radio6">
								</div>
							</td>
							<td class="" style="padding-left: 8px;padding-right: 8px;padding-bottom: unset;padding-top: unset;">
								<input placeholder="catatan..." type="text" value="<?= $verifikasi['c_6']; ?>" style="border: none;padding: unset;height: 33px;border-radius: unset;" class="form-control" name="6">
							</td>
						</tr>
						<tr>
							<td class="text-center">7</td>
							<td id="sub">- Maksud</td>
							<td class="text-center">
								<div class="form-check">
									<input class="form-check-input" type="radio" value="Layak" <?= ($verifikasi['i_7'] == 'Layak') ? 'checked' : ''; ?> name="radio7">
								</div>
							</td>
							<td class="text-center">
								<div class="form-check">
									<input class="form-check-input" type="radio" value="Kurang" <?= ($verifikasi['i_7'] == 'Kurang') ? 'checked' : ''; ?> name="radio7">
								</div>
							</td>
							<td class="text-center">
								<div class="form-check">
									<input class="form-check-input" type="radio" value="Salah" <?= ($verifikasi['i_7'] == 'Salah') ? 'checked' : ''; ?> name="radio7">
								</div>
							</td>
							<td class="text-center">
								<div class="form-check">
									<input class="form-check-input" type="radio" value="Tidak_ada" <?= ($verifikasi['i_7'] == 'Tidak_ada') ? 'checked' : ''; ?> name="radio7">
								</div>
							</td>
							<td class="" style="padding-left: 8px;padding-right: 8px;padding-bottom: unset;padding-top: unset;">
								<input placeholder="catatan..." type="text" value="<?= $verifikasi['c_7']; ?>" style="border: none;padding: unset;height: 33px;border-radius: unset;" class="form-control" name="7">
							</td>
						</tr>
						<tr>
							<td class="text-center">8</td>
							<td id="sub">- Tujuan</td>
							<td class="text-center">
								<div class="form-check">
									<input class="form-check-input" type="radio" value="Layak" <?= ($verifikasi['i_8'] == 'Layak') ? 'checked' : ''; ?> name="radio8">
								</div>
							</td>
							<td class="text-center">
								<div class="form-check">
									<input class="form-check-input" type="radio" value="Kurang" <?= ($verifikasi['i_8'] == 'Kurang') ? 'checked' : ''; ?> name="radio8">
								</div>
							</td>
							<td class="text-center">
								<div class="form-check">
									<input class="form-check-input" type="radio" value="Salah" <?= ($verifikasi['i_8'] == 'Salah') ? 'checked' : ''; ?> name="radio8">
								</div>
							</td>
							<td class="text-center">
								<div class="form-check">
									<input class="form-check-input" type="radio" value="Tidak_ada" <?= ($verifikasi['i_8'] == 'Tidak_ada') ? 'checked' : ''; ?> name="radio8">
								</div>
							</td>
							<td class="" style="padding-left: 8px;padding-right: 8px;padding-bottom: unset;padding-top: unset;">
								<input placeholder="catatan..." type="text" value="<?= $verifikasi['c_8']; ?>" style="border: none;padding: unset;height: 33px;border-radius: unset;" class="form-control" name="8">
							</td>
						</tr>
						<tr>
							<td class="text-center">9</td>
							<td class="">PROGRAM DAN KEGIATAN</td>
							<td class="text-center">
								<div class="form-check">
									<input class="form-check-input" type="radio" value="Layak" <?= ($verifikasi['i_9'] == 'Layak') ? 'checked' : ''; ?> name="radio9">
								</div>
							</td>
							<td class="text-center">
								<div class="form-check">
									<input class="form-check-input" type="radio" value="Kurang" <?= ($verifikasi['i_9'] == 'Kurang') ? 'checked' : ''; ?> name="radio9">
								</div>
							</td>
							<td class="text-center">
								<div class="form-check">
									<input class="form-check-input" type="radio" value="Salah" <?= ($verifikasi['i_9'] == 'Salah') ? 'checked' : ''; ?> name="radio9">
								</div>
							</td>
							<td class="text-center">
								<div class="form-check">
									<input class="form-check-input" type="radio" value="Tidak_ada" <?= ($verifikasi['i_9'] == 'Tidak_ada') ? 'checked' : ''; ?> name="radio9">
								</div>
							</td>
							<td class="" style="padding-left: 8px;padding-right: 8px;padding-bottom: unset;padding-top: unset;">
								<input placeholder="catatan..." type="text" value="<?= $verifikasi['c_9']; ?>" style="border: none;padding: unset;height: 33px;border-radius: unset;" class="form-control" name="9">
							</td>
						</tr>
						<tr>
							<td class=" text-center">10</td>
							<td id="sub">- Nama Urusan</td>
							<td class="text-center">
								<div class="form-check">
									<input class="form-check-input" type="radio" value="Layak" <?= ($verifikasi['i_10'] == 'Layak') ? 'checked' : ''; ?> name="radio10">
								</div>
							</td>
							<td class="text-center">
								<div class="form-check">
									<input class="form-check-input" type="radio" value="Kurang" <?= ($verifikasi['i_10'] == 'Kurang') ? 'checked' : ''; ?> name="radio10">
								</div>
							</td>
							<td class="text-center">
								<div class="form-check">
									<input class="form-check-input" type="radio" value="Salah" <?= ($verifikasi['i_10'] == 'Salah') ? 'checked' : ''; ?> name="radio10">
								</div>
							</td>
							<td class="text-center">
								<div class="form-check">
									<input class="form-check-input" type="radio" value="Tidak_ada" <?= ($verifikasi['i_10'] == 'Tidak_ada') ? 'checked' : ''; ?> name="radio10">
								</div>
							</td>
							<td class="" style="padding-left: 8px;padding-right: 8px;padding-bottom: unset;padding-top: unset;">
								<input placeholder="catatan..." type="text" value="<?= $verifikasi['c_10']; ?>" style="border: none;padding: unset;height: 33px;border-radius: unset;" class="form-control" name="10">
							</td>
						</tr>
						<tr>
							<td class="text-center">11</td>
							<td id="sub">- Nama Program</td>
							<td class="text-center">
								<div class="form-check">
									<input class="form-check-input" type="radio" value="Layak" <?= ($verifikasi['i_11'] == 'Layak') ? 'checked' : ''; ?> name="radio11">
								</div>
							</td>
							<td class="text-center">
								<div class="form-check">
									<input class="form-check-input" type="radio" value="Kurang" <?= ($verifikasi['i_11'] == 'Kurang') ? 'checked' : ''; ?> name="radio11">
								</div>
							</td>
							<td class="text-center">
								<div class="form-check">
									<input class="form-check-input" type="radio" value="Salah" <?= ($verifikasi['i_11'] == 'Salah') ? 'checked' : ''; ?> name="radio11">
								</div>
							</td>
							<td class="text-center">
								<div class="form-check">
									<input class="form-check-input" type="radio" value="Tidak_ada" <?= ($verifikasi['i_11'] == 'Tidak_ada') ? 'checked' : ''; ?> name="radio11">
								</div>
							</td>
							<td class="" style="padding-left: 8px;padding-right: 8px;padding-bottom: unset;padding-top: unset;">
								<input placeholder="catatan..." type="text" value="<?= $verifikasi['c_11']; ?>" style="border: none;padding: unset;height: 33px;border-radius: unset;" class="form-control" name="11">
							</td>
						</tr>
						<tr>
							<td class="text-center">12</td>
							<td id="sub">- Nama Kegiatan</td>
							<td class="text-center">
								<div class="form-check">
									<input class="form-check-input" type="radio" value="Layak" <?= ($verifikasi['i_12'] == 'Layak') ? 'checked' : ''; ?> name="radio12">
								</div>
							</td>
							<td class="text-center">
								<div class="form-check">
									<input class="form-check-input" type="radio" value="Kurang" <?= ($verifikasi['i_12'] == 'Kurang') ? 'checked' : ''; ?> name="radio12">
								</div>
							</td>
							<td class="text-center">
								<div class="form-check">
									<input class="form-check-input" type="radio" value="Salah" <?= ($verifikasi['i_12'] == 'Salah') ? 'checked' : ''; ?> name="radio12">
								</div>
							</td>
							<td class="text-center">
								<div class="form-check">
									<input class="form-check-input" type="radio" value="Tidak_ada" <?= ($verifikasi['i_12'] == 'Tidak_ada') ? 'checked' : ''; ?> name="radio12">
								</div>
							</td>
							<td class="" style="padding-left: 8px;padding-right: 8px;padding-bottom: unset;padding-top: unset;">
								<input placeholder="catatan..." type="text" value="<?= $verifikasi['c_12']; ?>" style="border: none;padding: unset;height: 33px;border-radius: unset;" class="form-control" name="12">
							</td>
						</tr>
						<tr>
							<td class="text-center">13</td>
							<td id="sub">- Lokus Usulan</td>
							<td class="text-center">
								<div class="form-check">
									<input class="form-check-input" type="radio" value="Layak" <?= ($verifikasi['i_13'] == 'Layak') ? 'checked' : ''; ?> name="radio13">
								</div>
							</td>
							<td class="text-center">
								<div class="form-check">
									<input class="form-check-input" type="radio" value="Kurang" <?= ($verifikasi['i_13'] == 'Kurang') ? 'checked' : ''; ?> name="radio13">
								</div>
							</td>
							<td class="text-center">
								<div class="form-check">
									<input class="form-check-input" type="radio" value="Salah" <?= ($verifikasi['i_13'] == 'Salah') ? 'checked' : ''; ?> name="radio13">
								</div>
							</td>
							<td class="text-center">
								<div class="form-check">
									<input class="form-check-input" type="radio" value="Tidak_ada" <?= ($verifikasi['i_13'] == 'Tidak_ada') ? 'checked' : ''; ?> name="radio13">
								</div>
							</td>
							<td class="" style="padding-left: 8px;padding-right: 8px;padding-bottom: unset;padding-top: unset;">
								<input placeholder="catatan..." type="text" value="<?= $verifikasi['c_13']; ?>" style="border: none;padding: unset;height: 33px;border-radius: unset;" class="form-control" name="13">
							</td>
						</tr>
						<tr>
							<td class="text-center">14</td>
							<td id="sub">- Volume</td>
							<td class="text-center">
								<div class="form-check">
									<input class="form-check-input" type="radio" value="Layak" <?= ($verifikasi['i_14'] == 'Layak') ? 'checked' : ''; ?> name="radio14">
								</div>
							</td>
							<td class="text-center">
								<div class="form-check">
									<input class="form-check-input" type="radio" value="Kurang" <?= ($verifikasi['i_14'] == 'Kurang') ? 'checked' : ''; ?> name="radio14">
								</div>
							</td>
							<td class="text-center">
								<div class="form-check">
									<input class="form-check-input" type="radio" value="Salah" <?= ($verifikasi['i_14'] == 'Salah') ? 'checked' : ''; ?> name="radio14">
								</div>
							</td>
							<td class="text-center">
								<div class="form-check">
									<input class="form-check-input" type="radio" value="Tidak_ada" <?= ($verifikasi['i_14'] == 'Tidak_ada') ? 'checked' : ''; ?> name="radio14">
								</div>
							</td>
							<td class="" style="padding-left: 8px;padding-right: 8px;padding-bottom: unset;padding-top: unset;">
								<input placeholder="catatan..." type="text" value="<?= $verifikasi['c_14']; ?>" style="border: none;padding: unset;height: 33px;border-radius: unset;" class="form-control" name="14">
							</td>
						</tr>
						<tr>
							<td class="text-center">15</td>
							<td id="sub">- Satuan</td>
							<td class="text-center">
								<div class="form-check">
									<input class="form-check-input" type="radio" value="Layak" <?= ($verifikasi['i_15'] == 'Layak') ? 'checked' : ''; ?> name="radio15">
								</div>
							</td>
							<td class="text-center">
								<div class="form-check">
									<input class="form-check-input" type="radio" value="Kurang" <?= ($verifikasi['i_15'] == 'Kurang') ? 'checked' : ''; ?> name="radio15">
								</div>
							</td>
							<td class="text-center">
								<div class="form-check">
									<input class="form-check-input" type="radio" value="Salah" <?= ($verifikasi['i_15'] == 'Salah') ? 'checked' : ''; ?> name="radio15">
								</div>
							</td>
							<td class="text-center">
								<div class="form-check">
									<input class="form-check-input" type="radio" value="Tidak_ada" <?= ($verifikasi['i_15'] == 'Tidak_ada') ? 'checked' : ''; ?> name="radio15">
								</div>
							</td>
							<td class="" style="padding-left: 8px;padding-right: 8px;padding-bottom: unset;padding-top: unset;">
								<input placeholder="catatan..." type="text" value="<?= $verifikasi['c_15']; ?>" style="border: none;padding: unset;height: 33px;border-radius: unset;" class="form-control" name="15">
							</td>
						</tr>
						<tr>
							<td class="text-center">16</td>
							<td id="sub">- Alamat</td>
							<td class="text-center">
								<div class="form-check">
									<input class="form-check-input" type="radio" value="Layak" <?= ($verifikasi['i_16'] == 'Layak') ? 'checked' : ''; ?> name="radio16">
								</div>
							</td>
							<td class="text-center">
								<div class="form-check">
									<input class="form-check-input" type="radio" value="Kurang" <?= ($verifikasi['i_16'] == 'Kurang') ? 'checked' : ''; ?> name="radio16">
								</div>
							</td>
							<td class="text-center">
								<div class="form-check">
									<input class="form-check-input" type="radio" value="Salah" <?= ($verifikasi['i_16'] == 'Salah') ? 'checked' : ''; ?> name="radio16">
								</div>
							</td>
							<td class="text-center">
								<div class="form-check">
									<input class="form-check-input" type="radio" value="Tidak_ada" <?= ($verifikasi['i_16'] == 'Tidak_ada') ? 'checked' : ''; ?> name="radio16">
								</div>
							</td>
							<td class="" style="padding-left: 8px;padding-right: 8px;padding-bottom: unset;padding-top: unset;">
								<input placeholder="catatan..." type="text" value="<?= $verifikasi['c_16']; ?>" style="border: none;padding: unset;height: 33px;border-radius: unset;" class="form-control" name="16">
							</td>
						</tr>
						<tr>
							<td class="text-center">17</td>
							<td class="">PENUTUP</td>
							<td class="text-center">
								<div class="form-check">
									<input class="form-check-input" type="radio" value="Layak" <?= ($verifikasi['i_17'] == 'Layak') ? 'checked' : ''; ?> name="radio17">
								</div>
							</td>
							<td class="text-center">
								<div class="form-check">
									<input class="form-check-input" type="radio" value="Kurang" <?= ($verifikasi['i_17'] == 'Kurang') ? 'checked' : ''; ?> name="radio17">
								</div>
							</td>
							<td class="text-center">
								<div class="form-check">
									<input class="form-check-input" type="radio" value="Salah" <?= ($verifikasi['i_17'] == 'Salah') ? 'checked' : ''; ?> name="radio17">
								</div>
							</td>
							<td class="text-center">
								<div class="form-check">
									<input class="form-check-input" type="radio" value="Tidak_ada" <?= ($verifikasi['i_17'] == 'Tidak_ada') ? 'checked' : ''; ?> name="radio17">
								</div>
							</td>
							<td class="" style="padding-left: 8px;padding-right: 8px;padding-bottom: unset;padding-top: unset;">
								<input placeholder="catatan..." type="text" value="<?= $verifikasi['c_17']; ?>" style="border: none;padding: unset;height: 33px;border-radius: unset;" class="form-control" name="17">
							</td>
						</tr>
						<tr>
							<td class="text-center">18</td>
							<td class="">LAMPIRAN</td>
							<td class="text-center">
								<div class="form-check">
									<input class="form-check-input" type="radio" value="Layak" <?= ($verifikasi['i_18'] == 'Layak') ? 'checked' : ''; ?> name="radio18">
								</div>
							</td>
							<td class="text-center">
								<div class="form-check">
									<input class="form-check-input" type="radio" value="Kurang" <?= ($verifikasi['i_18'] == 'Kurang') ? 'checked' : ''; ?> name="radio18">
								</div>
							</td>
							<td class="text-center">
								<div class="form-check">
									<input class="form-check-input" type="radio" value="Salah" <?= ($verifikasi['i_18'] == 'Salah') ? 'checked' : ''; ?> name="radio18">
								</div>
							</td>
							<td class="text-center">
								<div class="form-check">
									<input class="form-check-input" type="radio" value="Tidak_ada" <?= ($verifikasi['i_18'] == 'Tidak_ada') ? 'checked' : ''; ?> name="radio18">
								</div>
							</td>
							<td class="" style="padding-left: 8px;padding-right: 8px;padding-bottom: unset;padding-top: unset;">
								<input placeholder="catatan..." type="text" value="<?= $verifikasi['c_18']; ?>" style="border: none;padding: unset;height: 33px;border-radius: unset;" class="form-control" name="18">
							</td>
						</tr>
						<tr>
							<td class="text-center">19</td>
							<td id="sub">- Perencanaan /DED/KAK</td>
							<td class="text-center">
								<div class="form-check">
									<input class="form-check-input" type="radio" value="Layak" <?= ($verifikasi['i_19'] == 'Layak') ? 'checked' : ''; ?> name="radio19">
								</div>
							</td>
							<td class="text-center">
								<div class="form-check">
									<input class="form-check-input" type="radio" value="Kurang" <?= ($verifikasi['i_19'] == 'Kurang') ? 'checked' : ''; ?> name="radio19">
								</div>
							</td>
							<td class="text-center">
								<div class="form-check">
									<input class="form-check-input" type="radio" value="Salah" <?= ($verifikasi['i_19'] == 'Salah') ? 'checked' : ''; ?> name="radio19">
								</div>
							</td>
							<td class="text-center">
								<div class="form-check">
									<input class="form-check-input" type="radio" value="Tidak_ada" <?= ($verifikasi['i_19'] == 'Tidak_ada') ? 'checked' : ''; ?> name="radio19">
								</div>
							</td>
							<td class="" style="padding-left: 8px;padding-right: 8px;padding-bottom: unset;padding-top: unset;">
								<input placeholder="catatan..." type="text" value="<?= $verifikasi['c_19']; ?>" style="border: none;padding: unset;height: 33px;border-radius: unset;" class="form-control" name="19">
							</td>
						</tr>
						<tr>
							<td class="text-center">20</td>
							<td id="sub">- RAB</td>
							<td class="text-center">
								<div class="form-check">
									<input class="form-check-input" type="radio" value="Layak" <?= ($verifikasi['i_20'] == 'Layak') ? 'checked' : ''; ?> name="radio20">
								</div>
							</td>
							<td class="text-center">
								<div class="form-check">
									<input class="form-check-input" type="radio" value="Kurang" <?= ($verifikasi['i_20'] == 'Kurang') ? 'checked' : ''; ?> name="radio20">
								</div>
							</td>
							<td class="text-center">
								<div class="form-check">
									<input class="form-check-input" type="radio" value="Salah" <?= ($verifikasi['i_20'] == 'Salah') ? 'checked' : ''; ?> name="radio20">
								</div>
							</td>
							<td class="text-center">
								<div class="form-check">
									<input class="form-check-input" type="radio" value="Tidak_ada" <?= ($verifikasi['i_20'] == 'Tidak_ada') ? 'checked' : ''; ?> name="radio20">
								</div>
							</td>
							<td class="" style="padding-left: 8px;padding-right: 8px;padding-bottom: unset;padding-top: unset;">
								<input placeholder="catatan..." type="text" value="<?= $verifikasi['c_20']; ?>" style="border: none;padding: unset;height: 33px;border-radius: unset;" class="form-control" name="20">
							</td>
						</tr>
						<tr>
							<td class="text-center">21</td>
							<td id="sub">- Pra RKA</td>
							<td class="text-center">
								<div class="form-check">
									<input class="form-check-input" type="radio" value="Layak" <?= ($verifikasi['i_21'] == 'Layak') ? 'checked' : ''; ?> name="radio21">
								</div>
							</td>
							<td class="text-center">
								<div class="form-check">
									<input class="form-check-input" type="radio" value="Kurang" <?= ($verifikasi['i_21'] == 'Kurang') ? 'checked' : ''; ?> name="radio21">
								</div>
							</td>
							<td class="text-center">
								<div class="form-check">
									<input class="form-check-input" type="radio" value="Salah" <?= ($verifikasi['i_21'] == 'Salah') ? 'checked' : ''; ?> name="radio21">
								</div>
							</td>
							<td class="text-center">
								<div class="form-check">
									<input class="form-check-input" type="radio" value="Tidak_ada" <?= ($verifikasi['i_21'] == 'Tidak_ada') ? 'checked' : ''; ?> name="radio21">
								</div>
							</td>
							<td class="" style="padding-left: 8px;padding-right: 8px;padding-bottom: unset;padding-top: unset;">
								<input placeholder="catatan..." type="text" value="<?= $verifikasi['c_21']; ?>" style="border: none;padding: unset;height: 33px;border-radius: unset;" class="form-control" name="21">
							</td>
						</tr>
						<tr>
							<td class="text-center">22</td>
							<td id="sub">- Dokumentasi</td>
							<td class="text-center">
								<div class="form-check">
									<input class="form-check-input" type="radio" value="Layak" <?= ($verifikasi['i_22'] == 'Layak') ? 'checked' : ''; ?> name="radio22">
								</div>
							</td>
							<td class="text-center">
								<div class="form-check">
									<input class="form-check-input" type="radio" value="Kurang" <?= ($verifikasi['i_22'] == 'Kurang') ? 'checked' : ''; ?> name="radio22">
								</div>
							</td>
							<td class="text-center">
								<div class="form-check">
									<input class="form-check-input" type="radio" value="Salah" <?= ($verifikasi['i_22'] == 'Salah') ? 'checked' : ''; ?> name="radio22">
								</div>
							</td>
							<td class="text-center">
								<div class="form-check">
									<input class="form-check-input" type="radio" value="Tidak_ada" <?= ($verifikasi['i_22'] == 'Tidak_ada') ? 'checked' : ''; ?> name="radio22">
								</div>
							</td>
							<td class="" style="padding-left: 8px;padding-right: 8px;padding-bottom: unset;padding-top: unset;">
								<input placeholder="catatan..." type="text" value="<?= $verifikasi['c_22']; ?>" style="border: none;padding: unset;height: 33px;border-radius: unset;" class="form-control" name="22">
							</td>
						</tr>
						<tr class="font-weight-bold">
							<td class="text-center">II</td>
							<td class="">VERIFIKASI SUBSTANSI PROPOSAL</td>
							<td class=""></td>
							<td class=""></td>
							<td class=""></td>
							<td class=""></td>
							<td class=""></td>
						</tr>
						<tr>
							<td class="text-center">1</td>
							<td class="text-wrap">Keterkaitan usulan kegiatan terhadap prioritas daerah, pencapaian target kinerja pembangunan daerah Tahun 2024</td>
							<td class="text-center">
								<div class="form-check">
									<input class="form-check-input" type="radio" value="Layak" <?= ($verifikasi['ii_1'] == 'Layak') ? 'checked' : ''; ?> name="radioi1">
								</div>
							</td>
							<td class="text-center">
								<div class="form-check">
									<input class="form-check-input" type="radio" value="Kurang" <?= ($verifikasi['ii_1'] == 'Kurang') ? 'checked' : ''; ?> name="radioi1">
								</div>
							</td>
							<td class="text-center">
								<div class="form-check">
									<input class="form-check-input" type="radio" value="Salah" <?= ($verifikasi['ii_1'] == 'Salah') ? 'checked' : ''; ?> name="radioi1">
								</div>
							</td>
							<td class="text-center">
								<div class="form-check">
									<input class="form-check-input" type="radio" value="Tidak_ada" <?= ($verifikasi['ii_1'] == 'Tidak_ada') ? 'checked' : ''; ?> name="radioi1">
								</div>
							</td>
							<td class="" style="padding-left: 8px;padding-right: 8px;padding-bottom: unset;padding-top: unset;">
								<input placeholder="catatan..." type="text" value="<?= $verifikasi['ii_c_1']; ?>" style="border: none;padding: unset;height: 85px;border-radius: unset;" class="form-control" name="II_1">
							</td>
						</tr>
						<tr>
							<td class="text-center">2</td>
							<td class="text-wrap">Keterkaitan usulan kegiatan terhadap prioritas daerah, pencapaian target kinerja pembangunan daerah Tahun 2024</td>
							<td class="text-center">
								<div class="form-check">
									<input class="form-check-input" type="radio" value="Layak" <?= ($verifikasi['ii_2'] == 'Layak') ? 'checked' : ''; ?> name="radioi2">
								</div>
							</td>
							<td class="text-center">
								<div class="form-check">
									<input class="form-check-input" type="radio" value="Kurang" <?= ($verifikasi['ii_2'] == 'Kurang') ? 'checked' : ''; ?> name="radioi2">
								</div>
							</td>
							<td class="text-center">
								<div class="form-check">
									<input class="form-check-input" type="radio" value="Salah" <?= ($verifikasi['ii_2'] == 'Salah') ? 'checked' : ''; ?> name="radioi2">
								</div>
							</td>
							<td class="text-center">
								<div class="form-check">
									<input class="form-check-input" type="radio" value="Tidak_ada" <?= ($verifikasi['ii_2'] == 'Tidak_ada') ? 'checked' : ''; ?> name="radioi2">
								</div>
							</td>
							<td class="" style="padding-left: 8px;padding-right: 8px;padding-bottom: unset;padding-top: unset;">
								<input placeholder="catatan..." type="text" value="<?= $verifikasi['ii_c_2']; ?>" style="border: none;padding: unset;height: 85px;border-radius: unset;" class="form-control" name="II_2">
							</td>
						</tr>
						<tr>
							<td class="text-center">3</td>
							<td class="text-wrap">Kewajaran besaran pagu yang diusulkan berdasarkan standar biaya daerah</td>
							<td class="text-center">
								<div class="form-check">
									<input class="form-check-input" type="radio" value="Layak" <?= ($verifikasi['ii_3'] == 'Layak') ? 'checked' : ''; ?> name="radioi3">
								</div>
							</td>
							<td class="text-center">
								<div class="form-check">
									<input class="form-check-input" type="radio" value="Kurang" <?= ($verifikasi['ii_3'] == 'Kurang') ? 'checked' : ''; ?> name="radioi3">
								</div>
							</td>
							<td class="text-center">
								<div class="form-check">
									<input class="form-check-input" type="radio" value="Salah" <?= ($verifikasi['ii_3'] == 'Salah') ? 'checked' : ''; ?> name="radioi3">
								</div>
							</td>
							<td class="text-center">
								<div class="form-check">
									<input class="form-check-input" type="radio" value="Tidak_ada" <?= ($verifikasi['ii_3'] == 'Tidak_ada') ? 'checked' : ''; ?> name="radioi3">
								</div>
							</td>
							<td class="" style="padding-left: 8px;padding-right: 8px;padding-bottom: unset;padding-top: unset;">
								<input placeholder="catatan..." type="text" value="<?= $verifikasi['ii_c_3']; ?>" style="border: none;padding: unset;height: 85px;border-radius: unset;" class="form-control" name="II_3">
							</td>
						</tr>
						<tr>
							<td colspan="7" class="">Kesimpulan Pemeriksaan : Bahwa Dokumen Usulan/ Proposal tersebut diatas dinyatakan:</td>
						</tr>
						<tr>
							<td colspan="2" class="">1. TELAH MEMENUHI SYARAT</td>
							<td class="text-center">
								<div class="form-check">
									<input class="form-check-input" type="radio" value="telah" <?= ($verifikasi['syarat'] == 'telah') ? 'checked' : ''; ?> name="radio111">
								</div>
							</td>
							<td colspan="4" class="">Maka bisa dilanjutkan ke proses selanjutnya</td>
						</tr>
						<tr>
							<td colspan="2" class="">2. BELUM MEMENUHI SYARAT</td>
							<td class="text-center">
								<div class="form-check">
									<input class="form-check-input" type="radio" value="belum" <?= ($verifikasi['syarat'] == 'belum') ? 'checked' : ''; ?> name="radio111">
								</div>
							</td>
							<td colspan="4" class="">Maka perlu diperbaiki dulu oleh SKPD pengusul</td>
						</tr>
					</tbody>
				</table>
				<br>
				<div class="form-group">
					<button type="submit" class="btn btn-info">Submit</button>
				</div>
			</form>
		</div>
		<div class="col-5">
			<iframe src="<?= base_url('/user/proposal/pengajuan/show/' . kunci($proposal['id_proposal'])); ?>" style="width: 100%;height:100%;"></iframe>
		</div>
		<!-- <div id="popup" class="modal fade bd-example-modal-xl" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
			<div class="modal-dialog modal-xl" role="document">
				<div class="modal-content" style="height: 80vh;display: block;">
					<div class="row">
						<div class="col-md" style="height: 80vh;">
							<div id="map"></div>
						</div>
					</div>
				</div>
			</div>
		</div> -->
	</div>
</div>
<!-- Extra large modal -->


<div id="popup" class="popup-overlay">
	<div class="popup-content">
		<span class="close-btn" onclick="closePopup()">&times;</span>
		<div id="map"></div>
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
			"paging": false,
			"responsive": true,
			"autoWidth": false,
			"ordering": false,
			"lengthMenu": [
				[20, 40, 60, 100, -1],
				[20, 40, 60, 100, 'All']
			]
		});
		$('#example2').DataTable({
			"paging": false,
			"lengthChange": false,
			"searching": false,
			"ordering": false,
			"info": false,
			"autoWidth": false,
			"responsive": true,
		});
	});
</script>

<script>
	function closePopup() {
		document.getElementById("popup").style.display = "none";
	}
</script>
<script>
	function showMap() {
		// Menampilkan container popup
		var popupContainer = document.getElementById('popup');
		popupContainer.style.display = 'block';

		// MENGATUR TITIK KOORDINAT TITIK TENGAN & LEVEL ZOOM PADA BASEMAP
		var map = L.map('map').setView([-7.629538, 108.530578], 11);

		// MENAMPILKAN SKALA
		L.control.scale({
			imperial: false
		}).addTo(map);

		// PILIHAN BASEMAP YANG AKAN DITAMPILKAN
		var baseLayers = {
			'Esri.WorldTopoMapfff': L.tileLayer('https://api.maptiler.com/maps/openstreetmap/{z}/{x}/{y}.jpg?key=i0mwSf7DPjH2JjoVNyFa', {
				attribution: 'Map data &copy; <a href="">Kangsommay</a> ',
				maxZoom: 20,
				id: 'mapbox/streets-v11', //menggunakan peta model streets-v11 kalian bisa melihat jenis-jenis peta lainnnya di web resmi mapbox
				tileSize: 512,
				zoomOffset: -1,
				accessToken: 'i0mwSf7DPjH2JjoVNyFa'
			}).addTo(map),
			'Esri.WorldTopoMap': L.tileLayer.provider('Esri.WorldTopoMap'),
			'Esri WorldStreetMap': L.tileLayer.provider('Esri.WorldStreetMap'),
			'Esri WorldImagery': L.tileLayer.provider('Esri.WorldImagery')
		};

		// // MENAMPILKAN TOOLS UNTUK MEMILIH BASEMAP
		L.control.layers(baseLayers, {}).addTo(map);


		// // Membuat layer group untuk GeoJSON
		var geojsonLayer = L.layerGroup().addTo(map);

		// URL file GeoJSON
		var geojsonUrl = '<?= base_url('/jalan_kabupaten.geojson'); ?>';

		// Memuat data GeoJSON dari URL
		fetch(geojsonUrl)
			.then(response => response.json())
			.then(data => {
				// Menambahkan data GeoJSON ke layer group
				L.geoJSON(data, {
					style: function(feature) {
						var Style1
						if (feature.properties.warna_garis != null) {
							var color = feature.properties.warna_garis;
						} else {
							var color = "#cc3f39";
						}
						return {

							color: color,
							fillColor: feature.properties.warna,
							weight: 3,
							opacity: 1
						}; // ini adalah style yang akan digunakan
					},
					// MENAMPILKAN POPUP DENGAN ISI BERDASARKAN ATRIBUT KAB_KOTA
					onEachFeature: function(feature, layer) {
						layer.bindPopup("<center>" + feature.properties.Kd_Inf + "</center><br>" + "<center>" + feature.properties.Nm_Ruas + "</center>")
						that = this; // perintah agar menghasilkan efek hover pada objek layer
						layer.on('mouseover', function(e) {
							this.setStyle({
								weight: 3,
								color: '#72152b',
								dashArray: '',
								fillOpacity: 1
							});
							if (!L.Browser.ie && !L.Browser.opera) {
								layer.bringToFront();
							}
							info.update(layer.feature.properties);
						});
						layer.on('mouseout', function(e) {
							geojsonLayer.resetStyle(e.Kd_Inf); // isi dengan nama variabel dari layer
							info.update();
						});
					}
				}).addTo(geojsonLayer);
			})
			.catch(error => {
				console.error('Error:', error);
			});
		// =========================================================================
		// MENAMBAHKAN TOOL PENCARIAN
		var searchControl = new L.Control.Search({
			layer: geojsonLayer, // ISI DENGAN NANA VARIABEL LAYER
			propertyName: 'Nm_Ruas', // isi dengan nama field dari file geojson bali yang akan dijadiakn acuan ketiak melakukan pencarian
			HidecircleLocation: false,
			moveToLocation: function(latlng, title, map) {
				//map.fitBounds( latlng.layer.getBounds() );
				var zoom = map.getBoundsZoom(latlng.layer.getBounds());
				map.setView(latlng, zoom); // access the zoom
			}
		});
		searchControl.on('search:locationfound', function(e) {
			e.layer.setStyle({});
			if (e.layer._popup)
				e.layer.openPopup();
		}).on('search:collapsed', function(e) {
			featuresLayer.eachLayer(function(layer) {
				featuresLayer.resetStyle(layer);
			});
		});
		map.addControl(searchControl); //menambahakn tool pencarian ke tampilan map
		// menambahkan tools defautl extent
		L.control.defaultExtent().addTo(map);


		<?php if ($proposal['titik_lokasi']) : ?>
			L.marker([<?php echo str_replace(['[', ']', 'LatLng', '(', ')'], '', $proposal['titik_lokasi']); ?>]).addTo(map)
			// L.marker([-7.692525, 108.537353]).addTo(mymap)
		<?php endif; ?>

		// Mengatur ukuran map saat container popup ditampilkan
		map.invalidateSize();
	}
</script>
<?= $this->endSection(); ?>