<?php

namespace App\Http\Controllers;

use Auth;
use Log;
use Session;
use Validator;
use App\Customer;
use App\Order;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class CustomerController extends Controller
{
    
    
    /**
     * Create a new customer controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth', ['only' => 'show']);
        $this->middleware('auth.once', ['only' => 'store']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'order_id' => 'required|integer|min:1',
            'vorname' => 'required|max:255',
            'nachname' => 'required|max:255',
            'strasse' => 'required|max:255',
            'PLZ' => 'required|min:4|max:5',
            'stadt' => 'required|max:255',
        ]);
		
        if ($validator->fails()) {
			// Return JSON response with 422 HTTP status code
            return $validator->errors()->all();
        }
		
		$values = $request->all();
        $values = array_map('trim',$values); //remove leading and trailing whitespaces on all values
        $values['group'] = Auth::user()->group;
		// Check whether the order exists and is actually owned by the given group
		$order = Order::where('id', $values['order_id'])->where('group', $values['group'])->firstOrFail();
		unset($values['order_id']);

		
        // Validation successfull, let's check if we already have a customer with the same namespace
		$customer = Customer::where('vorname', $values['vorname'])
					->where('nachname', $values['nachname'])
					->where('strasse', $values['strasse'])
					->where('PLZ', $values['PLZ'])
					->where('stadt', $values['stadt'])
					->where('group', $values['group'])
					->first();

		Log::Info(print_r($customer, true));
		
		// if this is a new customer, we create it first		
		if (is_null($customer)){ //|| $customer->isEmpty()
			$customer = new Customer($values);
			$customer->save();
		}
		
		$existing_associations = $order->customer()->lists('id');

		// check if the relation between order and customer is already established
		if(! in_array($customer->id, array_values($existing_associations->toArray()))){
			// link the customer to the order 
			$order->customer()->attach($customer->id);
		}
		
		// Return customer object
        return $customer;
    }
    
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
		if(Auth::user()->admin == 1){
			$customer = Customer::findOrFail($id);
		}else{
			$customer = Customer::where('group', Auth::user()->group)->where('id', $id)->firstOrFail();
		}
        return view('customer.show', ['customer' => $customer]);
    }
}
