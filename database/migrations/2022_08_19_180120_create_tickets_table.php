<?php

use App\Enums\TicketStatusEnum;
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
        Schema::create('tickets', function (Blueprint $table) {
            $table->id()->startingValue(1000);
            $table->integer('user_id');
            $table->string('subject')->default('OTHER');
            $table->text('message');
            $table->string('order_id')->nullable();
            $table->string('order_request')->nullable();
            $table->string('pay_type')->nullable();
            $table->string('pay_id')->nullable();
            $table->string('feature_request')->nullable();
            $table->string('status')->default(TicketStatusEnum::ACTIVE->value);
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
        Schema::dropIfExists('tickets');
    }
};
