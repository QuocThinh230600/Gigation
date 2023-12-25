<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoryNewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     * @author Quốc Tuấn <contact.quoctuan@gmail.com>
     */
    public function up()
    {
        Schema::create('category_news', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->constrained()->onDelete('cascade');
            $table->foreignId('news_id')->constrained()->onDelete('cascade');
            $table->softDeletes();
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
        Schema::dropIfExists('category_news');
    }
}
