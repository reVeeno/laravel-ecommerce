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
        Schema::create('goods', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_shop')->unsigned();
            $table->integer('id_category')->unsigned();
            $table->string('goods_code');
            $table->string('goods_name');
            $table->string('image');
            $table->string('price');
            $table->text('description');
            $table->integer('stock');
            $table->string('color')->nullable();
            $table->foreign('id_shop')->references('id')->on('shop')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('id_category')->references('id')->on('category')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('goods');
    }
};
