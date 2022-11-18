<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pesanan', function (Blueprint $table) {
            $table->id();
            $table->string('ticket', 15);
            $table->string('order_id', 30)->nullable();
            $table->string('nama', 50);
            $table->string('no_wa', 20);
            $table->string('alamat');
            $table->dateTime('pesanan_diambil');
            $table->longText('pesanan');
            $table->tinyInteger('status_admin');
            $table->string('payment_type')->nullable();
            $table->string('transaction_id')->nullable();
            $table->string('status')->nullable();
            $table->integer('status_code')->nullable();
            $table->string('gross_amount')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pesanans');
    }
};
