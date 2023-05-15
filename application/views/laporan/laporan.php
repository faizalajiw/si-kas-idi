<div class="container-fluid py-4">
	<div class="row justify-content-end">
		<!-- <div class="col-6">
			<?= $this->session->flashdata('msg'); ?>
		</div> -->
	</div>
	<div class="row justify-content-center">
		<div class="col-10 col-md-8">

			<div class="card my-4">
				<div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
					<div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
						<h6 class="text-white text-capitalize ps-3">Laporan kas</h6>
					</div>
				</div>
				<div class="card-body px-2 pb-2">
					<form action="" method="post" target="_blank">
						<div class="row">
							<div class="col-sm-6 text-center">Laporan kas</div>
							<div class="col-sm-6">
								<div class="form-check">
									<input class="form-check-input" type="radio" name="tabel"
										id="kas" value="kas" checked>
									<label class="form-check-label" for="kas">
										Kas
									</label>
								</div>
								
							</div>
						</div>
						<div class="row mt-4">
							<div class="col-sm-6 text-center">
								Tanggal
							</div>
							<div class="col-sm-5">
								<div class="input-group input-group-outline">
									<input type="text" class="form-control text-center" name="tanggal" id="tanggal">
								</div>
							</div>
						</div>
						<div class="text-center">
							<button type="submit" name="cetak" class="btn bg-gradient-primary my-4 mb-2">
								<i class="material-icons opacity-10">print</i>
								Cetak
							</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>

<script>
	$(function () {

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