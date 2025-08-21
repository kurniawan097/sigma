<header class="page-header">
	<h2><i class="icons fas fa-database "></i>&nbsp;<?= $page_title ?></h2>
	<div class="right-wrapper text-left">
		<ol class="breadcrumbs">
			<li><span><?= $page_desc ?></span></li>
		</ol>
	</div>
</header>

<div class="row">
	<div class="col">
		<div class="">
			<a href="javascript:;" id="btn-show-add-form" class="btn btn-sm btn-success"><i class="icons icon-plus"></i>&nbsp;Tambah Barang</a>
			<a href="javascript:;" id="btn-cetaklaporan-form" class="btn btn-sm btn-success"><i class="fas fa-print"></i>&nbsp;&nbsp;&nbsp;Cetak Laporan</a>
		</div>
		<br>
		<div class="card-body">
			<div class="table-responsive">
				<table class="table table-striped table-sm table-bordered table-hover" id="kt_table_1">
					<thead>
						<tr>
							<th> # </th>
							<th style="text-align: center;"> Kategori</th>
							<th style="text-align: center;"> Nama</th>
							<th> Kode</th>
							<th> Unit</th>
							<th> Stock</th>
							<th> Aksi </th>
						</tr>
					</thead>
				</table>
			</div>
		</div>
	</div>
</div>

<div id="main-modal" class="modal fade" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" style="display: none;" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content ">
			<div class="modal-header bg-dark text-light">
				<h5 id="modal-label"><i class="flaticon2-avatar icon-2x text-grey-light"></i> Form Barang</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>
			</div>
			<?= form_open('#', array('id' => 'modal-form', 'autocomplete' => 'off')); ?>
			<div class="modal-body">
				
					<div class="form-group">
						<label for="id_kategori" class="form-control-label">Kategori Barang <span class="text-danger">*</span> :</label>
						<select data-plugin-selectTwo class="form-control populate" id="id_kategori" name="id_kategori" required>
							<option value="">- Pilih Kategori Barang -</option>
							<?php
							foreach ($list_kategori as $row) {
								echo '<option value="' . $row->id . '">' . $row->name . '</option>';
							}
							?>
						</select>
					</div>

					<div>
						<div class="form-group">
							<label for="nama_barang" class="form-control-label">Nama <span class="text-danger">*</span> :</label>
							<input type="text" class="form-control" id="nama_barang" name="nama_barang" required>
						</div>
					</div>
					<div>
						<div class="form-group">
							<label for="code" class="form-control-label">Code <span class="text-danger">*</span> :</label>
							<input type="text" class="form-control" id="code" name="code" required>
						</div>
					</div>
					<div>
						<div class="form-group">
							<label for="unit" class="form-control-label">Unit <span class="text-danger">*</span> :</label>
							<input type="text" class="form-control" id="unit" name="unit" required>
						</div>
					</div>
					<div>
						<div class="form-group">
							<label for="stock" class="form-control-label">Stock <span class="text-danger">*</span> :</label>
							<input type="number" class="form-control" id="stock" name="stock" required>
						</div>
					</div>
			</div>
			<div class="modal-footer">
				<div class="is_aktif"></div>
				<input type="hidden" id="id_barang" name="id_barang">
				<button type="button" class="btn btn-secondary btn-clear-form" data-dismiss="modal">Tutup</button>
				<button type="button" class="btn btn-success btn-save">Simpan</button>
			</div>
			<?= form_close(); ?>
		</div>
	</div>
</div>


<script>
	document.addEventListener('DOMContentLoaded', function() {
		table = $('#kt_table_1').DataTable({
			responsive: false,
			processing: true,
			serverSide: true,
			order: [
				[0, 'desc']
			],
			ajax: {
				url: 'barang/pagination/barang',
				type: 'POST',
				data: function(e) {
					e.csrf_token = token
				}
			},
			columnDefs: [{
				targets: [0, 3, 4, 5, 6],
				className: 'text-center'
			}]
		})

		$('#btn-show-add-form').click(function() {
			$('.form-control').val(null)
			$('#main-modal #modal-form').attr('action', 'barang/add/barang')
			$('#main-modal').modal()
		})


		$(document).on('click', '.btn-edit', function() {
			var object = 'barang'
			$('#main-modal #modal-form').attr('action', 'barang/update/barang')
			$('#main-modal').modal()

			var id = $(this).attr("data-id")
            
			fetch(object + '/editBarang/' + id)
				.then(function(resp) {
					return resp.json()
				})
				.then(function(data) {
                    
					$('#main-modal #id_barang').val(data[0].id)
					$('#main-modal #id_kategori').val(data[0].categories_id)
					$('#main-modal #nama_barang').val(data[0].name)
					$('#main-modal #code').val(data[0].code)
					$('#main-modal #unit').val(data[0].unit)
					$('#main-modal #stock').val(data[0].stock)
				})
		})



		//Export
		$('#btn-cetaklaporan-form').click(function() {
				window.open("<?php echo base_url(); ?>barang/exportStock", "_blank");
		});

	})

	function updateDatatable() {
		table.ajax.reload(null, false)
	}
</script>