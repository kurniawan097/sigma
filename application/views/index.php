<!doctype html>
<html class="modern fixed has-top-menu has-left-sidebar-half" data-style-switcher-options="{'changeLogo': false}">

<head>
	<base href="<?= base_url() ?>">
	<!-- Basic -->
	<meta charset="UTF-8">

	<title><?= $page_title ?> | <?= $this->config->item('apps_name') ?></title>
	<meta name="keywords" content="Sistem Informasi" />
	<meta name="description" content="<?= $this->config->item('apps_name') ?>">

	<!-- Mobile Metas -->
	<!--<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />-->
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<?php include 'includes_css.php'; ?>

	<!-- Head Libs -->
	<script src="<?= base_url('assets/') ?>vendor/modernizr/modernizr.js"></script>

</head>

<body>
	<section class="body">
		
		<!-- start: header -->
		<?php include 'includes_header.php'; ?>
		<!-- end: header -->

		<div class="inner-wrapper">
			<!-- start: sidebar -->			
			<?php
				if($switch == "home"){
					include 'includes_aside.php';
				}
				 
			?>
			<!-- end: sidebar -->

			<section role="main" class="content-body content-body-modern mt-0">
				<!-- start: page -->
				<?php include 'pages/' . $page_name . '.php'; ?>
				<!-- end: page -->
			</section>

			<?php include 'includes_js.php'; ?>
	</section>
</body>

</html>