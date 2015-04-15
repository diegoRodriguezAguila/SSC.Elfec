<!DOCTYPE html>
<html lang="<?php echo LANGUAGE_CODE; ?>">
<head>

	<!-- Site meta -->
	<meta charset="utf-8">
	<title><?php echo $data['title'].' - '.SITETITLE; //SITETITLE defined in app/core/config.php ?></title>

	<!-- CSS -->
	<?php
		helpers\assets::css(array(
			'//maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css',
			helpers\url::template_path() . 'css/style.css',
		));
    helpers\assets::js(array(helpers\Url::template_path().'js/jquery.min.js',helpers\Url::template_path().'js/bootstrap.min.js',helpers\Url::template_path().'js/bootstrap.dropdown.js'));
	?>
    <script>
        $(document).ready(function () {
            $('.dropdown-toggle').dropdown();
        });
    </script
</head>
<body style='background-image:url(/SSC.Elfec/app/templates/default/images/fondo.jpg); background-size: 100%;' >
<div class="row" style='background-image:url(/SSC.Elfec/app/templates/default/images/imagenaca.png); background-size: 100%; height: 100px; width:100%'></div>
<nav class="navbar navbar-default">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">Logo aca</a>
        </div>

        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li class="active"><a href="#">Link <span class="sr-only">(current)</span></a></li>
                <li><a href="#">Link</a></li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Dropdown <span class="caret"></span></a>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href="#">Action</a></li>
                        <li><a href="#">Another action</a></li>
                        <li><a href="#">Something else here</a></li>
                        <li class="divider"></li>
                        <li><a href="#">Separated link</a></li>
                        <li class="divider"></li>
                        <li><a href="#">One more separated link</a></li>
                    </ul>
                </li>
            </ul>
            <form class="navbar-form navbar-left" role="search">
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="Buscar">
                </div>
                <button type="submit" class="btn btn-default">Submit</button>
            </form>
            <ul class="nav navbar-nav navbar-right">
                <li><a href="/SSC.Elfec/logout">Link</a></li>
            </ul>
        </div>
    </div>
</nav>
<div class="row">
        <div class="col-lg-2"></div>
        <div class="col-lg-8"  style="border-style: dashed;border-width: 1px; background-color:#ffffff;">
                <div >

