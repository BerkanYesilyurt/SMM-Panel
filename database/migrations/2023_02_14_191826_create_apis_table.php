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
            $table->string('action');
            $table->text('order_endpoint');
            $table->string('order_method');
            $table->string('order_id_key');
            $table->text('status_endpoint');
            $table->text('status_method');
            $table->string('status_key');
            $table->string('start_counter_key');
            $table->integer('remain_key');
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
