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
        Schema::create('product_type_taxes', function (Blueprint $table) {
            $table->bigInteger('product_type_id');
            $table->bigInteger('tax_id');
            $table->foreign('product_type_id')->references('id')->on('product_types')->onDelete('CASCADE');
            $table->foreign('tax_id')->references('id')->on('taxes')->onDelete('CASCADE');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_type_taxes');
    }
};
