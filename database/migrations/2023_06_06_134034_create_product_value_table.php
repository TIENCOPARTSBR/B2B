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
        Schema::create('product_value', function (Blueprint $table) {
            $table->id();
            $table->string('part_number', 20);
            $table->string('product_value', 50);
            $table->string('value_type', 50);
            $table->foreign('distributor_id')->references('id')->on('distributor')->onDelete('cascade');
            $table->foreign('direct_distributor_id')->references('id')->on('direct_distributor')->onDelete('cascade');
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
        Schema::dropIfExists('product_value');
    }
};
