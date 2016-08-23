<!DOCTYPE html>
<html>
<head>
    <title>Laravel</title>

    <link href="https://fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">

    <style>
        html, body {
            height: 100%;
        }

        body {
            background: url('{{ URL::asset('src/images/sys/silver_scales.png') }}');
            margin: 0;
            padding: 0;
            width: 100%;
            display: table;
            font-weight: 100;

        }

        .container {
            text-align: center;
            display: table-cell;
            vertical-align: middle;
        }

        .content {
            text-align: center;
            display: inline-block;
        }

        input[type="submit"] {
            background: #0098cb;
            border: 0px;
            border-radius: 5px;
            color: #fff;
            padding: 10px;
            margin: 20px auto;
        }
    </style>
    @include('layouts.css')
    @include('layouts.js')
    <script src="{{ URL::to('src/js/file_upload/ng-file-upload.js') }}" type="text/javascript"></script>
    <script src="{{ URL::to('src/js/file_upload/ng-file-upload-shim.js') }}" type="text/javascript"></script>
    <script src="{{ URL::to('src/js/upload-image.js') }}" type="text/javascript"></script>


</head>
<body ng-app="fileUpload" ng-controller="MyCtrl">
<div class="container">
    <div class="content ">
        <div class="title">
            <label style="font-size: 50px;">Success!</label><br>
            <label style="font-size: 25px;">Kindly proceed to the admin office for approval of your account!</label><br>
            <label style="font-size: 25px;">Thank you :)</label><br><br>
            <button class="btn btn-success btn-lg" style="width: 200px;"
                    onclick="window.location='{{ url("/login") }}'">OK
            </button>

            {{--<br>
            <h4>Upload on file select</h4>
              @if (count($errors) > 0)
                  <div class="alert alert-danger">
                      <strong>Whoops!</strong> There were some problems with your input.<br><br>
                      <ul>
                          @foreach ($errors->all() as $error)
                              <li>{{ $error }}</li>
                          @endforeach
                      </ul>
                  </div>
              @endif
              <form action="{{route('fileUpload')}}" method="POST" enctype="multipart/form-data">
                  {{ csrf_field() }}
                  <div class="row cancel">
                      <div class="col-md-4">
                          <input type="file" name="image" id="image" accept="image/gif, image/jpeg" class="image"/>
                      </div>
                      <div class="col-md-4">
                          <button type="submit" class="btn btn-success">Create</button>
                      </div>
                  </div>
              </form>--}}

          {{--  <button type="file" ngf-select="uploadFiles($file, $invalidFiles)"
                    accept="image/*" ngf-max-height="1000" ngf-max-size="10MB">
                Select File
            </button>
            <br><br>
            File:
            <div>
                <%f.name%> <%errFile.name%> <%errFile.$error%> <%errFile.$errorParam%>
                <span class="progress" ng-show="f.progress >= 0"></span>
                <%errorMsg%>
            </div>--}}

            <script>
                var myToken = '{{ Session::token() }}';
                var publicUrl = '{{URL::asset('/'). '' . 'src/images/uploads/'}}';
            </script>
        </div>
    </div>
</div>
</body>
</html>