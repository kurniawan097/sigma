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
			<a href="javascript:;" id="btn-show-add-form" class="btn btn-sm btn-success"><i class="icons icon-plus"></i>&nbsp;Tambah Pembelian</a>
			<a href="javascript:;" id="btn-cetaklaporan-form" class="btn btn-sm btn-success"><i class="fas fa-print"></i>&nbsp;&nbsp;&nbsp;Cetak Laporan</a>
		</div>
		<br>
		<div class="card-body">
			<div class="table-responsive">
				<table class="table table-striped table-sm table-bordered table-hover" id="kt_table_1">
					<thead>
						<tr>
							<th> # </th>
							<th style="text-align: center;"> Nama Vendor</th>
							<th style="text-align: center;"> Alamat</th>
							<th> Tanggal</th>
							<th> Nama Pembeli</th>
							<th> Detail Barang</th>
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
				<h5 id="modal-label"><i class="flaticon2-avatar icon-2x text-grey-light"></i> Form Pembelian</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>
			</div>
			<?= form_open('#', array('id' => 'modal-form', 'autocomplete' => 'off')); ?>
			<div class="modal-body">
				
					<div>
						<div class="form-group">
							<label for="nama_vendor" class="form-control-label">Nama Vendor<span class="text-danger">*</span> :</label>
							<input type="text" class="form-control" id="nama_vendor" name="nama_vendor" required>
						</div>
					</div>						
					<div>				
						<div class="form-group">
							<label for="alamat_vendor" class="form-control-label">Alamat Vendor <span class="text-danger">*</span> :</label>
							<textarea type="text" class="form-control" id="alamat_vendor" name="alamat_vendor" required></textarea>
						</div>
					</div>	
					<div>
						<div class="form-group">
							<label for="waktu" class="form-control-label">Tanggal <span class="text-danger">*</span> :</label>
							<div class="input-daterange input-group" data-plugin-datepicker data-plugin-options='{ "format": "dd-mm-yyyy"}'>
								<span class="input-group-text">
									<i class="fas fa-calendar-alt"></i>
								</span>
								<input type="text" class="form-control" id="tanggal" name="tanggal" required>
							</div>
						</div>
					</div>	
					<div>
						<div class="form-group">
							<label for="nama_pembeli" class="form-control-label">Nama Pembeli<span class="text-danger">*</span> :</label>
							<input type="text" class="form-control" id="nama_pembeli" name="nama_pembeli" required>
						</div>
					</div>	
					<br>
					<div>
						<div class="form-group">
								<label for="barang" class="form-control-label">Daftar Barang :</label>
								<div id="barang-wrapper">
								</div>
								<button type="button" class="btn btn-sm btn-primary mt-2" id="add-barang">+ Tambah Barang</button>
						</div>
					</div>	


			</div>
			<div class="modal-footer">
				<div class="is_aktif"></div>
				<input type="hidden" id="id_pembelian" name="id_pembelian">
				<button type="button" class="btn btn-secondary btn-clear-form" data-dismiss="modal">Tutup</button>
				<button type="button" class="btn btn-success btn-save">Simpan</button>
			</div>
			<?= form_close(); ?>
		</div>
	</div>
</div>

<?php
ob_start();
?>
<div class="row mb-2 barang-row">
    <div class="col-md-6">
        <select name="id_barang[]" class="form-control" required>
            <option value="">- Pilih Barang -</option>
            <?php foreach ($list_barang as $row): ?>
                <option value="<?= $row->id ?>"><?= $row->name ?></option>
            <?php endforeach; ?>
        </select>
    </div>
    <div class="col-md-4">
        <input type="number" name="qty[]" class="form-control" min="1" placeholder="Qty" required>
    </div>
    <div class="col-md-2">
        <button type="button" class="btn btn-danger btn-remove-barang">&times;</button>
    </div>
</div>
<?php
$template_barang = ob_get_clean();
?>


