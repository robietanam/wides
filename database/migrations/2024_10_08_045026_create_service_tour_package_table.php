<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('service_tour_package', function (Blueprint $table) {
            $table->id();
            $table->foreignId('service_id')->constrained()->onDelete('restrict');
            $table->foreignId('tour_package_id')->constrained()->onDelete('restrict');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('service_tour_package');
}

};
