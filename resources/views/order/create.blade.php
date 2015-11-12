@extends('template')

@section('content')
<div class="container-fluid">
<div class="row" id="paybuddy">
		<div class="col-md-8 col-md-offset-2">
       	<div class="panel panel-default">
				<div class="panel-heading">Tickets Bestellen</div>
				<div class="panel-body">
				

<form class="form-horizontal" role="form" method="POST" action="/order">
<input type="hidden" name="_token" value="{{ csrf_token() }}">

<div class="form-group">
<div class="col-md-8 col-md-offset-2">
<h2>Komilitona UniRasn 2016<br>Jetzt Tickets sichern!</h2>
</div>
</div>

<div class="form-group">
<div class="col-md-4 col-md-offset-2 {{ $errors->has('firstname') ? 'has-error' : false }}">
<input type="text" class="form-control  " placeholder="Vorname" name="firstname" value="{{ old('firstname') }}">
</div>
<div class="col-md-4 {{ $errors->has('lastname') ? 'has-error' : false }}">
<input type="text" class="form-control" placeholder="Nachname"  name="lastname" value="{{ old('lastname') }}">
</div>
</div>

<div class="form-group {{ $errors->has('street') ? 'has-error' : false }}">
<div class="col-md-8 col-md-offset-2">
<input type="text" class="form-control" placeholder="Straße, Nr." name="street" value="{{ old('street') }}">
</div>
</div>

<div class="form-group ">
<div class="col-md-2 col-md-offset-2 {{ $errors->has('zip') ? 'has-error' : false }}">
<input type="text" placeholder="PLZ" class="form-control" name="zip" value="{{ old('zip') }}" maxlength="5">
</div>
<div class="col-md-6  {{ $errors->has('city') ? 'has-error' : false }}">
<input type="text" placeholder="Stadt" class="form-control" name="city" value="{{ old('city') }}">
</div>
</div>

<div class="form-group {{ $errors->has('amount') ? 'has-error' : false }}">
<div class="col-md-2 col-md-offset-2">
<label class="control-label"># Tickets</label>
</div>
<div class="col-md-6">
<select  class="form-control" name="amount" id="amount" value="{{ old('zip') }}">
@for ($i = 1; $i < 13; $i++)
    <option value="{{ $i }}">{{ $i }} Ticket(s)</option>
@endfor
</select>
</div>
</div>

<div class="form-group">
<div class="col-md-8 col-md-offset-2">
<p>Die Zahlung erfolgt per Lastschrift über den Dienstleister PayBuddy<sup>®</sup>. Bitte geben Sie hierzu im Folgenden Ihre IBAN an.</p>
</div>
</div>

<div class="form-group {{ $errors->has('iban') ? 'has-error' : false }}">
<div class="col-md-8 col-md-offset-2">
<input type="text" maxlength="20" class="form-control" placeholder="IBAN" name="iban" value="{{ old('iban') }}">
</div>
</div>

<div class="form-group">
<div class="col-md-3 col-md-offset-2">
<button type="submit" class="btn btn-success">
	JETZT KAUFEN
</button>
</div>
<div class="col-md-5">
<h4>Gesamtsumme: <span id="summe">5,00</span> €.</h4>
</div>
</div>
</form>
</div>
</div>
</div>
</div>
        
</div>
@stop
