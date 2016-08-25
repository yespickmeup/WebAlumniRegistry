/* Start of Angular App*/
var myApp = angular.module('myApp', ['smart-table', 'treasure-overlay-spinner', 'ui.bootstrap'], function ($interpolateProvider) {
    $interpolateProvider.startSymbol('<%');
    $interpolateProvider.endSymbol('%>');
});


myApp.controller('mainController', ['$scope', '$http', function ($scope, $http) {
    console.log('settings controller');
    $scope.msg = 'asd';
}]);


