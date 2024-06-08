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
        Schema::create('payment', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_basket')->unsigned();
            $table->text('shipping_address');
            $table->string('expedition');
            $table->enum('payment_status',['successful', 'failed', 'cancelled'])->default('successful');
            $table->foreign('id_basket')->references('id')->on('basket')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payment');
    }
};
