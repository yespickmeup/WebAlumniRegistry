var app = angular.module('fileUpload', ['ngFileUpload'], function ($interpolateProvider) {
    $interpolateProvider.startSymbol('<%');
    $interpolateProvider.endSymbol('%>');

});

app.directive('fileModel', ['$parse', function ($parse) {
    return {
        restrict: 'A',
        link: function (scope, element, attrs) {
            var model = $parse(attrs.fileModel);
            var modelSetter = model.assign;

            element.bind('change', function () {
                scope.$apply(function () {
                    modelSetter(scope, element[0].files[0]);
                });
            });
        }
    };
}]);

app.service('fileUpload', ['$http', function ($http) {
    this.uploadFileToUrl = function (file, uploadUrl) {

        var data = {
            '_token': myToken,
            'file': file,
        }
        $http.post(uploadUrl, data)
            .success(function (data, status, headers, config) {
                console.log('data1: ' + JSON.stringify(data));
            })
            .error(function (data, status, headers, config) {
                console.log('data2: ' + data);
            })
        ;
    }
}]);

app.controller('MyCtrl', ['$scope', '$http', 'Upload', '$timeout', 'fileUpload', function ($scope, $http, Upload, $timeout, fileUpload) {

    $scope.imageModel = 'asdad';


    $scope.uploadFiles = function (file, errFiles) {
        $scope.f = file;
        $scope.errFile = errFiles && errFiles[0];

        if (file) {
            file.upload = Upload.upload({
                url: '/fileUpload2',
                data: {
                    _token:myToken,
                    file: file
                }
            });

            file.upload.then(function (response) {
                $timeout(function () {
                    file.result = response.data;
                    console.log(response.data);
                });
            }, function (response) {
                if (response.status > 0)
                    $scope.errorMsg = response.status + ': ' + response.data;
            }, function (evt) {
                file.progress = Math.min(100, parseInt(100.0 *
                    evt.loaded / evt.total));
            });
        }
    }

    $scope.uploadFile = function () {
        var file = $scope.myFile;
        /* console.log('file is ');
         console.dir(file);*/
        var uploadUrl = "/fileUpload2";
        fileUpload.uploadFileToUrl(file, uploadUrl);
    };

    $scope.testUpload1 = function (file) {
        console.log('saving record....' + file);
        /* $scope.spinner.on();
         /!* console.log('user: '+JSON.stringify($scope.user));
         console.log('activities: '+JSON.stringify($scope.activities));
         console.log('members: '+JSON.stringify($scope.members));*!/
         $data = {
         '_token': myToken,
         'user': $scope.user,
         'activities': $scope.activities,
         'members': $scope.members,
         'image': $scope.imageSource,
         }
         $http.post('/api/users/save', $data)
         .success(function (data, status, headers, config) {

         var all = data['all'];
         var user = data['user'];
         var name = data['name'];
         var activities = data['activities'];
         var activity_names = data['activity_names'];
         /!*  console.log('data: '+JSON.stringify(data));*!/
         /!* console.log('user: '+JSON.stringify(user));*!/
         /!*  console.log('collection: '+JSON.stringify(collection));
         console.log('activity_names: '+JSON.stringify(activity_names));*!/
         console.log('name: ' + name);
         window.location.href = loginUrl;
         $scope.spinner.off();
         })
         .error(function (data, status, headers, config) {

         console.log('data: ' + data);
         console.log('status: ' + status);
         $scope.spinner.off();
         })
         ;*/
    }


    /* $scope.upload = function (file) {

     $scope.username = 'asdad';


     file.upload = Upload.upload({
     url: '/fileUpload',
     method: 'POST',
     headers: {
     'my-header': 'my-header-value'
     },
     fields: {username: $scope.username},
     file: file,
     fileFormDataName: 'myFile'
     });

     file.upload.then(function (response) {
     $timeout(function () {
     file.result = response.data;
     });
     }, function (response) {
     if (response.status > 0)
     $scope.errorMsg = response.status + ': ' + response.data;
     });

     file.upload.progress(function (evt) {
     // Math.min is to fix IE which reports 200% sometimes
     file.progress = Math.min(100, parseInt(100.0 * evt.loaded / evt.total));
     });
     };*/
}

]);