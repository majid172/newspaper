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
        Schema::create('categories', function (Blueprint $table) {

            $table->id();
            $table->string('category_name');
            $table->string('title')->nullable();
            $table->unsignedBigInteger('parent_id')->nullable();
            $table->boolean('header_display')->default(true);
            $table->boolean('menubar_display')->default(true);
            $table->boolean('status')->default(true);
            $table->text('keyword')->nullable();
            $table->string('slug')->unique();
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->unsignedBigInteger('deleted_by')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('parent_id')->references('id')->on('categories')->onDelete('set null');
            $table->foreign('created_by')->references('id')->on('authors')->onDelete('set null');
            $table->foreign('updated_by')->references('id')->on('authors')->onDelete('set null');
            $table->foreign('deleted_by')->references('id')->on('authors')->onDelete('set null');

            $table->index('slug');
            $table->index('category_name');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categories');
    }
};
