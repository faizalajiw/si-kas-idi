<div class="container-fluid py-4">
	<div class="row justify-content-end">
		<div class="col-6">
			<?= $this->session->flashdata('msg'); ?>
		</div>
	</div>
	<div class="row">
		<div class="col-12">
			<div class="card my-4">
				<div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
					<div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
						<h6 class="text-white text-capitalize ps-3">Pengaturan</h6>
					</div>
				</div>
				<div class="card-body px-4 pb-2">
					<div class=" mx-auto col-md-6 col-sm-6">
						<form action="<?= base_url('homepage/update_home') ?>" method="post">
							<label for="">Judul</label>
							<div class="input-group input-group-outline">
								<input type="text" name="judul" class="form-control" value="<?= $info->judul ?>" id="">
							</div>
							<label for="">Slogan</label>
							<div class="input-group input-group-outline">
								<textarea name="slogan" id="" cols="30" rows="4"
									class="form-control"><?= $info->slogan ?></textarea>
							</div>
							<label for="">Alamat</label>
							<div class="input-group input-group-outline">
								<input type="text" name="alamat" value="<?= $info->alamat ?>" class="form-control">
							</div>
							<label for="">Kontak Telepon</label>
							<div class="input-group input-group-outline">
								<input placeholder="628xxxxxx" type="text" name="kontak" value="<?= $info->kontak ?>"
									class="form-control">
							</div>
							<hr>
							<button type="reset" class="btn btn-danger">Batal</button>
							<button type="submit" name="simpan" class="btn btn-success">Update</button>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-12 col-md-8">
			<div class="card my-4">
				<div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
					<div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
						<h6 class="text-white text-capitalize ps-3"></h6>
					</div>
				</div>
				<div class="card-body px-0 pb-2">
					<div class="row p-4 mx-auto">
						<div class="col">
							<button type="button" class="btn btn-secondary menu-info" id="banner">Banner
							</button>
						</div>
						<div class="col">
							<button type="button" class="btn btn-secondary menu-info" id="layanan">Layanan
							</button>
						</div>
						<div class="col">
							<button type="button" class="btn btn-secondary menu-info" id="galeri">Galeri
							</button>
						</div>
						<div class="col">
							<button type="button" class="btn btn-secondary menu-info" id="jam_buka">Jam Buka
							</button>
						</div>
					</div>
				</div>
			</div>
		</div>
		
	</div>
	<div class="row">
		<div class="" id="section"></div>
	</div>
</div>

<script>

	$('.menu-info').on('click',function(e){
		e.preventDefault;
		
		$('.menu-info').removeClass('btn-primary').addClass('btn-secondary');
		$(this).removeClass('btn-secondary').addClass('btn-primary');

	});

	$('#banner').on('click',function(){
		requestMenu("<?= base_url('homepage/info_banner') ?>");
	})

	$('#layanan').on('click',function(){
		requestMenu("<?= base_url('homepage/info_layanan') ?>");
	})

	$('#galeri').on('click',function(){
		requestMenu("<?= base_url('homepage/info_galeri') ?>");
	})

	$('#jam_buka').on('click',function(){
		requestMenu("<?= base_url('homepage/info_jam_buka') ?>");
	})

	var requestMenu = (url) => {
		$.ajax({
			url : url,
			method : "POST",
			dataType : "html"
		}).done((html)=>{
			$("#section").html(html)
		});
	}
	
</script>