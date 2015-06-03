/**
 * Created by drodriguez on 27-05-15.
 */
var globalDatResult = null;
sscApp.controller('OutageCasesController', ['$scope', 'OutageCasesService', 'NotificationService', 'UserMessagesService',
    function ($scope, OutageCasesService, NotificationService, UserMessagesService) {
        $scope.selected_outage_case = null;
        $scope.outage_cases = [];
        $scope.notification_message = null;

        $scope.refreshOutageCases = function () {
            $scope.outage_cases = OutageCasesService.outage_cases.getAllExecuting()
                .$promise.then(function (outageCases) {
                    $scope.outage_cases = outageCases;
                    if ($scope.selected_outage_case != null) {
                        $scope.selected_outage_case = $scope.findOutage($scope.selected_outage_case);
                    }
                    setTimeout($scope.refreshOutageCases, 30000);
                }, function (error) {
                    console.log(error);
                });
        };
        $scope.refreshOutageCases();

        $scope.findOutage = function (outage_case_to_find) {
            for (var i in  $scope.outage_cases) {
                if (outage_case_to_find.caso == $scope.outage_cases[i].caso) {
                    return $scope.outage_cases[i];
                }
            }
            return null;
        };

        $scope.verifySelect = function (selected_outage_case) {
            if (selected_outage_case != null)
                $("#placeholder-id").text("");
            $scope.selected_outage_case = JSON.parse(selected_outage_case);
        };

        $scope.convertToDate = function (stringDate) {
            return new Date(stringDate);
        };

        $scope.sendNotification = function () {
            if ($scope.selected_outage_case != null) {
                NotificationService.notifications.send($.param({message: $scope.notification_message,
                    outage_case: $scope.selected_outage_case.caso})).$promise.then(function (data) {
                        globalDatResult = data;
                        UserMessagesService.show.info("Mensaje enviado", 'Se envió el mensaje <i>"'+data.message+'"</i> a los destinatarios correspondientes de forma exitosa!');
                    }, function (error) {
                        UserMessagesService.show.error("Error al enviar el mensaje",(typeof error.error_message != 'undefined')?error.error_message:"");
                        console.log(error);
                    });
            }
            else UserMessagesService.show.error("No se envió ningun mensaje", "Debe seleccionar un caso para poder enviar un mensaje");
        };
    }]);