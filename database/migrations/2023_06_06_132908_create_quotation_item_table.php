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
        Schema::create('quotation_item', function (Blueprint $table) {
            $table->id();
            $table->char('status', 1);
            $table->string('product_sisrev_id', 20);
            $table->char('country', 5);
            $table->int('quantity');
            $table->text('description');
            $table->char('product_exists', 1);
            $table->foreign('quotation_id')->references('id')->on('quotation')->onDelete('cascade');
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
        Schema::dropIfExists('quotation_item');
    }
};