<div id="main-modal-marketing" class="modal fade" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" style="display: none;" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content ">
			<div class="modal-header bg-dark text-light">
				<h5 id="modal-label"><i class="flaticon2-avatar icon-2x text-grey-light"></i> Cetak Data Barang Masuk  </h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>
			</div>
			<?= form_open('#', array('id' => 'modal-form-marketing', 'autocomplete' => 'off')); ?> 
			<div class="modal-body">
				<div class="dt-marketing-form">
				    <div class="form-group" style="display: flex;">
				        <div style="flex: 50%;padding: 10px;">
						<input class="form-control"  data-provide="datepicker" name="tglawal" id="tglawal" data-date-format="yyyy-mm-dd" placeholder="Pilih Tanggal Awal" required>
						</div>
						<div style="flex: 50%;padding: 10px;">
						<input class="form-control"  data-provide="datepicker" name="tglakhir" id="tglakhir" data-date-format="yyyy-mm-dd" placeholder="Pilih Tanggal Akhir" required>
						</div>
					</div>
					
				</div>
			</div>
			<div class="modal-footer">
				<!-- <div class="is_aktif"></div>
				<input type="hidden" id="ID" name="ID"> -->
				<button type="button" class="btn btn-secondary btn-clear-form" data-dismiss="modal">Tutup</button>
				<button type="button" id="btn-export" class="btn btn-success btn-clear-form" >Export Excel</button>
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
				url: 'barang/pagination/pembelian',
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
			$('#main-modal #modal-form').attr('action', 'barang/add/pembelian')
			$('#main-modal').modal()
		})


		$(document).on('click', '.btn-edit', function() {
				var id = $(this).attr("data-id");
				$('#main-modal #modal-form').attr('action', 'barang/update/pembelian');
				$('#main-modal').modal();

				// Kosongkan wrapper dulu
				$('#barang-wrapper').html('');

				fetch('barang/editPembelian/' + id)
						.then(resp => resp.json())
						.then(data => {
								if (data && data.pembelian) {
										// Isi field utama
										$('#id_pembelian').val(data.pembelian.id);
										$('#nama_vendor').val(data.pembelian.nama_vendor);
										$('#alamat_vendor').val(data.pembelian.alamat_vendor);
										$('#tanggal').val(data.pembelian.tanggal);
										$('#nama_pembeli').val(data.pembelian.nama_pembeli);

										// Render barang existing
										data.detail_barang.forEach(function(item) {
											var row = `
													<div class="row mb-2 barang-row">
															<div class="col-md-6">
																	<select name="id_barang[]" class="form-control" required>
																			<option value="">- Pilih Barang -</option>
																			${data.list_barang.map(barang => 
																					`<option value="${barang.id}" ${barang.id == item.product_id ? 'selected' : ''}>${barang.name}</option>`
																			).join('')}
																	</select>
															</div>
															<div class="col-md-4">
																	<input type="number" name="qty[]" class="form-control" min="1" value="${item.quantity}" required>
															</div>
															<div class="col-md-2">
																	<button type="button" class="btn btn-danger btn-remove-barang">&times;</button>
															</div>
													</div>
											`;
											$('#barang-wrapper').append(row);
									});

								}
						});
		});



		//Detail barang
		$(document).ready(function() {
				$('#add-barang').click(function() {
						var template = `<?= addslashes($template_barang) ?>`;
						$('#barang-wrapper').append(template);
				});

				$(document).on('click', '.btn-remove-barang', function() {
						$(this).closest('.barang-row').remove();
				});
		});



		//Export
		$('#btn-cetaklaporan-form').click(function() {
		     $('#main-modal-marketing').modal()	   
    			
		})

		$("#btn-export").click(function(){
		      
                tglawal = $("#tglawal").val();
                tglakhir = $("#tglakhir").val();
                 window.open("<?php echo base_url(); ?>barang/exportMasuk/search?tglawal="+encodeURIComponent(tglawal)+"&tglakhir="+encodeURIComponent(tglakhir),"_blank");
                $('#main-modal-marketing').modal('hide')
			
    });


	})

	function updateDatatable() {
		table.ajax.reload(null, false)
	}
</script>