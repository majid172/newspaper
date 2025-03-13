<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('article_photos', function (Blueprint $table) {

            $table->id();
    $table->unsignedBigInteger('article_id')->nullable();
    $table->string('image');
    $table->text('image_caption')->nullable();
    $table->tinyInteger('status')->default(1);
    $table->unsignedBigInteger('created_by');
    $table->timestamps();
    $table->unsignedBigInteger('updated_by')->nullable();

    $table->foreign('article_id')->references('id')->on('articles')->onDelete('set null');
    $table->foreign('created_by')->references('id')->on('authors')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('article_photos');
    }
};
