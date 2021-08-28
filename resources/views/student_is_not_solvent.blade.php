<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:400,600,700" rel="stylesheet">
        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    </head>
<body>
<div class="flex w-screen h-screen items-center justify-center">
  <div class="text-center">
      <img src="{{ asset('img/onlineStudents.jpg') }}" alt="Online Students">
      <h1 class="text-xl">Sección no disponible, comuníquese a dirección académica.</h1>
  </div>
</div>
</body>
</html>
