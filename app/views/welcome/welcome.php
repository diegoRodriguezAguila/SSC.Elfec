<div class="row">
    <div class="col-md-6 col-sm-8 col-md-offset-3 col-sm-offset-2">
        <div class="page-header">
            <h1><?php echo $data['title'] ?></h1>
        </div>
    </div>
</div>
<div class="row" ng-app="sscApp" ng-controller="OutageCasesController" >
    <div class="col-md-2 col-sm-2 col-md-offset-1 col-sm-offset-1">
        <ul class="list-group ng-hide" ng-hide="selected_outage_case == null"
            style="height: 400px; overflow:hidden; overflow-y:scroll;">
            <li ng-repeat="notif in selected_outage_case.sent_notifications" class="list-group-item">
               <small> {{ notif.message }}<br />
                <b>{{notif.sender_user}}</b><br />
                   {{convertToDate(notif.insert_date)}}</small>
            </li>
        </ul>
    </div>
    <div class="col-md-5 col-sm-5">
        <form  ng-submit="sendNotification()"
              class="form-horizontal" role="form">
            <div class="form-group">
                <label class="control-label" for="location"><b>Ubicacion:</b></label>
                <select ng-change="verifySelect(selected_outage_case)" ng-model="selected_outage_case"
                        name="outage_case"
                        class="select2-container form-control select select-primary">
                    <option ng-repeat="outage_case in outage_cases" value="{{ outage_case }}">{{ outage_case.caso + " -
                        " +
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
                                <small
                                    ng-bind="convertToDate(selected_outage_case.fecha_inicio)"></small>
                            </div>
                        </div>
                        <div class="row ng-hide" ng-hide="selected_outage_case.fecha_fin == null">
                            <div class="col-sm-4">
                                <small><strong>Fecha fin:</strong></small>
                            </div>
                            <div class="col-sm-8">
                                <small
                                    ng-bind="convertToDate(selected_outage_case.fecha_fin)"></small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label" for="messagge"><b>Ingrese la notificacion:</b></label>
                <textarea ng-model="notification_message" class="form-control" ng-maxlength=500  maxlength="500" required name="messagge"
                          placeholder="Mensaje..."></textarea>
            </div>
            <div class="form-group">
                <button class="btn btn-block btn-primary" type="submit">
                    Enviar
                </button>
            </div>
        </form>
        <br>
    </div>
</div>