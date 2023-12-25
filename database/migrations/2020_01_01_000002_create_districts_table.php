<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDistrictsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     * @author Quốc Tuấn <contact.quoctuan@gmail.com>
     */
    public function up()
    {
        Schema::create(config('vietnam-zone.tables.districts'), function (Blueprint $table) {
            $table->id();
            $table->string(config('vietnam-zone.columns.name'));
            $table->string(config('vietnam-zone.columns.gso_id'));
            $table->string('status')->default('on');
            $table->string('featured')->default('off');
            $table->unsignedBigInteger(config('vietnam-zone.columns.province_id'));
            $table->foreign(config('vietnam-zone.columns.province_id'))
                ->references('id')
                ->on(config('vietnam-zone.tables.provinces'))
                ->cascadeOnDelete();
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
        Schema::dropIfExists(config('vietnam-zone.tables.districts'));
    }
}
