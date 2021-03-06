/* For DatePicker*/
$(document).ready(function () {
    var date_input = $('input[name="date"]'); //our date input has the name "date"
    var container = $('.bootstrap-iso form').length > 0 ? $('.bootstrap-iso form').parent() : "body";
    date_input.datepicker({
        format: 'yyyy-mm-dd',
        container: container,
        todayHighlight: true,
        autoclose: true,
    })
})

/* Start of Angular App*/
var validationApp = angular.module('validationApp', ['ngFileUpload', 'smart-table', 'treasure-overlay-spinner', 'ui.bootstrap', 'tabs'], function ($interpolateProvider) {
    $interpolateProvider.startSymbol('<%');
    $interpolateProvider.endSymbol('%>');
});

angular.module('validationApp').run(run);
run.$inject = ['$rootScope'];
function run($rootScope) {
    $rootScope.spinner = {
        active: false,
        on: function () {
            this.active = true;
        },
        off: function () {
            this.active = false;
        }
    };
}


validationApp.controller('mainController', ['$scope', '$http', 'Upload', '$timeout', 'courseService', function ($scope, $http, Upload, $timeout, courseService) {

    $scope.active1 = 0;

    $scope.gotoActivities = function () {
        $scope.active1 = 1;
    }
    $scope.gotoPersonalInfo = function () {
        $scope.active1 = 0;
    }
    $scope.gotoFamily = function () {
        $scope.active1 = 2;
    }

    $scope.photoFile = null;

    $scope.uploadFiles = function (file, errFiles) {

        $scope.photoFile = file;

        console.log('image src: ' + $scope.photoFile);
    }

    /* Initialize User Input Fields*/

    $scope.courses = {
        availableOptions: [],
        selectedOption: {id: 0, course: ''}
    };

    courseService.getCourses().then(function (resp) {
        var courses = JSON.stringify(resp.data['courses']);
        $.each(JSON.parse(courses), function (idx, obj) {
            var data = {};
            data.id = obj.id;
            data.course = obj.course;
            $scope.courses.availableOptions.push(data);
        });
    });

    $scope.submitCourse = function () {
        $scope.user.course = $scope.courses.selectedOption.course;
    }

    $scope.levels = {
        availableOptions: [],
        selectedOption: {id: 0, level: ''}
    };
    courseService.getLevels().then(function (resp) {
        var levels = JSON.stringify(resp.data['levels']);
        $.each(JSON.parse(levels), function (idx, obj) {
            var data = {};
            data.id = obj.id;
            data.level = obj.level;
            $scope.levels.availableOptions.push(data);
        });
    });

    $scope.submitLevel = function () {
        $scope.user.level = $scope.levels.selectedOption.level;
    }

    $scope.years = {
        availableOptions: [],
        selectedOption: {id: 0, year: ''}
    };
    courseService.getYears().then(function (resp) {
        var years = JSON.stringify(resp.data['years']);
        $.each(JSON.parse(years), function (idx, obj) {
            var data = {};
            data.id = obj.id;
            data.year = obj.year;
            $scope.years.availableOptions.push(data);
        });
    });

    $scope.submitYear = function () {
        $scope.user.year = $scope.years.selectedOption.year;
    }

    $scope.majors = {
        availableOptions: [],
        selectedOption: {id: 0, major: ''}
    };


    courseService.getMajors().then(function (resp) {
        var majors = JSON.stringify(resp.data['majors']);
        $.each(JSON.parse(majors), function (idx, obj) {
            var data = {};
            data.id = obj.id;
            data.major = obj.major;
            $scope.majors.availableOptions.push(data);
        });
    });

    $scope.submitMajor = function () {
        $scope.user.major = $scope.majors.selectedOption.major;
    }


    $scope.user = {
        'alumni_no': '',
        'student_no': '',
        'first_name': '',
        'middle_name': '',
        'last_name': '',
        'suffix_name': '',
        'civil_status': '',
        'gender': '',
        'bday': '',
        'email': '',
        'password': '',
        'passwordConfirm': '',
        'landline_no': '',
        'cellphone_no': '',
        'level': '',
        'year': '',
        'course': '',
        'major': '',
        'motto': '',
        'father': '',
        'is_father_paulinian': '',
        'father_occupation': '',
        'father_office': '',
        'mother': '',
        'is_mother_paulinian': '',
        'mother_occupation': '',
        'mother_office': '',


    };

    /*Change Picture*/
    $scope.imageSource = $scope.defaultPicture;
    $scope.fileNameChaged = function (element) {

        $scope.photoFile = element.files[0];
        var reader = new FileReader();
        reader.onload = function (e) {
            $scope.$apply(function () {
                $scope.imageSource = e.target.result;
            });
        }
        reader.readAsDataURL(element.files[0]);
    }

    $scope.clearUser = function (isValid) {
        $scope.user = {
            'alumni_no': '',
            'student_no': '',
            'first_name': '',
            'middle_name': '',
            'last_name': '',
            'suffix_name': '',
            'civil_status': '',
            'gender': '',
            'bday': '',
            'email': '',
            'password': '',
            'passwordConfirm': '',
            'landline_no': '',
            'cellphone_no': '',
            'level': '',
            'year': '',
            'course': '',
            'major': '',
            'motto': '',
            'father': '',
            'is_father_paulinian': 'true',
            'father_occupation': '',
            'father_office': '',
            'mother': '',
            'is_mother_paulinian': 'true',
            'mother_occupation': '',
            'mother_office': '',
            'defaultPicture': ''
        };

    }

    $scope.doBack = function () {
        window.history.back();
    }
    $scope.submitForm = function (isValid) {
        /* Submit Form for saving*/
        console.log('isValid: ' + isValid);
        if (isValid) {
            checkEmail();
        }
    };

    function formValid() {
        console.log('saving record....');
        $scope.spinner.on();
        /* console.log('user: '+JSON.stringify($scope.user));
         console.log('activities: '+JSON.stringify($scope.activities));
         console.log('members: '+JSON.stringify($scope.members));*/
        $data = {
            '_token': myToken,
            'user': $scope.user,
            'activities': $scope.activities,
            'members': $scope.members,
            'image1': $scope.photoFile,
        }
        $http.post('/api/users/save', $data)
            .success(function (data, status, headers, config) {

                var all = data['all'];
                var user = data['user'];
                var name = data['name'];
                var activities = data['activities'];
                var activity_names = data['activity_names'];
                /*  console.log('data: '+JSON.stringify(data));*/
                /* console.log('user: '+JSON.stringify(user));*/
                /*  console.log('collection: '+JSON.stringify(collection));
                 console.log('activity_names: '+JSON.stringify(activity_names));*/
                /* console.log('name: ' + name);*/

                uploadImage(user.alumni_no);
                window.location.href = loginUrl;
                $scope.spinner.off();
            })
            .error(function (data, status, headers, config) {

                console.log('image: ' + data['image']);
                console.log('status: ' + status);
                $scope.spinner.off();
            })
        ;

        function uploadImage(filename) {
            if ($scope.photoFile) {
                $scope.photoFile.upload = Upload.upload({
                    url: '/fileUpload2',

                    data: {
                        _token: myToken,
                        file: $scope.photoFile,
                        filename: filename,
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
    }

    function checkEmail() {
        var email = $scope.user.email;
        console.log('checking...' + email);


        $scope.spinner.on();

        $http.get('/api/users/' + email)
            .success(function (data, status, headers, config) {
                var user = JSON.stringify(data['user']);
                /* console.log('data: '+JSON.stringify(data));*/
                if (user == 'null') {
                    $scope.myVar = false;
                    formValid();
                    /*  if ($scope.userForm.$valid) {

                     }*/
                } else {
                    $scope.myVar = true;
                    var userObject = JSON.parse(user);
                    $scope.spinner.off();
                    /* console.log("user: "+user);
                     console.log("id: "+userObject.id);*/
                }

            })
            .error(function (data, status, headers, config) {
                console.log('error');
                $scope.spinner.off();
            })
        ;
    }

    /* Start of Activity Tab*/


    var activityId = 1;
    $scope.activities = [];
    $scope.showActivityAdd = true;
    $scope.showActivityUpdate = false;
    $scope.activity = {
        'id': 0,
        'activity': '',
        'editactivityName': '',
    };

    $scope.IsVisible = false;
    $scope.ShowHide = function () {
        $scope.activity.activity = '';
        $scope.IsVisible = $scope.IsVisible ? false : true;
    }


    $scope.itemsByPage = 5;
    /* for (activityId; activityId < 15; activityId++) {
     var data = {};
     data.id = activityId;
     data.activity = 'activity' + activityId;
     $scope.activities.push(data);
     }*/

    $scope.addActivity = function addActivityRow() {
        var data = {};
        data.id = activityId;
        data.activity = $scope.activity.activity;
        $scope.activities.push(data);
        activityId++;
        $scope.activity.activity = '';
    };

    $scope.editInvolvement = function (activity) {
        $scope.activitiesOnEdit = activity;
        $scope.activity.activity = activity.activity;
        $scope.showActivityAdd = false;
        $scope.showActivityUpdate = true;
    };

    $scope.updateActivity = function () {
        $scope.activitiesOnEdit.activity = $scope.activity.activity;
        $scope.activity.activity = '';
        $scope.showActivityAdd = true;
        $scope.showActivityUpdate = false;
    };
    $scope.removeInvolvement = function removeItem(row) {
        var index = $scope.activities.indexOf(row);
        if (index !== -1) {
            $scope.activities.splice(index, 1);
        }
    }

    /* Start of Member Tab*/


    $scope.showMemberUpdate = false;
    $scope.showMemberAdd = true;

    var memberId = 1;
    $scope.members = [];
    $scope.member = {};
    $scope.member.name = '';
    $scope.member.relation = '';
    $scope.member.before_married = '';
    $scope.member.residence = '';
    $scope.member.occupation = '';
    $scope.member.office = '';

    /*for (memberId; memberId < 3; memberId++) {
     var data = {};
     data.id = memberId;
     data.name = 'name' + memberId;
     data.relation = 'son';
     data.before_married = 'name' + memberId;
     data.residence = 'residence';
     data.occupation = 'occupation';
     data.office = 'office';
     $scope.members.push(data);
     }*/
    $scope.clearMember = function () {
        $scope.member = {};
        $scope.showMemberUpdate = false;
        $scope.showMemberAdd = true;
    }

    $scope.editMember = function (member) {
        $scope.memberonEdit = member;
        $scope.member.name = member.name;
        $scope.member.relation = member.relation;
        $scope.member.before_married = member.before_married;
        $scope.member.residence = member.residence;
        $scope.member.occupation = member.occupation;
        $scope.member.office = member.office;

        $scope.showMemberUpdate = true;
        $scope.showMemberAdd = false;
    }
    $scope.updateMember = function () {
        $scope.memberonEdit.name = $scope.member.name;
        $scope.memberonEdit.relation = $scope.member.relation;
        $scope.memberonEdit.before_married = $scope.member.before_married;
        $scope.memberonEdit.residence = $scope.member.residence;
        $scope.memberonEdit.occupation = $scope.member.occupation;
        $scope.memberonEdit.office = $scope.member.office;
        $scope.member = {};
        $scope.showMemberUpdate = false;
        $scope.showMemberAdd = true;
    }
    $scope.addMember = function addActivityRow() {
        var data = {};
        data.id = memberId;
        data.name = $scope.member.name;
        data.relation = $scope.member.relation;
        data.before_married = $scope.member.before_married;
        data.residence = $scope.member.residence;
        data.occupation = $scope.member.occupation;
        data.office = $scope.member.office;
        $scope.members.push(data);
        memberId++;
        $scope.member.name = '';
        $scope.member.relation = '';
        $scope.member.before_married = '';
        $scope.member.residence = '';
        $scope.member.occupation = '';
        $scope.member.office = '';
    };
    $scope.removeMember = function removeItem(row) {
        var index = $scope.members.indexOf(row);
        if (index !== -1) {
            $scope.members.splice(index, 1);
        }
    }


    /* End of Member Tab*/

}]);

/* End of Controller*/

/* Directives*/
validationApp.directive('tabs', function () {
    return {
        restrict: 'E',
        transclude: true,
        scope: {},
        controller: ["$scope", function ($scope) {
            var panes = $scope.panes = [];
            $scope.mypanes = panes;
            $scope.select = function (pane) {
                angular.forEach(panes, function (pane) {
                    pane.selected = false;
                });
                pane.selected = true;
            }

            this.addPane = function (pane) {
                if (panes.length == 0) $scope.select(pane);
                panes.push(pane);
            }

        }],
        template: '<div class="tabbable">' +
        '<ul class="nav nav-tabs">' +
        '<li ng-repeat="pane in panes" ng-class="{active:pane.selected}">' +
        '<a href="" ng-click="select(pane)">{{pane.title}}</a>' +
        '</li>' +
        '</ul>' +
        '<div class="tab-content" ng-transclude></div>' +
        '</div>',
        replace: true
    };
});
validationApp.directive('pane', function () {
    return {
        require: '^tabs',
        restrict: 'E',
        transclude: true,
        scope: {title: '@'},
        link: function (scope, element, attrs, tabsCtrl) {
            tabsCtrl.addPane(scope);
        },
        template: '<div class="tab-pane" ng-class="{active: selected}" ng-transclude>' +
        '</div>',
        replace: true
    };
});


validationApp.service('courseService', function ($http) {
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

    this.getLevels = function () {
        return $http({
            method: 'GET',
            url: baseURL + '/api/levels'
        })
            .success(function (data, status, headers, config) {
                /*console.log('getlevels() success ');*/
            })
            .error(function (data, status, headers, config) {
                console.log('getlevels() error');
            });
    };

    this.getYears = function () {
        return $http({
            method: 'GET',
            url: baseURL + '/api/years'
        })
            .success(function (data, status, headers, config) {
                /* console.log('getYears() success ');*/
            })
            .error(function (data, status, headers, config) {
                console.log('getYears() error');
            });
    };

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
});
    