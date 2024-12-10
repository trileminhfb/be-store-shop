<?php

use App\Enums\gender\gender;
use App\Enums\product\statusProduct;
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
        Schema::create('product', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('price');
            $table->string('description')->nullable();
            $table->string('image');
            $table->integer('quantity');
            $table->integer('status')->default(statusProduct::AVAILABLE);
            $table->string('category')->nullable();
            $table->string('brand')->nullable();
            $table->integer('gender')->default(gender::MEN);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product');
    }
};
