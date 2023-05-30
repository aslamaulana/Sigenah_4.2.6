<?= $this->extend('_layout/template'); ?>

<?= $this->section('stylesheet'); ?>
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

	// ============================================================
	// var layer_ADMINISTRASI = new L.GeoJSON.AJAX("layer/request_bali.php", { // sekarang perintahnya diawali dengan variabel
	// 	style: function(feature) {
	// 		var fillColor, // ini style yang akan digunakan
	// 			kode = feature.properties.kode_kab; // pewarnaan objek polygon berdasarkan kode kabupaten di dalam file geojson
	// 		if (kode > 5171) fillColor = "#ffd700";
	// 		else if (kode > 5108) fillColor = "#4ba754";
	// 		else if (kode > 5107) fillColor = "#9b3339";
	// 		else if (kode > 5106) fillColor = "#dd38e0";
	// 		else if (kode > 5105) fillColor = "#908965";
	// 		else if (kode > 5104) fillColor = "#3ab7e9";
	// 		else if (kode > 5103) fillColor = "#c8cf06";
	// 		else if (kode > 5102) fillColor = "#2f838c";
	// 		else if (kode > 5101) fillColor = "#fede36";
	// 		else fillColor = "#ff4040"; // no data
	// 		return {
	// 			color: "#999",
	// 			dashArray: '3',
	// 			weight: 2,
	// 			fillColor: fillColor,
	// 			fillOpacity: 1
	// 		}; // style border sertaa transparansi
	// 	},
	// 	onEachFeature: function(feature, layer) {
	// 		layer.bindPopup("<center>" + feature.properties.kab_kot + "</center>"), // popup yang akan ditampilkan diambil dari filed kab_kot
	// 			that = this; // perintah agar menghasilkan efek hover pada objek layer
	// 		layer.on('mouseover', function(e) {
	// 			this.setStyle({
	// 				weight: 2,
	// 				color: '#72152b',
	// 				dashArray: '',
	// 				fillOpacity: 0.8
	// 			});
	// 			if (!L.Browser.ie && !L.Browser.opera) {
	// 				layer.bringToFront();
	// 			}
	// 			info.update(layer.feature.properties);
	// 		});
	// 		layer.on('mouseout', function(e) {
	// 			layer_ADMINISTRASI.resetStyle(e.target); // isi dengan nama variabel dari layer
	// 			info.update();
	// 		});
	// 	}
	// }).addTo(map);
</script>

