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
        Schema::create('transactions', function (Blueprint $table) {
            
           $table->string('transaction_code', 20)->primary();

           $table->string('name');
           $table->string('email');
           $table->string('noTelp');
           
           $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('set null'); // or ->onDelete('cascade') if you want to delete transactions when a user is deleted

           $table->string('payment_method');

           $table->date('visit_date');

           $table->enum('status', ['pending', 'processing', 'invoice', 'completed', 'rejected', 'refunded'])->default('pending');

           $table->double('discount')->default(0);

           $table->double('quantity')->default(1);

           $table->double('price')->default(0);

           $table->string('package_name')->default('');

           $table->timestamp('transaction_date')->useCurrent();

           $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
