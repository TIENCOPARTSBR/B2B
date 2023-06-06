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
        Schema::create('direct_distributor', function (Blueprint $table) {
            $table->id();
            $table->string('name', 200);
            $table->char('is_active', 1);
            $table->string('cif_fregiht', 50);
            $table->string('general_value', 50);
            $table->string('option_general_value', 50);
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
        Schema::dropIfExists('direct_distributor');
    }
};
