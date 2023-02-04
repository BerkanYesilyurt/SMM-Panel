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
        Schema::create('error_logs', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->nullable();
            $table->string('user_ip')->nullable();
            $table->text('user_agent')->nullable();
            $table->string('method', 30)->nullable();
            $table->string('referer')->nullable();
            $table->text('url')->nullable();
            $table->string('status_code', 30)->nullable();
            $table->text('message')->nullable();
            $table->text('filename')->nullable();
            $table->text('line')->nullable();
            $table->text('trace')->nullable();
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
        Schema::dropIfExists('error_logs');
    }
};
