<?php

use App\Order;  
use Illuminate\Database\Seeder;

class OrderTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $order = new Order([
            'firstname' => 'Karl',
			'lastname' => 'Käufer',
			'street' => 'Leonardo-Campus 3',
			'zip' => '48149',
			'city' => 'Münster',
			'amount' => 5,
            'iban' => 'DEXX888888880190123456',
            'group' => '99'
        ]);
		$order->save();
    }
}