<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = ['order_id', 'accountname', 'iban', 'subject', 'group', 'sum'];

	/*
     * Get the order record associated with the payment.
     */
    public function order()
    {
        return $this->belongsTo('App\Order');
    }

}
