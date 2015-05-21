<div class="page-header">
	<h1><?php echo $data['title'] ?></h1>
</div>
<?php if(isset($_GET["right"])) {?>
    <div class="alert alert-dismissible alert-warning">
        <button type="button" class="close" data-dismiss="alert">×</button>
        <h4>Listo!</h4>
        <p>Notificacion enviada correctamente</p>
    </div>
<?php } ?>

<form class="form-signin" action="/SSC.Elfec/welcome/notification" method="POST">
<b>Ingrese la notificacion:</b>
<textarea class="form-control" name="messagge">
</textarea>
    <b>Ubicacion:</b>
<select name="location" class="col-lg-6 form-control js-example-basic-single">
    <?php for($i=0;$i<count($data['locations']);$i++){ ?>
    <option value="<?php echo $data['locations'][$i]['id']?>"><?php echo $data['locations'][$i]['name']?></option>

    <?php } ?>
</select>
    <br><br>
<button class="form-control alert-success" type="submit">Enviar</button>
</form>
<br>