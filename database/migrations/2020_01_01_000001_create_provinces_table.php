<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProvincesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     * @author Quốc Tuấn <contact.quoctuan@gmail.com>
     */
    public function up()
    {
        Schema::create(config('vietnam-zone.tables.provinces'), function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('gso_id');
            $table->string('status')->default('on');
            $table->string('featured')->default('off');
            $table->softDeletes();
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
        Schema::dropIfExists(config('vietnam-zone.tables.provinces'));
    }
}
