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
        Schema::create('contactusquery', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->nullable();
            $table->string("name");
            $table->string("email");
            $table->string("phone",20);
            $table->text("message");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contactusquery');
    }
};
