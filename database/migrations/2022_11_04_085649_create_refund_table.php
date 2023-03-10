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
        if(Schema::hasTable('refund') == false){
            Schema::create('refund', function (Blueprint $table) {
                $table->id();
                $table->integer('id_user',11)->autoIncrement(false);
                $table->integer('subtotal',11)->autoIncrement(false);
                $table->string('name_admin',255);
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
        Schema::dropIfExists('refund');
    }
};
