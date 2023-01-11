<?php

use App\Enums\ActiveInactiveState;
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
        Schema::create('payment_methods', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug');
            $table->string('icon');
            $table->string('status')->default(ActiveInactiveState::ACTIVE->value);
            $table->string('config_key')->nullable();
            $table->string('config_value')->nullable();
            $table->string('min_amount');
            $table->string('max_amount');
            $table->string('is_manual')->default(ActiveInactiveState::ACTIVE->value);
            $table->text('content')->nullable();
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
        Schema::dropIfExists('payment_methods');
    }
};
