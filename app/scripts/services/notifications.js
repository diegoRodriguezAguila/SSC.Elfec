/**
 * Created by drodriguez on 29-05-15.
 */
sscApp.factory('NotificationService', ['$resource',  function($resource) {
    var service = {
        notifications: $resource('notifications/notification', {},
            {
                send: {method: 'POST'}
            })
    };
    return service;
}]);