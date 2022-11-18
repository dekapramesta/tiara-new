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
        Schema::create('t_menu', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_jenis')
                ->constrained('t_jenisMenu')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->string('nama', 50);
            $table->integer('harga');
            $table->string('gambar', 100);
            $table->longText('deskripsi')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('t_menu');
    }
};
