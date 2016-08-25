<!-- index.html -->
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Alumni Registry | Users</title>
    <link rel="icon" href="{{ URL::asset('src/images/sys/spud-alumni-logo.ico') }}"/>
    @include('layouts.css')
    @include('layouts.js')
    <link rel="stylesheet" href="{{ URL::to('src/css/register.css') }}"/>
    {{--    <link rel="stylesheet" href="{{ URL::to('src/css/smart-table.css') }}"/>--}}
    <link rel="stylesheet" href="{{ URL::to('src/css/treasure-overlay-spinner.css') }}"/>
    <style>
        body {
            background: url('{{ URL::asset('src/images/sys/silver_scales.png') }}');
            margin: 0px;
            padding: 0px;
        }
    </style>

    <script src="{{ URL::to('src/js/users-index.js') }}" type="text/javascript"></script>
    <script src="{{ URL::to('src/js/treasure-overlay-spinner.js') }}" type="text/javascript"></script>
</head>
<body>


<div ng-app="validationApp" ng-controller="mainController">

    <treasure-overlay-spinner active='spinner.active'>
        @include('layouts.header')
        <div class="container">
            <div class="panel panel-default col-md-12">
                <div class="panel-heading"><h1>Users</h1></div>
                <div class="alert alert-success fade in" ng-show="showUpdateSuccess">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <strong>Success! </strong>Account <b>[<%userName%>]</b>, successfully approved!
                </div>
                <div class="panel-body">
                    <table st-table="displayedCollection" st-safe-src="users"
                           class="table table-striped table-bordered table-hover">
                        <thead>
                        <tr>
                            <th colspan="10"><input st-search="" class="form-control" placeholder="Search ..."
                                                    type="text"/></th>
                        </tr>
                        <tr>
                            <th st-sort="user.first_name">First Name</th>
                            <th style="width:100px;" st-sort="user.middle_name">Middle Name</th>
                            <th st-sort="user.last_name">Last Name</th>
                            <th st-sort="user.roles">Roles</th>
                            <th style="width:30px;" st-sort="user.gender">Gender</th>
                            <th style="width:50px;" st-sort="user.civil_status">Status</th>
                            <th style="width:100px;" st-sort="user.bday">BirthDate</th>
                            <th st-sort="user.father">Father</th>
                            <th st-sort="user.mother">Mother</th>
                            <th style="width:30px;"></th>

                        </tr>

                        </thead>
                        <tbody>
                        <tr ng-repeat="user in displayedCollection">

                            <td><%user.first_name%></td>
                            <td><%user.middle_name%></td>
                            <td><%user.last_name%></td>

                            <td>
                                <%user.roles%>
                                @if(!empty($user->roles))
                                    @foreach($user->roles as $v)
                                        <label class="label label-success">{{ $v->display_name }}</label>
                                    @endforeach
                                @endif

                            </td>
                            <td><%user.gender%></td>
                            <td><%user.civil_status%></td>
                            <td><%user.bday%></td>
                            <td><%user.father%></td>
                            <td><%user.mother%></td>

                            <td>
                                <button type="button" ng-click="deleteUser(user)"
                                        class="btn btn-sm btn-danger">
                                    <i class="glyphicon glyphicon-remove-sign">
                                    </i>
                                </button>
                            </td>
                        </tr>
                        </tbody>
                        <tfoot>
                        <tr>
                            <td colspan="10" class="text-center">
                                <div st-pagination="" st-items-by-page="itemsByPage" st-displayed-pages="7"></div>
                            </td>
                        </tr>
                        </tfoot>
                    </table>
                    <script>
                        var myToken = '{{ Session::token() }}';
                    </script>
                </div>
            </div>

        </div>
    </treasure-overlay-spinner>
</div>

</body>
</html>