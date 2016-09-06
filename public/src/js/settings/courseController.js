myApp.controller('courseController', ['$scope', '$http', 'ModalService', 'courseService', function ($scope, $http, ModalService, courseService) {


    /* Level*/
    $scope.showAddCourseSuccess = false;
    $scope.showUpdateCourseSuccess = false;
    $scope.showDeleteCourseSuccess = false;


    $scope.showCourseAdd = true;
    $scope.showCourseUpdate = false;
    $scope.itemsByPage2 = 20;


    $scope.course = {
        id: 0,
        level_id: 0,
        year_id: 0,
        course: ''
    };


    $scope.inputCourse = '';


    $scope.courses = [];

    courseService.getCourses().then(function (resp) {
        var courses = JSON.stringify(resp.data['courses']);
        $.each(JSON.parse(courses), function (idx, obj) {
            var data = {};
            data.id = obj.id;
            data.level_id = obj.level_id;
            data.year_id = obj.year_id;
            data.course = obj.course;
            $scope.courses.push(data);

        });
    });


    $scope.newCourse = function () {
        $scope.inputCourse = '';
        angular.element('#inputCourse').focus();
    }

    $scope.addCourse = function (myFormCourse) {
        var data = {};
        data.id = 0;
        data.level_id = 0;
        data.year_id = 0;
        data.course = $scope.inputCourse;
        data.status = 1;

        if ($scope.myFormCourse.inputCourse.$valid) {
            courseService.addCourse($scope.inputCourse, data.level_id, data.year_id).then(function (resp) {

                var message = JSON.stringify(resp.data['course']);
                if (resp.status == 200) {
                    var id = JSON.parse(message).id;
                    data.id = id;
                    $scope.courses.push(data);
                    $scope.inputCourse = '';
                    myFormCourse.inputCourse.$touched = true;
                    angular.element('#inputCourse').focus();

                    $scope.showAddCourseSuccess = true;
                    setTimeout(function () {
                        $scope.$apply(function () {
                            $scope.showAddCourseSuccess = false;
                        });
                    }, 500);
                }
            });
        }

    }

    $scope.editCourse = function (course) {
        $scope.courseOnEdit = course;
        $scope.inputCourse = course.course;
        $scope.showCourseAdd = false;
        $scope.showCourseUpdate = true;
        angular.element('#inputCourse').focus();
    }

    $scope.updateCourse = function () {

        courseService.updateCourse($scope.courseOnEdit.id, $scope.inputCourse).then(function (resp) {
            var message = JSON.stringify(resp.data['message']);
            console.log('message: ' + message);
            if (resp.status == 200) {
                $scope.courseOnEdit.course = $scope.inputCourse;
                $scope.showCourseAdd = true;
                $scope.showCourseUpdate = false;
                $scope.inputCourse = '';
                angular.element('#inputCourse').focus();
                myFormCourse.inputCourse.$touched = false;

                $scope.showUpdateCourseSuccess = true;
                setTimeout(function () {
                    $scope.$apply(function () {
                        $scope.showUpdateCourseSuccess = false;
                    });
                }, 500);

            }
        });


    }

    $scope.confirmDeleteCourse = function (course) {

        ModalService.showModal({
            templateUrl: 'modal.html',
            controller: "ModalCourseController"
        }).then(function (modal) {
            modal.element.modal();

            modal.close.then(function (result) {
                if (result == 'Yes') {
                   courseService.deleteCourse(course.id).then(function (resp) {
                        var message = JSON.stringify(resp.data['message']);
                        console.log('message:' + message);
                        if (resp.status == 200) {
                            var index = $scope.courses.indexOf(course);
                            if (index !== -1) {
                                $scope.courses.splice(index, 1);
                                angular.element('#inputCourse').focus();
                            }
                            $scope.showDeleteCourseSuccess = true;
                            setTimeout(function () {
                                $scope.$apply(function () {
                                    $scope.showDeleteCourseSuccess = false;
                                });
                            }, 500);

                        }
                    });

                }
            });
        });
    };

}]);


myApp.controller('ModalCourseController', function ($scope, close) {
    $scope.close = function (result) {
        close(result, 500); // close, but give 500ms for bootstrap to animate
    };
});

myApp.service('courseService', function ($http) {
    this.getCourses = function () {
        return $http({
            method: 'GET',
            url: baseURL + '/api/courses'
        })
            .success(function (data, status, headers, config) {
               /* console.log('getCourses() success ');*/
            })
            .error(function (data, status, headers, config) {
                console.log('getCourses() error');
            });
    };

    this.addCourse = function (course, level_id, year_id) {

        return $http({
            method: 'POST',
            url: baseURL + '/api/course_add',
            data: {
                _token: myToken,
                course: course,
                level_id: level_id,
                year_id: year_id,
            }
        })
            .success(function (data, status, headers, config) {
              /*  console.log('add_course() success ');*/
            })
            .error(function (data, status, headers, config) {
                console.log('add_course() error');
            });
    };

    this.updateCourse = function (id, course) {
        return $http({
            method: 'POST',
            url: baseURL + '/api/course_update',
            data: {
                _token: myToken,
                id: id,
                course: course
            }
        })
            .success(function (data, status, headers, config) {
               /* console.log('update_year() success ');*/
            })
            .error(function (data, status, headers, config) {
                console.log('update_year() error');
            });
    };
    this.deleteCourse = function (id) {
        return $http({
            method: 'POST',
            url: baseURL + '/api/course_delete',
            data: {
                _token: myToken,
                id: id
            }
        })
            .success(function (data, status, headers, config) {
               /* console.log('delete_year() success ');*/
            })
            .error(function (data, status, headers, config) {
                console.log('delete_year() error');
            });
    };

});