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
        if(Schema::hasTable('history_topup') == false){
            Schema::create('history_topup', function (Blueprint $table) {
                $table->id();
                $table->integer('id_user',11)->autoIncrement(false);
                $table->integer('topup',11)->autoIncrement(false);
                $table->integer('status',1)->autoIncrement(false)->comment('0 for incoming,1 for accepted, if declined then it goes to refund');
                $table->dateTime('date_time')->default(date('Y-m-d H:i:s'));
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
        Schema::dropIfExists('history_topup');
    }
};
