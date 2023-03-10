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
        if(Schema::hasTable('users') == false){
            Schema::create('users', function (Blueprint $table) {
                $table->id()->key();
                $table->string('name',255);
                $table->text('email');
                $table->text('password');
                $table->text('alamat');
                $table->integer('saldo',11)->autoIncrement(false);
                $table->enum("role",["admin","user"])->default("user")->comment("ini role usernya");
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
        Schema::dropIfExists('users');
    }
};
