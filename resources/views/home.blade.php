<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>PRAPP | @if($page == "home") Build your reputation the right way @else {{ $page }} @endif</title>
    @if($page == "home")
        <link rel="stylesheet" href="css/main_extra.css">
    @elseif($page == "Login")
        <link rel="stylesheet" href="css/login.css">
    @elseif($page == "Sign Up")
        <link rel="stylesheet" href="css/signup.css">
    @endif

</head>
<body>

    @include('includes.header')

    @include('includes.nav')

    @if($page == "Login")
        @include('includes.login')
    @elseif($page == "Sign Up")
        @include('includes.signup')
    @endif

    @if($page == "home")
        @include('includes.about')
    @endif

    @include('includes.footer')

    <script src="jss/jquery-1.12.4.min.js"></script>
    <script src="jss/default.js"></script>
    @if($page == "Sign Up") <script src="jss/signup.js"></script> @endif

</body>
</html>


