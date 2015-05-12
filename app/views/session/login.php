<br>

<div class="panel panel-primary">
    <div class="panel-heading">
        <h2 class="panel-title">Iniciar Sesion</h2>
    </div>
    <div class="panel-body">
        <div class="row">
            <?php if(isset($_GET["error"])) {?>
                <div class="alert alert-dismissible alert-warning">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <h4>Error!</h4>
                    <p>Por favor verifique su password o nombre de usuario</p>
                </div>
            <?php } ?>
            <div class="col-sm-8 col-md-8 col-md-offset-2">
                <h1 class="text-center login-title">Ingrese sus datos</h1>
                <div class="account-wall" >
                    <form class="form-signin" action="/SSC.Elfec/session/logout" method="POST">
                        <input type="text" name="username" style="height: 50px" class="form-control" placeholder="Usuario" required autofocus>
                        <br><input type="password" style="height: 50px" name="password" class="form-control" placeholder="Password" required>
                       <br> <button class="btn btn-lg btn-primary btn-block" type="submit">
                            Ingresar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>