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
        Schema::create('basket_items', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('basket_id');
            $table->unsignedBigInteger('item_id'); // It could be event, media, or collection
            $table->string('item_type'); // 'event', 'media', or 'collection'
            $table->decimal('price', 10, 2);
            $table->integer('quantity')->default(1); // How many of this item
            $table->timestamps();

            // $table->foreign('basket_id')->references('id')->on('baskets')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('basket_items');
    }
};
