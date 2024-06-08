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
        Schema::create('shop', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_user')->unsigned();
            $table->string('shop_name');
            $table->enum('shop_category',['electronic','automotive','groceries','fashion','foods','pharmacy','accessories','furniture']);
            $table->text('shop_desc');
            $table->string('opening_day');
            $table->time('opening_time');
            $table->string('holiday');
            $table->boolean('active_status')->default(0);
            $table->string('shop_pic')->default('default-toko.png');
            $table->foreign('id_user')->on('users')->references('id')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shop');
    }
};
