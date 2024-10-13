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
        Schema::create('site_infos', function (Blueprint $table) {
            $table->id();
            $table->string('address');
            $table->string('phone_number');
            $table->string('contact_person');
            $table->string('contact_person_transaction');
            $table->string('email');
            $table->string('facebook');
            $table->string('instagram');
            $table->string('landing_image')->nullable(); 
            $table->string('video_profile')->nullable(); 
            $table->json('gallery')->nullable();    
            $table->string('profile_title');
            $table->string('profile_desc');   
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('site_infos');
    }
};
