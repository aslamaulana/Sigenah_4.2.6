<?= $this->extend('_layout/template'); ?>

<?= $this->section('stylesheet'); ?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.7.1/leaflet.css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/leaflet-groupedlayercontrol/0.6.1/leaflet.groupedlayercontrol.min.css" />

<style>
	/* ukuran peta */
	#mapid {
		height: 50%;
	}

	#map {
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
			<form action="<?= base_url('/user/proposal/pengajuan/proposal_create'); ?>" method="POST" enctype="multipart/form-data">
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
					<input type="text" class="form-control" value="<?= old('kegiatan'); ?>" name="kegiatan" required>
				</div>
				<div class="form-group">
					<label>Permasalahan</label>
					<input type="text" class="form-control" value="<?= old('permasalahan'); ?>" name="permasalahan" required>
				</div>
				<div class="form-group">
					<label>Usulan Anggaran</label>
					<input type="text" class="form-control" value="<?= old('anggaran'); ?>" name="anggaran" required>
				</div>
				<div class="form-group">
					<label>Titik Lokasi (Map)</label>
					<input type="text" class="form-control" id="latlong" value="<?= old('map'); ?>" name="map" placeholder="Pilih dari Map" required>
				</div>
				<div class="form-group">
					<label for="exampleFormControlInput1">Alamat</label>
					<textarea class="form-control" name="alamat" cols="30" rows="2" required><?= old('alamat'); ?></textarea>
				</div>
				<div class="form-group" style="overflow: hidden;">
					<label>Upload Proposal</label>
					<div class="input-group">
						<div class="custom-file">
							<input type="file" name="file" class="custom-file-input <?php if ($validation->getError('file')) : ?>is-invalid<?php endif ?>" id="file" required accept=".Pdf, .pdf" /></p>
							<label class="custom-file-label">Pilih dokumen [.pdf] Max 20Mb</label>
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
			<!-- <div id="mapid"></div> -->
			<div id="map"></div>
		</div>
	</div>
</div>

<?= $this->endSection(); ?>

<?= $this->section('Javascript'); ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.7.1/leaflet.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet-ajax/2.1.0/leaflet.ajax.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet-providers/1.12.0/leaflet-providers.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet-groupedlayercontrol/0.6.1/leaflet.groupedlayercontrol.min.js"></script>
<script>
	$(".custom-file-input").on("change", function() {
		var fileName = $(this).val().split("\\").pop();
		$(this).siblings(".custom-file-label").addClass("selected").html(fileName);
	});
	$(".file-input").on("change", function() {
		var fileName = $(this).val().split("\\").pop();
		$(this).siblings(".file-label").addClass("selected").html(fileName);
	});

	// // set lokasi latitude dan longitude, lokasinya kota palembang 
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

	// // buat variabel berisi fugnsi L.popup 
	// var popup = L.popup();

	// // buat fungsi popup saat map diklik
	// function onMapClick(e) {
	// 	popup
	// 		.setLatLng(e.latlng)
	// 		.setContent("koordinatnya adalah " + e.latlng
	// 			.toString()
	// 		) //set isi konten yang ingin ditampilkan, kali ini kita akan menampilkan latitude dan longitude
	// 		.openOn(mymap);

	// 	document.getElementById('latlong').value = e.latlng //value pada form latitde, longitude akan berganti secara otomatis
	// }
	// mymap.on('click', onMapClick); //jalankan fungsi

	// <?php if (old('map')) : ?>
	// 	L.marker([<?php echo str_replace(['[', ']', 'LatLng', '(', ')'], '', old('map')); ?>]).addTo(mymap)
	// 	// L.marker([-7.692525, 108.537353]).addTo(mymap)
	// <?php endif; ?>
</script>

<script>
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

	var groupedOverlays = {
		"Group 1": {
			"Overlay 1": ""
		},
		"Group 2": {
			"Overlay 2": ""
		}
	};

	// Menambahkan kontrol grup layer ke peta
	// L.control.groupedLayers(baseLayers, groupedOverlays).addTo(map);
	// // MENAMPILKAN TOOLS UNTUK MEMILIH BASEMAP
	L.control.layers(baseLayers, {}).addTo(map);


	// // Membuat layer group untuk GeoJSON
	var geojsonLayer = L.layerGroup().addTo(map);

	// URL file GeoJSON
	var geojsonUrl = '<?= base_url('/batas_desa_pangandaran.geojson'); ?>';

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
						weight: 1,
						opacity: 1
					}; // ini adalah style yang akan digunakan
				},
				// MENAMPILKAN POPUP DENGAN ISI BERDASARKAN ATRIBUT KAB_KOTA
				onEachFeature: function(feature, layer) {
					layer.bindPopup("<center>" + feature.properties.desa + "</center>")
				}
			}).addTo(geojsonLayer);
		})
		.catch(error => {
			console.error('Error:', error);
		});
</script>

<?= $this->endSection(); ?>