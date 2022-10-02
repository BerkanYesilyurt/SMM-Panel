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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->integer('service_id');
            $table->text('link');
            $table->integer('quantity');
            $table->decimal('charge', 15, 5);
            $table->string('type')->default('manual');
            $table->integer('api_provider_id')->nullable()->default(NULL);
            $table->integer('api_service_id')->nullable()->default(NULL);
            $table->integer('api_order_id')->nullable()->default(NULL);
            $table->string('start_count')->default(NULL);
            $table->string('remain')->default(NULL);
            $table->string('status')->default('PENDING');
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
};
