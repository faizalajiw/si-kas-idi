<div class="container-fluid py-4">
	<div class="row justify-content-end">
		<!-- <div class="col-6">
			<?= $this->session->flashdata('msg'); ?>
		</div> -->
	</div>
	<div class="col-12">
		<div class="card my-4">
			<div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
				<div class="bg-gradient-secondary shadow-dark border-radius-lg pt-4 pb-3 mb-2">
					<h6 class="text-white text-capitalize ps-3">Rekap Laporan</h6>
				</div>
				<hr class="dark horizontal my-3">
				<!-- Card Transaksi -->
				<div class="row gap-0 justify-content-between">
					<!-- Total Pemasukan -->
					<div class="col-xl-4 col-sm-6 mb-xl-0 mb-4">
						<div class="card">
							<div class="card-header p-3 pt-2">
								<div class="icon icon-lg icon-shape bg-gradient-info shadow-dark text-center border-radius-xl mt-n4 position-absolute">
									<i class="material-icons opacity-10" translate="no">table_view</i>
								</div>
								<div class="text-start pt-6 text-info">
									<p class="text-bold mb-0">Total Pemasukan</p>
									<?php
									$total_masuk = 0;
									foreach ($result as $row) {
										if (isset($row->jumlah_masuk)) {
											$total_masuk += $row->jumlah_masuk;
										}
									}
									?>
									<h5 class="mb-0">Rp. <?= number_format($total_masuk) ?></h5>
								</div>
							</div>
						</div>
					</div>
					<!-- Total Pemasukan -->

					<!-- Total Pengeluaran -->
					<div class="col-xl-4 col-sm-6 mb-xl-0 mb-4">
						<div class="card">
							<div class="card-header p-3 pt-2">
								<div class="icon icon-lg icon-shape bg-gradient-primary shadow-primary text-center border-radius-xl mt-n4 position-absolute">
									<i class="material-icons opacity-10" translate="no">table_view</i>
								</div>
								<div class="text-start pt-6 text-primary">
									<p class="text-bold mb-0">Total Pengeluaran</p>
									<?php
									$total_keluar = 0;
									foreach ($result as $row) {
										if (isset($row->jumlah_keluar)) {
											$total_keluar += $row->jumlah_keluar;
										}
									}
									?>
									<h5 class="mb-0">Rp. <?= number_format($total_keluar) ?></h5>
								</div>
							</div>
						</div>
					</div>
					<!-- Total Pengeluaran -->

					<!-- Saldo Akhir -->
					<div class="col-xl-4 col-sm-6 mb-xl-0 mb-4">
						<div class="card">
							<div class="card-header p-3 pt-2">
								<div class="icon icon-lg icon-shape bg-gradient-success shadow-dark text-center border-radius-xl mt-n4 position-absolute">
									<i class="material-icons opacity-10" translate="no">table_view</i>
								</div>
								<div class="text-start pt-6 text-success">
									<p class="text-bold mb-0">Saldo Akhir</p>
									<?php
									$total_masuk = 0;
									$total_keluar = 0;

									foreach ($result as $row) {
										if (isset($row->jumlah_masuk)) {
											$total_masuk += $row->jumlah_masuk;
										}

										if (isset($row->jumlah_keluar)) {
											$total_keluar += $row->jumlah_keluar;
										}
									}
									$jumlah_akhir = $total_masuk - $total_keluar;
									?>
									<h5 class="mb-0">Rp. <?= number_format($jumlah_akhir) ?></h5>
								</div>
							</div>
						</div>
					</div>
					<!-- Saldo Akhir -->
				</div>
				<!-- Card Transaksi -->

				<!-- Cetak PDF -->
				<form action="" method="post">
					<div class="row mt-4 align-items-center">
						<div class="col-2"></div>
						<!-- Tanggal -->
						<div class="col-1 text-center">Tanggal</div>
						<div class="col-3">
							<div class="input-group input-group-outline">
								<input type="text" class="form-control" name="tanggal" id="tanggal">
							</div>
						</div>
						<!-- Tanggal -->

						<!-- Radio Button -->
						<div class="col-1 form-check">
							<input class="form-check-input" type="radio" name="tabel" id="kas" value="kas" checked>
							<label class="form-check-label" for="kas">
								Kas
							</label>
						</div>
						<!-- Radio Button -->

						<!-- Cetak -->
						<div class="col-3 mt-3">
							<button type="submit" name="cetak" class="btn bg-gradient-primary">
								<i class="material-icons opacity-10">print</i>
								Cetak
							</button>
						</div>
						<!-- Cetak -->
					</div>
				</form>
				<!-- Cetak PDF -->
			</div>
			<div class="card-body px-0 pb-2">
				<div class="table-responsive p-4 mx-2">
					<table class="table align-items-center mb-0" id="datatable">
						<thead>
							<tr>
								<th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
									Tanggal
								</th>
								<th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
									Kategori
								</th>
								<th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
									Keterangan
								</th>
								<th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
									Pemasukan
								</th>
								<th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
									Pengeluaran
								</th>
							</tr>
						</thead>
						<tbody>
							<?php foreach ($result as $row) : ?>
								<tr>
									<td class="align-middle text-center">
										<span class="text-secondary text-sm font-weight-bold"><?= $row->tanggal ?>
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

<script>
	$(function() {

		var start = moment().subtract(29, 'days');
		var end = moment();

		function cb(start, end) {
			$('#tanggal').val(start.format('DD-MM-YYYY') + ' - ' + end.format('DD-MM-YYYY'));
		}

		$('#tanggal').daterangepicker({
			startDate: start,
			endDate: end,
			ranges: {
				'Hari ini': [moment(), moment()],
				'Kemarin': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
				'7 hari terakhir': [moment().subtract(6, 'days'), moment()],
				'30 hari terakhir': [moment().subtract(29, 'days'), moment()],
				'Bulan ini': [moment().startOf('month'), moment().endOf('month')],
				'Bulan lalu': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1,
					'month').endOf('month')],
				'Tahun ini': [moment().startOf('year'), moment().endOf('year')],
				'Tahun lalu': [moment().subtract(1, 'year').startOf('year'), moment().subtract(1, 'year')
					.endOf('year')
				]
			}
		}, cb);

		cb(start, end);
	});
</script>