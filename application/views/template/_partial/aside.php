<aside
	class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3   bg-gradient-dark"
	id="sidenav-main">
	<div class="sidenav-header">
		<i class="fas fa-times p-3 cursor-pointer text-white opacity-5 position-absolute end-0 top-0 d-none d-xl-none"
			aria-hidden="true" id="iconSidenav"></i>
		<a class="navbar-brand m-0" href="<?= base_url('dashboard') ?>">
			<img src="<?= base_url() ?>/assets/img/logo-idi.png" class="navbar-brand-img h-100" alt="main_logo">
			<span class="ms-1 font-weight-bold text-white" translate="no">Si-Kas IDI</span>
		</a>
	</div>
	<hr class="horizontal light mt-0 mb-2">
	<div class="collapse navbar-collapse  w-auto h-auto max-height-vh-100" id="sidenav-collapse-main">
		<ul class="navbar-nav">
			<li class="nav-item">
				<a class="nav-link text-white <?php if($this->uri->segment(1) == 'dashboard' || $this->uri->segment(1) == '') echo 'active bg-gradient-primary' ?>" href="<?= base_url('dashboard') ?>">
					<div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
						<i class="material-icons opacity-10" translate="no">dashboard</i>
					</div>
					<span class="nav-link-text ms-1">Dashboard</span>
				</a>
			</li>
            <li class="nav-item mt-3">
				<h6 class="ps-4 ms-2 text-uppercase text-xs text-white font-weight-bolder opacity-8">kas</h6>
			</li>
			<li class="nav-item">
				<a class="nav-link text-white <?php if($this->uri->segment(2) == 'pemasukan') echo 'active bg-gradient-primary' ?>" href="<?= base_url('kas/pemasukan') ?>">
					<div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
						<i class="material-icons opacity-10" translate="no">table_view</i>
					</div>
					<span class="nav-link-text ms-1" >Pemasukan</span>
				</a>
			</li>
			<li class="nav-item">
				<a class="nav-link text-white <?php if($this->uri->segment(2) == 'pengeluaran') echo 'active bg-gradient-primary' ?>" href="<?= base_url('kas/pengeluaran') ?>">
					<div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
						<i class="material-icons opacity-10" translate="no">receipt_long</i>
					</div>
					<span class="nav-link-text ms-1">Pengeluaran</span>
				</a>
			</li>
			<li class="nav-item mt-3">
				<h6 class="ps-4 ms-2 text-uppercase text-xs text-white font-weight-bolder opacity-8">Laporan</h6>
			</li>
			<li class="nav-item">
				<a class="nav-link text-white <?php if($this->uri->segment(1) == 'rekap') echo 'active bg-gradient-primary' ?>" href="<?= base_url('rekap') ?>">
					<div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
						<i class="material-icons opacity-10" translate="no">assessment</i>
					</div>
					<span class="nav-link-text ms-1">Rekap Laporan</span>
				</a>
			</li>
			<li class="nav-item">
				<a class="nav-link text-white <?php if($this->uri->segment(1) == 'laporan') echo 'active bg-gradient-primary' ?>" href="<?= base_url('laporan') ?>">
					<div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
						<i class="material-icons opacity-10" translate="no">print</i>
					</div>
					<span class="nav-link-text ms-1">Cetak Laporan</span>
				</a>
			</li>
			<?php if(is_admin()) : ?>
            <li class="nav-item mt-3">
				<h6 class="ps-4 ms-2 text-uppercase text-xs text-white font-weight-bolder opacity-8">Pengaturan</h6>
			</li>
			<li class="nav-item">
				<a class="nav-link text-white <?php if($this->uri->segment(1) == 'pengguna') echo 'active bg-gradient-primary' ?>" href="<?= base_url('pengguna') ?>">
					<div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
						<i class="material-icons opacity-10" translate="no">person</i>
					</div>
					<span class="nav-link-text ms-1">User Management</span>
				</a>
			</li>
			<!-- <li class="nav-item">
				<a class="nav-link text-white <?php if($this->uri->segment(1) == 'homepage') echo 'active bg-gradient-primary' ?>" href="<?= base_url('homepage') ?>">
					<div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
						<i class="material-icons opacity-10" translate="no">home</i>
					</div>
					<span class="nav-link-text ms-1">Halaman Beranda</span>
				</a>
			</li> -->
			<?php endif ?>
		</ul>
	</div>
</aside>
