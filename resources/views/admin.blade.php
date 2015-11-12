@extends('template')

@section('content')

  <div class="jumbotron" id="jumbo">
    <h1>P-AWS Tutorial 04</h1>
    <p>This is an overview page for displaying the data created by calls to the CMS, PayBuddy and FiBu APIs. It helps determining the tutorial groups having successfully implemented the workflow.</p>
  </div>

<div class="row" id="orders">
  <div class="col-md-12">
        <h2>Group Results</h2>
          <table class="table table-striped">
            <thead>
              <tr>
                <th>Group ID</th>
                <th>Order ID</th>
                <th>Order Date</th>
                <th># Tickets</th>
                <th>CRM Customer</th>
                <th>PayBuddy Payment</th>
				<th>Complete</th>
              </tr>
            </thead>
            <tbody>
            @foreach ($orders as $order)
              <tr>
			    <td>{{ $order->group }}
				</td>
                <td><a href="/order/{{ $order->id }}" title="View Order">{{ $order->id }}</a></td>
                <td>{{ $order->created_at }}</td>
                <td>{{ $order->amount }} Ticket(s)</td>
                <td>
				@if (count($order->customer) > 0)
				@foreach ($order->customer as $customer)
				<a href="/customer/{{ $customer->id }}" title="View Customer">
				(#{{ $customer->id }}) {{ $customer->vorname}} {{ $customer->nachname}}
				</a><br />
				@endforeach
				@else
					n/a
				@endif
				</td>
                <td>
				@if (count($order->payment) > 0)
				@foreach ($order->payment as $payment)
				<a href="/payment/{{ $payment->id }}" title="View payment">
				(#{{ $payment->id }}) {{ $payment->accountname}}
				</a><br />
				@endforeach
				@else
					n/a
				@endif
				</td>
				<td class="text-center">
				@if ($order->isComplete())
				<i class="glyphicon glyphicon-ok"></i>
				@else
				<i class="glyphicon glyphicon-remove"></i>
				@endif
              </tr>
            @endforeach
            </tbody>
          </table>
        </div>
</div>

<div class="row" id="crm">
        <div class="col-md-12">
        <h2>CRM</h2>
          <table class="table table-striped">
            <thead>
              <tr>
                <th>Group ID</th>
                <th>#</th>
                <th>Vorname</th>
                <th>Nachname</th>
                <th>Adresse</th>
              </tr>
            </thead>
            <tbody>
            @foreach ($customers as $customer)
              <tr>
                <td>{{ $customer->group }}</td>
                <td>{{ $customer->id }}</td>
                <td>{{ $customer->vorname }}</td>
                <td>{{ $customer->nachname }}</td>
                <td>{{ $customer->strasse }}, {{ $customer->PLZ }} {{ $customer->stadt }}</td>
              </tr>
            @endforeach
            </tbody>
          </table>
        </div>
</div>
  
<div class="row" id="paybuddy">
        <div class="col-md-12">
        <h2>PayBuddy</h2>
          <table class="table table-striped">
            <thead>
              <tr>
                <th>Group ID</th>
                <th>#</th>
                <th>Account Name</th>
                <th>IBAN</th>
                <th>Subject</th>
                <th>Total Sum</th>
              </tr>
            </thead>
            <tbody>
            @foreach ($payments as $payment)
              <tr>
                <td>{{ $payment->id }}</td>
                <td>{{ $payment->group }}</td>
                <td>{{ $payment->accountname }}</td>
                <td>{{ $payment->iban }}</td>
                <td>{{ $payment->subject }}</td>
                <td>{{ $payment->sum }}</td>
              </tr>
            @endforeach
            </tbody>
          </table>
        </div>
</div>
@stop