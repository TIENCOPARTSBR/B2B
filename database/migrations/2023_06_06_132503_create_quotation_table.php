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
        Schema::create('quotation', function (Blueprint $table) {
            $table->id();
            $table->char('status', 1);
            $table->string('customer_name', 100);
            $table->string('requester_quotation', 100);
            $table->char('quotation_type', 1);
            $table->text('general_observation');
            $table->char('urgent', 1);
            $table->date('reply_date');
            $table->foreign('direct_distributor_id')->references('id')->on('direct_distributor')->onDelete('cascade');
            $table->foreign('distributor_id')->references('id')->on('distributor')->onDelete('cascade');
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
        Schema::dropIfExists('quotation');
    }
};
