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
        Schema::create('user_distributor', function (Blueprint $table) {
            $table->id();
            $table->foreign('distributor_id')->references('id')->on('distributor')->onDelete('cascade');
            $table->char('type', 1);
            $table->string('name', 200);
            $table->string('mail', 128);
            $table->string('password', 128);
            $table->char('is_active', 1);
            $table->rememberToken();
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
        Schema::dropIfExists('user_distributor');
    }
};
