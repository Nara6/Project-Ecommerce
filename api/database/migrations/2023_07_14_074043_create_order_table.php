<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->double('total_price',10,2);
            $table->integer('discount')->nullable();
            $table->string('shipping_address');
            $table->string('shipping_address1')->nullable();
            $table->string('shipping_city');
            $table->string('shipping_country');
            $table->string('shipping_postalcode');
            $table->string('shipping_method');
            $table->string('billing_address');
            $table->string('billing_city');
            $table->string('billing_country');
            $table->string('billing_postalcode');
            $table->string('card_number');
            $table->string('card_type');
            $table->string('cardholder_name');
            $table->string('expired_date');
            $table->string('CVV');
            $table->dateTime('order_at');
            $table->foreign('user_id')->references('id')->on('user')->onDelete('cascade');
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
        Schema::dropIfExists('order');
    }
}
