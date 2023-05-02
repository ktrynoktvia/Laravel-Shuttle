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
        Schema::create('shuttles', function (Blueprint $table) {
            $table->id();
            $table->char('idbus',12);
            $table->string('busname',30);
            $table->string('location',100);
            $table->string('address',100);
            $table->string('website',50);
            $table->string('email',50);
            $table->char('callcenter',20);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shuttles');
    }
};
