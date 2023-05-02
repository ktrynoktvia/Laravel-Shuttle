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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->char('idorder',20);
            $table->string('busname',30);
            $table->string('customername',100);
            $table->string('customeremail',50);
            $table->char('customerphone',20);
            $table->string('customeraddress',100);
            $table->string('total',100);
            $table->string('price',50);
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
