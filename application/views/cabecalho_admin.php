<!DOCTYPE html>
<html lang="pt-br">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<?php if(isset($titulo_pagina)): ?><title><?= $titulo_pagina ; ?></title><?= PHP_EOL ;?><?php endif;?>
		<meta name="language" content="pt-br" />
		<?php if(isset($keywords_pagina)): ?><meta name="keywords" content="<?= $keywords_pagina;?>"/><?= PHP_EOL ;?><?php endif;?>
		<?php if(isset($descricao_pagina)): ?><meta name="description" content="<?= $descricao_pagina;?>" /><?= PHP_EOL ;?><?php endif;?>
		<?php if(isset($robots_pagina)): ?><meta name="robots" content="<?= $robots_pagina ;?>"><?= PHP_EOL ;?><?php endif;?>
		<?php if(isset($author_pagina)): ?><meta name="author" content="<?= $author_pagina ;?>"><?= PHP_EOL ;?><?php endif;?>
		<?php if(isset($author_reply)): ?><meta name="reply-to" content="<?= $author_reply ;?>"><?= PHP_EOL ;?><?php endif;?>
		<?php $actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"; ?><?= PHP_EOL ;?>
		<link rel="canonical" href="<?= $actual_link;?>" /><?= PHP_EOL ;?>
		<?php if(isset($author_pagina)): ?><meta name="copyright" content="<?= $author_pagina;?> - <?= date('Y');?>" /><?= PHP_EOL ;?><?php endif;?>
		<meta http-equiv="imagetoolbar" content="no" />
		<meta name="rating" content="general" />

		<link href="<?= base_url("assets/css/bootstrap.min.css"); ?>" rel="stylesheet">
		<link href="<?= base_url("assets/css/font-awesome.min.css"); ?>" rel="stylesheet">
		<link href="<?= base_url("assets/css/normalize.css"); ?>" rel="stylesheet">
		<link href="<?= base_url("assets/css/admin/menu/metisMenu.min.css"); ?>" rel="stylesheet">
		<link href="<?= base_url("assets/css/admin/template-admin.css"); ?>" rel="stylesheet">
		<!--[if lt IE 9]>
			<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
			<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
		<?php
			if (isset($jsArray) && is_array($jsArray)) {
				foreach ($jsArray as $value) {
					echo '<script type="text/javascript" src="' . base_url() . $value.'"></script>' . PHP_EOL;
				}
			}
			if (isset($cssArray)) {
				foreach ($cssArray as $value) {
					echo '<link href="' . base_url() . $value.'" type="text/css" rel="stylesheet" />' . PHP_EOL;
				}
			}
		?>
	</head>
	<body>
		<?php
		if (isset($jsArrayBody) && is_array($jsArrayBody)) {
			foreach ($jsArrayBody as $value) {
				echo '<script type="text/javascript" src="' . base_url() . $value.'"></script>' . PHP_EOL;
			}
		}
		?>

	<div id="wrapper">


	<?php // Navigation ?>
	<nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a class="navbar-brand" href="<?= base_url('administracao');?>"><?= $configs['site_nomeConfigs']; ?> - Admin</a>
		</div>
		<?php // .navbar-header ?>

		<div class="navbar-default sidebar" role="navigation">
			<?= getMenuSidebar(); ?>
		</div> 
	</nav>

	<div id="page-wrapper">
		<div class="container-fluid">
			<div class="row">
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<?php if( $this->session->flashdata("success") ) :?>
				<div class="all">
					<div class="container">
						<div class="row">
							<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 alertas-flashdata">
								<div class="bg-success">
									<div class="row">
										<div class="col-lg-1 col-md-1 col-sm-1 col-xs-1">
											<span class="text-center text-success"><span class="glyphicon glyphicon-ok-circle"></span></span>
										</div>
										<div class="col-lg-11 col-md-11 col-sm-11 col-xs-11">
											<p class="text-center text-success"><?= $this->session->flashdata("success") ?></p>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<?php elseif($this->session->flashdata("danger")) : ?>
				<div class="all">
					<div class="container">
						<div class="row">
							<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 alertas-flashdata">
								<div class="bg-danger">
									<div class="row">
										<div class="col-lg-1 col-md-1 col-sm-1 col-xs-1">
											<span class="text-center text-danger"><span class="glyphicon glyphicon-ban-circle"></span></span>
										</div>
										<div class="col-lg-11 col-md-11 col-sm-11 col-xs-11">
											<p class="text-center text-danger"><?= $this->session->flashdata("danger") ?></p>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<?php elseif($this->session->flashdata("info")) : ?>
				<div class="all">
					<div class="container">
						<div class="row">
							<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 alertas-flashdata">
								<div class="bg-info">
									<div class="row">
										<div class="col-lg-1 col-md-1 col-sm-1 col-xs-1">
											<span class="text-center text-info"><span class="glyphicon glyphicon-exclamation-sign"></span></span>
										</div>
										<div class="col-lg-11 col-md-11 col-sm-11 col-xs-11">
											<p class="text-center text-info"><?= $this->session->flashdata("info") ?></p>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<?php endif ?>