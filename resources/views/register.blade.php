<!-- index.html -->
<!DOCTYPE html>
<html>
<head>
    @include('layouts.css')
    @include('layouts.js')
    <link rel="stylesheet" href="{{ URL::to('src/css/register.css') }}"/>
    <link rel="stylesheet" href="{{ URL::to('src/css/treasure-overlay-spinner.css') }}"/>
    <style>
        body {
            background: url('{{ URL::asset('src/images/sys/silver_scales.png') }}');
        }
    </style>

    <script src="{{ URL::to('src/js/user-signup.js') }}" type="text/javascript"></script>
    <script src="{{ URL::to('src/js/treasure-overlay-spinner.js') }}" type="text/javascript"></script>
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
                <form name="userForm" ng-submit="submitForm(userForm.$valid)" novalidate class="tab-form-demo" style="" ng-model="userForm" enctype="multipart/form-data">
                    <tabs id="Tabs" ng-model="Tabs">
                        <pane title="Personal Information" ng-model="pane1">
                            @include('users.personal-info')
                        </pane>
                        <pane title="School Activities Involvements" ng-model="pane2">
                            <div>
                                @include('users.personal-activities')
                            </div>
                        </pane>
                        <pane title="Alumni Family Members" ng-model="pane3">
                            <div>
                                @include('users.personal-family')
                            </div>
                        </pane>
                    </tabs>
                    <script>
                        var myToken = '{{ Session::token() }}';
                        var loginUrl = '{{ url('/registered') }}';
                    </script>
                </form>
            </div>
        </div>

    </div>
    </treasure-overlay-spinner>
</div>

</body>
</html>