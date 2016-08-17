<!DOCTYPE html>
<html>
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laravel</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css" integrity="sha384-XdYbMnZ/QjLh6iI4ogqCTaIjrFk87ip+ekIjefZch0Y+PvJ8CDYtEs1ipDmPorQ+" crossorigin="anonymous">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/css/bootstrap.min.css" crossorigin="anonymous">
    <style>
        body {
            background: url('{{ URL::asset('src/images/sys/stpaul2.jpg') }}') no-repeat center center fixed;
            -webkit-background-size: cover;
            -moz-background-size: cover;
            background-size: cover;
            -o-background-size: cover;
        }
        .onesidedropshadow {
          
            -webkit-box-shadow: 0 5px 10px -5px black;
            -moz-box-shadow: 0 5px 10px -5px black;
            box-shadow: 0 5px 10px -5px black;
        }

    </style>
</head>
<body>
   <br><br> <br><br> <br><br> <br><br> <br><br> <br><br> <br><br>
<div class="container container-table">
    <div class="row ">
        <div class="col-md-6 col-md-offset-3 onesidedropshadow">
            <div class="panel panel-default ">
                <header class="panel-heading">
                <h3>Login with your credentials</h3>
                </header>
                
               <br><br>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/login') }}" >
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                            <div class="col-md-7">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}">

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">Password</label>

                            <div class="col-md-7">
                                <input id="password" type="password" class="form-control" name="password">

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                        <div class="col-md-5 pull-right">
                             <a class="btn btn-link" href="{{ route('signup') }}">Signup?</a>
                             <button type="submit" class="btn btn-primary ">
                                <i class="fa fa-btn fa-sign-in"></i> Login
                             </button>

                            <!--  <a class="btn btn-link" href="{{ url('/password/reset') }}">Forgot Your Password?</a> -->
                        </div>
                          
                             <br> <br>
                       
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
 <!-- JavaScripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.3/jquery.min.js" integrity="sha384-I6F5OKECLVtK/BL+8iSLDEHowSAfUo76ZL9+kGAgTRdiByINKJaqTPH/QVNS1VDb" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
</body>
</html>