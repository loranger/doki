<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Wiki Doki</title>

    <link rel="stylesheet" href="{{ asset('/css/plugins.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/doki.css') }}">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>

    <div class="navbar navbar-default navbar-fixed-top" role="navigation">
        <div class="container">
            <div class="navbar-header">
              <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
              </button>
              <a class="navbar-brand" href="{{{ URL::to('') }}}">Wiki Doki</a>
            </div>

            <div class="navbar-collapse collapse">
                @include('ui.navbar', array('items', $items))
            </div>
        </div>
    </div>

    <div class="container">

        <ol class="breadcrumb">
            @yield('breadcrumbs')
        </ol>

      @yield('content')

    </div>

    <script src="{{ asset('/js/plugins.js') }}" type="text/javascript" charset="utf-8"></script>
    <script src="{{ asset('/js/doki.js') }}" type="text/javascript" charset="utf-8"></script>
  </body>
</html>
