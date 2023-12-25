<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePayordersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     * @author Quốc Tuấn <contact.quoctuan@gmail.com>
     */
    public function up()
    {
        Schema::create('payorders', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('fullname')->nullable();
            $table->string('email')->nullable();
            $table->string('address')->nullable();
            $table->string('phone')->nullable();
            $table->string('note')->nullable();
            $table->integer('status')->default(4);
            $table->integer('payment_method')->default(1);
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     * @author Quốc Tuấn <contact.quoctuan@gmail.com>
     */
    public function down()
    {
        Schema::dropIfExists('payorders');
    }
}
