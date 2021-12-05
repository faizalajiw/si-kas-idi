<div class="col-md-8">
	<div class="card my-4">
		<div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
			<div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
				<h6 class="text-white text-capitalize ps-3">Galeri</h6>
			</div>
		</div>
		<div class="card-body px-0 pb-2">
			<div class="text-end me-3">
				<button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#modalTambah">
					<i class="material-icons opacity-10" translate="no">add</i> Tambah Galeri
				</button>
			</div>
			<div class="table-responsive p-0 mx-2">
				<table class="table align-items-center mb-0" id="datatable">
					<thead>
						<tr>
							<th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
								Tanggal</th>
							<th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
								Gambar
							</th>
							<th class="text-secondary opacity-7"></th>
						</tr>
					</thead>
					<tbody>
						<?php foreach($galeri as $g) : ?>
						<tr>
							<td class="align-middle text-center">
								<span class="text-secondary text-xs font-weight-bold"><?= $g->tanggal ?></span>
							</td>
							<td>
								<div class="img-fluid">
									<a target="_blank" href="<?= base_url('assets/img/galeri/').$g->gambar ?>"><img
											src="<?= base_url('assets/img/galeri/').$g->gambar ?>" width="70px"
											class="img-thumbnail" alt=""></a>
								</div>
							</td>
							<td class="align-middle">
								<a href="<?= base_url('homepage/galeri_hapus/').$g->id ?>"
									onclick="return confirm('Hapus ?')"
									class="text-secondary text-danger font-weight-bold text-xs">
									<i class="material-icons opacity-10" translate="no">delete
									</i>
								</a>
							</td>
						</tr>
						<?php endforeach ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>


<!-- Modal -->
<div class="modal fade" id="modalTambah" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
	aria-labelledby="staticBackdropLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered modal-sm">
		<div class="modal-content">
			<form action="<?= base_url('homepage/tambah_galeri') ?>" method="post" enctype="multipart/form-data">
				<div class="modal-header p-0 position-relative mt-n4 mx-3 z-index-2">
					<div
						class="w-100 bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3 d-flex justify-content-between">
						<h6 class="modal-title text-white text-capitalize ps-3">Galeri</h6>
						<button type="button" class="btn-close me-2" data-bs-dismiss="modal"
							aria-label="Close"></button>
					</div>
				</div>
				<div class="modal-body">
					<div class="row my-3">
						<label class="form-label">Foto</label>
						<div class="input-group input-group-outline">
							<input class="form-control" type="file" name="foto" required>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
					<button type="submit" name="simpan" class="btn btn-primary">Simpan</button>
				</div>
			</form>
		</div>
	</div>
</div>

<script>
	$(document).ready( function () {
		$('#datatable').DataTable({
			language: {
				"paginate": {
					"first":      "&laquo",
					"last":       "&raquo",
					"next":       "&gt",
					"previous":   "&lt"
				},
			},
			dom:' <"d-flex"l>rt<"d-flex justify-content-between"ip><"clear">'
		});
	} );
</script>