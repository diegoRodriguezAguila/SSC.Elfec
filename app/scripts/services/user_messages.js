/**
 * Created by drodriguez on 29-05-15.
 */
sscApp.factory('UserMessagesService', ['$resource', function ($resource) {
    var service = {
        show: {
            error: function (title, message) {
                toastr.options = {
                    "closeButton": true,
                    "preventDuplicates": true,
                    "showEasing": "swing",
                    "hideEasing": "linear",
                    "showMethod": "fadeIn",
                    "hideMethod": "fadeOut"
                }
                toastr.error(message, title);
            },
            info: function (title, message) {
                toastr.options = {
                    "closeButton": true,
                    "preventDuplicates": true,
                    "showEasing": "swing",
                    "hideEasing": "linear",
                    "showMethod": "fadeIn",
                    "hideMethod": "fadeOut"
                }
                toastr.info(message, title);
            },
            warning: function (title, message) {
                toastr.options = {
                    "closeButton": true,
                    "preventDuplicates": true,
                    "showEasing": "swing",
                    "hideEasing": "linear",
                    "showMethod": "fadeIn",
                    "hideMethod": "fadeOut"
                }
                toastr.warning(message, title);
            },
            success: function (title, message) {
                toastr.options = {
                    "closeButton": true,
                    "preventDuplicates": true,
                    "showEasing": "swing",
                    "hideEasing": "linear",
                    "showMethod": "fadeIn",
                    "hideMethod": "fadeOut"
                }
                toastr.success(message, title);
            }
        },
        hide: {
            all: function () {
                toastr.clear();
            }

        }
    };
    return service;
}]);