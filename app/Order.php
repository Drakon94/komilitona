<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    
    protected $fillable = ['firstname', 'lastname', 'street', 'zip', 'city', 'amount', 'iban', 'group'];
    
    /**
     * Get the customer for the order.
     */
    public function customer()
    {
        return $this->belongsToMany('App\Customer')->withTimestamps();
    }
	
	/**
     * Get the payment for the order.
     */
    public function payment()
    {
        return $this->hasMany('App\Payment');
    }

	/**
     * Does this order has both related objects?
     */
	public function isComplete(){
		return count($this->customer()->get()) * count($this->payment()->get());
	}
}
