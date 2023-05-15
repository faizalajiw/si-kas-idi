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
						<h6 class="text-white text-capitalize ps-3">Pengeluaran</h6>
					</div>
				</div>
				<div class="card-body px-0 pb-2">
					<div class="text-end me-3">
						<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalTambah">
							<i class="material-icons opacity-10" translate="no">add</i> Tambah Data
						</button>
					</div>
					<div class="table-responsive p-4 mx-2">
						<table class="table align-items-center mb-0" id="datatable">
							<thead>
								<tr>
									<th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
										Tanggal
									</th>
									<th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
										Kategori
									</th>
									<th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
										Keterangan
									</th>
									<th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
										Jumlah Pengeluaran
									</th>
									<th class="text-secondary opacity-7"></th>
								</tr>
							</thead>
							<tbody>
								<?php foreach ($kas as $row) : ?>
									<tr>
										<?php if ($row->jumlah_keluar != 0) : ?>
											<td class="align-middle text-center">
												<span class="text-secondary text-sm font-weight-bold"><?= $row->tanggal ?></span>
											</td>
											<td>
												<p class="text-sm text-secondary mb-0"><?= $row->kategori ?></p>
											</td>
											<td>
												<p class="text-sm text-secondary mb-0"><?= $row->keterangan ?></p>
											</td>
											<td>
												<p class="text-sm font-weight-bold mb-0">Rp. <?= number_format($row->jumlah_keluar) ?></p>
											</td>
											<!-- <td>
												<p class="text-sm text-secondary mb-0"><?= $row->nama ?></p>
											</td> -->
											<td class="align-middle">
												<a href="<?= base_url('kas/pengeluaran_hapus/') . $row->id ?>" onclick="return confirm('Apakah anda yakin menghapus data?')" class="text-secondary text-danger font-weight-bold text-xs">
													<i class="material-icons opacity-10" translate="no">delete</i>
												</a>
											</td>
										<?php endif; ?>
									</tr>
								<?php endforeach ?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<!-- Modal -->
<div class="modal fade" id="modalTambah" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered modal-sm">
		<div class="modal-content">
			<form action="<?= base_url('kas/pengeluaran_proses') ?>" method="post">
				<div class="modal-header p-0 position-relative mt-n4 mx-3 z-index-2">
					<div class="w-100 bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3 d-flex justify-content-between">
						<h6 class="modal-title text-white text-capitalize ps-3">Pengeluaran</h6>
						<button type="button" class="btn-close me-2" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
				</div>
				<div class="modal-body">
					<div class="row">
						<label>Tanggal</label>
						<div class="input-group input-group-outline">
							<input type="date" name="tanggal" class="form-control" required>
						</div>
					</div>
					<div class="row my-3">
						<div class="input-group input-group-outline">
							<select class="form-control" name="kategori">
								<option value="">Pilih Kategori</option>
								<option value="Rutin Gedung">Rutin Geudng</option>
								<option value="Honor Pegawai IDI">Honor Pegawai IDI</option>
								<option value="Transport Perjalanan Dinas">Transport Perjalanan Dinas</option>
								<option value="Pembangunan Gedung">Pembangunan Gedung</option>
								<option value="Pemeliharaan Gedung">Pemeliharaan Gedung</option>
								<option value="Kegiatan IDI">Kegiatan IDI</option>
								<option value="Sosial (Tahziyah), THR">Sosial (Tahziyah), THR</option>
								<option value="Iuran IDI Wilayah">Iuran IDI Wilayah</option>
								<option value="ATK">ATK</option>
								<option value="Iklan HUT Brebes">Iklan HUT Brebes</option>
								<option value="Uang P2KB">Uang P2KB</option>
								<option value="Dana Sosial">Dana Sosial</option>
							</select>
						</div>
					</div>
					<div class="row my-3">
					<label>Keterangan <span style="color: red; font-size: 12px;">(max.60 karakter)</span></label>
						<div class="input-group input-group-outline">
							<textarea name="keterangan" maxlength="60" class="form-control" cols="10" rows="3"></textarea>
						</div>
					</div>
					<div class="row my-3">
						<label>Jumlah Pengeluaran</label>
						<div class="input-group input-group-outline">
							<input type="number" name="jumlah_keluar" required class="form-control">
						</div>
					</div>
					<div class="row my-3">
						<label>Jenis</label>
						<div class="input-group input-group-outline">
							<input type="text" name="jenis" value="keluar" readonly class="form-control">
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
	$(document).ready(function() {
		$('#datatable').DataTable({
			language: {
				"paginate": {
					"first": "&laquo",
					"last": "&raquo",
					"next": "&gt",
					"previous": "&lt"
				},
			},
			dom: ' <"d-flex"l<"input-group input-group-outline justify-content-end me-4"f>>rt<"d-flex justify-content-between"ip><"clear">'
		});
	});
</script>