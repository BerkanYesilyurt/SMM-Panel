<?php

use App\Enums\UserAuthorityEnum;
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
        Schema::create('users', function (Blueprint $table) {
            $table->id()->startingValue(1000);
            $table->string('name');
            $table->string('email')->unique()->index();
            $table->decimal('balance', 15, 5)->default('0');
            $table->string('password');
            $table->string('contact');
            $table->string('api_key')->nullable();
            $table->string('authority')->default(UserAuthorityEnum::none->value);
            $table->string('timezone')->nullable();
            $table->string('activation_token')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->timestamp('last_login')->nullable();
            $table->string('last_login_ip')->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
};
