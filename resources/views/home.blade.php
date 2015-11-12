@extends('template')

@section('content')

  <div class="jumbotron">
	<img  class="img-responsive img-rounded" src="{!! URL::asset('images/wiesn_header.jpg') !!}" alt="Photo by JasonParis https://www.flickr.com/photos/jasonparis/6225501342/" />
    <h1>Komilitona UniRasn 2016</h1>
    @if (Auth::check())
	<p>You can <a href="/order/create">order tickets</a> for UniRasn 2016 or <a href="/order">review the existing orders</a> of your group.</p>
	<p class='text-right'><a class="btn btn-success" href="/order/create" role="button">Order Now &raquo;</a> <a class="btn btn-primary " href="/order" role="button">Review Orders &raquo;</a></p>
	@else
	<p>Please <a href="/auth/login">login</a> or <a href="/auth/register">register</a> in order to order tickets and review your group's orders.</p>
	<p class='text-right'><a class="btn btn-primary " href="/auth/login" role="button">Login &raquo;</a> <a class="btn btn-primary" href="/auth/register" role="button">Register &raquo;</a></p>
	@endif
  </div>

@stop