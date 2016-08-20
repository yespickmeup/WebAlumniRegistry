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
var validationApp = angular.module('validationApp', ['smart-table', 'treasure-overlay-spinner'], function ($interpolateProvider) {
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

validationApp.controller('mainController', ['$scope', '$http', function ($scope, $http) {

    $scope.clearUser = false;
    /* Initialize User Input Fields*/
    $scope.user = {
        'id': user.id,
        'alumni_no': user.alumni_no,
        'student_no': user.student_no,
        'first_name': user.first_name,
        'middle_name': user.middle_name,
        'last_name': user.last_name,
        'suffix_name': user.suffix_name,
        'civil_status': user.civil_status,
        'gender': user.gender,
        'bday': user.date_of_birth,
        'email': user.email,
        'password': '0000000000',
        'passwordConfirm': '0000000000',
        'landline_no': user.landline_no,
        'cellphone_no': user.cellphone_no,
        'level': user.level,
        'year': user.year,
        'course': user.course,
        'major': user.major,
        'motto': user.motto_in_life,
        'father': user.father_name,
        'is_father_paulinian': (user.is_father_paulinian == 1) ? true : false,
        'father_occupation': user.father_occupation,
        'father_office': user.father_office,
        'mother': user.mother_name,
        'is_mother_paulinian': (user.is_mother_paulinian == 1) ? true : false,
        'mother_occupation': user.mother_occupation,
        'mother_office': user.mother_office,
        'defaultPicture': ''

    };


    /*Change Picture*/
    $scope.imageSource = $scope.defaultPicture;
    $scope.fileNameChaged = function (element) {
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

    $scope.showUpdateSuccess = false;

    $scope.updateUser = function (isValid) {
        if (isValid) {
            console.log('update record......');
            console.log('fname: ' + $scope.user.first_name);
            $scope.spinner.on();
            $data = {
                '_token': myToken,
                'user': $scope.user
            }
            $http.post('/api/users/update', $data)
                .success(function (data, status, headers, config) {
                    var all = data['all'];
                    var user = data['user'];
                    /*   console.log('all: '+JSON.stringify(all));*/
                    console.log('user: ' + data['fname'] + ', successfully updated!');
                    $scope.showUpdateSuccess = true;

                    setTimeout(function () {
                        $scope.$apply(function () {
                            $scope.showUpdateSuccess = false;
                        });
                    }, 2000);

                    $scope.spinner.off();
                })
                .error(function (data, status, headers, config) {
                    console.log('data: ' + data);
                    console.log('status: ' + status);
                    $scope.spinner.off();
                })
            ;
        }
    }


    function formValid() {
        console.log('saving record......');
        $scope.spinner.on();
        /* console.log('user: '+JSON.stringify($scope.user));
         console.log('activities: '+JSON.stringify($scope.activities));
         console.log('members: '+JSON.stringify($scope.members));*/
        $data = {
            '_token': myToken,
            'user': $scope.user,
            'activities': $scope.activities,
            'members': $scope.members
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
                console.log('name: ' + name);
                window.location.href = loginUrl;
                $scope.spinner.off();
            })
            .error(function (data, status, headers, config) {

                console.log('data: ' + data);
                console.log('status: ' + status);
                $scope.spinner.off();
            })
        ;
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


    getUserInvolvements($scope.user.id);

    function getUserInvolvements($user_id) {
        $http.get('/api/user_involvements/' + $user_id)
            .success(function (data, status, headers, config) {
                var my_invs = JSON.stringify(data['involvements']);
                $.each(JSON.parse(my_invs), function (idx, obj) {
                    var data = {};
                    data.id = obj.id;
                    data.activity = obj.involvement;
                    $scope.activities.push(data);
                });
            })
            .error(function (data, status, headers, config) {
                console.log('data: ' + data);
                console.log('status: ' + status);
            })
        ;
    }

    $scope.addActivity = function addActivityRow() {
        var data = {};
        data.id = activityId;
        data.activity = $scope.activity.activity;
        $scope.activities.push(data);
        activityId++;
        $scope.activity.activity = '';
    };

    $scope.addActivityPost = function addActivityRow() {
        var data = {};
        data.id = activityId;
        data.activity = $scope.activity.activity;
        $scope.activities.push(data);
        activityId++;
        $scope.activity.activity = '';

        $data = {
            '_token': myToken,
            'user_id': $scope.user.id,
            'user_involvement':  data.activity,
        }
        $http.post('/api/user_involvement/save', $data)
            .success(function (data, status, headers, config) {
                var response = JSON.stringify(data['response']);
                console.log('response: ' + response);

            })
            .error(function (data, status, headers, config) {
                console.log('data: ' + data);
                console.log('status: ' + status);
                $scope.spinner.off();
            })
        ;
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

    $scope.updateActivityPost = function () {
        $scope.activitiesOnEdit.activity = $scope.activity.activity;
        $scope.activity.activity = '';
        $scope.showActivityAdd = true;
        $scope.showActivityUpdate = false;

        $data = {
            '_token': myToken,
            'id': $scope.activitiesOnEdit.id,
            'user_involvement':  $scope.activitiesOnEdit.activity,
        }
        $http.post('/api/user_involvement/update', $data)
            .success(function (data, status, headers, config) {
                var response = JSON.stringify(data['response']);
                console.log('response: ' + response);

            })
            .error(function (data, status, headers, config) {
                console.log('data: ' + data);
                console.log('status: ' + status);

            })
        ;
    };

    $scope.removeInvolvement = function removeItem(row) {
        var index = $scope.activities.indexOf(row);
        if (index !== -1) {
            $scope.activities.splice(index, 1);
        }
    }
    $scope.removeInvolvementPost = function removeItem(row) {
        var index = $scope.activities.indexOf(row);
        if (index !== -1) {
            $scope.activities.splice(index, 1);
            $data = {
                '_token': myToken,
                'id': row.id
            }
            $http.post('/api/user_involvement/delete', $data)
                .success(function (data, status, headers, config) {
                    var response = JSON.stringify(data['response']);
                    console.log('response: ' + response);
                })
                .error(function (data, status, headers, config) {
                    console.log('data: ' + data);
                    console.log('status: ' + status);

                })
            ;
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


    getUserFamily($scope.user.id);

    function getUserFamily($user_id) {
        $http.get('/api/user_family/' + $user_id)
            .success(function (data, status, headers, config) {
                var family = JSON.stringify(data['family']);
                $.each(JSON.parse(family), function (idx, obj) {
                    var data = {};
                    data.id = obj.id;
                    data.name = obj.name;
                    data.relation = obj.relation;
                    data.before_married = obj.name_before_married;
                    data.residence = obj.address;
                    data.occupation = obj.occupation;
                    data.office = obj.office_address;
                    $scope.members.push(data);
                });
            })
            .error(function (data, status, headers, config) {
                console.log('data: ' + data);
                console.log('status: ' + status);
            })
        ;
    }

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
    $scope.updateMemberPost = function () {
        $scope.memberonEdit.name = $scope.member.name;
        $scope.memberonEdit.relation = $scope.member.relation;
        $scope.memberonEdit.before_married = $scope.member.before_married;
        $scope.memberonEdit.residence = $scope.member.residence;
        $scope.memberonEdit.occupation = $scope.member.occupation;
        $scope.memberonEdit.office = $scope.member.office;
        $scope.member = {};
        $scope.showMemberUpdate = false;
        $scope.showMemberAdd = true;

        $data = {
            '_token': myToken,
            'id': $scope.memberonEdit.id,
            'name':  $scope.memberonEdit.name,
            'relation':  $scope.memberonEdit.relation,
            'name_before_married':  $scope.memberonEdit.before_married,
            'address':  $scope.memberonEdit.residence,
            'occupation':  $scope.memberonEdit.occupation,
            'office_address':  $scope.memberonEdit.office
        }
        $http.post('/api/user_family/update', $data)
            .success(function (data, status, headers, config) {
                var response = JSON.stringify(data['response']);
                console.log('response: ' + response);
            })
            .error(function (data, status, headers, config) {
                console.log('data: ' + data);
                console.log('status: ' + status);
            })
        ;
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
    $scope.addMemberPost = function addActivityRow() {
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

        $data = {
            '_token': myToken,
            'user_id': $scope.user.id,
            'name':  data.name,
            'relation':  data.relation,
            'before_married':  data.before_married,
            'residence':  data.residence,
            'occupation':  data.occupation,
            'office':  data.office
        }
        $http.post('/api/user_family/save', $data)
            .success(function (data, status, headers, config) {
                var response = JSON.stringify(data['response']);
                console.log('response: ' + response);
            })
            .error(function (data, status, headers, config) {
                console.log('data: ' + data);
                console.log('status: ' + status);
                $scope.spinner.off();
            })
        ;
    };
    $scope.removeMember = function removeItem(row) {
        var index = $scope.members.indexOf(row);
        if (index !== -1) {
            $scope.members.splice(index, 1);

            $data = {
                '_token': myToken,
                'id': row.id
            }
            $http.post('/api/user_family/delete', $data)
                .success(function (data, status, headers, config) {
                    var response = JSON.stringify(data['response']);
                    console.log('response: ' + response);
                })
                .error(function (data, status, headers, config) {
                    console.log('data: ' + data);
                    console.log('status: ' + status);

                })
            ;
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



    