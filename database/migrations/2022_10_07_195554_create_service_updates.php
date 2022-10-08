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
            $table->integer('new_service_id');
            $table->integer('old_price');
            $table->integer('new_price');
            $table->text('description');
            $table->integer('public');
            $table->integer('show_id_changes');
            $table->integer('show_price_changes');
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
