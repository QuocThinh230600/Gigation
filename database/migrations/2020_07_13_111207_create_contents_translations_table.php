<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContentsTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     * @author Quốc Tuấn <contact.quoctuan@gmail.com>
     */
    public function up()
    {
        Schema::create('contents_translations', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique();
            $table->text('content')->nullable();
            $table->string('image')->nullable();
            $table->string('locale');
            $table->foreignId('content_id')->constrained()->onDelete('cascade');
            $table->softDeletes();
            $table->index(['locale']);
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
        Schema::dropIfExists('contents_translations');
    }
}
