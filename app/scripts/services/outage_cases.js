/**
 * Created by drodriguez on 27-05-15.
 */
sscApp.factory('OutageCasesService', ['$resource',  function($resource) {
        var service = {
            outage_cases: $resource('outage_cases', null,
                {
                    getAllExecuting: {method: 'GET', isArray: true}
                })
        };
        return service;
    }]);