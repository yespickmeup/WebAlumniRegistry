<!-- index.html -->
<!DOCTYPE html>
<html>
<head>
    <title>Alumni Registry | Signup</title>
    <link rel="icon" href="{{ URL::asset('src/images/sys/spud-alumni-logo.ico') }}"/>
    @include('layouts.css')
    @include('layouts.js')
    <link rel="stylesheet" href="{{ URL::to('src/css/register.css') }}"/>
    <link rel="stylesheet" href="{{ URL::to('src/css/angular.css') }}"/>
    <link rel="stylesheet" href="{{ URL::to('src/css/animate.min.css') }}"/>
    <link rel="stylesheet" href="{{ URL::to('src/css/treasure-overlay-spinner.css') }}"/>
    <style>
        body {
            background: url('{{ URL::asset('src/images/sys/silver_scales.png') }}');
        }
    </style>

    <script src="{{ URL::to('src/js/file_upload/ng-file-upload.js') }}" type="text/javascript"></script>
    <script src="{{ URL::to('src/js/file_upload/ng-file-upload-shim.js') }}" type="text/javascript"></script>
    <script src="{{ URL::to('src/js/user-signup.js') }}" type="text/javascript"></script>
    <script src="{{ URL::to('src/js/treasure-overlay-spinner.js') }}" type="text/javascript"></script>

    <script src="{{ URL::to('src/js/modules/tabs.js') }}" type="text/javascript"></script>

</head>
<body>

<div ng-app="validationApp" ng-controller="mainController">
    <treasure-overlay-spinner active='spinner.active'>
        <div class="container  ">

            <div class="panel panel-default col-md-12">
                <div class="panel-heading">
                    <h1>Signup</h1>

                </div>
                <div class="col-md-offset-5">
                    <br>


                    <ul class="list-group" ng-model="error.errorList">
                        <li ng-show="userForm.student_no.$error.required && userForm.student_no.$touched"  style="color:red;left:-10px;"><span>Student no is required.</span>
                        </li>
                        <li ng-show="userForm.first_name.$error.required && userForm.first_name.$touched"  style="color:red;left:-10px;"><span>First name is required.</span>
                        </li>
                        <li ng-show="userForm.last_name.$error.required && userForm.last_name.$touched"  style="color:red;left:-10px;"><span>Last name is required.</span>
                        </li>
                        <li ng-show="userForm.bday.$error.required && userForm.bday.$touched"  style="color:red;left:-10px;"><span>Birth date is required.</span>

                        <li ng-show="userForm.email.$error.required && userForm.email.$touched"  style="color:red;left:-10px;"><span>Email Address is required.</span>
                        </li>
                        <li ng-show="userForm.email.$invalid && userForm.email.$touched"  style="color:red;left:-10px;">
                            <span>Enter a valid Email Address.</span></li>
                        <li ng-show="myVar" style="color:red;left:-10px;"><span>Email Already Exists</span></li>

                        <li ng-show="userForm.password.$error.required && userForm.password.$touched"  style="color:red;left:-10px;"><span>Password is required.</span>
                        </li>
                        <li ng-show="userForm.passwordConfirm.$error.required && userForm.passwordConfirm.$touched"  style="color:red;left:-10px;"><span>Confirm password is required.</span>
                        </li>
                        <li ng-show="userForm.passwordConfirm.$error.match && userForm.passwordConfirm.$touched"  style="color:red;left:-10px;"><span>Entered passwords do not match.</span>
                        </li>
                    </ul>

                </div>
                <div class="panel-body">
                    <form name="userForm" ng-submit="submitForm(userForm.$valid)" novalidate class="tab-form-demo"
                          style="" ng-model="userForm" enctype="multipart/form-data">


                        <uib-tabset active="active1">
                            <uib-tab index="0" heading="Personal Information">
                                @include('users.personal-info')
                            </uib-tab>

                            <uib-tab index="1" heading="School Activities Involvements">
                                @include('users.personal-activities')
                            </uib-tab>
                            <uib-tab index="2" heading="Alumni Family Members">
                                @include('users.personal-family')
                            </uib-tab>

                        </uib-tabset>


                        <script>
                            var myToken = '{{ Session::token() }}';
                            var loginUrl = '{{ url('/registered') }}';
                            var baseURL = '{{ url('/') }}';
                        </script>
                    </form>
                </div>


            </div>


        </div>
    </treasure-overlay-spinner>
</div>

</body>
</html>