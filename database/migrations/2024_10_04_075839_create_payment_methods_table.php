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
        Schema::create('payment_methods', function (Blueprint $table) {
            $table->string('payment_name')->primary();  
            $table->enum('type', ['Cash', 'E-Wallet', 'Transfer Bank']);
            $table->string('account_holder');  
            $table->string('account_number');  
            $table->boolean('isActivated')->default(true);  // New column to activate or deactivate
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('payment_methods');
    }
};
