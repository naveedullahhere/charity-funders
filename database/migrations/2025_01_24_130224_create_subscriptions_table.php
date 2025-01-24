<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('subscriptions', function (Blueprint $table) {
            $table->id();
            $table->string('firstName');
            $table->string('lastName');
            $table->string('jobTitle');
            $table->string('organisationName');
            $table->string('charityNo')->nullable();
            $table->string('address');
            $table->string('townOrcity');
            $table->string('postCode');
            $table->string('emailAddress');
            $table->string('telephoneNumber');
            $table->string('password');
            $table->tinyInteger('newsletter')->default(0);  
            $table->tinyInteger('terms')->default(0);      
            $table->string('subscriptionType');
            $table->decimal('subscriptionAmount', 8, 2);
            $table->string('paymentMethod');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subscriptions');
    }
};
