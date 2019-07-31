<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateResponsesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('responses', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('offer_id');
            $table->string('price_offer');
            $table->string('company_id');
            $table->string('company_name');
            $table->string('user_id');
            $table->string('user_name');
            $table->string('currency');
            $table->string('price_offer_extra');
            $table->string('currency_extra');
            $table->integer('is_send_email');
            $table->integer('is_send');
            $table->integer('is_customer_response');
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
        Schema::dropIfExists('responses');
    }
}
