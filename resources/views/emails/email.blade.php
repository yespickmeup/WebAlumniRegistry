



<html>
<head>

</head>
<body>

    <form action="{{ route('sendEmail') }}" method="POST">
        <input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
        <input type="submit" value="Submit">
    </form>
</body>
</html>