<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     * @author Quốc Tuấn <contact.quoctuan@gmail.com>
     */
    public function up()
    {
        Schema::create('news', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique();
            $table->string('date_start')->nullable();
            $table->string('time_start')->nullable();
            $table->string('date_end')->nullable();
            $table->string('time_end')->nullable();
            $table->integer('position')->default(1);
            $table->string('access')->nullable();
            $table->string('open_link')->default('_self');
            $table->tinyInteger('status')->default(1);
            $table->string('featured')->nullable();
            $table->integer('template')->default(1);
            $table->integer('viewed')->default(100);
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->softDeletes();
            $table->index(['status', 'featured', 'template']);
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
        Schema::dropIfExists('news');
    }
}
