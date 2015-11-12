<?php

namespace App\Http\Controllers;

use Auth;
use Log;
use Session;
use Validator;
use App\Order;
use App\Customer;
use App\Payment;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class PaymentController extends Controller
{
    /**
     * Create a new order controller instance.
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
            'accountname' => 'required|max:255',
            'iban' => 'required|min:20|max:20',
            'subject' => 'required|max:255',
            'sum' => 'required',
            'order_id' => 'required|integer|min:1'
        ]);

		$values = $request->all();
        $values = array_map('trim',$values); //remove leading and trailing whitespaces on all values
        $values['group'] = Auth::user()->group;
		
		//try calculating the sum from string
		try {
			$calculator = new \NXP\MathExecutor();
			$values['sum'] = $calculator->execute($values['sum']);
		} catch (Exception $e) {
			Log::Info('Input: "'.$values['sum'].'" has failed to evaluate');
		}
		
		// Check whether the order exists and is actually owned by the given group
		$order = Order::where('id', $values['order_id'])->where('group', $values['group'])->firstOrFail();
		
        if ($validator->fails()) {
			// Return JSON response with 422 HTTP status code
            return $validator->errors()->all();
        }
        
        // Validation successful, store entity
        $payment = new Payment($values);
        $payment->save();

        return $payment;
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
			$payment = Payment::findOrFail($id);
		}else{
			$payment = Payment::where('group', Auth::user()->group)->where('id', $id)->firstOrFail();
		}
        return view('payment.show', ['payment' => $payment]);
    }
}
