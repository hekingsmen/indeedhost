<head>

  <meta charset="utf-8" />

  <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('dashboard/assets/img/apple-icon.png') }}">

  <link rel="icon" type="image/png" href="{{ asset('dashboard/assets/img/favicon.png') }}">

  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>

    Admin

  </title>

  <meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />

  <!--     Fonts and icons     -->

  <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />

  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">

  <!-- CSS Files -->

  <link href="{{ asset('dashboard/assets/css/material-dashboard.css?v=2.1.2') }}" rel="stylesheet" />

  <!-- CSS Just for demo purpose, don't include it in your project -->

  <link href="{{ asset('dashboard/assets/demo/demo.css') }}" rel="stylesheet" />

  <link href="{{ asset('dashboard/assets/css/bootstrap.min.css') }}" rel="stylesheet" />

  <link href=" {{ asset('dashboard/assets/css/jquery.dataTables.min.css') }}" rel="stylesheet">

  <link href=" {{ asset('dashboard/assets/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet">

{{--  for multi select --}}
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/css/select2.min.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">

  @stack('styles')

</head>

