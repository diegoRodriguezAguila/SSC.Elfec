<!DOCTYPE html>
<html lang="<?php echo LANGUAGE_CODE; ?>">
<head>

	<!-- Site meta -->
	<meta charset="utf-8">
	<title><?php echo $data['title'].' - '.SITETITLE; //SITETITLE defined in app/core/config.php ?></title>

	<!-- CSS -->
	<?php
		helpers\assets::css([
            helpers\url::template_path() . 'css/vendor/bootstrap.min.css',
            helpers\url::template_path() . 'css/flat-ui.css',
            helpers\url::template_path() . 'css/select2.min.css',
			helpers\url::template_path() . 'css/style.css', helpers\url::template_path().'css/dropdown.css',
		]);
    helpers\assets::js([helpers\Url::template_path().'js/jquery.min.js', helpers\Url::template_path().'js/select2.min.js',
        helpers\Url::template_path().'js/flat-ui.js', helpers\Url::template_path().'js/bootstrap.min.js',helpers\Url::template_path().'js/bootstrap.dropdown.js']);
	?>
    <link rel="icon"
          type="image/png"
          href="<?php  echo helpers\url::template_path().'img/favicon.png' ?>">
    <script>
        $(document).ready(function () {
            $('.dropdown-toggle').dropdown();
        });
    </script>
</head>
<body style='background-image:url(/SSC.Elfec/app/templates/default/img/fondo.jpg); background-size: 100%;' >
<div class="row">
    <div class="col-xs-12 col-lg-12 col-md-12 col-sm-12">
<nav class="navbar navbar-default">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">SSC Elfec</a>
        </div>

        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav navbar-right">
                <?php use helpers\Session; if(Session::get('username')!=null){?>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <?php echo Session::get('username') ?>
                            <b class="caret" ></b>
                        </a>
                        <span class="dropdown-arrow"></span>
                        <ul class="dropdown-menu">
                            <li><a href="/SSC.Elfec/logout">Salir</a></li>
                        </ul>
                    </li>

                <?php } ?>
            </ul>
        </div>
    </div>
</nav>
</div>
</div>
<div class="row">
        <div class="col-lg-2"></div>
        <div class="col-lg-8"  style="border-style: dashed;border-width: 1px; background-color:#ffffff;">
                <div >