<script>
	// // MENGATUR TITIK KOORDINAT TITIK TENGAN & LEVEL ZOOM PADA BASEMAP
	// var map = L.map('map').setView([-8.4521135, 115.0599022], 10);

	// // MENAMPILKAN SKALA
	// L.control.scale({
	// 	imperial: false
	// }).addTo(map);
	// // ------------------- VECTOR ----------------------------
	// var layer_ADMINISTRASI = new L.GeoJSON.AJAX("layer/request_bali.php", { // sekarang perintahnya diawali dengan variabel
	// 	style: function(feature) {
	// 		var fillColor, // ini style yang akan digunakan
	// 			kode = feature.properties.kode_kab; // perwarnaan objek polygon berdasarkan kode kabupaten di dalam file geojson
	// 		if (kode > 5171) fillColor = "#ffd700";
	// 		else if (kode > 5108) fillColor = "#4ba754";
	// 		else if (kode > 5107) fillColor = "#9b3339";
	// 		else if (kode > 5106) fillColor = "#dd38e0";
	// 		else if (kode > 5105) fillColor = "#908965";
	// 		else if (kode > 5104) fillColor = "#3ab7e9";
	// 		else if (kode > 5103) fillColor = "#c8cf06";
	// 		else if (kode > 5102) fillColor = "#2f838c";
	// 		else if (kode > 5101) fillColor = "#fede36";
	// 		else fillColor = "#ff4040"; // no data
	// 		return {
	// 			color: "#999",
	// 			dashArray: '3',
	// 			weight: 2,
	// 			fillColor: fillColor,
	// 			fillOpacity: 1
	// 		}; // style border sertaa transparansi
	// 	},
	// 	onEachFeature: function(feature, layer) {
	// 		layer.bindPopup("<center>" + feature.properties.nama + "</center>"), // popup yang akan ditampilkan diambil dari filed kab_kot
	// 			that = this; // perintah agar menghasilkan efek hover pada objek layer

	// 		layer.on('mouseover', function(e) {
	// 			this.setStyle({
	// 				weight: 2,
	// 				color: '#72152b',
	// 				dashArray: '',
	// 				fillOpacity: 0.8
	// 			});

	// 			if (!L.Browser.ie && !L.Browser.opera) {
	// 				layer.bringToFront();
	// 			}

	// 			info.update(layer.feature.properties);
	// 		});
	// 		layer.on('mouseout', function(e) {
	// 			layer_ADMINISTRASI.resetStyle(e.target); // isi dengan nama variabel dari layer
	// 			info.update();
	// 		});
	// 	}
	// }).addTo(map);
	// var layer_GEOLOGI = new L.GeoJSON.AJAX("layer/request_geologi.php", { // layer geologi berada di dalam variabel layer_geologi
	// 	style: function(feature) {
	// 		var fillColor, // ini style yang akan digunakan
	// 			kode = feature.properties.kode; // perwarnaan objek polygon berdasarkan field kode  di dalam file geojson
	// 		if (kode > 17) fillColor = "#ffd700";
	// 		else if (kode > 16) fillColor = "#E3912B";
	// 		else if (kode > 15) fillColor = "#ED6933";
	// 		else if (kode > 14) fillColor = "#0070FF";
	// 		else if (kode > 13) fillColor = "#F5731C";
	// 		else if (kode > 12) fillColor = "#BFD9FF";
	// 		else if (kode > 11) fillColor = "#8C140D";
	// 		else if (kode > 10) fillColor = "#FFC400";
	// 		else if (kode > 9) fillColor = "#FF5500";
	// 		else if (kode > 8) fillColor = "#F79400";
	// 		else if (kode > 7) fillColor = "#FFBEBE";
	// 		else if (kode > 6) fillColor = "#97DBF2";
	// 		else if (kode > 5) fillColor = "#FF4766";
	// 		else if (kode > 4) fillColor = "#F27066";
	// 		else if (kode > 3) fillColor = "#732400";
	// 		else if (kode > 2) fillColor = "#A83800";
	// 		else if (kode > 1) fillColor = "#E64200";
	// 		else fillColor = "#FFFFED"; // no data
	// 		return {
	// 			color: "#999",
	// 			dashArray: '3',
	// 			weight: 2,
	// 			fillColor: fillColor,
	// 			fillOpacity: 1
	// 		}; // style border sertaa transparansi

	// 	},
	// 	onEachFeature: function(feature, layer) {
	// 		layer.bindPopup("<center>" + "<strong>" + feature.properties.nama + "</strong>" + "<br/>" + feature.properties.keterangan + "</center>"), // popup yang akan ditampilkan diambil dari field nama dan keterangan
	// 			that = this; // perintah agar menghasilkan efek hover pada objek layer

	// 		layer.on('mouseover', function(e) {
	// 			this.setStyle({
	// 				weight: 2,
	// 				color: '#72152b',
	// 				dashArray: '',
	// 				fillOpacity: 0.8
	// 			});

	// 			if (!L.Browser.ie && !L.Browser.opera) {
	// 				layer.bringToFront();
	// 			}

	// 			info.update(layer.feature.properties);
	// 		});
	// 		layer.on('mouseout', function(e) {
	// 			layer_GEOLOGI.resetStyle(e.target); // isi dengan nama variabel dari layer
	// 			info.update();
	// 		});
	// 	}
	// }).addTo(map);
	// // MENAMBAHKAN TOOL PENCARIAN
	// var searchlayer = L.featureGroup([layer_ADMINISTRASI, layer_GEOLOGI]);
	// L.Control.Search.include({
	// 	_recordsFromLayer: function() { //return table: key,value from layer
	// 		var that = this,
	// 			retRecords = {},
	// 			propName = this.options.propertyName,
	// 			loc;

	// 		function searchInLayer(layer) {
	// 			if (layer instanceof L.Control.Search.Marker) return;

	// 			if (layer instanceof L.Marker || layer instanceof L.CircleMarker) {
	// 				if (that._getPath(layer.options, propName)) {
	// 					loc = layer.getLatLng();
	// 					loc.layer = layer;
	// 					retRecords[that._getPath(layer.options, propName)] = loc;

	// 				} else if (that._getPath(layer.feature.properties, propName)) {

	// 					loc = layer.getLatLng();
	// 					loc.layer = layer;
	// 					retRecords[that._getPath(layer.feature.properties, propName)] = loc;

	// 				} else {
	// 					throw new Error("propertyName '" + propName + "' not found in marker");
	// 				}
	// 			} else if (layer.hasOwnProperty('feature')) { //GeoJSON

	// 				if (layer.feature.properties.hasOwnProperty(propName)) {
	// 					loc = layer.getBounds().getCenter();
	// 					loc.layer = layer;
	// 					retRecords[layer.feature.properties[propName]] = loc;
	// 				} else {
	// 					throw new Error("propertyName '" + propName + "' not found in feature");
	// 				}
	// 			} else if (layer instanceof L.LayerGroup) {
	// 				//TODO: Optimize
	// 				layer.eachLayer(searchInLayer, this);
	// 			}
	// 		}

	// 		this._layer.eachLayer(searchInLayer, this);

	// 		return retRecords;
	// 	}
	// });

	// L.control.search({

	// 		layer: searchlayer,

	// 		propertyName: 'nama', // nama field yang akan dijadikan acuan di dalam tool pencarian
	// 		moveToLocation: function(latlng, title, map) {
	// 			//map.fitBounds( latlng.layer.getBounds() );
	// 			var zoom = map.getBoundsZoom(latlng.layer.getBounds());
	// 			map.setView(latlng, zoom); // access the zoom
	// 		}
	// 	})
	// 	.addTo(map);

	// // menambahkan tools defautl extent
	// L.control.defaultExtent().addTo(map);
	// // PILIHAN BASEMAP YANG AKAN DITAMPILKAN
	// var baseLayers = {
	// 	'Esri.WorldTopoMap': L.tileLayer.provider('Esri.WorldTopoMap').addTo(map),
	// 	'Esri WorldImagery': L.tileLayer.provider('Esri.WorldImagery')
	// };
	// // membuat pilihan untuk menampilkan layer
	// var overlays = {
	// 	"PROVINSI BALI": {
	// 		"Administrasi": layer_ADMINISTRASI,
	// 		"Geologi": layer_GEOLOGI
	// 	}
	// };
	// var options = {
	// 	exclusiveGroups: ["PROVINSI BALI"]
	// };
	// // MENAMPILKAN TOOLS UNTUK MEMILIH BASEMAP
	// L.control.groupedLayers(baseLayers, overlays, options).addTo(map);
</script>
<?= $this->endSection(); ?>