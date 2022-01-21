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
            $table->engine = 'InnoDB';
            $table->id();
            $table->foreignId('user_id')->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('profile_id')->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->string('invoice_number');
            $table->string('receiver_name');
            $table->string('sender_name');
            $table->integer('vip_customer')->nullable();
            $table->integer('city_of_deli_id');
            $table->string('phone_num');
            $table->date('date');
            $table->string('address');
            $table->integer('cash_status');
            $table->integer('total_price');
            $table->integer('labour');
            $table->integer('invest_price');
            $table->string('remark');

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
        Schema::dropIfExists('orders');
    }
}
