<div class="page-header">
    <h1><?php echo $data['title'] ?></h1>
</div>
<?php if (isset($_GET["right"])) { ?>
    <div class="alert alert-dismissible alert-info">
        <button type="button" class="close" data-dismiss="alert">×</button>
        <h4>Listo!</h4>

        <p>Notificacion enviada correctamente</p>
    </div>
<?php } ?>

<form class="form-horizontal" action="/SSC.Elfec/welcome/notification" method="POST" role="form">
    <div class="form-group">
        <label class="control-label" for="messagge"><b>Ingrese la notificacion:</b></label>
        <textarea class="form-control" name="messagge" placeholder="Mensaje..." ></textarea>
    </div>
    <div class="form-group">
        <label class="control-label" for="location"><b>Ubicacion:</b></label>
        <select name="location" class="select2-container form-control select select-primary js-example-basic-single">
            <?php for ($i = 0; $i < count($data['locations']); $i++) { ?>
                <option
                    value="<?php echo $data['locations'][$i]['id'] ?>"><?php echo $data['locations'][$i]['name'] ?></option>

            <?php } ?>
        </select>
    </div>
    <div class="form-group">
        <button class="btn btn-block btn-primary" type="submit">
            Enviar
        </button>
    </div>
</form>
<br>