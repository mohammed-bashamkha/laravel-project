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
        Schema::create('jourbal_entries', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->decimal('amount', 12, 2);
            $table->text('description')->nullable();

            // الحساب المدين والدائن (عامل أو مشروع)
            $table->foreignId('debit_entity_id')->nullable()->constrained('entities')->onDelete('set null');
            $table->foreignId('credit_entity_id')->nullable()->constrained('entities')->onDelete('set null');

            // الربط بالعملية المالية (اختياري)
            $table->foreignId('revenue_expense_id')->nullable()->constrained('revenues_expenses')->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jourbal_entries');
    }
};
