<!-- index.html -->
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Alumni Registry | Settings</title>
    <link rel="icon" href="{{ URL::asset('src/images/sys/spud-alumni-logo.ico') }}"/>
    @include('layouts.css')
    @include('layouts.js')

    <style type="text/css">
        form.tab-form-demo .tab-pane {
            margin: 20px 20px;
        }
    </style>

    <script src="{{ URL::to('src/js/settings/settings.js') }}" type="text/javascript"></script>
    <script src="{{ URL::to('src/js/settings/yearlevelController.js') }}" type="text/javascript"></script>
    <script src="{{ URL::to('src/js/treasure-overlay-spinner.js') }}" type="text/javascript"></script>
</head>
<body>

@include('layouts.header')
<div class="container" ng-app="myApp" ng-controller="mainController">


    <uib-tabset active="active">
        <uib-tab index="0" heading="Year & Level">
            <br>
            <div ng-controller="yearController">
                @include('settings.yearlevel')
            </div>
        </uib-tab>


        <uib-tab index="2" heading="Courses">
            Static content2
        </uib-tab>
        <uib-tab index="3" heading="Majors">
            Static content2
        </uib-tab>
    </uib-tabset>




</div>

</body>
</html>

