<nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur"
	navbar-scroll="true">
	<div class="container-fluid py-1 px-3 d-flex">
		<nav aria-label="breadcrumb">
			<ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
				<li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Pages</a>
				</li>
				<li class="breadcrumb-item text-sm text-dark active" aria-current="page"><?= ucfirst($this->uri->segment(1)) ? ucfirst($this->uri->segment(1)) : 'Dashboard'  ?></li>
			</ol>
			<h6 class="font-weight-bolder mb-0"><?= ucfirst($this->uri->segment(1)) ? ucfirst($this->uri->segment(1))." ".ucfirst($this->uri->segment(2)) : 'Dashboard' ?></h6>
		</nav>
		<div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
			<ul class="navbar-nav ms-auto justify-content-end">
				<li class="nav-item d-flex align-items-center dropdown">
					<a href="javascript:;" class="nav-link text-body font-weight-bold px-0" id="dropdownMenuButton"
						data-bs-toggle="dropdown">
						<i class="fa fa-user me-sm-1"></i>
						<span class="d-sm-inline d-none"><?= $this->session->userdata('username') ?></span>
					</a>
					<ul class="dropdown-menu  dropdown-menu-end  px-2 py-3 me-sm-n4"
						aria-labelledby="dropdownMenuButton">
						<li class="mb-2">
							<a class="dropdown-item border-radius-md" href="<?= base_url('pengguna/profil/') ?>">
								<div class="d-flex py-1">
									<div class="my-auto">
										<img src="<?= base_url('assets/img/profil/').$this->session->userdata('foto') ?>" class="avatar avatar-sm  me-3 ">
									</div>
									<div class="d-flex flex-column justify-content-center">
										<h6 class="text-sm font-weight-normal mb-1">
											<span class="font-weight-bold"><?= $this->session->userdata('nama') ?></span>
										</h6>
										<p class="text-xs text-secondary mb-0">
											<i class="fa fa-briefcase me-1"></i>
											<?= $this->session->userdata('role') ?>
										</p>
									</div>
								</div>
							</a>
						</li>
						<li class="d-flex justify-content-end">
							<a href="<?= base_url('auth/logout') ?>" class="w-100 btn btn-danger"><i class="material-icons opacity-10">logout</i> Logout</a>
						</li>
					</ul>
				</li>
				<li class="nav-item d-xl-none ps-3 d-flex align-items-center">
					<a href="javascript:;" class="nav-link text-body p-0" id="iconNavbarSidenav">
						<div class="sidenav-toggler-inner">
							<i class="sidenav-toggler-line"></i>
							<i class="sidenav-toggler-line"></i>
							<i class="sidenav-toggler-line"></i>
						</div>
					</a>
				</li>
				<!-- <li class="nav-item px-3 d-flex align-items-center">
					<a href="javascript:;" class="nav-link text-body p-0">
						<i class="fa fa-cog fixed-plugin-button-nav cursor-pointer"></i>
					</a>
				</li> -->
			</ul>
		</div>
	</div>
</nav>
