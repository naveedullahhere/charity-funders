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
        Schema::table('users', function (Blueprint $table) {
            $table->string('nic')->nullable();
            $table->string('contact_no')->nullable();
            $table->date('dob')->nullable();
            $table->string('bio')->nullable();
            $table->string('profile_image')->nullable();
            $table->string('signature_image')->nullable();
            $table->string('designation')->nullable();
            //Security concern
            $table->string('security')->default(0)->comment('0=No security , 1 = Email verification , 2 = Authentiator App');
            $table->boolean('active_status')->default(0);
            $table->longText('google2fa_secret')->nullable();
            $table->boolean('google2fa_enabled')->default(false);
            $table->integer('can_login')->default(1);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
