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
				<li class="nav-item <?= $gr == 'skpd' ? 'menu-open' : ''; ?>">
					<a href="#" class="nav-link <?= $gr == 'skpd' ? 'active' : ''; ?>">
						<i class="nav-icon fas fa-university"></i>
						<p>
							SKPD
							<i class="fas fa-angle-left right"></i>
						</p>
					</a>
					<ul class="nav nav-treeview">
						<li class="nav-item">
							<a href="<?= base_url('/admin/user/bidang'); ?>" class="nav-link <?= $mn == 'skpd' ? 'active' : ''; ?>">
								<i class="far nav-icon"></i>
								<p><small></small> SKPD</p>
							</a>
						</li>
					</ul>
				</li>
				<li class="nav-item <?= $gr == 'menu' ? 'menu-open' : ''; ?>">
					<a href="#" class="nav-link <?= $gr == 'menu' ? 'active' : ''; ?>">
						<i class="nav-icon fas fa-th"></i>
						<p>
							Menu
							<i class="fas fa-angle-left right"></i>
						</p>
					</a>
					<ul class="nav nav-treeview">
						<li class="nav-item">
							<a href="<?= base_url('/admin/menu/menu'); ?>" class="nav-link <?= $mn == 'menu' ? 'active' : ''; ?>">
								<i class="far nav-icon"></i>
								<p><small></small> Timer</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="<?= base_url('/admin/menu/tag'); ?>" class="nav-link <?= $mn == 'tag' ? 'active' : ''; ?>">
								<i class="far nav-icon"></i>
								<p><small></small> Tag</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="<?= base_url('/admin/menu/satuan'); ?>" class="nav-link <?= $mn == 'satuan' ? 'active' : ''; ?>">
								<i class="far nav-icon"></i>
								<p><small></small> Satuan</p>
							</a>
						</li>
					</ul>
				</li>
				<!-- =============================================================== -->
				<li class="nav-header">=====================</li>
				<!-- =============================================================== -->
				<li class="nav-item <?= $gr == 'rpjmd' ? 'menu-open' : ''; ?>">
					<a href="#" class="nav-link <?= $gr == 'rpjmd' ? 'active' : ''; ?>">
						<i class="nav-icon fas fa-copy"></i>
						<p>
							RPJMD
							<i class="fas fa-angle-left right"></i>
						</p>
					</a>
					<ul class="nav nav-treeview">
						<li class="nav-item">
							<a href="<?= base_url('/admin/rpjmd/visi'); ?>" class="nav-link <?= $mn == 'visi' ? 'active' : ''; ?>">
								<i class="far nav-icon"></i>
								<p><small>1. </small> VISI / MISI</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="<?= base_url('/admin/rpjmd/tujuan'); ?>" class="nav-link <?= $mn == 'tujuan' ? 'active' : ''; ?>">
								<i class="far nav-icon"></i>
								<p><small>2. </small> Tujuan</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="<?= base_url('/admin/rpjmd/sasaran'); ?>" class="nav-link <?= $mn == 'sasaran' ? 'active' : ''; ?>">
								<i class="far nav-icon"></i>
								<p><small>3. </small> Sasaran</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="<?= base_url('/admin/rpjmd/strategi'); ?>" class="nav-link <?= $mn == 'strategi' ? 'active' : ''; ?>">
								<i class="far nav-icon"></i>
								<p><small>4. </small> Strategi</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="<?= base_url('/admin/rpjmd/arah_kebijakan'); ?>" class="nav-link <?= $mn == 'arah_kebijakan' ? 'active' : ''; ?>">
								<i class="far nav-icon"></i>
								<p><small>5. </small> Arah Kebijakan</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="<?= base_url('/admin/rpjmd/program'); ?>" class="nav-link <?= $mn == 'program' ? 'active' : ''; ?>">
								<i class="far nav-icon"></i>
								<p><small>6. </small> Program</p>
							</a>
						</li>
					</ul>
				</li>
				<!-- =============================================================== -->
				<li class="nav-header">=====================</li>
				<!-- =============================================================== -->
				<li class="nav-item  <?= $gr == 'A_Renstra' || $gr == 'A_rkpd' || $gr == 'A_dokumen' ? 'menu-open' : ''; ?>">
					<a href="#" class="nav-link <?= $gr == 'A_Renstra' || $gr == 'A_rkpd' || $gr == 'A_dokumen' ? 'active' : ''; ?>" title="Data Perencanaan">
						<i class="nav-icon fas fa-circle"></i>
						<p>
							DARA
							<i class="right fas fa-angle-left"></i>
						</p>
					</a>
					<ul class="nav nav-treeview">
						<li class="nav-item <?= $gr == 'A_Renstra' ? 'menu-open' : ''; ?>">
							<a href="#" class="nav-link <?= $gr == 'A_Renstra' ? 'active' : ''; ?>">
								<i class="nav-icon fab fa-buffer"></i>
								<p>
									RENSTRA
									<i class="right fas fa-angle-left"></i>
								</p>
							</a>
							<ul class="nav nav-treeview">
								<li class="nav-item">
									<a href="<?= base_url('/admin/renstra/opd_tujuan'); ?>" class="nav-link <?= $mn == 'A_opd_tujuan' ? 'active' : ''; ?>">
										<i class="far nav-icon"></i>
										<p><small>1. </small> Tujuan</p>
									</a>
								</li>
								<li class="nav-item">
									<a href="<?= base_url('/admin/renstra/opd_sasaran'); ?>" class="nav-link <?= $mn == 'A_opd_sasaran' ? 'active' : ''; ?>">
										<i class="far nav-icon"></i>
										<p><small>2. </small> Sasaran</p>
									</a>
								</li>
								<li class="nav-item">
									<a href="<?= base_url('/admin/renstra/opd_strategi'); ?>" class="nav-link <?= $mn == 'A_opd_strategi' ? 'active' : ''; ?>">
										<i class="far nav-icon"></i>
										<p><small>3. </small> Strategi</p>
									</a>
								</li>
								<li class="nav-item">
									<a href="<?= base_url('/admin/renstra/opd_arah_kebijakan'); ?>" class="nav-link <?= $mn == 'A_opd_arah_kebijakan' ? 'active' : ''; ?>">
										<i class="far nav-icon"></i>
										<p><small>4. </small> Arah Kebijakan</p>
									</a>
								</li>
								<li class="nav-item">
									<a href="<?= base_url('/admin/renstra/opd_program'); ?>" class="nav-link <?= $mn == 'A_opd_program' ? 'active' : ''; ?>">
										<i class="far nav-icon"></i>
										<p><small>5.</small> Program</p>
									</a>
								</li>
								<li class="nav-item">
									<a href="<?= base_url('/admin/renstra/opd_kegiatan'); ?>" class="nav-link <?= $mn == 'A_opd_kegiatan' ? 'active' : ''; ?>">
										<i class="far nav-icon"></i>
										<p><small>6. </small> Kegiatan</p>
									</a>
								</li>
								<li class="nav-item">
									<a href="<?= base_url('/admin/renstra/opd_kegiatan_sub'); ?>" class="nav-link <?= $mn == 'A_opd_kegiatan_sub' ? 'active' : ''; ?>">
										<i class="far nav-icon"></i>
										<p><small>7. </small> Kegiatan Sub</p>
									</a>
								</li>
								<li class="nav-item">
									<a href="<?= base_url('/admin/renstra/opd_renstra_laporan'); ?>" class="nav-link <?= $mn == 'A_opd_laporan' ? 'active' : ''; ?>">
										<i class="far nav-icon"></i>
										<p><small>8. </small> Laporan</p>
									</a>
								</li>
							</ul>
						</li>
						<li class="nav-item">
							<a href="<?= base_url('/admin/renstra/opd_dokumen'); ?>" class="nav-link <?= $mn == 'A_dokumen' ? 'active' : ''; ?>">
								<i class="nav-icon fas fa-folder-open"></i>
								<p><small></small> Dokumen</p>
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
							<a href="<?= base_url('/admin/simonela/simonela'); ?>" class="nav-link <?= $mn == 'simonela' ? 'active' : ''; ?>">
								<i class="far nav-icon"></i>
								<p><small>1. </small> Entri Progres</p>
							</a>
						</li>
					</ul>
					<ul class="nav nav-treeview">
						<li class="nav-item">
							<a href="<?= base_url('/admin/simonela/simonela/laporan?bu=b1'); ?>" class="nav-link <?= $mn == 'simonela_laporan' ? 'active' : ''; ?>">
								<i class="far nav-icon"></i>
								<p><small>2. </small> Laporan</p>
							</a>
						</li>
					</ul>
				</li>
				<br><br>
				<br><br>
			</ul>
		</nav>
	</div>
</aside>