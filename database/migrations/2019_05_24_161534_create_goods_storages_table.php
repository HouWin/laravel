<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGoodsStoragesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('goods_storages', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('goods_name');
            $table->decimal('goods_price');
            $table->string('desc');
            $table->string('image');
            $table->string('weight');
            $table->string('packaging');
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
        Schema::dropIfExists('goods_storages');
    }
}
