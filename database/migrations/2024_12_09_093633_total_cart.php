<?php

use App\Enums\totalCart\statusTotalCart;
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
        Schema::create('totalCart', function (Blueprint $table) {
            $table->id();
            $table->integer('id_cart');
            $table->integer('id_payment');
            $table->date('orderTime');
            $table->string('address');
            $table->string('phoneNumber');
            $table->integer('status')->default(statusTotalCart::WAITING);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('totalCart');
    }
};
