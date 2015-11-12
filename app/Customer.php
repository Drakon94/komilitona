<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $fillable = ['order_id', 'vorname', 'nachname', 'strasse', 'PLZ', 'stadt', 'group'];

	/*
     * Get the order records associated with the customer.
     */
    public function order()
    {
        return $this->belongsToMany('App\Order')->withTimestamps();
    }
}
