<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Laravel Auth Haravan">
    <meta name="author" content="tweb.com.vn">
    <title>Laravel Auth Haravan</title>

    <link href="{{ url('css/bootstrap.min.css') }}" rel="stylesheet"/>
    <meta name="theme-color" content="#7952b3">


    <style>
        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            user-select: none;
        }

        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
                font-size: 3.5rem;
            }
        }
    </style>

    <link href="{{ url('css/signin.css') }}" rel="stylesheet"/>
</head>
<body class="text-center">

<main class="form-signin">
    <form action="{{ url('login') }}" method="get">
        <img class="mb-4" src="{{url('img/bootstrap-logo.svg')}}" alt="" width="72" height="57">
        <h1 class="h3 mb-3 fw-normal">Please sign in</h1>

        <button class="w-100 btn btn-lg btn-primary" type="submit">Sign in with Haravan </button>
    </form>
</main>
</body>
</html>

