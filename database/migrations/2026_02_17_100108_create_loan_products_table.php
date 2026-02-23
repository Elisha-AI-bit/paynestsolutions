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
        Schema::create('loan_products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->decimal('interest_min', 5, 2);
            $table->decimal('interest_max', 5, 2);
            $table->decimal('max_amount', 15, 2);
            $table->integer('min_duration'); // in months
            $table->integer('max_duration'); // in months
            $table->string('employment_type_required'); // government, marketer, business
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('loan_products');
    }
};
