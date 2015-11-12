<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- resources/views/payments.blade.php -->
    <title>Komilitona - Tickets bestellen</title>
    <link rel="stylesheet"  href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.5/css/bootstrap.min.css" />
    <link rel="stylesheet"  href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.5/css/bootstrap-theme.min.css" />
    <link rel="stylesheet"  href="https://cdnjs.cloudflare.com/ajax/libs/jquery.tablesorter/2.23.5/css/theme.bootstrap.min.css" />
    <link rel="stylesheet"  href="https://cdnjs.cloudflare.com/ajax/libs/jquery.tablesorter/2.23.5/css/jquery.tablesorter.pager.min.css" />
    <link rel="stylesheet"  href="{!! URL::asset('style.css') !!}" />
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>  
  <body role="document" data-spy="scroll" data-target="#navbar">
      <!-- Fixed navbar -->
    <nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="/">P-AWS Tutorial 04</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          @if (Request::path() == 'admin')
          <ul class="nav navbar-nav">
            <li><a href="#jumbo">Start</a></li>
            <li><a href="#orders">Group Results</a></li>
            <li><a href="#crm">CRM</a></li>
            <li><a href="#paybuddy">PayBuddy</a></li>
          </ul>
		@elseif (Auth::check())  
		   <ul class="nav navbar-nav">
            <li {{!! Request::path() == 'order/create' ? ' class="active"' : '' !!}}><a href="/order/create">Order Now</a></li>
            <li {{!! Request::path() == 'order' ? ' class="active"' : '' !!}}><a href="/order">Review Orders</a></li>
          </ul>
        @endif
          <ul class="nav navbar-nav navbar-right">
          @if (Auth::check() && Auth::user()->admin == 1)
           <li><a href="/admin"><span class="label label-success">Admin</span></a>
           <li><a href="/auth/logout"><span class="label label-primary">Logout</span></a>
           @elseif (Auth::check())  
           <li><a href="/auth/logout"><span class="label label-primary">Logout</span></a>
          @else
          <li><a href="/admin"><span class="label label-primary">Admin</span></a>
          @endif
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>

    <div class="container" role="main">

@include('snippets.error')

@yield('content')

<!-- Footer -->
        <footer>
            <div class="container text-center">
                <p>Copyright &copy; <a href="https://rck.ms">Jan Betzing</a> 2015</p>
            </div>
        </footer>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.5/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.tablesorter/2.23.5/js/jquery.tablesorter.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.tablesorter/2.23.5/js/jquery.tablesorter.widgets.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.tablesorter/2.23.5/js/extras/jquery.tablesorter.pager.min.js"></script>
    <script src="{!! URL::asset('scripts.js') !!}"></script>
</body>  
</html>  