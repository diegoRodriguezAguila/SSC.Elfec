/**
 * Created by drodriguez on 27-05-15.
 */
var sscApp = angular.module('sscApp', ['ngResource'])
    .filter('capitalize_paragraph', function() {
        return function(input, scope) {
            if (input!=null)
                input = input.toLowerCase();
            return input.substring(0,1).toUpperCase()+input.substring(1);
        }
    });