<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMediaTable extends Migration
{
    public function up()
    {
        Schema::create('media', function (Blueprint $table) {
            $table->id();
            $table->string('group_id')->nullable(); // Path to the thumbnail for videos
            $table->foreignId('gallery_id')->nullable()->constrained('galleries')->onDelete('cascade');
            $table->string('file_path'); // Path to the file
            $table->enum('file_type', ['image', 'video']); // 'image' or 'video'
            $table->string('resolution')->nullable(); // Size identifier (e.g., 'small', 'medium', 'large')
            $table->string('resolution_type')->nullable(); // Size identifier (e.g., 'small', 'medium', 'large')
            $table->longText('size')->default('0'); // Size identifier (e.g., 'small', 'medium', 'large')
            $table->boolean('is_thumbnail')->default(false); // Path to the thumbnail for videos
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('media');
    }
}
