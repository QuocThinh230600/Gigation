<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePagesTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     * @author Quốc Tuấn <contact.quoctuan@gmail.com>
     */
    public function up()
    {
        Schema::create('pages_translations', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique();
            $table->string('name')->nullable();
            $table->text('content')->nullable();
            $table->string('image')->nullable();
            $table->string('title_tag')->nullable();
            $table->string('meta_keywords')->nullable();
            $table->string('meta_description')->nullable();
            $table->string('meta_robots')->nullable();
            $table->string('meta_google_bot')->nullable();
            $table->string('locale');
            $table->foreignId('page_id')->constrained()->onDelete('cascade');
            $table->index(['name', 'locale']);
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
        Schema::dropIfExists('pages_translations');
    }
}
