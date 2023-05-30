<?= $this->extend('_layout/template'); ?>

<?= $this->section('stylesheet'); ?>
<link rel="stylesheet" href="<?= base_url('/toping/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') ?>">
<style>
	#sub {
		padding-left: 40px;
	}

	input[type=radio] {
		width: 15px;
		height: 15px;
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
	</table><br>
	<div class="row"> <!-- class row digunakan sebelum membuat column  -->
		<div class="col-7 overflow-auto" style="height: 68vh;">
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
							<?= ($verifikasi['i_1'] == 'Layak') ? '<i class="nav-icon fa fa-check"></i>' : ''; ?>
						</td>
						<td class="text-center">
							<?= ($verifikasi['i_1'] == 'Kurang') ? '<i class="nav-icon fa fa-check"></i>' : ''; ?>
						</td>
						<td class="text-center">
							<?= ($verifikasi['i_1'] == 'Salah') ? '<i class="nav-icon fa fa-check"></i>' : ''; ?>
						</td>
						<td class="text-center">
							<?= ($verifikasi['i_1'] == 'Tidak_ada') ? '<i class="nav-icon fa fa-check"></i>' : ''; ?>
						</td>
						<td class="text-wrap">
							<?= $verifikasi['c_1']; ?>
						</td>
					</tr>
					<tr>
						<td class=" text-center">2</td>
						<td class="">SURAT PENGANTAR BUPATI</td>
						<td class="text-center">
							<?= ($verifikasi['i_2'] == 'Layak') ? '<i class="nav-icon fa fa-check"></i>' : ''; ?>
						</td>
						<td class="text-center">
							<?= ($verifikasi['i_2'] == 'Kurang') ? '<i class="nav-icon fa fa-check"></i>' : ''; ?>
						</td>
						<td class="text-center">
							<?= ($verifikasi['i_2'] == 'Salah') ? '<i class="nav-icon fa fa-check"></i>' : ''; ?>
						</td>
						<td class="text-center">
							<?= ($verifikasi['i_2'] == 'Tidak_ada') ? '<i class="nav-icon fa fa-check"></i>' : ''; ?>
						</td>
						<td class="text-wrap">
							<?= $verifikasi['c_2']; ?>
						</td>
					</tr>
					<tr>
						<td class=" text-center">3</td>
						<td class="">SURAT PENGANTAR KEPALA SKPD</td>
						<td class="text-center">
							<?= ($verifikasi['i_3'] == 'Layak') ? '<i class="nav-icon fa fa-check"></i>' : ''; ?>
						</td>
						<td class="text-center">
							<?= ($verifikasi['i_3'] == 'Kurang') ? '<i class="nav-icon fa fa-check"></i>' : ''; ?>
						</td>
						<td class="text-center">
							<?= ($verifikasi['i_3'] == 'Salah') ? '<i class="nav-icon fa fa-check"></i>' : ''; ?>
						</td>
						<td class="text-center">
							<?= ($verifikasi['i_3'] == 'Tidak_ada') ? '<i class="nav-icon fa fa-check"></i>' : ''; ?>
						</td>
						<td class="text-wrap">
							<?= $verifikasi['c_3']; ?>
						</td>
					</tr>
					<tr>
						<td class=" text-center">4</td>
						<td class="">PENDAHULUAN</td>
						<td class="text-center">
							<?= ($verifikasi['i_4'] == 'Layak') ? '<i class="nav-icon fa fa-check"></i>' : ''; ?>
						</td>
						<td class="text-center">
							<?= ($verifikasi['i_4'] == 'Kurang') ? '<i class="nav-icon fa fa-check"></i>' : ''; ?>
						</td>
						<td class="text-center">
							<?= ($verifikasi['i_4'] == 'Salah') ? '<i class="nav-icon fa fa-check"></i>' : ''; ?>
						</td>
						<td class="text-center">
							<?= ($verifikasi['i_4'] == 'Tidak_ada') ? '<i class="nav-icon fa fa-check"></i>' : ''; ?>
						</td>
						<td class="text-wrap">
							<?= $verifikasi['c_4']; ?>
						</td>
					</tr>
					<tr>
						<td class=" text-center">5</td>
						<td id="sub">- Latar Belakang</td>
						<td class="text-center">
							<?= ($verifikasi['i_5'] == 'Layak') ? '<i class="nav-icon fa fa-check"></i>' : ''; ?>
						</td>
						<td class="text-center">
							<?= ($verifikasi['i_5'] == 'Kurang') ? '<i class="nav-icon fa fa-check"></i>' : ''; ?>
						</td>
						<td class="text-center">
							<?= ($verifikasi['i_5'] == 'Salah') ? '<i class="nav-icon fa fa-check"></i>' : ''; ?>
						</td>
						<td class="text-center">
							<?= ($verifikasi['i_5'] == 'Tidak_ada') ? '<i class="nav-icon fa fa-check"></i>' : ''; ?>
						</td>
						<td class="text-wrap">
							<?= $verifikasi['c_5']; ?>
						</td>
					</tr>
					<tr>
						<td class="text-center">6</td>
						<td id="sub">- Dasar Hukum</td>
						<td class="text-center">
							<?= ($verifikasi['i_6'] == 'Layak') ? '<i class="nav-icon fa fa-check"></i>' : ''; ?>
						</td>
						<td class="text-center">
							<?= ($verifikasi['i_6'] == 'Kurang') ? '<i class="nav-icon fa fa-check"></i>' : ''; ?>
						</td>
						<td class="text-center">
							<?= ($verifikasi['i_6'] == 'Salah') ? '<i class="nav-icon fa fa-check"></i>' : ''; ?>
						</td>
						<td class="text-center">
							<?= ($verifikasi['i_6'] == 'Tidak_ada') ? '<i class="nav-icon fa fa-check"></i>' : ''; ?>
						</td>
						<td class="text-wrap">
							<?= $verifikasi['c_6']; ?>
						</td>
					</tr>
					<tr>
						<td class="text-center">7</td>
						<td id="sub">- Maksud</td>
						<td class="text-center">
							<?= ($verifikasi['i_7'] == 'Layak') ? '<i class="nav-icon fa fa-check"></i>' : ''; ?>
						</td>
						<td class="text-center">
							<?= ($verifikasi['i_7'] == 'Kurang') ? '<i class="nav-icon fa fa-check"></i>' : ''; ?>
						</td>
						<td class="text-center">
							<?= ($verifikasi['i_7'] == 'Salah') ? '<i class="nav-icon fa fa-check"></i>' : ''; ?>
						</td>
						<td class="text-center">
							<?= ($verifikasi['i_7'] == 'Tidak_ada') ? '<i class="nav-icon fa fa-check"></i>' : ''; ?>
						</td>
						<td class="text-wrap">
							<?= $verifikasi['c_7']; ?>
						</td>
					</tr>
					<tr>
						<td class="text-center">8</td>
						<td id="sub">- Tujuan</td>
						<td class="text-center">
							<?= ($verifikasi['i_8'] == 'Layak') ? '<i class="nav-icon fa fa-check"></i>' : ''; ?>
						</td>
						<td class="text-center">
							<?= ($verifikasi['i_8'] == 'Kurang') ? '<i class="nav-icon fa fa-check"></i>' : ''; ?>
						</td>
						<td class="text-center">
							<?= ($verifikasi['i_8'] == 'Salah') ? '<i class="nav-icon fa fa-check"></i>' : ''; ?>
						</td>
						<td class="text-center">
							<?= ($verifikasi['i_8'] == 'Tidak_ada') ? '<i class="nav-icon fa fa-check"></i>' : ''; ?>
						</td>
						<td class="text-wrap">
							<?= $verifikasi['c_8']; ?>
						</td>
					</tr>
					<tr>
						<td class="text-center">9</td>
						<td class="">PROGRAM DAN KEGIATAN</td>
						<td class="text-center">
							<?= ($verifikasi['i_9'] == 'Layak') ? '<i class="nav-icon fa fa-check"></i>' : ''; ?>
						</td>
						<td class="text-center">
							<?= ($verifikasi['i_9'] == 'Kurang') ? '<i class="nav-icon fa fa-check"></i>' : ''; ?>
						</td>
						<td class="text-center">
							<?= ($verifikasi['i_9'] == 'Salah') ? '<i class="nav-icon fa fa-check"></i>' : ''; ?>
						</td>
						<td class="text-center">
							<?= ($verifikasi['i_9'] == 'Tidak_ada') ? '<i class="nav-icon fa fa-check"></i>' : ''; ?>
						</td>
						<td class="text-wrap">
							<?= $verifikasi['c_9']; ?>
						</td>
					</tr>
					<tr>
						<td class=" text-center">10</td>
						<td id="sub">- Nama Urusan</td>
						<td class="text-center">
							<?= ($verifikasi['i_10'] == 'Layak') ? '<i class="nav-icon fa fa-check"></i>' : ''; ?>
						</td>
						<td class="text-center">
							<?= ($verifikasi['i_10'] == 'Kurang') ? '<i class="nav-icon fa fa-check"></i>' : ''; ?>
						</td>
						<td class="text-center">
							<?= ($verifikasi['i_10'] == 'Salah') ? '<i class="nav-icon fa fa-check"></i>' : ''; ?>
						</td>
						<td class="text-center">
							<?= ($verifikasi['i_10'] == 'Tidak_ada') ? '<i class="nav-icon fa fa-check"></i>' : ''; ?>
						</td>
						<td class="text-wrap">
							<?= $verifikasi['c_10']; ?>
						</td>
					</tr>
					<tr>
						<td class="text-center">11</td>
						<td id="sub">- Nama Program</td>
						<td class="text-center">
							<?= ($verifikasi['i_11'] == 'Layak') ? '<i class="nav-icon fa fa-check"></i>' : ''; ?>
						</td>
						<td class="text-center">
							<?= ($verifikasi['i_11'] == 'Kurang') ? '<i class="nav-icon fa fa-check"></i>' : ''; ?>
						</td>
						<td class="text-center">
							<?= ($verifikasi['i_11'] == 'Salah') ? '<i class="nav-icon fa fa-check"></i>' : ''; ?>
						</td>
						<td class="text-center">
							<?= ($verifikasi['i_11'] == 'Tidak_ada') ? '<i class="nav-icon fa fa-check"></i>' : ''; ?>
						</td>
						<td class="text-wrap">
							<?= $verifikasi['c_11']; ?>
						</td>
					</tr>
					<tr>
						<td class="text-center">12</td>
						<td id="sub">- Nama Kegiatan</td>
						<td class="text-center">
							<?= ($verifikasi['i_12'] == 'Layak') ? '<i class="nav-icon fa fa-check"></i>' : ''; ?>
						</td>
						<td class="text-center">
							<?= ($verifikasi['i_12'] == 'Kurang') ? '<i class="nav-icon fa fa-check"></i>' : ''; ?>
						</td>
						<td class="text-center">
							<?= ($verifikasi['i_12'] == 'Salah') ? '<i class="nav-icon fa fa-check"></i>' : ''; ?>
						</td>
						<td class="text-center">
							<?= ($verifikasi['i_12'] == 'Tidak_ada') ? '<i class="nav-icon fa fa-check"></i>' : ''; ?>
						</td>
						<td class="text-wrap">
							<?= $verifikasi['c_12']; ?>
						</td>
					</tr>
					<tr>
						<td class="text-center">13</td>
						<td id="sub">- Lokus Usulan</td>
						<td class="text-center">
							<?= ($verifikasi['i_13'] == 'Layak') ? '<i class="nav-icon fa fa-check"></i>' : ''; ?>
						</td>
						<td class="text-center">
							<?= ($verifikasi['i_13'] == 'Kurang') ? '<i class="nav-icon fa fa-check"></i>' : ''; ?>
						</td>
						<td class="text-center">
							<?= ($verifikasi['i_13'] == 'Salah') ? '<i class="nav-icon fa fa-check"></i>' : ''; ?>
						</td>
						<td class="text-center">
							<?= ($verifikasi['i_13'] == 'Tidak_ada') ? '<i class="nav-icon fa fa-check"></i>' : ''; ?>
						</td>
						<td class="text-wrap">
							<?= $verifikasi['c_13']; ?>
						</td>
					</tr>
					<tr>
						<td class="text-center">14</td>
						<td id="sub">- Volume</td>
						<td class="text-center">
							<?= ($verifikasi['i_14'] == 'Layak') ? '<i class="nav-icon fa fa-check"></i>' : ''; ?>
						</td>
						<td class="text-center">
							<?= ($verifikasi['i_14'] == 'Kurang') ? '<i class="nav-icon fa fa-check"></i>' : ''; ?>
						</td>
						<td class="text-center">
							<?= ($verifikasi['i_14'] == 'Salah') ? '<i class="nav-icon fa fa-check"></i>' : ''; ?>
						</td>
						<td class="text-center">
							<?= ($verifikasi['i_14'] == 'Tidak_ada') ? '<i class="nav-icon fa fa-check"></i>' : ''; ?>
						</td>
						<td class="text-wrap">
							<?= $verifikasi['c_14']; ?>
						</td>
					</tr>
					<tr>
						<td class="text-center">15</td>
						<td id="sub">- Satuan</td>
						<td class="text-center">
							<?= ($verifikasi['i_15'] == 'Layak') ? '<i class="nav-icon fa fa-check"></i>' : ''; ?>
						</td>
						<td class="text-center">
							<?= ($verifikasi['i_15'] == 'Kurang') ? '<i class="nav-icon fa fa-check"></i>' : ''; ?>
						</td>
						<td class="text-center">
							<?= ($verifikasi['i_15'] == 'Salah') ? '<i class="nav-icon fa fa-check"></i>' : ''; ?>
						</td>
						<td class="text-center">
							<?= ($verifikasi['i_15'] == 'Tidak_ada') ? '<i class="nav-icon fa fa-check"></i>' : ''; ?>
						</td>
						<td class="text-wrap">
							<?= $verifikasi['c_15']; ?>
						</td>
					</tr>
					<tr>
						<td class="text-center">16</td>
						<td id="sub">- Alamat</td>
						<td class="text-center">
							<?= ($verifikasi['i_16'] == 'Layak') ? '<i class="nav-icon fa fa-check"></i>' : ''; ?>
						</td>
						<td class="text-center">
							<?= ($verifikasi['i_16'] == 'Kurang') ? '<i class="nav-icon fa fa-check"></i>' : ''; ?>
						</td>
						<td class="text-center">
							<?= ($verifikasi['i_16'] == 'Salah') ? '<i class="nav-icon fa fa-check"></i>' : ''; ?>
						</td>
						<td class="text-center">
							<?= ($verifikasi['i_16'] == 'Tidak_ada') ? '<i class="nav-icon fa fa-check"></i>' : ''; ?>
						</td>
						<td class="text-wrap">
							<?= $verifikasi['c_16']; ?>
						</td>
					</tr>
					<tr>
						<td class="text-center">17</td>
						<td class="">PENUTUP</td>
						<td class="text-center">
							<?= ($verifikasi['i_17'] == 'Layak') ? '<i class="nav-icon fa fa-check"></i>' : ''; ?>
						</td>
						<td class="text-center">
							<?= ($verifikasi['i_17'] == 'Kurang') ? '<i class="nav-icon fa fa-check"></i>' : ''; ?>
						</td>
						<td class="text-center">
							<?= ($verifikasi['i_17'] == 'Salah') ? '<i class="nav-icon fa fa-check"></i>' : ''; ?>
						</td>
						<td class="text-center">
							<?= ($verifikasi['i_17'] == 'Tidak_ada') ? '<i class="nav-icon fa fa-check"></i>' : ''; ?>
						</td>
						<td class="text-wrap">
							<?= $verifikasi['c_17']; ?>
						</td>
					</tr>
					<tr>
						<td class="text-center">18</td>
						<td class="">LAMPIRAN</td>
						<td class="text-center">
							<?= ($verifikasi['i_18'] == 'Layak') ? '<i class="nav-icon fa fa-check"></i>' : ''; ?>
						</td>
						<td class="text-center">
							<?= ($verifikasi['i_18'] == 'Kurang') ? '<i class="nav-icon fa fa-check"></i>' : ''; ?>
						</td>
						<td class="text-center">
							<?= ($verifikasi['i_18'] == 'Salah') ? '<i class="nav-icon fa fa-check"></i>' : ''; ?>
						</td>
						<td class="text-center">
							<?= ($verifikasi['i_18'] == 'Tidak_ada') ? '<i class="nav-icon fa fa-check"></i>' : ''; ?>
						</td>
						<td class="text-wrap">
							<?= $verifikasi['c_18']; ?>
						</td>
					</tr>
					<tr>
						<td class="text-center">19</td>
						<td id="sub">- Perencanaan /DED/KAK</td>
						<td class="text-center">
							<?= ($verifikasi['i_19'] == 'Layak') ? '<i class="nav-icon fa fa-check"></i>' : ''; ?>
						</td>
						<td class="text-center">
							<?= ($verifikasi['i_19'] == 'Kurang') ? '<i class="nav-icon fa fa-check"></i>' : ''; ?>
						</td>
						<td class="text-center">
							<?= ($verifikasi['i_19'] == 'Salah') ? '<i class="nav-icon fa fa-check"></i>' : ''; ?>
						</td>
						<td class="text-center">
							<?= ($verifikasi['i_19'] == 'Tidak_ada') ? '<i class="nav-icon fa fa-check"></i>' : ''; ?>
						</td>
						<td class="text-wrap">
							<?= $verifikasi['c_19']; ?>
						</td>
					</tr>
					<tr>
						<td class="text-center">20</td>
						<td id="sub">- RAB</td>
						<td class="text-center">
							<?= ($verifikasi['i_20'] == 'Layak') ? '<i class="nav-icon fa fa-check"></i>' : ''; ?>
						</td>
						<td class="text-center">
							<?= ($verifikasi['i_20'] == 'Kurang') ? '<i class="nav-icon fa fa-check"></i>' : ''; ?>
						</td>
						<td class="text-center">
							<?= ($verifikasi['i_20'] == 'Salah') ? '<i class="nav-icon fa fa-check"></i>' : ''; ?>
						</td>
						<td class="text-center">
							<?= ($verifikasi['i_20'] == 'Tidak_ada') ? '<i class="nav-icon fa fa-check"></i>' : ''; ?>
						</td>
						<td class="text-wrap">
							<?= $verifikasi['c_20']; ?>
						</td>
					</tr>
					<tr>
						<td class="text-center">21</td>
						<td id="sub">- Pra RKA</td>
						<td class="text-center">
							<?= ($verifikasi['i_21'] == 'Layak') ? '<i class="nav-icon fa fa-check"></i>' : ''; ?>
						</td>
						<td class="text-center">
							<?= ($verifikasi['i_21'] == 'Kurang') ? '<i class="nav-icon fa fa-check"></i>' : ''; ?>
						</td>
						<td class="text-center">
							<?= ($verifikasi['i_21'] == 'Salah') ? '<i class="nav-icon fa fa-check"></i>' : ''; ?>
						</td>
						<td class="text-center">
							<?= ($verifikasi['i_21'] == 'Tidak_ada') ? '<i class="nav-icon fa fa-check"></i>' : ''; ?>
						</td>
						<td class="text-wrap">
							<?= $verifikasi['c_21']; ?>
						</td>
					</tr>
					<tr>
						<td class="text-center">22</td>
						<td id="sub">- Dokumentasi</td>
						<td class="text-center">
							<?= ($verifikasi['i_22'] == 'Layak') ? '<i class="nav-icon fa fa-check"></i>' : ''; ?>
						</td>
						<td class="text-center">
							<?= ($verifikasi['i_22'] == 'Kurang') ? '<i class="nav-icon fa fa-check"></i>' : ''; ?>
						</td>
						<td class="text-center">
							<?= ($verifikasi['i_22'] == 'Salah') ? '<i class="nav-icon fa fa-check"></i>' : ''; ?>
						</td>
						<td class="text-center">
							<?= ($verifikasi['i_22'] == 'Tidak_ada') ? '<i class="nav-icon fa fa-check"></i>' : ''; ?>
						</td>
						<td class="text-wrap">
							<?= $verifikasi['c_22']; ?>
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
							<?= ($verifikasi['ii_1'] == 'Layak') ? '<i class="nav-icon fa fa-check"></i>' : ''; ?>
						</td>
						<td class="text-center">
							<?= ($verifikasi['ii_1'] == 'Kurang') ? '<i class="nav-icon fa fa-check"></i>' : ''; ?>
						</td>
						<td class="text-center">
							<?= ($verifikasi['ii_1'] == 'Salah') ? '<i class="nav-icon fa fa-check"></i>' : ''; ?>
						</td>
						<td class="text-center">
							<?= ($verifikasi['ii_1'] == 'Tidak_ada') ? '<i class="nav-icon fa fa-check"></i>' : ''; ?>
						</td>
						<td class="text-wrap">
							<?= $verifikasi['ii_c_1']; ?>
						</td>
					</tr>
					<tr>
						<td class="text-center">2</td>
						<td class="text-wrap">Keterkaitan usulan kegiatan terhadap prioritas daerah, pencapaian target kinerja pembangunan daerah Tahun 2024</td>
						<td class="text-center">
							<?= ($verifikasi['ii_2'] == 'Layak') ? '<i class="nav-icon fa fa-check"></i>' : ''; ?>
						</td>
						<td class="text-center">
							<?= ($verifikasi['ii_2'] == 'Kurang') ? '<i class="nav-icon fa fa-check"></i>' : ''; ?>
						</td>
						<td class="text-center">
							<?= ($verifikasi['ii_2'] == 'Salah') ? '<i class="nav-icon fa fa-check"></i>' : ''; ?>
						</td>
						<td class="text-center">
							<?= ($verifikasi['ii_2'] == 'Tidak_ada') ? '<i class="nav-icon fa fa-check"></i>' : ''; ?>
						</td>
						<td class="text-wrap">
							<?= $verifikasi['ii_c_2']; ?>
						</td>
					</tr>
					<tr>
						<td class="text-center">3</td>
						<td class="text-wrap">Kewajaran besaran pagu yang diusulkan berdasarkan standar biaya daerah</td>
						<td class="text-center">
							<?= ($verifikasi['ii_3'] == 'Layak') ? '<i class="nav-icon fa fa-check"></i>' : ''; ?>
						</td>
						<td class="text-center">
							<?= ($verifikasi['ii_3'] == 'Kurang') ? '<i class="nav-icon fa fa-check"></i>' : ''; ?>
						</td>
						<td class="text-center">
							<?= ($verifikasi['ii_3'] == 'Salah') ? '<i class="nav-icon fa fa-check"></i>' : ''; ?>
						</td>
						<td class="text-center">
							<?= ($verifikasi['ii_3'] == 'Tidak_ada') ? '<i class="nav-icon fa fa-check"></i>' : ''; ?>
						</td>
						<td class="text-wrap">
							<?= $verifikasi['ii_c_3']; ?>
						</td>
					</tr>
					<tr>
						<td colspan="7" class="">Kesimpulan Pemeriksaan : Bahwa Dokumen Usulan/ Proposal tersebut diatas dinyatakan:</td>
					</tr>
					<tr>
						<td colspan="2" class="">1. TELAH MEMENUHI SYARAT</td>
						<td class="text-center">
							<?= ($verifikasi['syarat'] == 'telah') ? '<i class="nav-icon fa fa-check"></i>' : ''; ?>
						</td>
						<td colspan="4" class="">Maka bisa dilanjutkan ke proses selanjutnya</td>
					</tr>
					<tr>
						<td colspan="2" class="">2. BELUM MEMENUHI SYARAT</td>
						<td class="text-center">
							<?= ($verifikasi['syarat'] == 'belum') ? '<i class="nav-icon fa fa-check"></i>' : ''; ?>
						</td>
						<td colspan="4" class="">Maka perlu diperbaiki dulu oleh SKPD pengusul</td>
					</tr>
				</tbody>
			</table>
		</div>
		<div class="col-5">
			<iframe src="<?= base_url('/user/proposal/pengajuan/show/' . kunci($proposal['id_proposal'])); ?>" style="width: 100%;height:100%;"></iframe>
		</div>
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
<?= $this->endSection(); ?>