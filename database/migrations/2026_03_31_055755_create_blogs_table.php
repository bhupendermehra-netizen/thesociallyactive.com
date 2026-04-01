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
    Schema::create('blogs', function (Blueprint $table) {
        $table->id();
        $table->string('title');
        $table->string('slug')->unique();
        $table->unsignedBigInteger('category_id')->nullable();
        $table->string('cover_image')->nullable();
        $table->text('description')->nullable();
        $table->longText('content')->nullable();
        $table->string('seo_title')->nullable();
        $table->text('seo_description')->nullable();
        $table->boolean('is_published')->default(true);
        $table->integer('sort_order')->default(0);
        $table->timestamps();
        $table->foreign('category_id')->references('id')->on('blog_categories')->onDelete('set null');
    });
}
public function down(): void { Schema::dropIfExists('blogs'); }
};
