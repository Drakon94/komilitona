<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('vorname');
            $table->string('nachname');
            $table->string('strasse');
            $table->string('PLZ', 5);
            $table->string('stadt');
			$table->string('group', 2);
            $table->timestamps();
            $table->softDeletes();
        });
		
		// pivot table
		Schema::create('customer_order', function (Blueprint $table) {
            $table->integer('customer_id')->unsigned()->index()->references('id')->on('customers')->onDelete('cascade');
            $table->integer('order_id')->unsigned()->index()->references('id')->on('orders')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('customers');
        Schema::drop('customer_order');
    }
}
