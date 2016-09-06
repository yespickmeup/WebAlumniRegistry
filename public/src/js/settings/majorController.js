myApp.controller('majorController', ['$scope', '$http', 'ModalService', 'majorService', function ($scope, $http, ModalService, majorService) {


    /* Level*/
    $scope.showAddMajorSuccess = false;
    $scope.showUpdateMajorSuccess = false;
    $scope.showDeleteMajorSuccess = false;


    $scope.showMajorAdd = true;
    $scope.showMajorUpdate = false;
    $scope.itemsByPage2 = 20;


    $scope.major = {
        id: 0,
        level_id: 0,
        year_id: 0,
        course_id: 0,
        major: ''
    };


    $scope.inputMajor = '';


    $scope.majors = [];

    majorService.getMajors().then(function (resp) {
        var majors = JSON.stringify(resp.data['majors']);
        $.each(JSON.parse(majors), function (idx, obj) {
            var data = {};
            data.id = obj.id;
            data.level_id = obj.level_id;
            data.year_id = obj.year_id;
            data.course_id = obj.course_id;
            data.major = obj.major;
            $scope.majors.push(data);

        });
    });


    $scope.newMajor = function () {
        $scope.inputMajor = '';
        angular.element('#inputMajor').focus();
    }

    $scope.addMajor = function (myFormMajor) {
        var data = {};
        data.id = 0;
        data.level_id = 0;
        data.year_id = 0;
        data.course_id = 0;
        data.major = $scope.inputMajor;
        data.status = 1;

        if ($scope.myFormMajor.inputMajor.$valid) {
            majorService.addMajor($scope.inputMajor, data.level_id, data.year_id,data.course_id).then(function (resp) {

                var message = JSON.stringify(resp.data['major']);
                if (resp.status == 200) {
                    var id = JSON.parse(message).id;
                    data.id = id;
                    $scope.majors.push(data);
                    $scope.inputMajor = '';
                    myFormMajor.inputMajor.$touched = true;
                    angular.element('#inputMajor').focus();

                    $scope.showAddMajorSuccess = true;
                    setTimeout(function () {
                        $scope.$apply(function () {
                            $scope.showAddMajorSuccess = false;
                        });
                    }, 500);
                }
            });
        }

    }

    $scope.editMajor = function (major) {
        $scope.majorOnEdit = major;
        $scope.inputMajor = major.major;
        $scope.showMajorAdd = false;
        $scope.showMajorUpdate = true;
        angular.element('#inputMajor').focus();
    }

    $scope.updateMajor = function () {

        majorService.updateMajor($scope.majorOnEdit.id, $scope.inputMajor).then(function (resp) {
            var message = JSON.stringify(resp.data['message']);
            console.log('message: ' + message);
            if (resp.status == 200) {
                $scope.majorOnEdit.major = $scope.inputMajor;
                $scope.showMajorAdd = true;
                $scope.showMajorUpdate = false;
                $scope.inputMajor = '';
                angular.element('#inputMajor').focus();
                myFormMajor.inputMajor.$touched = false;

                $scope.showUpdateMajorSuccess = true;
                setTimeout(function () {
                    $scope.$apply(function () {
                        $scope.showUpdateMajorSuccess = false;
                    });
                }, 500);

            }
        });


    }

    $scope.confirmDeleteMajor = function (major) {

        ModalService.showModal({
            templateUrl: 'modal.html',
            controller: "ModalMajorController"
        }).then(function (modal) {
            modal.element.modal();

            modal.close.then(function (result) {
                if (result == 'Yes') {
                    majorService.deleteMajor(major.id).then(function (resp) {
                        var message = JSON.stringify(resp.data['message']);
                        console.log('message:' + message);
                        if (resp.status == 200) {
                            var index = $scope.majors.indexOf(major);
                            if (index !== -1) {
                                $scope.majors.splice(index, 1);
                                angular.element('#inputMajor').focus();
                            }
                            $scope.showDeleteMajorSuccess = true;
                            setTimeout(function () {
                                $scope.$apply(function () {
                                    $scope.showDeleteMajorSuccess = false;
                                });
                            }, 500);

                        }
                    });

                }
            });
        });
    };

}]);


myApp.controller('ModalMajorController', function ($scope, close) {
    $scope.close = function (result) {
        close(result, 500); // close, but give 500ms for bootstrap to animate
    };
});

myApp.service('majorService', function ($http) {
    this.getMajors = function () {
        return $http({
            method: 'GET',
            url: baseURL + '/api/majors'
        })
            .success(function (data, status, headers, config) {
                /* console.log('getMajors() success ');*/
            })
            .error(function (data, status, headers, config) {
                console.log('getMajors() error');
            });
    };

    this.addMajor = function (major, level_id, year_id,course_id) {

        return $http({
            method: 'POST',
            url: baseURL + '/api/major_add',
            data: {
                _token: myToken,
                major: major,
                level_id: level_id,
                year_id: year_id,
                course_id: course_id,
            }
        })
            .success(function (data, status, headers, config) {
                /*  console.log('add_major() success ');*/
            })
            .error(function (data, status, headers, config) {
                console.log('add_major() error');
            });
    };

    this.updateMajor = function (id, major) {
        return $http({
            method: 'POST',
            url: baseURL + '/api/major_update',
            data: {
                _token: myToken,
                id: id,
                major: major
            }
        })
            .success(function (data, status, headers, config) {
                /* console.log('update_year() success ');*/
            })
            .error(function (data, status, headers, config) {
                console.log('update_major() error');
            });
    };
    this.deleteMajor = function (id) {
        return $http({
            method: 'POST',
            url: baseURL + '/api/major_delete',
            data: {
                _token: myToken,
                id: id
            }
        })
            .success(function (data, status, headers, config) {
                /* console.log('delete_year() success ');*/
            })
            .error(function (data, status, headers, config) {
                console.log('delete_major() error');
            });
    };

});