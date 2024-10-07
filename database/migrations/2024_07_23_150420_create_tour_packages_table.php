<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tour_packages', function (Blueprint $table) {
            $table->id();
            $table->string('tour_package_code', 4)->unique();
            $table->string('name', 100)->unique();
            $table->decimal('price', 10, 2);
            $table->text('description')->nullable();
            $table->boolean('is_visible')->default(true);
            $table->string('image_icon')->nullable();
            $table->decimal('discount');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tour_packages');
    }
};
