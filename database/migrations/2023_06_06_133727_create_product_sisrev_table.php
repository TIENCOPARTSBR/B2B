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
        Schema::create('product_sisrev', function (Blueprint $table) {
            $table->id();
            $table->string('part_number', 20);
            $table->string('descricao_br', 100);
            $table->string('descricao_en', 100);
            $table->string('descricao_es', 100);
            $table->float('saldo_br');
            $table->float('saldo_eua');
            $table->float('custo_liquido_br');
            $table->float('custo_liquido_eua');
            $table->float('peso');
            $table->char('status_color', 1);
            $table->string('local_fornecimento_br', 5);
            $table->string('local_fornecimento_usa', 5);
            $table->string('minimum_quantity_order', 100);
            $table->string('lead_time_eua', 100);
            $table->string('lead_time_br', 100);
            $table->string('ncm', 50);
            $table->string('hscode', 50);
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
        Schema::dropIfExists('product_sisrev');
    }
};
