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
        Schema::create('distributor', function (Blueprint $table) {
            $table->id();
            $table->string('name', 200);
            $table->char('is_active', 1);
            $table->string('cif_fregiht', 50);
            $table->string('profit_margin_option', 50);
            $table->string('profit_margin_value', 50);
            $table->char('allow_quotation', 1);
            $table->char('allow_product_report', 1);
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
        Schema::dropIfExists('distributor');
    }
};
