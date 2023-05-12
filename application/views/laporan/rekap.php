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
						<h6 class="text-white text-capitalize ps-3">Rekap Laporan</h6>
					</div>
				</div>
				<div class="card-body px-0 pb-2">
					<!-- <div class="text-end me-3">
						<button type="button" class="btn btn-secondary" data-bs-toggle="modal"
							data-bs-target="#modalTambah">
							<i class="material-icons opacity-10" translate="no">add</i>Cetak
						</button>
					</div> -->
					<div class="table-responsive p-4 mx-2">
						<table class="table align-items-center mb-0" id="datatable">
							<thead>
								<tr>
									<th
										class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
										Tanggal
                                    </th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Kategori
                                    </th>
									<th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
										Keterangan
									</th>
									<th
										class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
										Pemasukan
                                    </th>
									<th
										class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
										Pengeluaran
                                    </th>
								</tr>
							</thead>
							<tbody>
								<?php foreach($result as $row) : ?>
								<tr>
									<td class="align-middle text-center">
										<span
											class="text-secondary text-sm font-weight-bold"><?= $row->tanggal ?>
                                        </span>
									</td>
                                    <td class="align-middle text-center text-sm">
										<span>
											<?= $row->kategori ?>
										</span>
									</td>
									<td>
										<p class="text-sm text-secondary mb-0"><?= $row->keterangan ?></p>
									</td>
									<td>
										<p class="text-sm font-weight-bold mb-0">Rp. <?= number_format($row->jumlah_masuk) ?>
										</p>
									</td>
									<td>
										<p class="text-sm font-weight-bold mb-0">Rp. <?= number_format($row->jumlah_keluar) ?>
										</p>
									</td>
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
			dom:' <"d-flex"l<"input-group input-group-outline justify-content-end me-4"f>>rt<"d-flex justify-content-between"ip><"clear">'
		});
	} );
</script>