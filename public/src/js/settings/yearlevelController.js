myApp.controller('yearController', ['$scope', '$http', function ($scope, $http) {

    console.log('year-level controllers');
    $scope.itemsByPage = 5;
    $scope.itemsByPage2 = 5;

    var idLevel = 1;
    $scope.level = {
        id: '',
        level: ''
    }
    $scope.levels = [];

    for (idLevel; idLevel < 5; idLevel++) {
        $scope.level = {
            id: idLevel,
            level: 'level' + idLevel
        }
        $scope.levels.push($scope.level);
    }


    var id = 1;
    $scope.year = {
        id: '',
        year: ''
    }
    $scope.years = [];

    for (id; id < 5; id++) {
        $scope.year = {
            id: id,
            year: 'year' + id
        }
        $scope.years.push($scope.year);
    }

}]);
