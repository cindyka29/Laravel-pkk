<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    
    public function up()
    {
        Schema::create('kasumums', function (Blueprint $table) {
            $table->id('id');
            $table->string('keterangan');
            $table->integer('jumlah');
            $table->DateTime('tanggal');
            $table->boolean('isPemasukan');
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
        Schema::dropIfExists('kasumums');
    }
};
