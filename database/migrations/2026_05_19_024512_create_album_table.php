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
Schema::create('album', function (Blueprint $table) {
    $table->id('album_id');
    $table->string('album_nombre');
    $table->string('album_descripcion');
    $table->unsignedBigInteger('usuario_id')->unsigned();
    $table->foreign('usuario_id')->references('id')->on('users');
    $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('album');
    }
};
