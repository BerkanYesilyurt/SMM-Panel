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
        Schema::create('service_updates', function (Blueprint $table) {
            $table->id();
            $table->integer('service_id');
            $table->integer('new_service_id')->nullable();
            $table->integer('old_price')->nullable();
            $table->integer('new_price')->nullable();
            $table->text('description')->nullable();
            $table->integer('public')->nullable();
            $table->integer('show_id_changes')->nullable();
            $table->integer('show_price_changes')->nullable();
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
        Schema::dropIfExists('service_updates');
    }
};
