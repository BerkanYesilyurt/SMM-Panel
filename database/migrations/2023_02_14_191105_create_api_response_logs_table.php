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
        Schema::create('api_response_logs', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('order_id')->nullable()->index();
            $table->unsignedInteger('api_id')->index();
            $table->smallInteger('type')->index();
            $table->text('response');
            $table->boolean('error')->index();
            $table->timestamps();
            $table->index(['order_id', 'type']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('api_response_logs');
    }
};
