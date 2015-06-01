/**
 * Created by drodriguez on 27-05-15.
 */
var sscApp = angular.module('sscApp', ['ngResource'])
    .config(function($httpProvider) {

        delete $httpProvider.defaults.headers.common['X-Requested-With'];
        // Use x-www-form-urlencoded Content-Type
        $httpProvider.defaults.headers.post['Content-Type'] = 'application/x-www-form-urlencoded;charset=utf-8';

        $httpProvider.defaults.transformRequest = [function(data)
        {
            return angular.isObject(data) && String(data) !== '[object File]' ? jQuery.param(data) : data;
        }];
    })
    .filter('capitalize_paragraph', function() {
        return function(input, scope) {
            if (input!=null)
            {
                input = input.toLowerCase();
                return input.substring(0,1).toUpperCase()+input.substring(1);
            }
            return null;
        }
    });