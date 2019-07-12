<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOffersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('offers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('submit_action')->nullable();
            $table->string('from_name');
            $table->string('from_company_name');
            $table->string('from_lat');
            $table->string('from_lng');
            $table->string('from_address_name');
            $table->string('from_address_id');
            $table->string('from_zip_code');
            $table->string('to_name');
            $table->string('to_company_name');
            $table->string('to_lat');
            $table->string('to_lng');
            $table->string('to_address_name');
            $table->string('to_address_id');
            $table->string('to_zip_code');
            $table->timestamp('from_date');
            $table->timestamp('to_date');
            $table->timestamp('note');
            $table->string('user_id');
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
        Schema::dropIfExists('offers');
    }
}
