<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePackagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('packages', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('user_id');
            $table->string('order_id');
            $table->string('package_quantity');
            $table->string('package_width');
            $table->string('package_height');
            $table->string('package_length');
            $table->string('package_weight');
            $table->string('package_type');
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
        Schema::dropIfExists('packages');
    }
}
