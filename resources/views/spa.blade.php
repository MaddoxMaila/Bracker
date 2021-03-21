@php
$config = [
    'appName' => config('app.name'),
    'locale' => $locale = app()->getLocale(),
    'locales' => config('app.locales'),
    'githubAuth' => config('services.github.client_id'),
];
@endphp
<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <title>{{ config('app.name') }}</title>

  <link rel="stylesheet" href="{{ mix('dist/css/app.css') }}">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <style type="text/css">
    
    #app{
      background-color: #fff;
    }
    /*AIzaSyBDiwgyOB93hfiIKMUflHfYP3nBfuDirio*/

  </style>
</head>
<body>

  <script type="text/javascript" src="{{ asset('dist/pusher.min.js') }}"></script>
  <script type="text/javascript">
    function initMap(){}
  </script>
  
  <div id="app"></div>

  {{-- Global configuration object --}}
  <script>
    window.config = @json($config);
  </script>

  {{-- Load the application scripts --}}
  <script src="{{ mix('dist/js/app.js') }}"></script>
  <script async defer src="&callback=initMap"></script>
</body>
</html>
