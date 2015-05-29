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

<div ng-app="sscApp" ng-controller="OutageCasesController" class="form-horizontal">
    <div class="form-group">
        <label class="control-label" for="location"><b>Ubicacion:</b></label>
        <select ng-change="verifySelect(selected_outage_case)" ng-model="selected_outage_case" name="location"
                class="select2-container form-control select select-primary">
            <option ng-repeat="outage_case in outage_cases" value="{{ outage_case }}">{{ outage_case.caso + " - " +
                outage_case.tipo_corte }}
            </option>
        </select>
    </div>
    <div class="form-group ng-hide" ng-hide="selected_outage_case == null">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h2 class="panel-title">Información del caso</h2>
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-sm-4">
                        <strong>Caso:</strong>
                    </div>
                    <div class="col-sm-8" ng-bind="selected_outage_case.caso"></div>
                </div>
                <div class="row">
                    <div class="col-sm-4">
                        <strong>Tipo de corte:</strong>
                    </div>
                    <div class="col-sm-8" ng-bind="selected_outage_case.tipo_corte"></div>
                </div>
                <div class="row">
                    <div class="col-sm-4">
                        <strong>Suministros afectados:</strong>
                    </div>
                    <div class="col-sm-8" ng-bind="selected_outage_case.suministros_afectados"></div>
                </div>
                <div class="row ng-hide" ng-hide="selected_outage_case.descripcion == null">
                    <div class="col-sm-4">
                        <strong>Descripción:</strong>
                    </div>
                    <div class="col-sm-8" ng-bind="selected_outage_case.descripcion|capitalize_paragraph"></div>
                </div>
                <div class="row">
                    <div class="col-sm-4">
                        <small><strong>Fecha inicio:</strong></small>
                    </div>
                    <div class="col-sm-8">
                        <small ng-bind="convertToDate(selected_outage_case.fecha_inicio)|date : 'dd/MM/yyyy HH:mm:ss'"></small>
                    </div>
                </div>
                <div class="row ng-hide" ng-hide="selected_outage_case.fecha_fin == null">
                    <div class="col-sm-4">
                        <small><strong>Fecha fin:</strong></small>
                    </div>
                    <div class="col-sm-8">
                        <small ng-bind="convertToDate(selected_outage_case.fecha_fin)|date : 'dd/MM/yyyy HH:mm:ss'"></small>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="form-group">
        <label class="control-label" for="messagge"><b>Ingrese la notificacion:</b></label>
        <textarea class="form-control" name="messagge" placeholder="Mensaje..."></textarea>
    </div>
    <div class="form-group">
        <button class="btn btn-block btn-primary" type="submit">
            Enviar
        </button>
    </div>
</div>
<br>