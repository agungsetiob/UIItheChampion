<!DOCTYPE HTML>
<html>
<head>
    <title>{{ config('app.title', 'dr. H. Andi Abdurrahman Noor') }}</title>
    <link href="{{ asset('css/error.css') }}" rel="stylesheet" type="text/css"  media="all" />
    <link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Bangers">
</head>
<body class="error-page">
    <div class="content">
        <img src="{{ url('storage/hulk-404s.gif') }}" title="error" />
        <p><span></span>You requested a page that is not exist</p>
        <a href="{{ url('/') }}">Back To Home</a>
    </div>
</div>
</body>
</html>