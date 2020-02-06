<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('influencer_id');
            $table->unsignedBigInteger('product_id');
            $table->unsignedBigInteger('product_thumb_id');
            $table->unsignedBigInteger('evaluation_id')->nullable();
            $table->unsignedBigInteger('delivery_addr');
            $table->unsignedBigInteger('delivery_unit');
            $table->string('person_incharge');
            $table->string('phone_incharge');
            $table->string('product_name');
            $table->string('category_name');
            $table->integer('status')->default(0);
            $table->decimal('total_amount');
            $table->integer('payment_method')->default(0);
            $table->date('date_receive_est');
            $table->text('note')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
