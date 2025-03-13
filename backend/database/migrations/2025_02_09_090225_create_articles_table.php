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
        Schema::create('articles', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('author_id')->nullable();
            $table->unsignedBigInteger('placement_id')->nullable();
            $table->text('shoulder')->nullable();
            $table->text('headline')->nullable();
            $table->text('hanger')->nullable();
            $table->string('url_title')->nullable()->unique();
            $table->text('video_code')->nullable();
            $table->text('thumbnail')->nullable();
            $table->text('thumbnail_caption')->nullable();
            $table->text('description')->nullable();
            $table->text('tags');
            $table->unsignedBigInteger('division_id')->nullable();
            $table->unsignedBigInteger('district_id')->nullable();
            $table->unsignedBigInteger('upazila_id')->nullable();
            $table->integer('total_hit')->default(0);
            $table->integer('order_id')->nullable();
            $table->integer('display_order_id')->nullable();
            $table->boolean('home_page_visibility')->default(false);
            $table->enum('status', ['draft', 'published', 'scheduled', 'canceled'])->default('draft');
            $table->unsignedBigInteger('created_by');
            $table->unsignedBigInteger('updated_by')->nullable();

            $table->timestamps();



            $table->foreign('author_id')->references('id')->on('authors')->onDelete('set null');
            $table->foreign('division_id')->references('id')->on('divisions')->onDelete('set null');
            $table->foreign('district_id')->references('id')->on('districts')->onDelete('set null');
            $table->foreign('upazila_id')->references('id')->on('upazilas')->onDelete('set null');
            $table->foreign('placement_id')->references('id')->on('placements')->onDelete('set null');
            $table->foreign('created_by')->references('id')->on('authors')->onDelete('restrict');

            $table->index('url_title');
            $table->index('author_id');
            $table->index('placement_id');
            $table->index('division_id');
            $table->index('district_id');
            $table->index('upazila_id');
            $table->index('status');
            $table->index('created_by');
            $table->index('home_page_visibility');
            $table->index('tags');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('articles');
    }
};
