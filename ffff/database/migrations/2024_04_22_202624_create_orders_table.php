<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->tinyInteger("status")->default(0)->comment('0=pending,1=completed');
            $table->string("inv_id")->unique();
            $table->string("email")->nullable();
            $table->string("first_name")->nullable();
            $table->string("last_name")->nullable();
            $table->string("phone_no")->nullable();
            $table->string("vehicle_registration")->nullable();
            $table->string("vehicle_model")->nullable();
            $table->string("vehicle_color")->nullable();
            $table->string("passenger")->nullable();
            $table->string("terminal_out")->nullable();
            $table->string("terminal_in")->nullable();
            $table->string("flight_out")->nullable();
            $table->string("flight_in")->nullable();
            $table->string("product_price")->nullable();
            $table->string("basket_id")->nullable();
            $table->string("payment_method", 255)->nullable();
            $table->string("payment_status")->nullable();
            $table->string("transaction_key")->nullable();
            $table->string("transaction_url")->nullable();
            $table->integer("user_id")->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
