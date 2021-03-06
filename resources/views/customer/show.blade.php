@extends('template')

@section('content')

   
<div class="row">
        <div class="col-md-12">
        <h2>View Customer #{{ $customer->id }}</h2>
		<a class="btn btn-default" href="/order">&laquo; Back to Orders</a><br><br>
		<ul class="list-group">
		@foreach ($customer->toArray() as $key => $value)
		<li class="list-group-item"><strong>{{$key}}</strong>: {{$value}}</li>
		@endforeach
		</ul>
		<a class="btn btn-default" href="/order">&laquo; Back to Orders</a>
</div>
@stop