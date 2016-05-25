'use strict';

var app = angular.module('app', [
    'ngRoute',          //$routeProvider
    'mgcrea.ngStrap',   //bs-navbar, data-match-route directives
    'controllers'      //Our module frontend/web/js/controllers.js
    /*'ngMaterial',
    'ngMessages'  */
]);

app.config(['$routeProvider', '$httpProvider',
    function($routeProvider, $httpProvider) {
        $routeProvider.
            when('/', {
                templateUrl: 'partials/index.html'
            }).
            when('/about', {
                templateUrl: 'partials/about.html'
            }).
            when('/contact', {
                templateUrl: 'partials/contact.html',
                controller: 'ContactController'
            }).
            when('/login', {
                templateUrl: 'partials/login.html',
                controller: 'LoginController'
            }).
            when('/dashboard', {
                templateUrl: 'partials/dashboard.html',
                controller: 'DashboardController'
            }).
            otherwise({
                templateUrl: 'partials/404.html'
            });
        $httpProvider.interceptors.push('authInterceptor');
    }
]);
app.directive('onFinishRender', function ($timeout) {
    return {
        restrict: 'A',
        link: function (scope, element, attr) {
            if (scope.$last === true) {
                $timeout(function () {
                    scope.$emit('ngRepeatFinished');
                });
            }
        }
    }
});
app.directive('onDocumentClick', function ($document) {
    return {
        restrict: 'A',
        link: function(scope, element, attrs) {

            var onClick = function() {
                scope.$apply(function() {
                    scope.$eval(attrs.onDocumentClick);
                });
            };

            $document.on('click', onClick);

            scope.$on('$destroy', function() {
                $document.off('click', onClick);
            });
        }
    }
});
app.factory('authInterceptor', function ($q, $window, $location) {
    return {
        request: function (config) {
            if ($window.sessionStorage.access_token) {
                //HttpBearerAuth
                config.headers.Authorization = 'Bearer ' + $window.sessionStorage.access_token;
            }
            return config;
        },
        responseError: function (rejection) {
            if (rejection.status === 401) {
                $location.path('/login').replace();
            }
            return $q.reject(rejection);
        }
    };
});
