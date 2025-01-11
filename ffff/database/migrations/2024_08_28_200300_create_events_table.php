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
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->integer('status')->default(1);
            $table->string('name');
            $table->integer('event_location_id');
            $table->integer('event_role_id');
            $table->date('event_date');
            $table->longText('thumbnail');
            $table->decimal('whole_event_price', 10, 2);
            $table->decimal('price_per_video', 10, 2);
            $table->decimal('price_per_image', 10, 2);
            $table->longText('thumbnail')->nullable();
//            Metas not use for now
            $table->longText('meta_title')->nullable();
            $table->longText('meta_description')->nullable();
            $table->longText('meta_keyword')->nullable();
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('deleted_by')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('created_by')->references('id')->on('users');
            $table->foreign('deleted_by')->references('id')->on('users');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};

