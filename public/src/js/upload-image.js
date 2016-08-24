var app = angular.module('fileUpload', ['ngFileUpload'], function ($interpolateProvider) {
    $interpolateProvider.startSymbol('<%');
    $interpolateProvider.endSymbol('%>');

});


app.controller('MyCtrl', ['$scope', '$http', 'Upload', '$timeout', function ($scope, $http, Upload, $timeout) {


    $scope.photoFile = null;

    $scope.uploadFiles = function (file, errFiles) {
        $scope.photoFile = file;
        console.log('$scope.photoFile: ' + file);
        if ($scope.photoFile) {

            $scope.photoFile.upload = Upload.upload({
                url: '/fileUpload2',
                data: {
                    _token: myToken,
                    file: file,
                    filename: 'asdadadda',
                }
            });
            $scope.photoFile.upload.then(function (response) {
                $timeout(function () {
                    $scope.photoFile.result = response.data;
                    console.log(response.data);
                });
            }, function (response) {
                if (response.status > 0)
                    $scope.errorMsg = response.status + ': ' + response.data;
            }, function (evt) {
                $scope.photoFile.progress = Math.min(100, parseInt(100.0 *
                    evt.loaded / evt.total));
            });
        }

    }

    $scope.upload = function (file) {
        Upload.upload({
            url: '/fileUpload2',
            data: {
                _token: myToken,
                file: file,
                filename: 'asdadadda',
            }
        }).then(function (resp) {
            console.log('Success ' + resp.config.data.file.name + 'uploaded. Response: ' + resp.data);
        }, function (resp) {
            console.log('Error status: ' + resp.status);
        }, function (evt) {
            var progressPercentage = parseInt(100.0 * evt.loaded / evt.total);
            console.log('progress: ' + progressPercentage + '% ' + evt.config.data.file.name);
        });
    };
}

]);