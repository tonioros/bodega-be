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
        Schema::create('ingredient_warehouse', function (Blueprint $table) {
            $table->id();
            $table->string("name")->unique();
            $table->string("total_available");
            $table->timestamps();
        });

        Schema::create('market_purchases', function (Blueprint $table) {
            $table->id();
            $table->dateTime("request_date");
            $table->bigInteger("ingredient_id");
            $table->integer("total_purchased");
            $table->foreign("ingredient_id")->references("id")->on("ingredient_warehouse");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ingredient_warehouse');
        Schema::dropIfExists('market_purchases');
    }
};
