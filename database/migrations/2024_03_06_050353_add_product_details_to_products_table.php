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
        Schema::table('products', function (Blueprint $table) {
            $table->enum('category', ['Stationary', 'Clothing', 'Electronics', 'Accessories', 'Home appliances'])->default('Clothing')->nullable();
            $table->integer('quantity')->default(0)->nullable();
            $table->enum('display', ["Yes", "No"])->nullable();
            $table->string('productimage')->nullable();
            $table->integer('price')->nullable();
            $table->string('product_id');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropForeign(['author_id']);
            $table->dropColumn(['category','quantity','display','productimage','price','author_id']);
        });
    }
};
