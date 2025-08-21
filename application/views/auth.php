<!doctype html>
<html class="fixed">

<head>
	<meta charset="UTF-8">
	<title>Login Page | <?= $this->config->item('apps_name') ?></title>
	<meta name="keywords" content="Sistem Informasi" />
	<meta name="description" content="<?= $this->config->item('apps_name') ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
	<link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800|Shadows+Into+Light" rel="stylesheet" type="text/css">
	<link rel="stylesheet" href="<?= base_url() ?>assets/vendor/bootstrap/css/bootstrap.css" />
	<link rel="stylesheet" href="<?= base_url() ?>assets/vendor/animate/animate.compat.css">
	<link rel="stylesheet" href="<?= base_url() ?>assets/vendor/font-awesome/css/all.min.css" />
	<link rel="stylesheet" href="<?= base_url() ?>assets/vendor/boxicons/css/boxicons.min.css" />
	<link rel="stylesheet" href="<?= base_url() ?>assets/vendor/magnific-popup/magnific-popup.css" />
	<link rel="stylesheet" href="<?= base_url() ?>assets/vendor/bootstrap-datepicker/css/bootstrap-datepicker3.css" />
	<link rel="stylesheet" href="<?= base_url('assets/') ?>vendor/simple-line-icons/css/simple-line-icons.css" />
	<link rel="stylesheet" href="<?= base_url('assets/') ?>js/sweetalert2/sweetalert2.min.css" />
	<link rel="stylesheet" href="<?= base_url() ?>assets/css/theme.css" />
	<link rel="stylesheet" href="<?= base_url() ?>assets/css/custom.css">
	<link rel="shortcut icon" href="<?= base_url('assets/') ?>img/favicon.png" />
	<script src="<?= base_url() ?>assets/vendor/modernizr/modernizr.js"></script>
	<script src="<?= base_url() ?>assets/master/style-switcher/style.switcher.localstorage.js"></script>
</head>

