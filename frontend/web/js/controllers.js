'use strict';

var controllers = angular.module('controllers', []);

controllers.controller('MainController', ['$scope', '$location', '$window',
    function ($scope, $location, $window) {
        $scope.loggedIn = function() {
            return Boolean($window.sessionStorage.access_token);
        };

        $scope.logout = function () {
            delete $window.sessionStorage.access_token;
            $location.path('/login').replace();
        };
    }
]);

controllers.controller('ContactController', ['$scope', '$http', '$window',
    function($scope, $http, $window) {
        $scope.captchaUrl = 'site/captcha';
        $scope.contact = function () {
            $scope.submitted = true;
            $scope.error = {};
            $http.post('api/contact', $scope.contactModel).success(
                function (data) {
                    $scope.contactModel = {};
                    $scope.flash = data.flash;
                    $window.scrollTo(0,0);
                    $scope.submitted = false;
                    $scope.captchaUrl = 'site/captcha' + '?' + new Date().getTime();
            }).error(
                function (data) {
                    angular.forEach(data, function (error) {
                        $scope.error[error.field] = error.message;
                    });
                }
            );
        };

        $scope.refreshCaptcha = function() {
            $http.get('site/captcha?refresh=1').success(function(data) {
                $scope.captchaUrl = data.url;
            });
        };
    }]);

controllers.controller('DashboardController', ['$scope', '$http',
    function ($scope, $http) {
        $http.get('dashboard').success(function (data) {
           $scope.dashboard = data;
        })
    }
]);

controllers.controller('LoginController', ['$scope', '$http', '$window', '$location',
    function($scope, $http, $window, $location) {
        $scope.showHints = true;
        $scope.login = function () {
            $scope.submitted = true;
            $scope.error = {};
            $http.post('login', $scope.user).success(
                function (data) {
                    $window.sessionStorage.access_token = data.access_token;
                    $location.path('/dashboard').replace();
            }).error(
                function (data) {
                    $scope.showHints = false;
                    angular.forEach(data, function (error) {
                        $scope.error[error.field] = error.message;
                    });
                }
            );
        };
    }
]);

controllers.controller('IngredientController', ['$scope', '$http',
    function ($scope, $http) {
        var getIngredients = function () {
            return $http.get('get-ingredients');
        };
        var promise = getIngredients();
        promise.then(function(resolve) {
            $scope.notSelectedIngredients = resolve.data;
            $scope.ingredients = [];
            $scope.recipes = [];
            $scope.changeIngredient = changeIngredient;
        });
        $scope.$on('ngRepeatFinished', function(ngRepeatFinishedEvent) {
            load_script();
        });
        function load_script() {
            var s = document.createElement('script'); // use global document since Angular's $document is weak
            s.src = 'scripts/custom.js';
            document.body.appendChild(s);

        }

        function changeIngredient() {
            $('.ingredient-select').chosen().change(function(e, params) {
	            if (
                       (params.selected && $.inArray(params.selected, $scope.ingredients) == -1) ||
                       (params.deselected && $.inArray(params.deselected, $scope.ingredients) != -1)
                ) {
                    $scope.ingredients = $(".ingredient-select").chosen().val();
                    getRecipes();
                }
            });
        }

        function getRecipes() {
            var recipes = function () {
                return $http.post('get-recipes', {ingredients: $scope.ingredients});
            };
            var promise = recipes();
            promise.then(function(resolve) {
                $scope.recipes = resolve.data;
                console.log($scope.recipes);
            });
        }
    }
]);
