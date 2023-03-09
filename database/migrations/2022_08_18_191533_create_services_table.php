<?php

use App\Enums\ServiceStatusEnum;
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
            $table->id()->startingValue(1000);
            $table->integer('category_id');
            $table->text('name');
            $table->text('description');
            $table->decimal('price', 15, 5)->default('0');
            $table->integer('min');
            $table->integer('max');
            $table->string('type')->default('manual');
            $table->integer('api_provider_id')->nullable();
            $table->integer('api_service_id')->nullable();
            $table->string('status')->default(ServiceStatusEnum::ACTIVE->value);
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
        Schema::dropIfExists('services');
    }
};
