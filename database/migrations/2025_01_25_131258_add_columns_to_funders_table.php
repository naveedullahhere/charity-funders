<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('funders', function (Blueprint $table) {
            $table->unsignedBigInteger('type_id')->nullable()->after('country_id');
            $table->text('application_procedure')->nullable()->after('type_id');
        });
    }

    public function down()
    {
        Schema::table('funders', function (Blueprint $table) {
            $table->dropColumn('type_id');
            $table->dropColumn('application_procedure');
        });
    }
};