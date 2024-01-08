<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('cards', function (Blueprint $table) {
            $table->id();
            $table->string('stripe_id');
            $table->string('last_four', 4);
            $table->string('brand');
            $table->integer('exp_month');
            $table->integer('exp_year');
            $table->boolean('is_primary')->default(false);
            $table->integer('user_id')->unsigned()->index();
            $table->softDeletes();
            $table->timestamps();
        });
    }
    
    public function down(): void
    {
        Schema::dropIfExists('cards');
    }
};
