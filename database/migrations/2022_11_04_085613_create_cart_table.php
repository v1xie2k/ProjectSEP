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
        if(Schema::hasTable('cart') == false){
            Schema::create('cart', function (Blueprint $table) {
                $table->integer('id_user',11)->autoIncrement(false);
                $table->integer('id_menu',11)->autoIncrement(false);
                $table->string('name_menu',255);
                $table->integer('price',11)->autoIncrement(false);
                $table->integer('quantity',11)->autoIncrement(false);
                $table->integer('subtotal',11)->autoIncrement(false);
                $table->timestamps();
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
        Schema::dropIfExists('cart');
    }
};
