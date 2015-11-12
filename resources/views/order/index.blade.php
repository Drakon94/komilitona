@extends('template')

@section('content')

   
<div class="row" id="orders">
        <div class="col-md-12">
        <h2>Your Orders</h2>
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
@stop