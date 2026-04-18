<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('prescription_orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('patient_id')->constrained('users')->cascadeOnDelete();
            $table->foreignId('pharmacist_id')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('pharmacy_stock_id')->constrained('pharmacy_stocks')->cascadeOnDelete();
            $table->integer('quantity')->default(1);
            $table->string('status')->default('pending');
            $table->text('instructions')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('prescription_orders');
    }
};
