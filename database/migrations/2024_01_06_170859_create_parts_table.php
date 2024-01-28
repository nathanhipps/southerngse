<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    public function up(): void
    {
        Schema::create('parts', function (Blueprint $table) {
            $table->id();
            $table->string('sku');
            $table->string('description');
            $table->integer('price');
            $table->integer('cost')->nullable();
            $table->integer('inventory')->default(0);
            $table->bigInteger('lead_time_in_days')->default(0);
            $table->string('slug');
            $table->string('image_path')->nullable();
            $table->string('manufacturer_id')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('parts');
    }
};
