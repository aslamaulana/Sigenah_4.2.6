<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title><?= $title; ?></title>
	<!-- <link rel="icon" href="../../../../favicon.ico"> -->
	<!-- <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback"> -->
	<link rel="stylesheet" href="<?= base_url('/toping/plugins/fontawesome-free/css/all.min.css') ?>">
	<link rel="stylesheet" href="<?= base_url('/toping/dist/css/ionicons.min.css') ?>">
	<link rel="stylesheet" href="<?= base_url('/toping/plugins/icheck-bootstrap/icheck-bootstrap.min.css') ?>">
	<link rel="stylesheet" href="<?= base_url('/toping/dist/css/adminlte.min.css') ?>">
	<link rel="stylesheet" href="<?= base_url('/toping/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') ?>">
	<link rel="stylesheet" href="<?= base_url('/toping/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css') ?>">
	<script src="<?= base_url('/toping/plugins/sweetalert2/sweetalert2.min.js') ?>"></script>
	<style>
		.tooltip-inner {
			max-width: none;
			white-space: nowrap;
			background: black;
			border: 1px solid lightgray;
			-webkit-box-shadow: 0px 3px 3px 0px rgba(0, 0, 0, 0.3);
			-moz-box-shadow: 0px 3px 3px 0px rgba(0, 0, 0, 0.3);
			box-shadow: 0px 3px 3px 0px rgba(0, 0, 0, 0.3);
			color: #fff;
			margin: 0;
			text-align: left;
			padding: 10px;
		}

		.tooltip.right .tooltip-arrow {
			top: 50;
			left: 50%;
			margin-left: -10px;
			border-right-color: red;
			/* black */
			border-width: 0 5px 5px;
		}
	</style>
	<?= $this->renderSection('stylesheet'); ?>
</head>