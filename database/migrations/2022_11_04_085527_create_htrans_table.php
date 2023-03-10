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
        if(Schema::hasTable('htrans') == false){
            Schema::create('htrans', function (Blueprint $table) {
                $table->id();
                $table->integer('id_user',11)->autoIncrement(false);
                $table->integer('id_ekspedisi',11)->autoIncrement(false);
                $table->integer('quantity',11)->autoIncrement(false);
                $table->integer('total',11)->autoIncrement(false);
                $table->date('date')->default(date('Y-m-d'));
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
        Schema::dropIfExists('htrans');
    }
};
