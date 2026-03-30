<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('pages', function (Blueprint $table) {
            if (!Schema::hasColumn('pages', 'meta_title')) {
                $table->string('meta_title')->nullable();
            }
            if (!Schema::hasColumn('pages', 'meta_description')) {
                $table->text('meta_description')->nullable();
            }
            if (!Schema::hasColumn('pages', 'meta_keywords')) {
                $table->text('meta_keywords')->nullable();
            }
            if (!Schema::hasColumn('pages', 'status')) {
                $table->enum('status', ['draft', 'published'])->default('published');
            }
        });
    }

    public function down(): void
    {
        Schema::table('pages', function (Blueprint $table) {
            if (Schema::hasColumn('pages', 'meta_title')) {
                $table->dropColumn('meta_title');
            }
            if (Schema::hasColumn('pages', 'meta_description')) {
                $table->dropColumn('meta_description');
            }
            if (Schema::hasColumn('pages', 'meta_keywords')) {
                $table->dropColumn('meta_keywords');
            }
            if (Schema::hasColumn('pages', 'status')) {
                $table->dropColumn('status');
            }
        });
    }
};
