<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('checkouts', function (Blueprint $table) {

            $table->id();

            $table->foreignId('user_id')->constrained()->onDelete('cascade');

            $table->string('fullname');
            $table->string('phone');
            $table->text('address');

            $table->string('payment_method');

            $table->decimal('total_price', 10, 2);

            $table->string('status')->default('Pending');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('checkouts');
    }
};