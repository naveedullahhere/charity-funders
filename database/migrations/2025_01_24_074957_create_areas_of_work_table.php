<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAreasOfWorkTable extends Migration
{
    public function up()
    {
        Schema::create('areas_of_work', function (Blueprint $table) {
            $table->id(); // Auto-incrementing primary key
            $table->unsignedBigInteger('funder_id')->nullable(); // Funder ID (foreign key)
            $table->unsignedBigInteger('work_area_id')->nullable(); // Work Area ID (foreign key)
            $table->timestamps(); // Created at and Updated at

            // Foreign key constraints
            $table->foreign('funder_id')
                  ->references('id')
                  ->on('funders')
                  ->onDelete('cascade'); // Cascade on delete

            $table->foreign('work_area_id')
                  ->references('id')
                  ->on('work_areas') // Assuming you have a `work_areas` table
                  ->onDelete('cascade'); // Cascade on delete
        });
    }

    public function down()
    {
        Schema::table('areas_of_work', function (Blueprint $table) {
            $table->dropForeign(['funder_id']); // Drop foreign key constraint
            $table->dropForeign(['work_area_id']); // Drop foreign key constraint
        });

        Schema::dropIfExists('areas_of_work');
    }
}