@extends('template')

@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading">Login</div>
				<div class="panel-body">
				

<form class="form-horizontal" role="form" method="POST" action="/auth/login">
<input type="hidden" name="_token" value="{{ csrf_token() }}">


<div class="form-group">
<label class="col-md-4 control-label">Username</label>
<div class="col-md-6">
<input type="text" class="form-control" placeholder="John Doe" name="name" value="{{ old('name') }}" aria-describedby="helpBlock">
<span id="helpBlock" class="help-block">This is your username (e.g., <em>John Doe</em>) and not your email address.</span>

</div>
</div>

<div class="form-group">
<label class="col-md-4 control-label">Password</label>
<div class="col-md-6">
<input type="password" class="form-control" name="password">
</div>
</div>

<div class="form-group">
<div class="col-md-6 col-md-offset-4">
<button type="submit" class="btn btn-primary">
	Login
</button>
<br /><br />
<p><a href="/password/email">Forgot password?</a></p>
</div>

</div>
</form>
</div>
</div>
</div>
</div>
</div>

@endsection
