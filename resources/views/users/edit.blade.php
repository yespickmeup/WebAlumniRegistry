<!-- index.html -->
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Alumni Registry | Account</title>
    <link rel="icon" href="{{ URL::asset('src/images/sys/spud-alumni-logo.ico') }}"/>
    @include('layouts.css')
    @include('layouts.js')


    <link rel="stylesheet" href="{{ URL::to('src/css/register.css') }}"/>
    <link rel="stylesheet" href="{{ URL::to('src/css/treasure-overlay-spinner.css') }}"/>
    <style>
        body {
            background: url('{{ URL::asset('src/images/sys/silver_scales.png') }}');
            margin: 0px;
            padding: 0px;
        }
    </style>

    <script src="{{ URL::to('src/js/file_upload/ng-file-upload.js') }}" type="text/javascript"></script>
    <script src="{{ URL::to('src/js/file_upload/ng-file-upload-shim.js') }}" type="text/javascript"></script>

    <script src="{{ URL::to('src/js/user-edit.js') }}" type="text/javascript"></script>
    <script src="{{ URL::to('src/js/treasure-overlay-spinner.js') }}" type="text/javascript"></script>


    <script src="{{ URL::to('src/js/modules/tabs.js') }}" type="text/javascript"></script>
</head>
<body>


@if(Auth::user()->id != $user->id)
    Unauthorized!
@else
    <div ng-app="validationApp" ng-controller="mainController">

        <div id="something" data-json="{{ $user }}"></div>

        <treasure-overlay-spinner active='spinner.active'>
            @include('layouts.header')
            <div class="container">
                <div class="panel panel-default col-md-12">
                    <div class="panel-heading"><h1>My account</h1></div>

                    <div class="alert alert-success fade in" ng-show="showUpdateSuccess">

                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <strong>Success!</strong>Personal information Successfully Updated!
                    </div>
                    <div class="col-md-offset-5">
                        <ul class="list-group" ng-model="error.errorList">
                            <br>
                            <li ng-show="userForm.student_no.$error.required" style="color:red;left:-10px;"><span>Student no is required.</span>
                            </li>
                            <li ng-show="userForm.first_name.$error.required" style="color:red;left:-10px;"><span>First name is required.</span>
                            </li>
                            <li ng-show="userForm.last_name.$error.required" style="color:red;left:-10px;"><span>Last name is required.</span>
                            </li>
                            <li ng-show="userForm.bday.$error.required" style="color:red;left:-10px;"><span>Birth date is required.</span>

                            <li ng-show="userForm.email.$error.required" style="color:red;left:-10px;"><span>Email Address is required.</span>
                            </li>
                            <li ng-show="userForm.email.$invalid" style="color:red;left:-10px;">
                                <span>Enter a valid Email Address.</span></li>
                            <li ng-show="myVar" style="color:red;left:-10px;"><span>Email Already Exists</span></li>

                            <li ng-show="userForm.password.$error.required" style="color:red;left:-10px;"><span>Password is required.</span>
                            </li>
                            <li ng-show="userForm.passwordConfirm.$error.required" style="color:red;left:-10px;"><span>Confirm password is required.</span>
                            </li>
                            <li ng-show="userForm.passwordConfirm.$error.match" style="color:red;left:-10px;"><span>Entered passwords do not match.</span>
                            </li>
                        </ul>
                    </div>
                    <div class="panel-body">
                        <form name="userForm" ng-submit="submitForm(userForm.$valid)" novalidate class="tab-form-demo"
                              style="" ng-model="userForm">

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
                                var loginUrl = '{{ url('/login') }}';
                                var user = JSON.parse(decodeURIComponent(something.getAttribute("data-json")))
                                var publicUrl = '{{URL::asset('/'). '' . 'src/images/uploads/'}}';
                                var photo = '{{ URL::asset('src/images/uploads/') }}';
                            </script>
                        </form>
                    </div>
                </div>

            </div>
        </treasure-overlay-spinner>
    </div>
@endif
</body>
</html>