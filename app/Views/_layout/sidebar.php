<aside class="main-sidebar sidebar-dark-primary elevation-4">
	<!-- Brand Logo -->
	<a href="#" class="brand-link" style="text-align: center;">
		<div class="image">
			<img src="<?= base_url('/toping/material/logo.png'); ?>" alt="AdminLTE Logo" style="width: -webkit-fill-available;max-width: 40px;margin-left: .8rem;">
			<span class="brand-text font-weight-light" style="font-family: monospace;" title="Sistem Informasi Pengendalian dan Evaluasi Kinerja Pembangunan Daerah"> SiGenah</span>
		</div>
		<!-- <img src="<?= base_url('/toping/material/logo.png'); ?>" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8"> -->
	</a>

	<!-- Sidebar -->
	<div class="sidebar">
		<!-- Sidebar user panel (optional) -->
		<div class="user-panel mt-3 pb-3 mb-3 text-center">
			<!-- <div class="image">
				<img src="<?= base_url('/toping/dist/img/user2-160x160.jpg') ?>" class="img-circle elevation-2" alt="User Image">
			</div> -->
			<div class="info">
				<a href="#" class="d-block"><?= user()->username; ?></a>
			</div>
		</div>

		<!-- SidebarSearch Form -->
		<div class="form-inline">
			<div class="input-group" data-widget="sidebar-search">
				<input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
				<div class="input-group-append">
					<button class="btn btn-sidebar">
						<i class="fas fa-search fa-fw"></i>
					</button>
				</div>
			</div>
		</div>

		<nav class="mt-2">
			<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
				<li class="nav-item ">
					<a href="<?= base_url('/'); ?>" class="nav-link <?= $mn == 'home' ? 'active' : ''; ?>">
						<i class="nav-icon fas fa-tachometer-alt"></i>
						<p>
							Dashboard
							<!-- <i class="right fas fa-angle-left"></i> -->
						</p>
					</a>
				</li>
				<li class="nav-item <?= $gr == 'opd' ? 'menu-open' : ''; ?>">
					<a href="#" class="nav-link <?= $gr == 'opd' ? 'active' : ''; ?>">
						<i class="nav-icon fas fa-house-user"></i>
						<p>
							OPD
							<i class="fas fa-angle-left right"></i>
						</p>
					</a>
					<ul class="nav nav-treeview">
						<li class="nav-item">
							<a href="<?= base_url('/user/user/users/user'); ?>" class="nav-link <?= $mn == 'bidang' ? 'active' : ''; ?>">
								<i class="far nav-icon"></i>
								<p><small>1. </small> Bidang & Sub Bidang</p>
							</a>
						</li>
					</ul>
				</li>
				<!-- =============================================================== -->
				<li class="nav-header">=====================</li>
				<!-- =============================================================== -->
				<li class="nav-item  <?= $gr == 'Dokumen' || $gr == 'Renstra' || $gr == 'rkpd' ? 'menu-open' : ''; ?>">
					<a href="#" class="nav-link <?= $gr == 'Dokumen' || $gr == 'Renstra' || $gr == 'rkpd' ? 'active' : ''; ?>" title="Data Perencanaan">
						<i class="nav-icon fas fa-circle"></i>
						<p>
							DARA
							<i class="right fas fa-angle-left"></i>
						</p>
					</a>
					<ul class="nav nav-treeview">
						<li class="nav-item <?= $gr == 'Renstra' ? 'menu-open' : ''; ?>">
							<a href="#" class="nav-link <?= $gr == 'Renstra' ? 'active' : ''; ?>">
								<i class="nav-icon fab fa-buffer"></i>
								<p>
									RENSTRA
									<i class="right fas fa-angle-left"></i>
								</p>
							</a>
							<ul class="nav nav-treeview">
								<li class="nav-item">
									<a href="<?= base_url('/user/renstra/opd_tujuan'); ?>" class="nav-link <?= $mn == 'opd_tujuan' ? 'active' : ''; ?>">
										<i class="far nav-icon"></i>
										<p><small>1. </small> Tujuan</p>
									</a>
								</li>
								<li class="nav-item">
									<a href="<?= base_url('/user/renstra/opd_sasaran'); ?>" class="nav-link <?= $mn == 'opd_sasaran' ? 'active' : ''; ?>">
										<i class="far nav-icon"></i>
										<p><small>2. </small> Sasaran</p>
									</a>
								</li>
								<li class="nav-item">
									<a href="<?= base_url('/user/renstra/opd_strategi'); ?>" class="nav-link <?= $mn == 'opd_strategi' ? 'active' : ''; ?>">
										<i class="far nav-icon"></i>
										<p><small>3. </small> Strategi</p>
									</a>
								</li>
								<li class="nav-item">
									<a href="<?= base_url('/user/renstra/opd_arah_kebijakan'); ?>" class="nav-link <?= $mn == 'opd_arah_kebijakan' ? 'active' : ''; ?>">
										<i class="far nav-icon"></i>
										<p><small>4. </small> Arah Kebijakan</p>
									</a>
								</li>
								<li class="nav-item">
									<a href="<?= base_url('/user/renstra/opd_program'); ?>" class="nav-link <?= $mn == 'opd_program' ? 'active' : ''; ?>">
										<i class="far nav-icon"></i>
										<p><small>5.</small> Program</p>
									</a>
								</li>
								<li class="nav-item">
									<a href="<?= base_url('/user/renstra/opd_kegiatan'); ?>" class="nav-link <?= $mn == 'opd_kegiatan' ? 'active' : ''; ?>">
										<i class="far nav-icon"></i>
										<p><small>6. </small> Kegiatan</p>
									</a>
								</li>
								<li class="nav-item">
									<a href="<?= base_url('/user/renstra/opd_kegiatan_sub'); ?>" class="nav-link <?= $mn == 'opd_kegiatan_sub' ? 'active' : ''; ?>">
										<i class="far nav-icon"></i>
										<p><small>7. </small> Kegiatan Sub</p>
									</a>
								</li>
								<li class="nav-item">
									<a href="<?= base_url('/user/renstra/opd_renstra_laporan'); ?>" class="nav-link <?= $mn == 'opd_laporan' ? 'active' : ''; ?>">
										<i class="far nav-icon"></i>
										<p><small>8. </small> Laporan</p>
									</a>
								</li>
								<li class="nav-item">
									<a href="<?= base_url('/user/renstra/opd_error_fix'); ?>" class="nav-link <?= $mn == 'opd_renstra_error_fix' ? 'active' : ''; ?>">
										<i class="far nav-icon"></i>
										<p><small>7X. </small> Error Fix</p>
									</a>
								</li>
							</ul>
						</li>
						<li class="nav-item <?= $gr == 'rkpd' ? 'menu-open' : ''; ?>">
							<a href="#" class="nav-link <?= $gr == 'rkpd' ? 'active' : ''; ?>">
								<i class="nav-icon fab fa-buffer"></i>
								<p>
									RENJA
									<i class="fas fa-angle-left right"></i>
								</p>
							</a>
							<ul class="nav nav-treeview">
								<li class="nav-item">
									<a href="<?= base_url('/user/rkpd/opd_program'); ?>" class="nav-link <?= $mn == 'rkpd_program' ? 'active' : ''; ?>">
										<i class="far nav-icon"></i>
										<p><small>1. </small> Program</p>
									</a>
								</li>
								<li class="nav-item">
									<a href="<?= base_url('/user/rkpd/opd_kegiatan'); ?>" class="nav-link <?= $mn == 'rkpd_kegiatan' ? 'active' : ''; ?>">
										<i class="far nav-icon"></i>
										<p><small>2. </small> Kegiatan</p>
									</a>
								</li>
								<li class="nav-item">
									<a href="<?= base_url('/user/rkpd/opd_kegiatan_sub'); ?>" class="nav-link <?= $mn == 'rkpd_kegiatan_sub' ? 'active' : ''; ?>">
										<i class="far nav-icon"></i>
										<p><small>3. </small> Kegiatan Sub</p>
									</a>
								</li>
								<li class="nav-item">
									<a href="<?= base_url('/user/rkpd/opd_kegiatan_sub_tag'); ?>" class="nav-link <?= $mn == 'rkpd_kegiatan_sub_tag' ? 'active' : ''; ?>">
										<i class="far nav-icon"></i>
										<p><small>4. </small> Pelabelan</p>
									</a>
								</li>
								<li class="nav-item">
									<a href="<?= base_url('/user/rkpd/opd_error_fix'); ?>" class="nav-link <?= $mn == 'opd_renstra_error_fix' ? 'active' : ''; ?>">
										<i class="far nav-icon"></i>
										<p><small>3X. </small> Error Fix</p>
									</a>
								</li>
							</ul>
						</li>
						<li class="nav-item">
							<a href="<?= base_url('/user/renstra/opd_dokumen'); ?>" class="nav-link <?= $mn == 'dokumen' ? 'active' : ''; ?>">
								<i class="nav-icon fas fa-folder-open"></i>
								<p><small></small> Dokumen</p>
							</a>
						</li>
					</ul>
				</li>
				<!-- =============================================================== -->
				<li class="nav-header">=====================</li>
				<!-- =============================================================== -->
				<li class="nav-item <?= $gr == 'ropk' ? 'menu-open' : ''; ?>">
					<a href="#" class="nav-link <?= $gr == 'ropk' ? 'active' : ''; ?>" title="Rencana Aktifitas Kinerja">
						<i class="nav-icon fas fa-chart-bar"></i>
						<p>
							Cantik
							<i class="fas fa-angle-left right"></i>
						</p>
					</a>
					<ul class="nav nav-treeview">
						<li class="nav-item">
							<a href="<?= base_url('/user/ropk/ropk_kegiatan_sub/organisasi'); ?>" class="nav-link <?= $mn == 'ropk_organisasi' ? 'active' : ''; ?>" title="Rencana Aktifitas Kinerja Organisasi">
								<i class="far nav-icon"></i>
								<p><small>1. </small> Cantik Organisasi</p>
							</a>
						</li>
					</ul>
					<ul class="nav nav-treeview">
						<li class="nav-item">
							<a href="<?= base_url('/user/ropk/ropk_kegiatan_sub/keuangan'); ?>" class="nav-link <?= $mn == 'ropk_keuangan' ? 'active' : ''; ?>" title="Rencana Aktifitas Kinerja Keuangan">
								<i class="far nav-icon"></i>
								<p><small>2. </small> Cantiku</p>
							</a>
						</li>
					</ul>
					<ul class="nav nav-treeview">
						<li class="nav-item">
							<a href="<?= base_url('/user/ropk/ropk_kegiatan_sub/fisik'); ?>" class="nav-link <?= $mn == 'ropk_fisik' ? 'active' : ''; ?>" title="Rencana Aktifitas Kinerjas">
								<i class="far nav-icon"></i>
								<p><small>3. </small> Cantika</p>
							</a>
						</li>
					</ul>
					<ul class="nav nav-treeview">
						<li class="nav-item">
							<a href="<?= base_url('/user/ropk/ropk_laporan'); ?>" class="nav-link <?= $mn == 'ropk_laporan' ? 'active' : ''; ?>">
								<i class="far nav-icon"></i>
								<p><small>4. </small> Laporan Triwulan</p>
							</a>
						</li>
					</ul>

				</li>
				<!-- =============================================================== -->
				<li class="nav-header">=====================</li>
				<!-- =============================================================== -->
				<li class="nav-item <?= $gr == 'simonela' || $gr == 'Renstra_capaian' ? 'menu-open' : ''; ?>">
					<a href="#" class="nav-link <?= $gr == 'simonela' || $gr == 'Renstra_capaian' ? 'active' : ''; ?>" title="Sistem Minitoring, Evaluasi dan Pelaporan Kinerja">
						<i class="nav-icon fas fa-tachometer-alt"></i>
						<p>
							Simonela
							<i class="fas fa-angle-left right"></i>
						</p>
					</a>
					<ul class="nav nav-treeview">
						<li class="nav-item">
							<a href="<?= base_url('/user/simonela/simonela'); ?>" class="nav-link <?= $mn == 'simonela' ? 'active' : ''; ?>">
								<i class="far nav-icon"></i>
								<p><small>1. </small> Entri Progres</p>
							</a>
						</li>
					</ul>
					<ul class="nav nav-treeview">
						<li class="nav-item">
							<a href="<?= base_url('/user/simonela/simonela/laporan?bu=b1'); ?>" class="nav-link <?= $mn == 'simonela_laporan' ? 'active' : ''; ?>">
								<i class="far nav-icon"></i>
								<p><small>2. </small> Laporan</p>
							</a>
						</li>
					</ul>
					<ul class="nav nav-treeview">
						<li class="nav-item <?= $gr == 'Renstra_capaian' ? 'menu-open' : ''; ?>">
							<a href="#" class="nav-link <?= $gr == 'Renstra_capaian' ? 'active' : ''; ?>">
								<i class="nav-icon fab fa-buffer"></i>
								<p>
									Renstra Capaian
									<i class="right fas fa-angle-left"></i>
								</p>
							</a>
							<ul class="nav nav-treeview">
								<li class="nav-item">
									<a href="<?= base_url('/user/renstra_capaian/opd_capaian_tujuan'); ?>" class="nav-link <?= $mn == 'opd_capaian_tujuan' ? 'active' : ''; ?>">
										<i class="far nav-icon"></i>
										<p><small>1. </small> Tujuan</p>
									</a>
								</li>
								<li class="nav-item">
									<a href="<?= base_url('/user/renstra_capaian/opd_capaian_sasaran'); ?>" class="nav-link <?= $mn == 'opd_capaian_sasaran' ? 'active' : ''; ?>">
										<i class="far nav-icon"></i>
										<p><small>2. </small> Sasaran</p>
									</a>
								</li>
								<li class="nav-item">
									<a href="<?= base_url('/user/renstra_capaian/opd_capaian_program'); ?>" class="nav-link <?= $mn == 'opd_capaian_program' ? 'active' : ''; ?>">
										<i class="far nav-icon"></i>
										<p><small>5.</small> Program</p>
									</a>
								</li>
								<li class="nav-item">
									<a href="<?= base_url('/user/renstra_capaian/opd_capaian_kegiatan'); ?>" class="nav-link <?= $mn == 'opd_capaian_kegiatan' ? 'active' : ''; ?>">
										<i class="far nav-icon"></i>
										<p><small>6. </small> Kegiatan</p>
									</a>
								</li>
								<li class="nav-item">
									<a href="<?= base_url('/user/renstra_capaian/opd_capaian_kegiatan_sub'); ?>" class="nav-link <?= $mn == 'opd_capaian_kegiatan_sub' ? 'active' : ''; ?>">
										<i class="far nav-icon"></i>
										<p><small>7. </small> Sub Kegiatan</p>
									</a>
								</li>
							</ul>
						</li>
					</ul>
				</li>
				<!-- =============================================================== -->
				<li class="nav-header">=====================</li>
				<!-- =============================================================== -->
				<li class="nav-item <?= $gr == 'proposal' ? 'menu-open' : ''; ?>">
					<a href="#" class="nav-link <?= $gr == 'proposal' ? 'active' : ''; ?>" title="">
						<i class="nav-icon fas fa-tachometer-alt"></i>
						<p>
							Proposal
							<i class="fas fa-angle-left right"></i>
						</p>
					</a>
					<ul class="nav nav-treeview">
						<li class="nav-item">
							<a href="<?= base_url('/user/proposal/pengajuan'); ?>" class="nav-link <?= $mn == 'pengajuan' ? 'active' : ''; ?>">
								<i class="far nav-icon"></i>
								<p><small>1. </small> Pengajuan</p>
							</a>
						</li>
					</ul>
					<?php if (has_permission('Verifikator')) { ?>
						<ul class="nav nav-treeview">
							<li class="nav-item">
								<a href="<?= base_url('/user/proposal/verifikator'); ?>" class="nav-link <?= $mn == 'verifikator' ? 'active' : ''; ?>">
									<i class="far nav-icon"></i>
									<p><small>2. </small> Verifikator</p>
								</a>
							</li>
						</ul>
					<?php } ?>
				</li>
				<br><br>
				<br><br>
			</ul>
		</nav>
	</div>
</aside>