<br>
<div class="row">
    <div class="col-sm-12 ">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h2 class="panel-title">Iniciar Sesion</h2>
            </div>
            <div class="panel-body login-form">
                <div class="row">
                    <?php if (isset($_GET["error"])) { ?>
                        <div class="alert alert-dismissible alert-danger">
                            <button type="button" class="close" data-dismiss="alert">×</button>
                            <h4>Error!</h4>

                            <p>Por favor verifique su password o nombre de usuario</p>
                        </div>
                    <?php } ?>
                    <div class="col-sm-6 col-md-6 col-md-offset-3">
                        <h4 class="text-center login-title">Ingrese sus datos</h4>

                        <div class="account-wall">
                            <form class="form-horizontal" action="/SSC.Elfec/session/auth_user" method="POST" role="form">
                                <div class="form-group input-group">
                                    <span class="input-group-addon fui-user"></span>
                                    <input type="text" class="form-control" name="username" placeholder="Usuario"
                                           required autofocus/>
                                </div>
                                <div class="form-group input-group">
                                    <span class="input-group-addon fui-lock"></span>
                                    <input type="password" class="form-control" name="password" placeholder="Password"
                                           required/>
                                </div>
                                <div class="form-group">
                                    <button class="btn btn-block btn-primary" type="submit">
                                        Ingresar
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>