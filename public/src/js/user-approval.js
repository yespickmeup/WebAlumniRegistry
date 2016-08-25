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

    $scope.userName = '';
    $scope.itemsByPage = 10;
    $scope.showUpdateSuccess = false;
    $scope.users = [];
    $scope.user = {
        'id': 0,
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
        'mother_office': ''
    };


    getUsersForApproval();

    function getUsersForApproval() {
        $http.get('/api/users_for_approval')
            .success(function (data, status, headers, config) {
                var users = JSON.stringify(data['users']);
                $.each(JSON.parse(users), function (idx, obj) {
                    var data = {};
                    data.id = obj.id;
                    data.alumni_no = obj.alumni_no;
                    data.student_no = obj.student_no;
                    data.first_name = obj.first_name;
                    data.middle_name = obj.middle_name;
                    data.last_name = obj.last_name;
                    data.suffix_name = obj.suffix_name;
                    data.civil_status = obj.civil_status;
                    data.gender = obj.gender;
                    data.bday = obj.date_of_birth;
                    data.email = obj.email;
                    data.landline_no = obj.landline_no;
                    data.cellphone_no = obj.cellphone_no;
                    data.level = obj.level;
                    data.year = obj.year;
                    data.course = obj.course;
                    data.major = obj.major;
                    data.motto = obj.motto;
                    data.father = obj.father_name;
                    data.is_father_paulinian = obj.is_father_paulinian;
                    data.father_occupation = obj.father_occupation;
                    data.father_office = obj.father_office;
                    data.mother = obj.mother_name;
                    data.is_mother_paulinian = obj.is_mother_paulinian;
                    data.mother_occupation = obj.mother_occupation;
                    data.mother_office = obj.mother_office;
                    $scope.users.push(data);

                });
            })
            .error(function (data, status, headers, config) {
                console.log('data: ' + data);
                console.log('status: ' + status);
            })
        ;
    }

    $scope.approveUser = function (user) {
        var index = $scope.users.indexOf(user);
        if (index !== -1) {
            $scope.users.splice(index, 1);

            $data = {
                '_token': myToken,
                'id': user['id']
            }
            $http.post('/api/user/approve', $data)
                .success(function (data, status, headers, config) {
                    var response = JSON.stringify(data['response']);
                    console.log('response: ' + 'success');
                    $scope.showUpdateSuccess = true;
                    $scope.userName = user['first_name'] + ' ' + user['middle_name'] + ' ' + user['last_name'];
                    setTimeout(function () {
                        $scope.$apply(function () {
                            $scope.showUpdateSuccess = false;
                        });
                    }, 2000);

                })
                .error(function (data, status, headers, config) {
                    console.log('data: ' + data);
                    console.log('status: ' + status);

                })
            ;
        }
    }
}]);

/* End of Controller*/