<body>
	<section class="body-sign body-locked">
		<div class="center-sign">
			<div class="panel card-sign">
				<div class="card-body">
					<?php if ($mode == "form-login") { ?>
						<?= form_open("auth/oauth", array('id' => 'kt_login_signin_form', 'class' => 'form', 'autocomplete' => 'off')); ?>
						<?php if ($this->config->item('apps_mode') == 'PKS') { ?>
							<div class="current-user text-center">
								<img src="<?= base_url() ?>assets/img/sigma_logo.png" alt="logo pks" class="rounded-circle user-image" />
								<h2 class="user-name text-dark m-0">Sign In</h2>
								<p class="user-email m-0">Silahkan masukkan Email & Password anda</p>
							</div>
						<?php } else { ?>
							<div class="current-user text-center mt-0">
								<h2 class="user-name text-dark m-0">Sign In</h2>
								<p class="user-email m-0">Silahkan masukkan Email & Password anda</p>
							</div>
						<?php } ?>
						<?= $this->session->flashdata('error') ? '<div class="alert alert-danger text-center" role="alert">' . $this->session->flashdata('error') . '</div>' : '' ?>
						<?= $this->session->flashdata('success') ? '<div class="alert alert-success text-center" role="alert">' . $this->session->flashdata('success') . '</div>' : '' ?>
						<div class="lgn-form">
							<div class="form-group mb-3">
								<div class="input-group">
									<input name="email" type="email" class="form-control" placeholder="Email" />
									<span class="input-group-append">
										<span class="input-group-text">
											<i class="bx bx-envelope"></i>
										</span>
									</span>
								</div>
								<br>
								<div class="input-group">
									<input name="password" type="password" class="form-control" placeholder="Password" />
									<span class="input-group-append">
										<span class="input-group-text">
											<i class="bx bxs-key"></i>
										</span>
									</span>
								</div>
							</div>
							<div class="row">
								<div class="col-6">
									
								</div>
								<div class="col-6">
									<button type="submit" class="btn btn-primary pull-right" id="btn-submit">Sign In</button>
								</div>
							</div>
						</div>
						<?= form_close() ?>

					<?php } else if ($mode == "form-register") { ?>
						<?= form_open("auth/register", array('id' => 'kt_login_signin_form', 'class' => 'form', 'autocomplete' => 'off')); ?>
						<div class="current-user text-center mt-0">
							<h2 class="user-name text-dark m-0">Sign Up</h2>
							<p class="user-email m-0">Silahkan isi Biodata anda dengan benar</p>
						</div>
						<h4>Data diri <span class="text-danger">*</span></h4>
						<div id="rgstr" class="rgstr-form">
							<div class="form-group mb-3">
								<div class="form-group">
									<input class="form-control" type="text" placeholder="Nama Lengkap" name="nama" required>
								</div>
								<div class="form-group">
									<input class="form-control" type="text" placeholder="No Handphone" name="no_hp" autocomplete="off" required>
								</div>
							</div>
							<!-- <div class="form-group">
								<select class="form-control" name="level" required>
									<option value="">Level User...</option>
									<option value="Staf Admin">Staff Admin</option>
									<option value="Marketing">Marketing</option>
								</select>
							</div> -->
							<!--<h4>Alamat saat ini <span class="text-danger">*</span></h4>-->
							<!--<div class="form-group">-->
							<!--	<textarea class="form-control" name="alamat" required placeholder="..."></textarea>-->
							<!--</div>-->
							<h4>Akun Email & Password <span class="text-danger">*</span></h4>
							<div class="form-group">
								<input class="form-control" type="text" placeholder="Email" name="email" autocomplete="off" required>
							</div>
							<div class="form-group">
								<input class="form-control" type="password" placeholder="Password" name="password" id="password" required>
							</div>
							<div class="form-group">
								<input class="form-control" type="password" placeholder="Confirm Password" name="cpassword" id="cpassword" required>
							</div>
							<?= $this->session->flashdata('error') ? '<div class="alert alert-danger" role="alert">' . $this->session->flashdata('error') . '</div>' : '' ?>
							<?= $this->session->flashdata('success') ? '<div class="alert alert-success" role="alert">' . $this->session->flashdata('success') . '</div>' : '' ?>
							<div class="text-center">
								<button type="button" class="btn btn-primary btn-submit-daftar">Submit</button>
								<a class="btn btn-danger" href="javascript:history.back()">Cancel</a>
							</div>
						</div>
						<?= form_close() ?>
					<?php } ?>
				</div>
			</div>
			<div style="width: 100%;" class="text-center">
				<div class="text-light" style="position: absolute;bottom: 0;width: 100%;">&copy; SIGMA 2025 by Kurniawan
				</div>
			</div>
		</div>
	</section>
	<input type="hidden" name="token" value="<?= $this->security->get_csrf_hash() ?>">
	<script src="<?= base_url() ?>assets/vendor/jquery/jquery.js"></script>
	<script src="<?= base_url() ?>assets/vendor/jquery-browser-mobile/jquery.browser.mobile.js"></script>
	<script src="<?= base_url() ?>assets/vendor/jquery-cookie/jquery.cookie.js"></script>
	<script src="<?= base_url() ?>assets/vendor/popper/umd/popper.min.js"></script>
	<script src="<?= base_url() ?>assets/vendor/bootstrap/js/bootstrap.js"></script>
	<script src="<?= base_url() ?>assets/vendor/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
	<script src="<?= base_url() ?>assets/vendor/common/common.js"></script>
	<script src="<?= base_url() ?>assets/vendor/nanoscroller/nanoscroller.js"></script>
	<script src="<?= base_url() ?>assets/vendor/magnific-popup/jquery.magnific-popup.js"></script>
	<script src="<?= base_url() ?>assets/vendor/jquery-placeholder/jquery.placeholder.js"></script>
	<script src="<?= base_url() ?>assets/js/theme.js"></script>
	<script src="<?= base_url() ?>assets/js/theme.init.js"></script>
	<script src="<?= base_url('assets/') ?>/js/sweetalert2/sweetalert2.min.js"></script>
	<script src="<?= base_url('assets/') ?>js/global.js"></script>
	<script>
		let token = $('input[name=token]').val()
	</script>
	<?php if ($mode == 'form-register') { ?>
		<link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A==" crossorigin="" />
		<script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js" integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA==" crossorigin=""></script>
		<script>
			var map;
			var popup;

			document.addEventListener("DOMContentLoaded", function() {
				initMap()

				$('.btn-submit-daftar').on('click', function() {
					const form = $(this).closest('form')
					const url = form.attr('action')
					const formId = form.attr('id')
					Swal.fire({
						title: 'Apakah anda yakin?',
						text: 'Pastikan data yang anda masukkan sudah benar!',
						icon: 'question',
						showCancelButton: true,
						confirmButtonText: 'Ya',
						cancelButtonText: 'Batal'
					}).then(function(result) {
						if (result.value) {
							$.ajax({
								url: url,
								type: "POST",
								data: new FormData($('#' + formId)[0]),
								contentType: false,
								processData: false,
								dataType: "JSON",
								success: function(resp) {
									if (resp['status'] == 'error') {
										return Swal.fire({
											html: `<h4>${resp['msg']}</h4>`,
											icon: resp['status']
										})
									} else {
										handleResponse(resp)
									}
								}
							});
						}
					})
				})
			})

			function initMap() {
				setTimeout(() => {
					existMap = new L.map('mapid', {
						center: [-1.239751, 116.8503613, 14],
						zoom: 12
					});
					popup = L.popup();
					L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token={accessToken}', {
						attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a>, <a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, © <a href="https://www.mapbox.com/">Mapbox</a>',
						maxZoom: 18,
						id: 'mapbox/streets-v11',
						accessToken: 'pk.eyJ1IjoiZmlrcmltdWhhZmZpemgiLCJhIjoiY2s4M3diamJ1MGIxOTNlbXVqMzliZWs0NyJ9.mMYzqzk2WlpzzSdZiEWb6g'
					}).addTo(existMap);
					existMap.on('click', onMapClick);
					existMap.invalidateSize(true);
				}, 500);
			}

			function onMapClick(e) {
				var longt = parseFloat(e.latlng['lng']).toFixed(8)
				var lat = parseFloat(e.latlng['lat']).toFixed(8)
				$('#longitude').val(longt)
				$('#latitude').val(lat)
				$('#longitude_text').html(parseFloat(longt))
				$('#latitude_text').html(parseFloat(lat))
				popup
					.setLatLng(e.latlng)
					.setContent("Alamat Saya Disini")
					.openOn(existMap);
			}
		</script>
	<?php } ?>
</body>

</html>