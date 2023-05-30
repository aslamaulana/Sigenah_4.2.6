<?= $this->extend('_layout/template'); ?>

<?= $this->section('stylesheet'); ?>
<link rel="stylesheet" href="<?= base_url('/toping/leaflet/leaflet.css') ?>">
<script src="<?= base_url('/toping/leaflet/leaflet.js') ?>"></script>

<style>
	/* ukuran peta */
	#mapid {
		height: 100%;
	}

	.jumbotron {
		height: 100%;
		border-radius: 0;
	}

	body {
		background-color: #ebe7e1;
	}
</style>
<?= $this->endSection(); ?>

<?= $this->section('content'); ?>
<div class="card-body">
	<div class="row"> <!-- class row digunakan sebelum membuat column  -->
		<div class="col-5 overflow-auto" style="height: 65vh;">
			<form action="<?= base_url('/user/proposal/pengajuan/proposal_update'); ?>" method="POST" enctype="multipart/form-data">
				<?= csrf_field() ?>
				<div class="form-group">
					<label>Usulan Kegiatan</label>
					<select class="form-control" name="usulan" id="" required>
						<option value="">--Kategori Tempat--</option>
						<option value="rumah makan">Rumah Makan</option>
						<option value="pom bensin">Pom Bensin</option>
						<option value="Fasilitas Umum">Fasilitas Umum</option>
						<option value="Pasar/Mall">Pasar/Mall</option>
						<option value="rumah sakit">Rumah Sakit</option>
						<option value="Sekolah">Sekolah</option>
					</select>
				</div>
				<div class="form-group">
					<label>Judul Kegiatan</label>
					<input type="text" class="form-control" value="<?= old('kegiatan') ? old('kegiatan') : $proposal['judul_kegiatan']; ?>" name="kegiatan" required>
					<input type="hidden" value="<?= $proposal['id_proposal']; ?>" name="id_proposal">
				</div>
				<div class="form-group">
					<label>Permasalahan</label>
					<input type="text" class="form-control" value="<?= old('permasalahan') ? old('permasalahan') : $proposal['permasalahan']; ?>" name="permasalahan" required>
				</div>
				<div class="form-group">
					<label>Usulan Anggaran</label>
					<input type="text" class="form-control" value="<?= old('anggaran') ? old('anggaran') : $proposal['usulan_anggaran']; ?>" name="anggaran" required>
				</div>
				<div class="form-group">
					<label>Titik Lokasi (Map)</label>
					<input type="text" class="form-control" id="latlong" value="<?= old('map') ? old('map') : $proposal['titik_lokasi']; ?>" name="map" placeholder="Pilih dari Map" required>
				</div>
				<div class="form-group">
					<label for="exampleFormControlInput1">Alamat</label>
					<textarea class="form-control" name="alamat" cols="30" rows="2" required><?= old('alamat') ? old('alamat') : $proposal['alamat']; ?></textarea>
				</div>
				<div class="form-group" style="overflow: hidden;">
					<label>Upload Proposal</label>
					<div class="input-group">
						<div class="custom-file">
							<input type="file" name="file" class="custom-file-input <?= $validation->getError('file') ? 'is-invalid' : ''; ?>" id="file" accept=".Pdf, .pdf" /></p>
							<label class="custom-file-label"><?= $proposal['dokumen']; ?></label>
							<input type="hidden" value="<?= $proposal['dokumen']; ?>" name="file-old">
							<input type="hidden" value="<?= $proposal['size']; ?>" name="size-old">
						</div>
					</div>
					<?php if ($validation->getError('file')) : ?>
						<div style="font-size: smaller;color: red;padding-top: 5px;">
							<?= $validation->getError('file'); ?>
						</div>
					<?php endif; ?>
				</div>
				<div class="form-group">
					<button type="submit" class="btn btn-info">Add</button>
				</div>
			</form>
		</div>
		<div class="col-7">
			<div id="mapid"></div>
		</div>
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

	// set lokasi latitude dan longitude, lokasinya kota palembang 
	var mymap = L.map('mapid').setView([-7.629538, 108.530578], 11);
	//setting maps menggunakan api mapbox bukan google maps, daftar dan dapatkan token  

	L.tileLayer(
		'https://api.maptiler.com/maps/openstreetmap/{z}/{x}/{y}.jpg?key=i0mwSf7DPjH2JjoVNyFa', {
			attribution: 'Map data &copy; <a href="">Kangsommay</a> ',
			maxZoom: 20,
			id: 'mapbox/streets-v11', //menggunakan peta model streets-v11 kalian bisa melihat jenis-jenis peta lainnnya di web resmi mapbox
			tileSize: 512,
			zoomOffset: -1,
			accessToken: 'i0mwSf7DPjH2JjoVNyFa'
		}).addTo(mymap);

	// buat variabel berisi fugnsi L.popup 
	var popup = L.popup();

	// buat fungsi popup saat map diklik
	function onMapClick(e) {
		popup
			.setLatLng(e.latlng)
			.setContent("koordinatnya adalah " + e.latlng
				.toString()
			) //set isi konten yang ingin ditampilkan, kali ini kita akan menampilkan latitude dan longitude
			.openOn(mymap);

		document.getElementById('latlong').value = e.latlng //value pada form latitde, longitude akan berganti secara otomatis
	}
	mymap.on('click', onMapClick); //jalankan fungsi

	<?php if (old('map')) { ?>
		L.marker([<?php echo str_replace(['[', ']', 'LatLng', '(', ')'], '', old('map')); ?>]).addTo(mymap)
		// L.marker([-7.692525, 108.537353]).addTo(mymap)
	<?php } else { ?>
		L.marker([<?php echo str_replace(['[', ']', 'LatLng', '(', ')'], '', $proposal['titik_lokasi']); ?>]).addTo(mymap)
	<?php } ?>
</script>

<?= $this->endSection(); ?>