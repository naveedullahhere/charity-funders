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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('title', 255);
            $table->integer('provider_id')->nullable();
            $table->integer('airport_id')->nullable();
            $table->integer('space_id')->nullable();
            $table->string('phone', 100)->nullable();
            $table->tinyInteger('transfer_required')->nullable()->default(0);
            $table->longText('selling_points')->nullable();
            $table->integer('min_lead_time')->nullable();
            $table->integer('max_lead_time')->nullable();
            $table->string('address', 500)->nullable();
            $table->string('post_code', 255)->nullable();
            $table->string('city', 255)->nullable();
            $table->string('satnav', 255)->nullable();
            $table->longText('short_description')->nullable();
            $table->longText('long_description')->nullable();
            $table->longText('arrival_procedure')->nullable();
            $table->longText('return_procedure')->nullable();
            $table->longText('additional_info')->nullable();
            $table->longText('instruction_content')->nullable();
            $table->longText('page_content')->nullable();
            $table->smallInteger('product_priority')->nullable();
            $table->integer('total_space')->nullable();
            $table->decimal('price', 8, 2)->nullable();
            $table->tinyInteger('status')->default(1);
            $table->softDeletes();
            $table->timestamps();

            // $table->foreign('provider_id')->references('id')->on('providers')->onDelete('set null');
            // $table->foreign('airport_id')->references('id')->on('airports')->onDelete('set null');
            // $table->foreign('space_id')->references('id')->on('spaces')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
