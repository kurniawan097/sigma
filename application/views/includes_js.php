<!-- Vendor -->
<script src="<?= base_url('assets/') ?>vendor/jquery/jquery.js"></script>
<script src="<?= base_url('assets/') ?>vendor/jquery-browser-mobile/jquery.browser.mobile.js"></script>
<script src="<?= base_url('assets/') ?>vendor/jquery-cookie/jquery.cookie.js"></script>
<script src="<?= base_url('assets/') ?>vendor/popper/umd/popper.min.js"></script>
<script src="<?= base_url('assets/') ?>vendor/bootstrap/js/bootstrap.js"></script>
<script src="<?= base_url('assets/') ?>vendor/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
<script src="<?= base_url('assets/') ?>vendor/common/common.js"></script>
<script src="<?= base_url('assets/') ?>vendor/nanoscroller/nanoscroller.js"></script>
<script src="<?= base_url('assets/') ?>vendor/magnific-popup/jquery.magnific-popup.js"></script>
<script src="<?= base_url('assets/') ?>vendor/jquery-placeholder/jquery.placeholder.js"></script>

<!-- Specific Page Vendor -->
<script src="<?= base_url('assets/') ?>vendor/jquery-ui/jquery-ui.js"></script>
<script src="<?= base_url('assets/') ?>vendor/jqueryui-touch-punch/jquery.ui.touch-punch.js"></script>
<script src="<?= base_url('assets/') ?>vendor/jquery-validation/jquery.validate.js"></script>
<script src="<?= base_url('assets/') ?>vendor/select2/js/select2.js"></script>
<script src="<?= base_url('assets/') ?>vendor/dropzone/dropzone.js"></script>
<script src="<?= base_url('assets/') ?>vendor/pnotify/pnotify.custom.js"></script>
<script src="<?= base_url('assets/') ?>vendor/datatables/media/js/jquery.dataTables.min.js"></script>
<script src="<?= base_url('assets/') ?>vendor/datatables/media/js/dataTables.bootstrap4.min.js"></script>
<script src="<?= base_url('assets/') ?>js/global.js"></script>
<script src="<?= base_url('assets/') ?>js/jquery.mask.min.js"></script>
<script src="<?= base_url('assets/') ?>js/table2excel.min.js"></script>
<script src="<?= base_url('assets/') ?>/js/sweetalert2/sweetalert2.min.js"></script>
<script src="<?= base_url('assets/') ?>/js/chart/chart.min.js"></script>
<script src="<?= base_url('assets/') ?>/js/ckeditor/ckeditor.js"></script>
<script src="<?= base_url('assets/') ?>/js/croppie/croppie.js"></script>

<!--(remove-empty-lines-end)-->

<!-- Theme Base, Components and Settings -->
<script src="<?= base_url('assets/') ?>js/theme.js"></script>


<!-- Theme Initialization Files -->
<script src="<?= base_url('assets/') ?>js/theme.init.js"></script>

<input type="hidden" name="token" value="<?= $this->security->get_csrf_hash() ?>">

<script>
	let token = $('input[name=token]').val()
	// Maintain Scroll Position
	if (typeof localStorage !== 'undefined') {
		if (localStorage.getItem('sidebar-left-position') !== null) {
			var initialPosition = localStorage.getItem('sidebar-left-position'),
				sidebarLeft = document.querySelector('#sidebar-left .nano-content');

			sidebarLeft.scrollTop = initialPosition;
		}
	}


</script>