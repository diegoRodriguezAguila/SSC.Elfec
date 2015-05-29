/**
 * Created by drodriguez on 27-05-15.
 */
sscApp.controller('OutageCasesController',['$scope', 'OutageCasesService', function($scope, OutageCasesService) {
    $scope.selected_outage_case = null;
    $scope.outage_cases = [];

    $scope.refreshOutageCases = function(){
        $scope.outage_cases = OutageCasesService.outage_cases.getAllExecuting()
            .$promise.then(function (outageCases) {
                $scope.outage_cases = outageCases;
                if ($scope.selected_outage_case!=null){
                    $scope.selected_outage_case = $scope.findOutage($scope.selected_outage_case);
                }
                setTimeout($scope.refreshOutageCases, 5000);
            }, function (error) {});
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

    $scope.convertToDate = function (stringDate){
        return new Date(stringDate);
    };
}]);