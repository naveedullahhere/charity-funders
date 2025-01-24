<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFundersTable extends Migration
{
    public function up()
    {
        Schema::create('funders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('category_id')->nullable(); 
            $table->unsignedBigInteger('sub_category_id')->nullable(); 
            $table->string('name')->nullable(); 
            $table->string('charity_no')->nullable(); 
            $table->string('p_name')->nullable();
            $table->string('web')->nullable(); 
            $table->string('phone')->nullable();
            $table->string('email')->nullable(); 
            $table->string('address_line1')->nullable(); 
            $table->string('address_line2')->nullable(); 
            $table->string('region')->nullable(); 
            $table->string('city')->nullable(); 
            $table->string('postcode')->nullable(); 
            $table->unsignedBigInteger('country_id')->nullable();
            $table->string('location')->nullable(); 
            $table->string('lat')->nullable(); 
            $table->string('lng')->nullable(); 
            $table->mediumText('company_description')->nullable(); 
            $table->string('contact_person_name')->nullable(); 
            $table->string('contact_person_designation')->nullable(); 
            $table->string('contact_person_phone')->nullable();
            $table->string('contact_person_email')->nullable(); 
            $table->float('previous_grant_beneficiaries')->nullable(); 
            $table->string('trustee_board_man_power')->nullable(); 
            $table->string('operation')->nullable(); 
            $table->string('facebook')->nullable(); 
            $table->string('twitter')->nullable(); 
            $table->string('google_plus')->nullable(); 
            $table->string('charity_url')->nullable(); 
            $table->enum('status', ['Publish', 'Draft'])->default('Draft'); 
            $table->string('logo')->nullable(); 
            $table->string('slug')->nullable(); 
            $table->timestamps(); 
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('funders');
    }
}