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
        Schema::create('services', function (Blueprint $table) {
            $table->id();
            $table->integer('category_id');
            $table->text('name');
            $table->text('description');
            $table->decimal('price', 15, 5)->default('0');
            $table->integer('min');
            $table->integer('max');
            $table->string('type')->default('manual');
            $table->integer('api_provider_id')->nullable()->default(NULL);
            $table->integer('api_service_id')->nullable()->default(NULL);
            $table->string('status')->default('ACTIVE');
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
        Schema::dropIfExists('services');
    }
};
