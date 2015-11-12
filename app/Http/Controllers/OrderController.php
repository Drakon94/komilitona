<?php

namespace App\Http\Controllers;

use Auth;
use Session;
use Validator;
use App\Order;
use App\Customer;
use App\Payment;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class OrderController extends Controller
{
    
    
    /**
     * Create a new order controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth', ['except' => 'store']);
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
            'firstname' => 'required|max:255',
            'lastname' => 'required|max:255',
            'street' => 'required|max:255',
            'zip' => 'required|min:4|max:5',
            'city' => 'required|max:255',
            'amount' => 'required|integer|min:1|max:12',
            'iban' => 'required|min:20|max:20',
        ]);

        if ($validator->fails()) {
            return redirect('/order/create')
                        ->withErrors($validator)
                        ->withInput();
        }
        
        // Validation successful, store entity
		$values = $request->all();
		$values['group'] = Auth::user()->group;
        $order = new Order($values);
        $order->save();

        Session::flash('success', 'Your order  #'.$order->id.' was successful!');
        return redirect('/order');
    }
    
        
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
		$orders = Order::where('group', Auth::user()->group)->orderBy('created_at', 'asc')->with('payment', 'customer')->get()->all();
		
        return view('order.index', ['orders' => $orders]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('order.create');
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
			$order = Order::findOrFail($id);
		}else{
			$order = Order::where('group', Auth::user()->group)->where('id', $id)->firstOrFail();
		}
        return view('order.show', ['order' => $order]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
