<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('apis', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('url');
            $table->text('key');
            $table->string('services_action');
            $table->string('add_action');
            $table->string('status_action');
            $table->string('refill_action');
            $table->string('refill_status_action');
            $table->string('balance_action');
            $table->string('service_key');
            $table->string('link_key');
            $table->string('quantity_key');
            $table->string('order_key');
            $table->string('orders_key');
            $table->string('refill_key');
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
        Schema::dropIfExists('apis');
    }
};
