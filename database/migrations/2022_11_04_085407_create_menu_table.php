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
        if(Schema::hasTable('menu') == false){
            Schema::create('menu', function (Blueprint $table) {
                $table->id();
                $table->integer('id_kategori',11)->autoIncrement(false);
                $table->string('name',255);
                $table->integer('harga',11)->autoIncrement(false);
                $table->text('deskripsi');
                $table->timestamps();
                $table->softDeletes();
            });
        }

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('menu');
    }
};
