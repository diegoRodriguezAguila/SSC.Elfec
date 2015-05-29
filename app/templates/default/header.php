<!DOCTYPE html>
<html lang="<?php echo LANGUAGE_CODE; ?>">
<head>

    <!-- Site meta -->
    <meta charset="utf-8">
    <title><?php echo $data['title'] . ' - ' . SITETITLE; //SITETITLE defined in app/core/config.php ?></title>
    <!-- CSS -->
    <?php
    helpers\assets::css([
        helpers\url::cssTemplatePath() . 'vendor/bootstrap.min.css',
        helpers\url::cssTemplatePath() . 'flat-ui.css',
        helpers\url::cssTemplatePath() . 'select2.min.css',
        helpers\url::cssTemplatePath() . 'style.css']);
    $js = [
        helpers\Url::jsTemplatePath() . 'vendor/jquery.min.js',
        helpers\Url::jsTemplatePath() . 'select2.min.js',
        helpers\Url::jsTemplatePath() . 'flat-ui.js',
        helpers\Url::jsTemplatePath() . 'application.js',
        helpers\Url::jsTemplatePath() . 'angular.min.js',
        helpers\Url::jsTemplatePath() . 'angular-resource.min.js',
        helpers\Url::scriptControllerPath() . 'app.js'];
    if(isset($data['angular_services']))
        foreach ($data['angular_services'] as $angular_service)
            array_push($js,  helpers\Url::scriptServicePath().$angular_service);
    if(isset($data['angular_controllers']))
        foreach ($data['angular_controllers'] as $angular_controller)
            array_push($js,  helpers\Url::scriptControllerPath().$angular_controller);
    helpers\assets::js($js);
    ?>
    <link rel="icon"
          type="image/png"
          href="<?php echo helpers\url::templatePath() . 'img/favicon.png' ?>">
    <script>
        $(document).ready(function () {
            $('.dropdown-toggle').dropdown();
        });
    </script>
</head>
<body>
<div class="row">
    <div class="col-xs-12 col-lg-12 col-md-12 col-sm-12">
        <nav class="navbar navbar-default">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                            data-target="#bs-example-navbar-collapse-1">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="#">SSC Elfec</a>
                </div>

                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav navbar-right">
                        <?php
                        use helpers\Session;

                        if (Session::get('username') != null) {
                            ?>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <?php echo Session::get('username') ?>
                                    <b class="caret"></b>
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
    <div class="col-md-6 col-sm-8 col-md-offset-3 col-sm-offset-2">
