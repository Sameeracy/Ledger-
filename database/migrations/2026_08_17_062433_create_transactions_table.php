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
    Schema::create('transactions', function (Blueprint $table) {
        $table->id();
        $table->foreignId('user_id')->constrained()->cascadeOnDelete();
        $table->string('title');
        $table->string('person_name');
        // 'you_owe' (money you owe) or 'they_owe' (money owed to you)
        $table->enum('type', ['you_owe', 'they_owe']);
        $table->decimal('amount', 12, 2);
        $table->date('transaction_date');
        // Status to track if the amount is pending or settled/paid
        $table->enum('status', ['pending', 'settled'])->default('pending');
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
