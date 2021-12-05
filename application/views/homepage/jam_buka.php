<div class="col-md-5">
	<div class="card my-4">
		<div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
			<div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
				<h6 class="text-white text-capitalize ps-3">Jam Buka</h6>
			</div>
		</div>
		<div class="card-body px-0 pb-2">
			<div class="table-responsive p-0 mx-2">
				<table class="table align-items-center mb-0">
					<thead>
						<tr>
							<th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
								Hari</th>
							<th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
								Jam
							</th>
							<th class="text-secondary opacity-7"></th>
						</tr>
					</thead>
					<tbody>
						<?php foreach($hari as $h) : ?>
						<tr>
							<td class="align-middle text-center">
								<span class="text-secondary text-xs font-weight-bold"><?= $h->hari ?></span>
							</td>
							<td>
								<span class="text-secondary text-xs font-weight-bold"><?= $h->jam ?></span>
							</td>
							<td class="align-middle">
								<a role="button" data-id="<?= $h->id ?>" class="edit text-secondary text-warning font-weight-bold text-xs">
									<i class="material-icons opacity-10" translate="no">edit
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
<div class="modal fade" id="modalEdit" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
	aria-labelledby="staticBackdropLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered modal-sm">
		<div class="modal-content">
			<form action="<?= base_url('homepage/update_jam') ?>" method="post">
				<input type="hidden" name="id" id="id">
				<div class="modal-header p-0 position-relative mt-n4 mx-3 z-index-2">
					<div
						class="w-100 bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3 d-flex justify-content-between">
						<h6 class="modal-title text-white text-capitalize ps-3">Jam Buka</h6>
						<button type="button" class="btn-close me-2" data-bs-dismiss="modal"
							aria-label="Close"></button>
					</div>
				</div>
				<div class="modal-body">
					<div class="row my-3">
						<label class="form-label" id="hari"></label>
						<div class="input-group input-group-outline">
							<input class="form-control" type="text" id="jam" name="jam" placeholder="09.00 - 17.00" required>
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
	$(document).ready(function(){

		$('.edit').on('click',function(){

			var id = $(this).attr('data-id');
			$.ajax({
				url: "<?= base_url('homepage/get_jam/') ?>" + id,
				type: "GET",
				dataType: "json",
			}).done(function(data){
				$('#id').val(data.id);
				$('#hari').html(data.hari);
				$('#jam').val(data.jam);
				$('#modalEdit').modal('show');
			});
		});

	});
</script>