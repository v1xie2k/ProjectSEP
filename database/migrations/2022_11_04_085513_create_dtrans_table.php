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
        if(Schema::hasTable('dtrans') == false){
            Schema::create('dtrans', function (Blueprint $table) {
                $table->integer('id_htrans',11)->autoIncrement(false);
                $table->integer('id_menu',11)->autoIncrement(false);
                $table->string('name_menu',255);
                $table->integer('price',11)->autoIncrement(false);
                $table->integer('quantity',11)->autoIncrement(false);
                $table->integer('subtotal',11)->autoIncrement(false);
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
        Schema::dropIfExists('dtrans');
    }
};
