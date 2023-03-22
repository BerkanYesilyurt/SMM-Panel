<?php

use App\Enums\OrderStatusEnum;
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
            $table->id()->startingValue(10000);
            $table->integer('user_id')->index();
            $table->integer('service_id')->index();
            $table->text('link');
            $table->integer('quantity');
            $table->decimal('charge', 15, 5);
            $table->string('type')->default('manual');
            $table->integer('api_provider_id')->nullable();
            $table->integer('api_service_id')->nullable();
            $table->integer('api_order_id')->nullable();
            $table->string('start_count')->nullable();
            $table->string('remain')->nullable();
            $table->string('status')->default(OrderStatusEnum::PENDING->value)->index();
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
