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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('number')->nullable();
            $table->integer('user_id')->index()->unsigned();
            $table->integer('card_id')->index()->unsigned()->nullable();
            $table->integer('address_id')->index()->unsigned();
            $table->integer('carrier_id')->index()->unsigned()->nullable();
            $table->string('shipping_time')->nullable();
            $table->integer('shipping')->nullable();
            $table->integer('tax')->nullable();
            $table->integer('subtotal')->nullable();
            $table->integer('total')->nullable();
            $table->string('tracking_number')->nullable();
            $table->dateTime('closed_at')->nullable();
            $table->text('notes')->nullable();

            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
