@if (count($errors) > 0)
<div class="flash-message">
    <div class="alert alert-danger">
        <strong>Whoops!</strong> There were some problems with your input.<br><br>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
</div>
@endif

@if (session('status'))
	<div class="flash-message">
    <div class="alert alert-success">
        {{ session('status') }}
    </div>
    </div>
@endif
<div class="flash-message">
    @foreach (['danger', 'warning', 'success', 'info'] as $msg)
      @if(Session::has($msg))

      <p class="alert alert-{{ $msg }}">{{ Session::get($msg) }}</p>
      @endif
    @endforeach
</div> <!-- end .flash-message -->